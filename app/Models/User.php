<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'age',
        'height',
        'weight',
        'goal',
        'activity_level',
        'daily_calorie_need',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function workoutPlans()
    {
        return $this->hasMany(WorkoutPlan::class, 'trainer_id');
    }
    public function savedWorkouts()
{
    return $this->belongsToMany(WorkoutPlan::class, 'saved_workout_plans', 'student_id', 'workout_plan_id');
}
public function receivedReviews()
{
    return $this->hasMany(Review::class, 'trainer_id');
}
public function orders()
{
    return $this->hasMany(Order::class, 'student_id');
}
public function dietPlans()
{
    return $this->hasMany(UserDietPlan::class);
}
 // Trainer's exercises
    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'user_id');
    }

    // Trainer's diets
    public function diets()
    {
        return $this->hasMany(UserDietPlan::class, 'user_id');
    }
}
