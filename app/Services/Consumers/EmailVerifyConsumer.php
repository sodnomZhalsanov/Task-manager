<?php

namespace App\Services\Consumers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use PhpAmqpLib\Message\AMQPMessage;

class EmailVerifyConsumer implements ConsumerInterface

{
    public function handle(AMQPMessage $msg)
    {
        $user = User::findOrFail($msg->body);
        event(new Registered($user));
        echo ' [x] Received ', $user->email, "\n";
    }
}
