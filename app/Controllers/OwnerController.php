<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InformasiTokoModel;
use CodeIgniter\Database\RawSql;

class OwnerController extends BaseController
{
    protected $db;
    protected $settingsModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->settingsModel = new InformasiTokoModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
      
      

        $voucher    = $db->table('voucher')->get()->getResultArray();
        $pembeli    = $db->table('pembeli')->get()->getResultArray();
        $itemstok   = $db->table('item')->select('sum(stok_item) as total_tersedia')->get()->getRowArray();
        $verifikasi = $db->table('cart_item')->where('status_bayar', 'Menunggu Validasi Bukti Bayar')->get()->getResultArray();

      return redirect()->to(base_url('OwnerPanel/Arsip'));
        // return view('owner/dashboard', [
        //    'voucher'       => count($voucher),
        //    'pembeli'       => count($pembeli),
        //    'itemstok'      => $itemstok['total_tersedia'],
        //    'verifikasi'    => count($verifikasi)
        // ]);
    }

    public function transaksi()
    {
        return view('owner/transaksi', [
            'data' => $this->db->table('transactions')->get()->getResultArray()
        ]);
    }

    public function item()
    {
        return view('owner/item', [
            'data' => $this->db->table('transactions')
                ->select(new RawSql('DISTINCT id_item, fullname, COUNT(id_item) as total_transaksi, transactions_datetime'))
                ->groupBy('id_item')->get()->getResultArray()
        ]);
    }

    public function pembeli()
    {
        return view('owner/pembeli', [
            'data' => $this->db->table('transactions')
                ->select(new RawSql('DISTINCT id_pembeli, COUNT(id_pembeli) as total_transaksi, transactions_datetime'))
                ->groupBy('id_pembeli')->get()->getResultArray()
        ]);
    }

    public function laporan()
    {
        return view('owner/laporan');
    }

    public function print()
    {
        $date1 = $this->request->getPost('val1');
        $date2 = $this->request->getPost('val2');
        $converDate1 = date('D, d M Y H:i:s', strtotime($date1 ?? ''));
        $converDate2 = date('D, d M Y H:i:s', strtotime($date2 ?? ''));

        return view('owner/transaksi', [
            'data' => $this->db->table('transactions')
                ->where('transactions_datetime BETWEEN "' . $converDate1 . '" and "' . $converDate2 . '"')
                ->get()->getResultArray()
        ]);
    }

    public function setting()
    {
        helper('form');
        // dd($this->settingsModel->find($id));
        return view('owner/setting', [
            'title' => 'Informasi Settings',
            'parentdir' => 'settings',
            'data' => $this->settingsModel->find('01')
        ]);
    }

    public function save_setting()
    {
        helper('form');
        $rules = [
            'alamat' => 'required|min_length[5]|max_length[254]',
            'nomor' => 'required|min_length[10]|max_length[13]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('OwnerPanel/Settings'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'alamat_toko' => $this->request->getPost('alamat'),
            'kontak_toko' => $this->request->getPost('nomor'),
        ];

        $this->settingsModel->update('01', $data);

        return redirect()->to(base_url('OwnerPanel/Settings'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diperbarui');
    }

    public function arsip()
    {
        return view('owner/arsip', [
            'data' => $this->db->table('arsip_laporan')->get()->getResultArray()
        ]);
    }

    public function viewer($id)
    {
        return view('owner/pdf_viewer', [
            'item' => $this->db->table('arsip_laporan')->where('id_arsip_laporan')->get()->getRowArray()
        ]);
    }
}
