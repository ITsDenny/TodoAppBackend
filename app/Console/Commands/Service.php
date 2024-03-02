<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Service extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd('test');
        $name = $this->argument('name');
        $servicePath = app_path("Services/{$name}.php");

        if (File::exists($servicePath)) {
            $this->error('Service already exists!');
            return;
        }

        $stub = File::get(base_path('stubs/service.stub'));
        $stub = str_replace('{{className}}', $name, $stub);

        File::put($servicePath, $stub);

        $this->info('Service created successfully');
    }
}
