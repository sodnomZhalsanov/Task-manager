<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

class InvitationController
{
    public function invite(string $email)
    {

        Mail::send('emails.invite', ['email' => $email], function ($message) use ($email)
        {
            $message->from('hello@example.com', 'Your Name');
            $message->to($email);
        });

    }

}
