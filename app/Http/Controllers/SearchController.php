<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\WorkoutPlan;
use App\Models\ExerciseVideo;
use App\Models\DietPlan;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Tokenization\WhitespaceTokenizer;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->input('q'));
        if (!$query) {
            return redirect()->back()->with('error', 'Please enter something to search.');
        }

        // Step 1: Gather all documents (title + description)
        $data = collect();

        $exercises = Exercise::all();
        $workouts  = WorkoutPlan::all();
        $videos    = ExerciseVideo::all();
        $diets     = DietPlan::all();

        foreach ($exercises as $e)
            $data->push(['type' => 'Exercise', 'id' => $e->id, 'text' => $e->title . ' ' . $e->description]);

        foreach ($workouts as $w)
            $data->push(['type' => 'Workout', 'id' => $w->id, 'text' => $w->title . ' ' . $w->goal]);

        foreach ($videos as $v)
            $data->push(['type' => 'Video', 'id' => $v->id, 'text' => $v->title . ' ' . $v->description]);

        foreach ($diets as $d)
            $data->push(['type' => 'DietPlan', 'id' => $d->id, 'text' => $d->title . ' ' . $d->goal]);

        // Step 2: Build TF-IDF model
        $documents = $data->pluck('text')->toArray();

        $vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
        $vectorizer->fit($documents);
        $vectorizer->transform($documents);

        $tfidf = new TfIdfTransformer($documents);
        $tfidf->transform($documents);

        // Step 3: Transform query to vector
        $queryVector = [$query];
        $vectorizer->transform($queryVector);
        $tfidf->transform($queryVector);
        $queryVector = $queryVector[0];

        // Step 4: Calculate cosine similarity between query and documents
        $results = [];
        foreach ($documents as $i => $docVector) {
            $similarity = $this->cosineSimilarity($queryVector, $docVector);
            if ($similarity > 0) {
                $results[] = [
                    'type' => $data[$i]['type'],
                    'id' => $data[$i]['id'],
                    'score' => $similarity,
                ];
            }
        }

        // Step 5: Sort by relevance (highest similarity first)
        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

        // Step 6: Group results by type
        $grouped = [
            'exercises' => [],
            'workouts' => [],
            'videos' => [],
            'dietPlans' => [],
        ];

        foreach ($results as $res) {
            switch ($res['type']) {
                case 'Exercise':  $grouped['exercises'][] = $exercises->find($res['id']); break;
                case 'Workout':   $grouped['workouts'][]  = $workouts->find($res['id']);  break;
                case 'Video':     $grouped['videos'][]    = $videos->find($res['id']);    break;
                case 'DietPlan':  $grouped['dietPlans'][] = $diets->find($res['id']);     break;
            }
        }

        return view('search.results', [
            'query' => $query,
            'exercises' => collect($grouped['exercises']),
            'workouts' => collect($grouped['workouts']),
            'videos' => collect($grouped['videos']),
            'dietPlans' => collect($grouped['dietPlans']),
        ]);
    }

    private function cosineSimilarity($vec1, $vec2)
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;
        foreach ($vec1 as $i => $val) {
            $dotProduct += $val * ($vec2[$i] ?? 0);
            $normA += $val ** 2;
        }
        foreach ($vec2 as $val) {
            $normB += $val ** 2;
        }
        return ($normA && $normB) ? $dotProduct / (sqrt($normA) * sqrt($normB)) : 0;
    }
}
