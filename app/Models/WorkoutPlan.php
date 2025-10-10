<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    protected $fillable = [
        'trainer_id', 'title', 'description', 'gender', 'duration_days','image','difficulty_level',
    ];
    public function trainer()
{
    return $this->belongsTo(User::class, 'trainer_id');
}

public function days()
{
    return $this->hasMany(WorkoutDay::class);
}
public function savedByUsers() {
    return $this->belongsToMany(User::class, 'saved_workout_plans');
}
public function reviews()
{
    return $this->hasMany(Review::class);
}
public function savedBy()
    {
        return $this->belongsToMany(
            User::class,
            'saved_workout_plans', // pivot table
            'workout_plan_id',     // this model's FK in pivot
            'student_id'              // related model's FK in pivot
        )->withTimestamps();
    }
 public function savedPlans()
    {
        return $this->hasMany(SavedWorkoutPlan::class, 'workout_plan_id', 'id');
    }
    // Relationship to workout days
    
}
