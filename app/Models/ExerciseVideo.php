<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseVideo extends Model
{
    protected $fillable = ['trainer_id', 'title', 'description', 'video_path', 'body_part', 'goal', 'duration'];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}

