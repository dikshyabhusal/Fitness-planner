<?php

namespace App\Services;

use App\Models\Exercise;
use App\Models\User;

class ExerciseRecommender
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Recommend exercises based on user activity level
     * Fallback to random exercises if none matched
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recommend($limit = 5)
    {
        $activity_level = $this->user->activity_level;

        $query = Exercise::query();

        // Recommend by activity level
        if ($activity_level === 'low') {
            $query->whereIn('exercise_category_id', [1, 2, 3]);
        } elseif ($activity_level === 'medium') {
            $query->whereIn('exercise_category_id', [4, 5, 6]);
        } elseif ($activity_level === 'high') {
            $query->whereIn('exercise_category_id', [7, 8, 9]);
        }

        $exercises = $query->inRandomOrder()->limit($limit)->get();

        // Fallback if no exercises found
        if ($exercises->isEmpty()) {
            $exercises = Exercise::inRandomOrder()->limit($limit)->get();
        }

        return $exercises;
    }
}
