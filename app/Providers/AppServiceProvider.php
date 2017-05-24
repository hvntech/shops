<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Exception;
use DB;
use \Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->validatorRegister();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $services = [
            'Video',
            'Event',
            'AdminUser',
            'User',
            'Page',
            'News',
            //*NEW*
        ];

        foreach ($services as $name) {
            $this->app->singleton(
                "App\\Services\\Interfaces\\{$name}ServiceInterface",
                "App\\Services\\Production\\{$name}Service"
            );
        }

        $this->app->bind('Helper', \App\Helpers\Helper::class);
        $this->app->bind(\App\Upload\UploadServiceInterface::class, \App\Upload\UploadService::class);
    }

    public function validatorRegister()
    {
        Validator::extend('mobile_phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[+]?[0-9 ]*$/', $value);
        });

        Validator::extend('datetime_after_now', function ($attribute, $value, $parameters, $validator) {
            $date = Carbon::createFromFormat('d/m/Y H:i', $value);
            $date->addHours(2);
            $now = Carbon::now();

            return $date->gte($now);
        });

        Validator::extend('db_exist', function ($attribute, $value, $parameters, $validator) {
            if (!is_array($parameters) && count($parameters) < 2) {
                throw new Exception('Parameters is missing');
            }

            $record = DB::table($parameters[0])->where($parameters[1], $value)
                ->first(['id']);

            if (empty($record)) {
                return false;
            }
            return true;
        });
    }
}
