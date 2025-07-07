<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = [
    'user_id',
    'workout_plan_id',
    'date',
    'workout_done',
    'diet_done',
];

}
