<?php

function admin_user($attribute = '')
{
    // for development environment
    if (env('APP_ENV') == 'dev') {
        $adminUser = \App\Models\AdminUser::first();
        if (empty($attribute)) {
            return $adminUser;
        }
        return $adminUser->{$attribute};
    }

    $adminUser = session(config('session.session_names.admin_login'));
    if (empty($adminUser)) {
        throw new App\Exceptions\Admin\UnauthorizedException();
    }

    $adminUser = json_decode($adminUser);
    if (empty($attribute)) {
        return $adminUser;
    }
    return $adminUser->{$attribute};
}
