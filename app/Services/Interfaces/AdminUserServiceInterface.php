<?php

namespace App\Services\Interfaces;

interface AdminUserServiceInterface extends BaseServiceInterface
{
    public function login($loginInfo);
}
