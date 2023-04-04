<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartItemModel;
use App\Models\InformasiTokoModel;
use App\Models\ItemModel;
use App\Models\PembeliInformasiModel;
use App\Models\ReviewItemModel;
use App\Models\TransactionsModel;

class PembeliController extends BaseController
{
    protected $transaksiModel;
    protected $db;
    protected $cart;
    protected $itemModel;
    protected $cart_itemModel;
    protected $informasiPembeli;
    protected $tokoInformasi;
    protected $reviewModel;

    public function __construct()
    {
        $this->transaksiModel   = new TransactionsModel();
        $this->itemModel        = new ItemModel();
        $this->cart_itemModel   = new CartItemModel();
        $this->informasiPembeli = new PembeliInformasiModel();
        $this->tokoInformasi    = new InformasiTokoModel();
        $this->reviewModel      = new ReviewItemModel();
        $this->db               = \Config\Database::connect();
        $this->cart             = \Config\Services::cart();
    }

    public function index()
    {
        return view('pembeli/dashboard');
    }

    public function transaksi()
    {
        $getcart_item = $this->db->table('cart_item')
            ->where('id_pembeli', $_SESSION['id_pembeli'])
            ->get()
            ->getResultArray();

        $getTransaksi = $this->db->table('transactions')
            ->where('id_pembeli', $_SESSION['id_pembeli'])
            ->get()
            ->getResultArray();

        return view('pembeli/transaksi', [
            'transaksi' => $getTransaksi,
            'cart_item' => $getcart_item
        ]);
    }

    public function ubah_status()
    {
        $data = [
            'status_bayar' => $this->request->getPost('status_bayar')
        ];

        $this->cart_itemModel->update($this->request->getPost('id_cart_item'), $data);

        $get = $this->db->query("SELECT * FROM voucher ORDER BY RAND() LIMIT 1")->getFirstRow();

        if (isset($get->potongan)) {
            $data = [
                'id_pembeli' => $_SESSION['id_pembeli'],
                'id_reward' => $get->id_reward,
                'fullname' => $_SESSION['fullname'],
                'potongan' => $get->potongan,
                'status' => 'Belum Terpakai',
                'up_datetime' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('voucher_pembeli')->insert($data);
            return $this->response->setJSON(['msg' => 'Berhasil merubah status bayar']);
        }

        return $this->response->setJSON(['msg' => 'Berhasil merubah status bayar']);
    }

    public function invoice($rowid)
    {
        helper('form');
        $get = $this->informasiPembeli->where('id_pembeli', $_SESSION['id_pembeli'])->first();
        $getTransaksi = $this->transaksiModel->where('rowid', $rowid)->first();
        $getcart_item = $this->cart_itemModel->where('rowid', $rowid)->first();

        $getTransaksiData = $this->db->table('transactions')
            ->where('rowid', $rowid)
            ->get()
            ->getResultArray();

        $tgl_batas = date('Y-m-d', strtotime('+2 days', strtotime($getcart_item['tgl_checkout'])));

        return view('pembeli/invoice', [
            'rowid' => $rowid,
            'dataToko' => $this->tokoInformasi->find(01),
            'datapembeli' => $get,
            'transaksi' => $getTransaksi,
            'cart_item' => $getcart_item,
            'batas' => $tgl_batas,
            'data' => $getTransaksiData
        ]);
    }

    public function upload($id)
    {
        helper('form');
        $rules = [
            'gambar' => 'is_image[gambar]|max_size[gambar,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('PembeliPanel/Transaksi'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'bukti_bayar' => $this->request->getFile('gambar')->getName(),
            'status_bayar' => 'Menunggu Validasi Bukti Bayar',
        ];

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads');
        }

        $this->cart_itemModel->update($id, $data);

        return redirect()->to(base_url('PembeliPanel/Transaksi'))->with('type-status', 'info')
            ->with('message', 'Bukti Bayar berhasil diupload');
    }

    public function voucher()
    {
        $get = $this->db->table('voucher_pembeli')->where('id_pembeli', $_SESSION['id_pembeli'])
            ->get()->getResultArray();
        return view('pembeli/voucher', [
            'data' => $get
        ]);
    }

    public function review()
    {
        return view('pembeli/review', [
            'data' => $this->db->table('review_item')
                ->where('id_pembeli', $_SESSION['id_pembeli'])
                ->get()->getResultArray()
        ]);
    }

