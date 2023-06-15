<?php

namespace App\Services;

use App\Models\User;
use App\Services\Consumers\ConsumerInterface;
use App\Services\Consumers\EmailVerifyConsumer;
use App\Services\Consumers\InviteConsumer;
use Illuminate\Auth\Events\Registered;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;
class RabbitMQService
{
    private array $consumers = [
        'email' => EmailVerifyConsumer::class,
        'invite' => InviteConsumer::class
    ];
    public function publish(string $message, string $queue): void
    {
        $connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $channel = $connection->channel();
        $channel->exchange_declare('test_exchange', 'direct', false, false, false);
        $channel->queue_declare($queue, false, false, false, false);
        $channel->queue_bind($queue, 'test_exchange', 'test_key');
        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, 'test_exchange', 'test_key');
        echo " [x] Sent to test_exchange / test_queue.\n";
        $channel->close();
        $connection->close();
    }
    public function consume(string $queue): void
    {
        $connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $channel = $connection->channel();

        $callback = function ($msg) use($queue){
            $obj = new $this->consumers[$queue];

            if($obj instanceof ConsumerInterface){
                $obj->handle($msg);
            }

        };
        $channel->queue_declare($queue, false, false, false, false);
        $channel->basic_consume($queue, '', false, true, false, false, $callback);
        echo "Waiting for new message on $queue", " \n";
        while ($channel->is_consuming()) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }

}
