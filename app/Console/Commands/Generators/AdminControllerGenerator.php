<?php

namespace App\Console\Commands\Generators;

class AdminControllerGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g:admin {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin web controller generator';

    public function generate()
    {
        $name = $this->argument('name');

        // MAKE MODEL
        $modelStub = $this->getStubContent('admin-controller.stub');
        $modelStub = $this->replace($modelStub, $name);

        $this->saveContent('Http/Controllers/Admin/' . $name . 'Controller.php', $modelStub);
    }
}
