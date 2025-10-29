<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TFIDFService;

class TFIDFController extends Controller
{
    protected $tfidf;

    public function __construct(TFIDFService $tfidf)
    {
        $this->tfidf = $tfidf;
    }

    public function recommend(Request $request)
    {
        $user = Auth::user();
        $q = $request->get('q');

        if (!$q && $user) {
            $parts = [];
            if (!empty($user->goal)) $parts[] = $user->goal;
            if (!empty($user->target_area)) $parts[] = $user->target_area;
            $q = implode(' ', $parts);
        }

        if (!$q) {
            return back()->with('error','Please provide a search query or set your goal in your profile.');
        }

        $this->tfidf->buildCorpusAndModel();

        $limit = (int)$request->get('limit',10);
        $results = $this->tfidf->recommend($q, $limit);

        return view('search.results', [
            'query' => $q,
            'results' => $results
        ]);
    }
}
