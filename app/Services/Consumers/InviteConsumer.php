<?php

namespace App\Services\Consumers;

use PhpAmqpLib\Message\AMQPMessage;

class InviteConsumer implements ConsumerInterface
{
    public function handle(AMQPMessage $msg)
    {

    }

}
