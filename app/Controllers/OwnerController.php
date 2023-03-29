<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OwnerController extends BaseController
{
    public function index()
    {
        return view('owner/dashboard');
    }
}
