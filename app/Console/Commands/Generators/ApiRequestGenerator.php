<?php

namespace App\Console\Commands\Generators;

class ApiRequestGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g:apiRequest {name}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make api request';

    public function generate()
    {
        $name = $this->argument('name');

        // MAKE MODEL
        $modelStub = $this->getStubContent('api-request.stub');
        $modelStub = $this->replace($modelStub, $name);

        $this->saveContent('Http/Requests/Api/' . $name . 'Request.php', $modelStub);
    }
}
