<?php

namespace App\Models;

class PageContent extends BaseModel
{
    const PAGE_ABOUT    = 1;
    const PAGE_PRIVACY  = 2;
    const PAGE_TERMS    = 3;

    protected $fillable = ['type', 'banner_url', 'text'];

    public function getPageNameAttribute() {
        static $map = [
            self::PAGE_ABOUT   => 'About',
            self::PAGE_PRIVACY => 'Privacy Policy',
            self::PAGE_TERMS   => 'Terms and Conditions',
        ];

        return isset($map[$this->type]) ? $map[$this->type] : '';
    }
}
