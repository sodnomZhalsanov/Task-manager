<?php

namespace App\Services\Consumers;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Message\AMQPMessage;

class InviteConsumer implements ConsumerInterface
{
    public function handle(AMQPMessage $msg)
    {
        list($email, $token) = explode(",",$msg->body);

        echo ' [x] Received ', $email, "\n";

        $invite = Invite::where('token', $token)->first();

        $task = (($invite->task())->first())->title;

        Mail::send('email.invite', ['email' =>  $email, 'token' => $token, 'title' => $task], function ($message) use ($email)
        {
            $message->from('hello@example.com', 'Your Name');
            $message->subject('Invitation to join a team');
            $message->to($email);
        });





    }

}
