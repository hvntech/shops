<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class AdminBaseController extends Controller
{
    protected $title = '';

    public function __construct()
    {
      View::share('title', $this->title);
    }
}
