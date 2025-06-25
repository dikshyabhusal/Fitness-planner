<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AboutController extends Controller
{
    public function about()
    {
        return view('about');
    }
    public function aboutauth()
    {
        return view('aboutauth');
    }
    public function show()
    {
        return view('contact');
    }
    public function submit(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
    ]);

    Contact::create($request->only('name', 'email', 'subject', 'message'));

    return redirect()->back()->with('success', 'Your message has been sent!');
}
}
