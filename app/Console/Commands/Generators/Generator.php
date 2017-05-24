<?php

namespace App\Console\Commands\Generators;

use Illuminate\Console\Command;

abstract class Generator extends Command
{

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    abstract function generate();

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->generate();
    }

    protected function getStubContent($name)
    {
        return file_get_contents(__DIR__ . '/Templates/' . $name);
    }

    protected function saveContent($filename, $content)
    {
        $success = file_put_contents(app_path($filename), $content);
        if (!$success) {
            $this->info('make ' . $filename . ' fail');
            die;
        } else {
            $this->info('save ' . $filename . ' success');
        }
    }

    protected function replace($oriStr, $str)
    {
        return str_replace('{name}', $str, $oriStr);
    }

}
