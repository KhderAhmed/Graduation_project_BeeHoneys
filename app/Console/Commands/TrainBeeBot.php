<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TrainBeeBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bee:train';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $script = base_path('app/Python/bee_bot_json.py');
        $output = shell_exec("python3 $script train-only");
        $this->info('Bee bot trained successfully!');
    }
    
}
