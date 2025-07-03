<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutDay extends Model
{
     protected $fillable = [
        'workout_plan_id', 'day_number', 'title', 'description',
    ];

    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }
}
