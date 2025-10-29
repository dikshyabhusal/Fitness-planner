<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Tokenization\WhitespaceTokenizer;
use App\Models\WorkoutPlan;
use App\Models\Exercise;
use App\Models\ExerciseVideo;
use App\Models\DietCategory;

class TFIDFService
{
    protected $vectorizer;
    protected $tfidf;
    protected $documents; // array of strings
    protected $meta;

    public function __construct()
    {
        $this->vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
        $this->tfidf = null;
        $this->documents = [];
        $this->meta = [];
    }

    public function buildCorpusAndModel(bool $forceRebuild = false)
    {
        $cacheKey = 'tfidf_model_v1';
        $cacheTtl = 3600;

        if (!$forceRebuild && Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);
            $this->documents = $cached['documents'];
            $this->meta = $cached['meta'];

            // Ensure all documents are strings
            $this->documents = array_map(fn($d) => is_array($d) ? implode(' ', $d) : $d, $this->documents);

            $this->vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
            $this->vectorizer->fit($this->documents);
            $this->vectorizer->transform($this->documents);

            $this->tfidf = new TfIdfTransformer($this->documents);
            $this->tfidf->transform($this->documents);

            return;
        }

        $this->documents = [];
        $this->meta = [];

        $addDoc = function ($text, $meta) {
            $text = $this->normalizeText($text);
            if ($text === '') {
                $text = 'empty';
            }
            $this->documents[] = $text;
            $this->meta[] = $meta;
        };

        // Workout Plans
        foreach (WorkoutPlan::select('id','title','description')->get() as $w) {
            $addDoc(($w->title ?? '') . ' ' . ($w->description ?? ''), ['type'=>'workout','id'=>$w->id]);
        }

        // Diet Categories
        foreach (DietCategory::select('id','goal','target_area')->get() as $d) {
            $addDoc(($d->goal ?? '') . ' ' . ($d->target_area ?? ''), ['type'=>'diet_category','id'=>$d->id]);
        }

        // Exercises
        foreach (Exercise::select('id','title','coach_tips','how_to_start','precautions')->get() as $e) {
            $addDoc(($e->title ?? '') . ' ' . ($e->coach_tips ?? '') . ' ' . ($e->how_to_start ?? '') . ' ' . ($e->precautions ?? ''), ['type'=>'exercise','id'=>$e->id]);
        }

        // Exercise Videos
        foreach (ExerciseVideo::select('id','title','description','body_part','goal')->get() as $v) {
            $addDoc(($v->title ?? '') . ' ' . ($v->description ?? '') . ' ' . ($v->body_part ?? '') . ' ' . ($v->goal ?? ''), ['type'=>'exercise_video','id'=>$v->id]);
        }

        if (empty($this->documents)) {
            $this->documents = ['empty'];
            $this->meta = [['type'=>'none','id'=>0]];
        }

        // Fit & transform
        $this->vectorizer->fit($this->documents);
        $this->vectorizer->transform($this->documents);

        $this->tfidf = new TfIdfTransformer($this->documents);
        $this->tfidf->transform($this->documents);

        Cache::put($cacheKey, [
            'documents' => $this->documents,
            'meta' => $this->meta,
        ], $cacheTtl);
    }

    public function recommend(string $query, int $limit = 10): array
    {
        if (is_null($this->tfidf) || empty($this->documents)) {
            $this->buildCorpusAndModel(false);
        }

        $query = $this->normalizeText($query);
        if ($query === '') return [];

        // Transform query for TF-IDF
        $qDocs = [$query];
        $this->vectorizer->transform($qDocs);
        $this->tfidf->transform($qDocs);

        $queryVector = $qDocs[0];
        $scores = [];

        foreach ($this->documents as $i => $docVector) {
            $score = $this->cosineSimilarity($queryVector, $docVector);
            if ($score > 0) {
                $scores[] = ['index' => $i, 'score' => $score];
            }
        }

        // Fallback: exact keyword match for all types
        if (empty($scores)) {
            foreach ($this->meta as $i => $meta) {
                $record = $this->fetchRecord($meta);
                if (!$record) continue;

                $fields = [];
                switch ($meta['type']) {
                    case 'workout':
                        $fields[] = $record->title ?? '';
                        $fields[] = $record->description ?? '';
                        break;
                    case 'diet_category':
                        $fields[] = $record->goal ?? '';
                        $fields[] = $record->target_area ?? '';
                        break;
                    case 'exercise':
                        $fields[] = $record->title ?? '';
                        $fields[] = $record->coach_tips ?? '';
                        $fields[] = $record->how_to_start ?? '';
                        $fields[] = $record->precautions ?? '';
                        break;
                    case 'exercise_video':
                        $fields[] = $record->title ?? '';
                        $fields[] = $record->description ?? '';
                        $fields[] = $record->body_part ?? '';
                        $fields[] = $record->goal ?? '';
                        break;
                }

                $text = strtolower(implode(' ', $fields));
                if (str_contains($text, strtolower($query))) {
                    $record->relevance_score = 1.0;
                    $scores[] = ['index'=>$i,'score'=>1.0];
                }
            }
        }

        usort($scores, fn($a,$b) => $b['score'] <=> $a['score']);

        $results = [];
        foreach (array_slice($scores,0,$limit) as $s) {
            $meta = $this->meta[$s['index']] ?? null;
            if (!$meta) continue;
            $record = $this->fetchRecord($meta);
            if ($record) {
                $record->relevance_score = $s['score'];
                $results[] = $record;
            }
        }

        return $results;
    }

    protected function fetchRecord(array $meta)
    {
        return match($meta['type']) {
            'workout' => WorkoutPlan::find($meta['id']),
            'diet_category' => DietCategory::find($meta['id']),
            'exercise' => Exercise::find($meta['id']),
            'exercise_video' => ExerciseVideo::find($meta['id']),
            default => null,
        };
    }

    protected function cosineSimilarity(array $a, array $b): float
    {
        $dot = $normA = $normB = 0.0;
        $len = max(count($a), count($b));
        for ($i=0;$i<$len;$i++){
            $x = $a[$i] ?? 0.0;
            $y = $b[$i] ?? 0.0;
            $dot += $x*$y;
            $normA += $x*$x;
            $normB += $y*$y;
        }
        if ($normA==0.0 || $normB==0.0) return 0.0;
        return $dot/(sqrt($normA)*sqrt($normB));
    }

    protected function normalizeText($text): string
    {
        if (is_array($text)) $text = implode(' ', $text);
        $s = mb_strtolower(strip_tags((string)$text));
        $s = preg_replace('/[^a-z0-9\s]+/u', ' ', $s);
        $s = preg_replace('/\s+/', ' ', $s);
        return trim($s);
    }
}
