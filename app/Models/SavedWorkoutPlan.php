<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedWorkoutPlan extends Model
{
    protected $fillable = [
        'student_id', 'workout_plan_id',
    ];

    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
