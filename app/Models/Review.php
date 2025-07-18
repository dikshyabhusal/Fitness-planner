<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['student_id', 'trainer_id', 'workout_plan_id', 'rating', 'comment'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }
}
