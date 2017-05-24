<?php

namespace App\Services\Interfaces;

interface VideoServiceInterface extends BaseServiceInterface
{
    public function getVideoById($videoId);

    public function getVideoLists($request);

    public function update($request);

    public function delete($videoIds);
}
