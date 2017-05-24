<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getFormattedUpdatedAtAttribute()
    {
        return \Helper::carbonToDisplayDateStr($this->updated_at);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return \Helper::carbonToDisplayDateStr($this->created_at);
    }
}
