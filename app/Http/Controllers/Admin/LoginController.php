<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminLoginRequest;
use App\Services\Interfaces\AdminUserServiceInterface;

class LoginController extends AdminBaseController
{
    protected $adminUserService;

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        parent::__construct();
        $this->adminUserService = $adminUserService;
    }

    public function login()
    {
        return view('admin.login');
    }

    public function doLogin(AdminLoginRequest $request)
    {
        if ($this->adminUserService->login($request->all())) {
            return redirect()->route('video_lists');
        } else {
            return redirect()->route('admin_show_login')->withErrors([
                trans('auth.admin_authorized_fail'),
            ])->withInput();
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('admin_show_login');
    }
}
