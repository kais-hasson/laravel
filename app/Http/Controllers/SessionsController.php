<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function  create()
    {
        return view('sessions.create');
    }
    public function store()
    {
       $attributes= request()->validate([
            'password'=>'required',
            'email'=>'required|email'
        ]);
        if (!auth()->attempt($attributes))
        {
            throw ValidationException::withMessages([
                'email'=>'Your provided credentials could not be verified']);
        }
        session()->regenerate();
        return redirect('/')
            ->with('success','Welcome Back!');
    }
    public function destroy()
    {
       auth()->logout();
       return redirect('/')->with('success','Goodbye!');
    }
}
