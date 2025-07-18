<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    protected $fillable = [
        'trainer_id', 'title', 'description', 'gender', 'duration_days',
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

}
