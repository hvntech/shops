<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $dates = ['datetime'];
    CONST PERPAGE = 10;

    public function partner() {
        return $this->belongsTo(Partner::class, 'partners_id');
    }

    public function userEventRegistration()
    {
        return $this->hasMany(UserEventRegistration::class, 'events_id');
    }

    public function getFormattedDatetimeAttribute()
    {
        return \Helper::carbonToDisplayDateStr($this->datetime);
    }

    public function countJoinedUsers()
    {
        return $this->UserEventRegistration->count();
    }
}
