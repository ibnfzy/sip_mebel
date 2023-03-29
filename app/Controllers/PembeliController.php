<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PembeliController extends BaseController
{
    public function index()
    {
        return view('pembeli/dashboard');
    }
}
