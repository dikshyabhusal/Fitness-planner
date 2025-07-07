<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use Carbon\Carbon;

class StudentWorkoutCalendar extends Component
{
    public $calendar = [];
    public $month;
    public $year;
    public $progress = [];

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;

        $this->buildCalendar();
    }

    public function buildCalendar()
    {
        $progresses = Progress::where('user_id', Auth::id())
            ->whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->get()
            ->keyBy(fn($item) => Carbon::parse($item->date)->format('Y-m-d'));

        $firstDay = Carbon::createFromDate($this->year, $this->month, 1);
        $startDay = $firstDay->copy()->startOfMonth()->startOfWeek();
        $endDay = $firstDay->copy()->endOfMonth()->endOfWeek();

        $date = $startDay->copy();
        $weeks = [];

        while ($date->lte($endDay)) {
            $week = [];

            for ($i = 0; $i < 7; $i++) {
                $formatted = $date->format('Y-m-d');

                $week[] = [
                    'date' => $date->copy(),
                    'workout_done' => $progresses[$formatted]->workout_done ?? null,
                ];

                $date->addDay();
            }

            $weeks[] = $week;
        }

        $this->calendar = $weeks;
    }

    public function render()
    {
        return view('livewire.student-workout-calendar');
    }
}
