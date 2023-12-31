<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RabbitMQService;
class MQConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mq:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume the mq email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        $mqService = new RabbitMQService();
        $mqService->consume('email');
    }
}
