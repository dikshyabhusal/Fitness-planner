<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPlanProgress extends Model
{
    protected $fillable = ['student_id', 'plan_id', 'current_day'];

    
    public function workoutPlan()
{
    return $this->belongsTo(WorkoutPlan::class, 'workout_plans_id');
}
}
