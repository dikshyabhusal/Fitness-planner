<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDietPlan extends Model
{
     protected $fillable = [
        'user_id',
        'diet_category_id',
        'day_number',
        'meal_time',
        'meal',
    ];

    public function category()
    {
        return $this->belongsTo(DietCategory::class, 'diet_category_id');
    }
}
