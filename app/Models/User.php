<?php

namespace App\Models;

class User extends BaseModel
{
    const PERPAGE = 10;

    protected $table = 'users';
}
