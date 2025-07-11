<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BMIController extends Controller
{
    // 1. BMI Calculator
    public function bmi() {
        return view('calculators.bmi');
    }

    public function bmiCalculate(Request $request) {
        $request->validate([
            'weight' => 'required|numeric',
            'height_cm' => 'nullable|numeric',
            'height_ft' => 'nullable|numeric',
            'height_in' => 'nullable|numeric',
        ]);

        if ($request->filled('height_cm')) {
            $height = $request->height_cm / 100;
        } else {
            $feet = $request->height_ft ?? 0;
            $inches = $request->height_in ?? 0;
            $height = (($feet * 12) + $inches) * 0.0254;
        }

        $bmi = round($request->weight / ($height * $height), 1);
        $category = match (true) {
            $bmi < 18.5 => 'Underweight',
            $bmi < 25 => 'Normal weight',
            $bmi < 30 => 'Overweight',
            default => 'Obese',
        };

        return view('calculators.bmi', compact('bmi', 'category'));
    }

    // 2. Body Fat Index (Navy method)
    public function bodyFat() {
        return view('calculators.bodyfat');
    }

    public function bodyFatCalculate(Request $request) {
        $request->validate([
            'waist' => 'required|numeric',
            'neck' => 'required|numeric',
            'height' => 'required|numeric',
            'gender' => 'required|string',
        ]);

        if ($request->gender === 'male') {
            $bfi = 495 / (1.0324 - 0.19077 * log10($request->waist - $request->neck) + 0.15456 * log10($request->height)) - 450;
        } else {
            $bfi = 495 / (1.29579 - 0.35004 * log10($request->waist + $request->hip - $request->neck) + 0.22100 * log10($request->height)) - 450;
        }

        return view('calculators.bodyfat', ['bfi' => round($bfi, 2)]);
    }

    // 3. Calories Burned
    public function caloriesBurned() {
        return view('calculators.caloriesburned');
    }

    public function caloriesBurnedCalculate(Request $request) {
        $request->validate([
            'weight' => 'required|numeric',
            'duration' => 'required|numeric',
            'met' => 'required|numeric',
        ]);

        $burned = 0.0175 * $request->met * $request->weight * $request->duration;
        return view('calculators.caloriesburned', ['burned' => round($burned, 2)]);
    }

    // 4. Daily Calorie Calculator (BMR with activity factor)
    public function dailyCalorie() {
        return view('calculators.dailycalorie');
    }

    public function dailyCalorieCalculate(Request $request) {
        $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required|string',
            'activity' => 'required|numeric',
        ]);

        $bmr = $request->gender === 'male'
            ? 10 * $request->weight + 6.25 * $request->height - 5 * $request->age + 5
            : 10 * $request->weight + 6.25 * $request->height - 5 * $request->age - 161;

        $calories = $bmr * $request->activity;

        return view('calculators.dailycalorie', ['calories' => round($calories)]);
    }

    // 5. One Rep Max (Epley formula)
    public function oneRepMax() {
        return view('calculators.onerepmax');
    }

    public function oneRepMaxCalculate(Request $request) {
        $request->validate([
            'weight' => 'required|numeric',
            'reps' => 'required|numeric',
        ]);

        $orm = $request->weight * (1 + ($request->reps / 30));
        return view('calculators.onerepmax', ['orm' => round($orm, 2)]);
    }

    // 6. Grip Strength Placeholder
    public function gripStrength() {
        return view('calculators.gripstrength');
    }

    public function gripStrengthCalculate(Request $request)
    {
        $request->validate([
            'gender' => 'required|string',
            'age' => 'required|integer|min:10|max:100',
            'grip_value' => 'required|numeric|min:0'
        ]);

        $score = $request->grip_value;
        $age = $request->age;
        $gender = $request->gender;

        // You can enhance this by mapping ranges from the normative table
        $classification = null;
        if ($gender === 'male') {
            if ($age >= 20 && $age <= 29) {
                $classification = match (true) {
                    $score >= 52.2 => 'Excellent',
                    $score >= 47.2 => 'Very Good',
                    $score >= 43.1 => 'Good',
                    $score >= 38.1 => 'Fair',
                    default => 'Poor',
                };
            }
            // Add other age groups as needed...
        } else {
            if ($age >= 20 && $age <= 29) {
                $classification = match (true) {
                    $score >= 31.8 => 'Excellent',
                    $score >= 28.6 => 'Very Good',
                    $score >= 26.3 => 'Good',
                    $score >= 23.6 => 'Fair',
                    default => 'Poor',
                };
            }
            // Add other age groups as needed...
        }

        return view('calculators.gripstrength', compact('score', 'classification'));
    }

}
