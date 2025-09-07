<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkoutPlan;
use App\Models\StudentPlanProgress;

class StudentPlanRunner extends Component
{
    public $progress; // Current student progress
    public $plan;     // Current workout plan

    public function mount()
    {
        // Get logged-in user ID
        $userId = Auth::id();

        // Load the first plan assigned to this user (or latest)
        $this->progress = StudentPlanProgress::where('user_id', $userId)->first();

        if ($this->progress) {
            $this->plan = WorkoutPlan::find($this->progress->workout_plans_id);
        }
    }

    public function markDayDone()
    {
        if ($this->progress && $this->plan) {
            // Increment current_day, but not beyond plan duration
            if ($this->progress->current_day < $this->plan->duration) {
                $this->progress->current_day++;
                $this->progress->save();
            }
        }
    }

    public function render()
    {
        return view('livewire.student-plan-runner');
    }
}
