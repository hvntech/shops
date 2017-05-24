<?php

namespace App\Console\Commands\Generators;

class ServiceGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g:service {name}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make model';

    public function generate()
    {
        $name = $this->argument('name');

        // MAKE SERVICE INTERFACE
        $serviceInterfaceStub = $this->getStubContent('service-interface.stub');
        $serviceInterfaceStub = $this->replace($serviceInterfaceStub, $name);

        $this->saveContent('Services/Interfaces/' . $name . 'ServiceInterface.php', $serviceInterfaceStub);

        // MAKE SERVICE
        $serviceStub = $this->getStubContent('service.stub');
        $serviceStub = $this->replace($serviceStub, $name);

        $this->saveContent('Services/Production/' . $name . 'Service.php', $serviceStub);

        // ADD PROVIDER
        $serviceProvider = file_get_contents(app_path('Providers/AppServiceProvider.php'));
        $serviceProvider = str_replace(
            '            //*NEW*',
            "            '" . $name . "'," . PHP_EOL . '            //*NEW*',
            $serviceProvider);

        $this->saveContent('Providers/AppServiceProvider.php', $serviceProvider);
    }
}
