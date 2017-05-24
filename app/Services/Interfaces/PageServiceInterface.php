<?php

namespace App\Services\Interfaces;

interface PageServiceInterface extends BaseServiceInterface
{
    public function getPageByType($type);

    public function updateOrInsert(array $data);
}
