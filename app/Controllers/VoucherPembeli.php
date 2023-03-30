<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VoucherPembeliModel;

class VoucherPembeli extends BaseController
{
    protected $voucherUserModel;

    public function __construct()
    {
        $this->voucherUserModel = new VoucherPembeliModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin/voucher_pembeli', [
            'title' => 'Table Pelanggan Reward',
            'parentdir' => 'Pelanggan Reward',
            'data' => $this->voucherUserModel->findAll()
        ]);
    }
}
