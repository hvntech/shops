<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Video;
use App\Models\Event;

class Partner extends Model
{
    protected $table = 'partners';

    public function video() {
        return $this->hasMany(Video::class);
    }

    public function event() {
        return $this->hasMany(Event::class);
    }
}
