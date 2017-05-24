<?php

namespace App\Services\Interfaces;

interface EventServiceInterface extends BaseServiceInterface
{
    public function add($dataRequest);

    public function getEventById($eventId);

    public function getEventLists($request);

    public function update($event);

    public function delete($eventIds);
}
