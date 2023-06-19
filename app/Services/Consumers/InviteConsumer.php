<?php

namespace App\Services\Consumers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Message\AMQPMessage;

class InviteConsumer implements ConsumerInterface
{
    public function handle(AMQPMessage $msg)
    {

        $email = $msg->body;
        echo ' [x] Received ', $email, "\n";

        Mail::send('email.invite', ['email' =>  $email], function ($message) use ($email)
        {
            $message->from('hello@example.com', 'Your Name');
            $message->subject('Invitation to join a team');
            $message->to($email);
        });





    }

}
