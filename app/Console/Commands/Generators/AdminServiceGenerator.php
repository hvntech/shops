<?php

namespace App\Console\Commands\Generators;

class AdminServiceGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g:adminService {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin Service generator.';

    public function generate()
    {
        $name = $this->argument('name');

        // MAKE SERVICE INTERFACE
        $serviceInterfaceStub = $this->getStubContent('admin-interface.stub');
        $serviceInterfaceStub = $this->replace($serviceInterfaceStub, $name);

        $this->saveContent('Services/Admin' . $name . 'ServiceInterface.php', $serviceInterfaceStub);

        // MAKE SERVICE
        $serviceStub = $this->getStubContent('admin-service.stub');
        $serviceStub = $this->replace($serviceStub, $name);

        $this->saveContent('Services/Admin/Admin' . $name . 'Service.php', $serviceStub);

        // ADD PROVIDER
        $serviceProvider = file_get_contents(app_path('Providers/AppServiceProvider.php'));
        $serviceProvider = str_replace(
            '            //*ADMIN-NEW*',
            "            '" . $name . "'," . PHP_EOL . '            //*ADMIN-NEW*',
            $serviceProvider);

        $this->saveContent('Providers/AppServiceProvider.php', $serviceProvider);
    }
}
