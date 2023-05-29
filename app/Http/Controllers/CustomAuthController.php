<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CustomAuthController extends Controller
{
    //
    public function signIn()
    {
        return view('signin');
    }

    public function signInPost(SignInRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withInput()->withErrors([
            'email'=> 'Invalid email or password, please try again',
        ]);
    }

    public function signUp()
    {
        return view('signup');
    }

    public function signUpPost(SignUpRequest $request)
    {
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);
        return redirect()->route('signin');
    }




}
