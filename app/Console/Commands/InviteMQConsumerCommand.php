<?php

namespace App\Console\Commands;

use App\Services\RabbitMQService;
use Illuminate\Console\Command;

class InviteMQConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mq:invite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume the mq invite';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mqService = new RabbitMQService();
        $mqService->consume('invite');
    }
}
