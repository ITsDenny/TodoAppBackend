<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $path = app_path("Repository/{$name}.php");
        $dirPath = dirname($path);
        if (!File::exists($dirPath)) {
            $this->info("Creating directory: {$dirPath}");
            File::makeDirectory($dirPath, 0755, true, true);
        }

        if (File::exists($path)) {
            $this->error('Repository already exists!');
            return 1;
        }

        $stub = str_replace('{{ namespace }}', $this->getNamespace(), $this->getStub());
        $stub = str_replace('{{ className }}', $this->getClassName(), $stub);

        if (File::put($path, $stub)) {
            $this->info("Repository created successfully: {$path}");
        } else {
            $this->error("Failed to create repository: {$path}");
        }

        return 0;
    }

    protected function getStub()
    {
        $stub = file_get_contents('stubs/repository.stub');
        $stub = str_replace('{{ namespace }}', $this->getNamespace(), $stub);
        $stub = str_replace('{{ className }}', $this->getClassName(), $stub);
        return $stub;
    }

    protected function getNamespace()
    {
        $namespace = trim(implode('\\', array_slice(explode('\\', get_class($this)), 0, -1)), '\\');
        return $namespace . '\\Repository';
    }

    protected function getClassName()
    {
        $className = Str::studly($this->argument('name'));

        return $className;
    }
}