    public function add_review()
    {
        $get = $this->db->table('cart_item')
            ->select([
                'cart_item.rowid',
                'transactions.id_item',
                'transactions.nama_item'
            ])->join('transactions', 'cart_item.rowid = transactions.rowid', 'inner')
            ->where('cart_item.status_bayar', 'Selesai')
            ->where('cart_item.id_pembeli', $_SESSION['id_pembeli'])
            ->get()->getResultArray();

        $option = [];
        foreach ($get as $data) {
            $option[$data['id_item']] = $data['nama_item'];
        }

        return view('pembeli/review_add', [
            'data' => $option
        ]);
    }

    public function save_review()
    {
        $rules = [
            'id_item' => 'required',
            'nilai' => 'required|less_than_equal_to[8]',
            'isi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('PembeliPanel/Testimoni/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'id_item' => $this->request->getPost('id_item'),
            'id_pembeli' => $_SESSION['id_pembeli'],
            'isi_review_item' => $this->request->getPost('isi'),
            'bintang' => $this->request->getPost('nilai'),
            'insert_datetime' => date('D, d M Y H:i:s'),
        ];

        $this->reviewModel->save($data);

        return redirect()->to(base_url('PembeliPanel/Testimoni'))->with('type-status', 'info')
            ->with('message', 'Testimoni berhasil');
    }

    public function setting()
    {
        helper('form');
        return view('pembeli/setting', [
            'data' => $this->informasiPembeli->where('id_pembeli', $_SESSION['id_pembeli'])->first()
        ]);
    }

    public function save_setting($id)
    {
        helper('form');
        $rules = [
            'alamat' => 'required|min_length[5]|max_length[254]',
            'nomor' => 'required|min_length[10]|max_length[13]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('PembeliPanel/informasi'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'alamat' => $this->request->getPost('alamat'),
            'nomor_hp' => $this->request->getPost('nomor'),
        ];

        $this->informasiPembeli->update($id, $data);

        return redirect()->to(base_url('PembeliPanel/informasi'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diperbarui');
    }

    public function checkout()
    {
        helper('text');
        $diskon = (isset($_SESSION['diskon'])) ? $_SESSION['diskon'] : 0;

        $subtotal = $_SESSION['subtotal'];

        if (isset($_SESSION['diskon'])) {
            $subtotal = ($_SESSION['diskon'] / 100) * $_SESSION['subtotal'];
        }
        if (isset($_SESSION['logged_in_pelanggan']) and $_SESSION['logged_in_pelanggan'] == TRUE) {
            $q = 0;
            $get = [];
            $data = [];
            $rowid = random_string('alnum', 15);
            foreach ($this->cart->contents() as $item) {
                $produk = $this->itemModel->find($item['id']);
                $get[] = $produk;
                $get[$q]['qty'] = $item['qty'];
                $get[$q]['total_harga'] = $item['qty'] * $item['price'];
                $stok = $produk['stok_item'] - $item['qty'];
                $this->itemModel->update($item['id'], [
                    'stok_item' => $stok
                ]);
                $q++;
            }

            foreach ($get as $item) {
                $data[] = [
                    'id_item' => $item['id_item'],
                    'id_pembeli' => $_SESSION['id_pembeli'],
                    'rowid' => $rowid,
                    'fullname' => $_SESSION['fullname'],
                    'nama_item' => $item['nama_item'],
                    'total_harga' => $item['total_harga'],
                    'transaksi_datetime' => date('D, d M Y H:i:s'),
                    'qty_transaksi' => $item['qty'],
                ];
            }

            $dataKeranjang = [
                'id_pembeli' => session()->get('id_pembeli'),
                'rowid' => $rowid,
                'total_items' => $this->cart->totalItems(),
                'potongan' => $diskon,
                'total_bayar' => $subtotal,
                'status_bayar' => 'Menunggu Bukti Bayar',
                'tgl_checkout' => date('Y-m-d')
            ];

            $this->db->table('transactions')->insertBatch($data);
            $this->db->table('cart_item')->insert($dataKeranjang);

            $home = new Home;
            $home->clear_cart();

            return redirect()->to(base_url('PembeliPanel/invoice/' . $rowid));
        } else {
            return $this->response->setJSON([
                'msg' => 'Anda harus login sebelum checkout'
            ]);
        }
    }
}
