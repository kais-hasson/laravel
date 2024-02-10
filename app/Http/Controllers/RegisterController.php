<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    public function store()
    {

       $user= User::create(request()->validate([

            'name'=>'required|max:255',
            'user_name'=>'required|max:255|min:3|unique:users,user_name',
            'password'=>'required|max:255|min:7',
            'email'=>'required|email|max:255|unique:users,email'
        ]));
        auth()->login($user);
        return redirect('/')->with('success','Your account has been created.');
    }
}
