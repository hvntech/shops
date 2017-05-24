<?php

namespace App\Services\Interfaces;

interface AdminBaseServiceInterface extends BaseServiceInterface
{
    public function get($dataRequest = []);

    public function add($dataRequest);

    public function edit($dataRequest);

    public function delete($id);
}