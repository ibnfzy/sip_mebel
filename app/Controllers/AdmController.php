<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InformasiTokoModel;

class AdmController extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }
}