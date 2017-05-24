<?php

namespace App\Models;

use App\Models\Event;

class UserEventRegistration extends BaseModel
{
    protected $table = 'user_event_registrations';

    public function event() {
        return $this->belongsTo(Event::class, 'events_id');
    }

}
