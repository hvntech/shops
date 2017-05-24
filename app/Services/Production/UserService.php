<?php

namespace App\Services\Production;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use DB;

class UserService extends BaseService implements UserServiceInterface
{
    public function add($data)
    {
        $duplicateUser = User::where('email', $data['email'])
            ->first();
        if (!empty($duplicateUser)) {
            return false;
        }

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->mobile_phone = $data['mobile_phone'];
        $user->password = \Hash::make($data['password']);
        $user->delete_flag = 0;

        return $user->save();
    }

    public function getUserList($requestData)
    {
        $query = User::query();
        $requestFields = $requestData['fields'];

        if (isset($requestFields['email'])) {
            $query->where('email', 'like', '%' . $requestFields['email'] . '%');
        }

        if (isset($requestFields['name'])) {
            $query->where('name', 'like', '%' . $requestFields['name'] . '%');
        }

        if (isset($requestFields['mobile_phone'])) {
            $query->where('mobile_phone', 'like', '%' . $requestFields['mobile_phone'] . '%');
        }

        if (isset($requestFields['created_at'])) {
            $query->whereDate('created_at', '=', \Helper::datepickerToDateStr($requestFields['created_at']));
        }

        $sortFields = empty($requestData['sorts']) ? [] : $requestData['sorts'];
        foreach ($sortFields as $col => $order) {
            $query->orderBy($col, $order);
        }

        $query->where('delete_flag', 0);

        return $query->paginate(User::PERPAGE);
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function update($userData)
    {
        $user = User::findOrFail($userData['id']);

        if ($user->email != $userData['email']) {
            $checkMailUser = User::where('email', $userData['email'])
                ->first();
            if (!empty($checkMailUser)) {
                return false;
            }
            $user->email = $userData['email'];
        }

        $user->name = $userData['name'];
        $user->mobile_phone = $userData['mobile_phone'];

        if (!empty($userData['password'])) {
            $user->password = \Hash::make($userData['password']);
        }
        return $user->save();
    }

    public function delete($ids)
    {
        if (is_array($ids)) {
            DB::beginTransaction();
            foreach ($ids as $id) {
                $user = User::findOrFail($id);
                $user->delete_flag = 1;
                if (!$user->save()){
                    DB::rollback();
                    return false;
                }
            }
            DB::commit();
            return true;
        } else {
            $user = User::findOrFail($ids);
            $user->delete_flag = 1;
            return $user->save();
        }
    }
}
