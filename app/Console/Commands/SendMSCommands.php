<?php

namespace App\Console\Commands;

use App\MSCommand;
use Illuminate\Console\Command;
use App\Mqtt;

class SendMSCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mscommand:send {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a My Sensors payload to the given sensor';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $command_id = $this->argument('id');
        $ms_command = MSCommand::findOrFail($command_id);
        
        $message = new Mqtt\MSMessage(0);

        $message->fromScratch($ms_command->sensor->node_address,
            $ms_command->sensor->sensor_address,
            $ms_command->command, $ms_command->ack,
            $ms_command->type);
        $message->setMessage($ms_command->payload);
        Mqtt\MqttSender::sendMessage($message);

        //\Log::useFiles(storage_path('/logs/mscommand.log'), 'info');
        \Log::info('Command send to sensor: '.$ms_command->sensor->name);
    }
}
