<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartItemModel;
use App\Models\InformasiTokoModel;
use App\Models\PembeliInformasiModel;
use App\Models\TransactionsModel;

class AdmController extends BaseController
{
    protected $transaksiModel;
    protected $keranjangModel;
    protected $db;
    protected $voucherSistem;
    protected $userInformation;
    protected $settingsModel;


    public function __construct()
    {
        helper('form');
        $this->db = \Config\Database::connect();
        $this->transaksiModel = new TransactionsModel();
        $this->keranjangModel = new CartItemModel();
        $this->userInformation = new PembeliInformasiModel();
        $this->settingsModel = new InformasiTokoModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();

        $voucher    = $db->table('voucher')->get()->getResultArray();
        $pembeli    = $db->table('pembeli')->get()->getResultArray();
        $itemstok   = $db->table('item')->select('sum(stok_item) as total_tersedia')->get()->getRowArray();
        $verifikasi = $db->table('cart_item')->where('status_bayar', 'Menunggu Validasi Bukti Bayar')->get()->getResultArray();

        return view('admin/dashboard', [
            'voucher'       => count($voucher),
            'pembeli'       => count($pembeli),
            'itemstok'      => $itemstok['total_tersedia'],
            'verifikasi'    => count($verifikasi)
        ]);
    }

    public function transaksi()
    {
        return view('admin/transaksi', [
            'order' => $this->transaksiModel->findAll(),
            'keranjang' => $this->keranjangModel->findAll()
        ]);
    }

    public function invoice($userid = '', $rowid = '')
    {
        helper('form');
        $get = $this->userInformation->where('id_pembeli', $userid)->first();
        $getTransaksi = $this->transaksiModel->where('rowid', $rowid)->first();
        $getKeranjang = $this->keranjangModel->where('rowid', $rowid)->first();
        $getuser = $this->db->table('user')->where('id_pembeli', $userid)->get()->getRowArray();

        $getTransaksiData = $this->db->table('transactions')
            ->where('rowid', $rowid)
            ->get()
            ->getResultArray();

        $tgl_batas = date('Y-m-d', strtotime('+2 days', strtotime($getKeranjang['tgl_checkout'])));

        return view('admin/invoice', [
            'title' => 'Invoice',
            'parentdir' => 'transaksi',
            'rowid' => $rowid,
            'dataToko' => $this->settingsModel->find(01),
            'datapembeli' => $get,
            'transaksi' => $getTransaksi,
            'keranjang' => $getKeranjang,
            'batas' => $tgl_batas,
            'data' => $getTransaksiData,
            'user' => $getuser
        ]);
    }

    public function validasi_bb($id)
    {
        $data = [
            'status_bayar' => 'Diproses'
        ];

        $this->keranjangModel->update($id, $data);

        return redirect()->to(base_url('AdmPanel/Transaksi'))->with('type-status', 'success')
            ->with('message', 'Data berhasil divalidasi');
    }

    public function update_kirim($id)
    {
        $data = [
            'status_bayar' => 'Dalam Pengiriman'
        ];

        $this->keranjangModel->update($id, $data);

        return redirect()->to(base_url('AdmPanel/Transaksi'))->with('type-status', 'success')
            ->with('message', 'Status Berhasil diubah');
    }
}
