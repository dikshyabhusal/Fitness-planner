<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietCategory extends Model
{
    protected $fillable = ['goal', 'target_area'];

    public function dietPlans()
    {
        return $this->hasMany(DietPlan::class);
    }
    public function plans()
    {
        return $this->hasMany(DietPlan::class);
    }

}
