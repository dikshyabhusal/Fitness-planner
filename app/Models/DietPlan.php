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


}
