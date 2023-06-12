<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;
class RabbitMQService
{
    public function publish($message)
    {
        $connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $channel = $connection->channel();
        $channel->exchange_declare('test_exchange', 'direct', false, false, false);
        $channel->queue_declare('test_queue', false, false, false, false);
        $channel->queue_bind('test_queue', 'test_exchange', 'test_key');
        $msg = new AMQPMessage($message['user_id']);
        $channel->basic_publish($msg, 'test_exchange', 'test_key');
        echo " [x] Sent to test_exchange / test_queue.\n";
        $channel->close();
        $connection->close();
    }
    public function consume()
    {
        $connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $channel = $connection->channel();
        $callback = function ($msg) {
            $user = User::findOrFail($msg->body);
            event(new Registered($user));
            echo ' [x] Received ', $msg->body, "\n";
        };
        $channel->queue_declare('test_queue', false, false, false, false);
        $channel->basic_consume('test_queue', '', false, true, false, false, $callback);
        echo 'Waiting for new message on test_queue', " \n";
        while ($channel->is_consuming()) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }

}
