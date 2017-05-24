<?php

namespace App\Models;

use App\Models\Partner;
use App\Models\BaseModel;
// use Illuminate\Database\Eloquent\Model;

class Video extends BaseModel
{
    protected $table = 'videos';
    protected $dates = ['upload_date'];
    CONST PERPAGE = 10;

    public function partner() {
        return $this->belongsTo(Partner::class, 'partners_id');
    }

    public function getFormattedUploadDateAttribute()
    {
        return \Helper::carbonToDisplayDateStr($this->upload_date);
    }
}
