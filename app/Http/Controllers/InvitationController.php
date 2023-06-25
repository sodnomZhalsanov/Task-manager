<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddCoworkerRequest;
use App\Models\Invite;
use App\Models\TaskUser;
use App\Models\User;
use App\Services\RabbitMQService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController
{
    public function __construct(RabbitMQService $MQService)
    {
        $this->MQService = $MQService;
    }

    public function addCoworker(AddCoworkerRequest $request): RedirectResponse
    {
        $task_id = $request->task_id;

        $user = User::where('email',$request->executor_mail)->first();


        if(!$user){
            return back()->withInput()->withErrors([
                'executor_mail'=> "Couldn't find a user by email"
            ]);
        }

        do {
            //generate a random string using Laravel's str_random helper
            $token = Str::random(16);
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = Invite::create([
            'owner_id' => Auth::id(),
            'user_id' => $user->id,
            'task_id' => $task_id,
            'token' => $token
        ]);

        $message = $user->email.",".$invite->token;

        $this->MQService->publish($message, 'invite');

        return redirect()->route('dashboard');

    }

    public function accept($token)
    {
        $invite = Invite::where('token', $token)->first();

        if (!$invite) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        } elseif($invite->is_accepted === true ){
            return back();
        }

        $invite->update(['is_accepted' => true]);

        TaskUser::create([
            'task_id' => $invite->task_id,
            'user_id' => $invite->user_id
        ]);

        return redirect()->route('dashboard');

    }





}
