<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminStoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends AdminBaseController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;

        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('admin.user.index', [
            'searchUrl' => route('user_data'),
            'fields' => $request->input('fields', []),
            'sorts' => $request->input('sorts', []),
            'page' => $request->input('page', 1),
        ]);
    }

    public function getUsers(Request $request)
    {
        $users = $this->userService->getUserList($request->all());

        return response()->json([
            'templates' => [
                'rows' => view('admin.user.rows', compact('users'))->render(),
                'pagination' => $users->links()->toHtml(),
            ],
            'url' => route('user_index', $request->all()),
        ]);
    }

    public function view($id)
    {
        $user = $this->userService->getUserById($id);
        return view('admin.user.view')
            ->with(compact('user'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(AdminStoreUserRequest $request)
    {
        if ($this->userService->add($request->all())) {
            return redirect()->route('user_index');
        } else {
            return redirect()
                ->back()
                ->withErrors([trans('message.failure')])
                ->withInput();
        }
    }

    public function showUpdate($id)
    {
        $user = $this->userService->getUserById($id);
        return view('admin.user.update')
            ->with(compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        if ($this->userService->update($request->all())) {
            return redirect()->route('user_index');
        }
        return redirect()->back()
            ->withErrors([trans('message.failure')]);
    }

    public function delete(Request $request)
    {
        if (empty($request->ids)) {
            return redirect()->back();
        }

        if (is_array($request->ids)) {
            $success = $this->userService->delete($request->ids);
            return response()->json(compact('success'));
        } else {
            if ($this->userService->delete($request->ids)) {
                return redirect()->back();
            }
            return redirect()->back()
                ->withErrors([trans('message.failure')]);
        }
    }
}
