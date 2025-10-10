<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    protected $fillable = [
        'workout_plan_id',
        'day_number',
        'meal_time',
        'meal',
    ];

    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }
    public function category()
    {
        return $this->belongsTo(DietCategory::class, 'diet_category_id');
    }
    

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
        public function savedPlans()
            {
                return $this->hasMany(SavedDietPlan::class, 'diet_plan_id', 'id');
            }
public function savedBy()
    {
        return $this->belongsToMany(
            User::class,
            'saved_diet_plans', // pivot table
            'diet_plan_id',     // this model's FK in pivot
            'student_id'           // related model's FK in pivot
        )->withTimestamps();
    }

    // Relationship to diet days
    public function days()
    {
        return $this->hasMany(DietDay::class);
    }
}
