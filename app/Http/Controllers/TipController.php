<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;
use Illuminate\Support\Facades\Cache;

class TipController extends Controller
{
    public function random()
    {
        // Fetch random tip
        $tip = Tip::inRandomOrder()->first();

        // If no tip found, show a fallback message
        if (!$tip) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tips available yet.'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'tip' => $tip->text
        ]);
    }
}
