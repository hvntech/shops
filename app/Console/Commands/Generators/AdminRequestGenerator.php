<?php

namespace App\Console\Commands\Generators;


class AdminRequestGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g:adminRequest {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin Request generator.';

    public function generate()
    {
        $name = $this->argument('name');

        // MAKE MODEL
        $modelStub = $this->getStubContent('admin-request.stub');
        $modelStub = $this->replace($modelStub, $name);

        $this->saveContent('Http/Requests/Admin/' . $name . 'Request.php', $modelStub);
    }
}
