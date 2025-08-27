<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'user_id',
        'exercise_category_id',
        'title',
        'coach_tips',
        'precautions',
        'how_to_start',
        'photo',
        'video',
        'views',
    ];

    public function category()
    {
        return $this->belongsTo(ExerciseCategory::class, 'exercise_category_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Exercise.php


}

