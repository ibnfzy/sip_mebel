<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartItemModel;
use App\Models\InformasiTokoModel;
use App\Models\ItemModel;
use App\Models\PembeliInformasiModel;
use App\Models\ReviewItemModel;
use App\Models\TransactionsModel;
use App\Models\VoucherPembeliModel;

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
    protected $voucherPembeli;

    public function __construct()
    {
        $this->transaksiModel   = new TransactionsModel();
        $this->itemModel        = new ItemModel();
        $this->cart_itemModel   = new CartItemModel();
        $this->informasiPembeli = new PembeliInformasiModel();
        $this->tokoInformasi    = new InformasiTokoModel();
        $this->reviewModel      = new ReviewItemModel();
        $this->voucherPembeli   = new VoucherPembeliModel();
        $this->db               = \Config\Database::connect();
        $this->cart             = \Config\Services::cart();
    }

    public function index()
    {
        return view('pembeli/dashboard', [
            'data' => $this->itemModel->orderBy('id_item', 'DESC')->paginate(6, 'items'),
            'pager' => $this->itemModel->pager
        ]);
    }

    public function transaksi()
    {
        $getcart_item = $this->db->table('cart_item')
            ->where('id_pembeli', $_SESSION['id_pembeli'])
          	->orderBy('id_cart_item', 'DESC')
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
          	'tanggal_upload_bayar' => date('Y-m-d'),
          	'batas_pembayaran' => null
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
        helper('form');
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
        helper('form');
        $rules = [
            'id_item' => 'required',
            'nilai' => 'required',
            'isi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('PembeliPanel/Review/new'))->with('type-status', 'error')
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

        return redirect()->to(base_url('PembeliPanel/Review'))->with('type-status', 'info')
            ->with('message', 'Testimoni berhasil');
    }

    public function delete_review($id)
    {
        $this->reviewModel->delete($id);
        return redirect()->to(base_url('PembeliPanel/Review'))->with('type-status', 'info')
            ->with('message', 'Testimoni berhasil Dihapus');
    }

    public function setting()
    {
        helper('form');
        $option = [];
        $w = 1;

        foreach ($this->db->table('biaya_ongkir')->get()->getResultArray() as $item) {
            $option[$item['nama_kota']] = $w . '. ' . $item['nama_kota'];
            $w++;
        }

        return view('pembeli/setting', [
            'data' => $this->informasiPembeli->where('id_pembeli', $_SESSION['id_pembeli'])->first(),
            'ongkir' => $option
        ]);
    }

    public function save_setting($id)
    {
        helper('form');
        $rules = [
            'kota' => 'required',
            'alamat' => 'required|min_length[5]|max_length[254]',
            'nomor' => 'required|min_length[10]|max_length[13]',
            'desa' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('PembeliPanel/Setting'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'kota' => $this->request->getPost('kota'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_hp' => $this->request->getPost('nomor'),
            'kec_desa' => $this->request->getPost('desa'),
        ];

        $this->informasiPembeli->update($id, $data);

        return redirect()->to(base_url('PembeliPanel/Setting'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diperbarui');
    }

    public function checkout()
    {
        helper('text');

        $subtotal = $_SESSION['subtotal'];
        $type_reward = 'diskon';
        $metode = $this->request->getPost('bayar');
      	$diskon = 0;
      
      	if ($this->cart->totalItems() == 1) {
      		$diskon = 5;    
        } else if ($this->cart->totalItems() == 2) {
         	$diskon = 10; 
        } else if ($this->cart->totalItems() >= 3) {
         	$type_reward = 'free';
        }
      
        $getPembeli = $this->db->table('pembeli_informasi')->where('id_pembeli', $_SESSION['id_pembeli'])->get()->getRowArray();
        $home = new Home;
      
        if (!isset($getPembeli) and $getPembeli['alamat'] == null or $getPembeli['nomor_hp'] == null or $getPembeli['kota'] == null or $getPembeli['kec_desa'] == null) {
            $home->clear_cart();
            return redirect()->to(base_url('PembeliPanel/Setting'))->with('type-status', 'info')
                ->with('message', 'Transaksi Gagal, silahkan lengkapi informasi dahulu');
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
                    'qty_transactions' => $item['qty'],
                ];
            }

            $dataKeranjang = [
                'id_pembeli' => session()->get('id_pembeli'),
                'rowid' => $rowid,
                'total_items' => $this->cart->totalItems(),
                'potongan' => $diskon,
                'total_bayar' => $subtotal,
                'status_bayar' => ($metode == 'transfer') ? 'Menunggu Bukti Bayar' : 'Diproses',
                'metode_pembayaran' => ($metode == 'transfer') ? 'Transfer' : 'Cash On Delivery',
                'tgl_checkout' => date('Y-m-d'),
              	'batas_pembayaran' => date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')),
                'type_reward' => $type_reward,
            ];

            $this->db->table('transactions')->insertBatch($data);
            $this->db->table('cart_item')->insert($dataKeranjang);

            $home->clear_cart();

            return redirect()->to(base_url('PembeliPanel/Transaksi/' . $rowid));
        } else {
            return $this->response->setJSON([
                'msg' => 'Anda harus login sebelum checkout'
            ]);
        }
    }
}
