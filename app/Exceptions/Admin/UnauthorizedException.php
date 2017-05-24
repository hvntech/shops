<?php

namespace App\Exceptions\Admin;

use Exception;

class UnauthorizedException extends Exception
{
    public function __construct()
    {
        parent::__construct(trans('auth.admin_unauthorized'));
    }
}
