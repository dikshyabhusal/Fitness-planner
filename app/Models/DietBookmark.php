<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietBookmark extends Model
{
    protected $fillable = ['user_id', 'diet_category_id'];

    public function category()
    {
        return $this->belongsTo(DietCategory::class, 'diet_category_id');
    }
}
