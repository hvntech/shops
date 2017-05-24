<?php

namespace App\Services\Interfaces;

interface UserServiceInterface extends BaseServiceInterface
{
    public function add($data);

    public function getUserList($requestData);

    public function getUserById($id);

    public function update($userData);

    public function delete($ids);
}
