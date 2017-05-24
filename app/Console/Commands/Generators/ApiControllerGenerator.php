<?php

namespace App\Console\Commands\Generators;

class ApiControllerGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g:api {name}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make api';

    public function generate()
    {
        $name = $this->argument('name');

        // MAKE MODEL
        $modelStub = $this->getStubContent('api-controller.stub');
        $modelStub = $this->replace($modelStub, $name);

        $this->saveContent('Http/Controllers/Api/' . $name . 'Controller.php', $modelStub);
    }
}
