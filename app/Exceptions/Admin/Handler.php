<?php

namespace App\Exceptions\Admin;

use Exception;

class Handler
{
    protected $ex;

    public function __construct(Exception $ex)
    {
        $this->ex = $ex;
    }

    public function response()
    {
        if ($this->ex instanceof UnauthorizedException) {
            return redirect()->route('admin_show_login')->withErrors([trans('auth.admin_unauthorized')]);
        }
        return null;
    }
}
