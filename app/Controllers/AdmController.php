<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartItemModel;
use App\Models\InformasiTokoModel;
use App\Models\PembeliInformasiModel;
use App\Models\TransactionsModel;
use CodeIgniter\Database\RawSql;

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

        $voucher = $db->table('voucher')->get()->getResultArray();
        $pembeli = $db->table('pembeli')->get()->getResultArray();
        $itemstok = $db->table('item')->select('sum(stok_item) as total_tersedia')->get()->getRowArray();
        $verifikasi = $db->table('cart_item')->where('status_bayar', 'Menunggu Validasi Bukti Bayar')->get()->getResultArray();

        return view('admin/dashboard', [
            'voucher' => count($voucher),
            'pembeli' => count($pembeli),
            'itemstok' => $itemstok['total_tersedia'],
            'verifikasi' => count($verifikasi)
        ]);
    }

    public function transaksi()
    {
        return view('admin/transaksi', [
            'order' => $this->transaksiModel->findAll(),
            'keranjang' => $this->keranjangModel->orderBy('id_cart_item', 'DESC')->findAll()
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

    public function biaya_ongkir()
    {
        return view('admin/ongkir', [
            'title' => 'Biaya Ongkir',
            'data' => $this->db->table('biaya_ongkir')->get()->getResultArray()
        ]);
    }

    public function add_biaya_ongkir()
    {
        helper('form');
        return view('admin/ongkir_add', [
            'title' => 'Tambah Biaya Onkir'
        ]);
    }

    public function store_biaya_ongkir()
    {
        helper('form');
        $rules = [
            'nama_kota' => 'required',
            'biaya' => 'required|min_length[1]|max_length[7]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/BiayaOngkir/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_kota' => $this->request->getPost('nama_kota'),
            'biaya' => $this->request->getPost('biaya')
        ];

        $this->db->table('biaya_ongkir')->insert($data);

        return redirect()->to(base_url('AdmPanel/BiayaOngkir'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function delete_biaya_ongkir($id)
    {
        $this->db->table('biaya_ongkir')->where('id_biaya_ongkir', $id)->delete();
        return redirect()->to(base_url('AdmPanel/BiayaOngkir'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
    }

    public function transaksi_get($id)
    {
        return $this->response->setJSON(
            $this->db->table('transactions')
                ->where('rowid', $id)
                ->get()->getResultArray()
        );
    }

    public function arsip_laporan()
    {
        return view('admin/arsip', [
            'data' => $this->db->table('arsip_laporan')->get()->getResultArray(),
            'title' => 'Arsip Laporan'
        ]);
    }

    public function add_arsip_laporan()
    {
        return view('admin/arsip_add', [
            'title' => 'New Arsip Laporan'
        ]);
    }

    public function store_arsip_laporan()
    {
        helper('form');
        $rules = [
            'nama_laporan' => 'required',
            'file' => 'uploaded[file]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/ArsipLaporan/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $ext = $this->request->getFile('file')->getExtension();
        $nama_file = date('D-dMY-H_i_s') . $ext;

        $data = [
            'nama_laporan' => $this->request->getPost('nama_laporan'),
            'nama_file' => $nama_file,
        ];

        if (!$this->request->getFile('file')->hasMoved()) {
            $this->request->getFile('file')->move('uploads', $nama_file);
        }

        $this->db->table('arsip_laporan')->insert($data);

        return redirect()->to(base_url('AdmPanel/ArsipLaporan'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function edit_arsip_laporan($id)
    {
        return view('admin/arsip_edit', [
            'data' => $this->db->table('arsip_laporan')->where('id_arsip_laporan', $id)->get()->getRowArray(),
            'title' => 'Edit Arsip Laporan'
        ]);
    }

    public function update_arsip_laporan($id)
    {
        helper('form');
        if ($this->request->getFile('nama_file')->isValid()) {
            $rules = [
                'nama_laporan' => 'required',
                'file' => 'uploaded[file]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->to(base_url('AdmPanel/ArsipLaporan/new'))->with('type-status', 'error')
                    ->with('dataMessage', $this->validator->getErrors());
            }

            $ext = $this->request->getFile('gambar')->getExtension();
            $nama_file = date('D-dMY-H_i_s') . $ext;

            $data = [
                'nama_laporan' => $this->request->getPost('nama_laporan'),
                'nama_file' => $nama_file,
            ];

            if (!$this->request->getFile('nama_file')->hasMoved()) {
                $this->request->getFile('nama_file')->move('uploads', $nama_file);
            }

            $this->db->table('arsip_laporan')->insert($data);

            return redirect()->to(base_url('AdmPanel/ArsipLaporan'))->with('type-status', 'success')
                ->with('message', 'Data berhasil diubah');
        } else {
            $rules = [
                'nama_laporan' => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->to(base_url('AdmPanel/ArsipLaporan/new'))->with('type-status', 'error')
                    ->with('dataMessage', $this->validator->getErrors());
            }

            $data = [
                'nama_laporan' => $this->request->getPost('nama_laporan'),
            ];

            $this->db->table('arsip_laporan')->where('id_arsip_laporan', $id)->update($data);

            return redirect()->to(base_url('AdmPanel/ArsipLaporan'))->with('type-status', 'success')
                ->with('message', 'Data berhasil diubah');
        }
    }

    public function delete_arsip_laporan($id)
    {
        $this->db->table('arsip_laporan')->where('id_arsip_laporan', $id)->delete();

        return redirect()->to(base_url('AdmPanel/ArsipLaporan'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
    }

    public function transaksi_laporan()
    {
        return view('admin/laporan_transaksi', [
            'data' => $this->db->table('transactions')->orderBy('id_transactions', 'DESC')->get()->getResultArray()
        ]);
    }

    public function item()
    {
        return view('admin/laporan_item', [
            'data' => $this->db->table('transactions')
                ->select(new RawSql('DISTINCT id_item, fullname, COUNT(id_item) as total_transaksi, transactions_datetime'))
                ->groupBy('id_item')->get()->getResultArray()
        ]);
    }

    public function pembeli()
    {
        return view('admin/laporan_pembeli', [
            'data' => $this->db->table('pembeli')->get()->getResultArray()
        ]);
    }

    public function laporan()
    {
        return view('admin/laporan');
    }

    public function print()
    {
        $date1 = $this->request->getPost('val1');
        $date2 = $this->request->getPost('val2');

        return view('admin/transaksi', [
            'order' => $this->db->query("SELECT * FROM transactions WHERE transactions_datetime BETWEEN '$date1' AND '$date2'")->getResultArray(),
            'keranjang' => $this->keranjangModel->findAll(),
        ]);
    }
}