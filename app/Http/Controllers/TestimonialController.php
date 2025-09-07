<?php

// app/Http/Controllers/TestimonialController.php
namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'message' => 'required|string|max:500',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create($request->only('name', 'message', 'rating'));

        return redirect()->back()->with('success', 'Thank you for your review!');
    }

    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('testimonials.index', compact('testimonials'));
    }
}
