<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        // dd($name);
        $servicePath = app_path("Services/{$name}.php");

        if (!File::exists(dirname($servicePath))) {
            $this->info("Creating directory: " . dirname($servicePath));
            File::makeDirectory(dirname($servicePath), 0755, true, true);
        }

        if (File::exists($servicePath)) {
            $this->error('Service already exists!');
            return 1;
        }

        $stub = str_replace('{{ namespace }}', $this->getNamespace(), $this->getStub());
        $stub = str_replace('{{ className }}', $this->getClassName(), $stub);

        if (File::put($servicePath, $stub)) {
            $this->info("Service created successfully: {$servicePath}");
        } else {
            $this->error("Failed to create service: {$servicePath}");
        }

        return 0;
    }

    protected function getStub()
    {
        $stub = file_get_contents('stubs/service.stub');
        $stub = str_replace('{{ namespace }}', $this->getNamespace(), $stub);
        $stub = str_replace('{{ className }}', $this->getClassName(), $stub);
        return $stub;
    }

    protected function getNamespace()
    {
        $namespace = trim(implode('\\', array_slice(explode('\\', get_class($this)), 0, -1)), '\\');
        return $namespace . '\\Services';
    }

    protected function getClassName()
    {
        $className = Str::studly($this->argument('name'));

        return $className;
    }
}
