<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Providers\RouteServiceProvider;
use App\Services\RabbitMQService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CustomAuthController extends Controller
{
    //
    protected RabbitMQService $MQService;
    public function __construct(RabbitMQService $MQService)
    {
       $this->MQService = $MQService;
    }
    public function signIn(): Factory|View|Application
    {
        return view('signin');
    }

    public function signInPost(SignInRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withInput()->withErrors([
            'email'=> 'Invalid email or password, please try again',
        ]);
    }

    public function signUp(): Factory|View|Application
    {
        return view('signup');
    }

    public function signUpPost(SignUpRequest $request): RedirectResponse
    {
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $this->MQService->publish($user->id, 'email');

        Auth::login($user);
        return redirect()->route('signin');
    }

    public function signOut() {

        Session::flush();
        Auth::logout();
        return redirect()->route('signin');
    }




}
