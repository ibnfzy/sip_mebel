<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembeliModel;

class Pembeli extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PembeliModel();
    }
    public function index()
    {
        $data = [
            'pelanggan' => $this->pelangganModel->findAll()
        ];

        return view('admin/pembeli', $data);
    }
}
