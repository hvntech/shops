<?php

namespace App\Console\Commands\Generators;

class ModelGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g:model {name}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make model';

    public function generate()
    {
        $name = $this->argument('name');

        // MAKE MODEL
        $modelStub = $this->getStubContent('model.stub');
        $modelStub = $this->replace($modelStub, $name);

        $this->saveContent('Models/' . $name . '.php', $modelStub);
    }
}
