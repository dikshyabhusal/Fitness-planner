<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class StudentProgress extends Component
{
    public $planId;
    public $today;
    public $workout_done = false;
    public $diet_done = false;

    public function mount($planId)
    {
        $this->planId = $planId;
        $this->today = now()->toDateString();

        $progress = Progress::where('user_id', Auth::id())
            ->where('workout_plan_id', $this->planId)
            ->where('date', $this->today)
            ->first();

        if ($progress) {
            $this->workout_done = $progress->workout_done;
            $this->diet_done = $progress->diet_done;
        }
    }
public function saveProgress()
{
    Progress::updateOrCreate(
        [
            'user_id' => Auth::id(),
            'workout_plan_id' => $this->planId, // ⚠️ if this is not defined, define it!
            'date' => $this->today,
        ],
        [
            'workout_done' => $this->workout_done,
            'diet_done' => $this->diet_done,
        ]
    );

    session()->flash('message', 'Progress saved!');
}


    public function updated($property)
    {
        logger('Saving Progress', [
        'user_id' => Auth::id(),
        'plan_id' => $this->planId,
        'workout_done' => $this->workout_done,
        'diet_done' => $this->diet_done,
    ]);
        Progress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'workout_plan_id' => $this->planId,
                'date' => $this->today,
            ],
            [
                'workout_done' => $this->workout_done,
                'diet_done' => $this->diet_done,
            ]
        );
    }

    public function render()
    {
        return view('livewire.student-progress');
    }
}
