<?php

namespace App\Services\Production;

use App\Models\AdminUser;
use App\Services\Interfaces\AdminUserServiceInterface;
use Hash;

class AdminUserService extends BaseService implements AdminUserServiceInterface
{
    public function login($loginInfo)
    {
        $adminUser = AdminUser::where('email', $loginInfo['email'])
            ->first();
        if (!empty($adminUser) && Hash::check($loginInfo['password'], $adminUser->password)) {
            session([config('session.session_names.admin_login') => $adminUser->toJson()]);
            return true;
        }
        return false;
    }
}
