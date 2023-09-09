<?php

namespace App\Controllers;

use App\Models\CorouselModel;
use App\Models\ItemModel;

class Home extends BaseController
{
    protected $cart;
    protected $itemModel;
    protected $db;
    protected $corouselModel;
    protected $corousel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->cart = \Config\Services::cart();
        $this->itemModel = new ItemModel();
        $this->corouselModel = new CorouselModel();

        $this->corousel = $this->corouselModel->findAll();
    }

    public function index()
    {
        return view('web/home', [
            'cr' => $this->corousel,
            'rekom' => $this->itemModel->orderBy('rand()')->findAll(8)
        ]);
    }

    public function item()
    {
        return view('web/item', [
            'data' => $this->itemModel->orderBy('id_item', 'DESC')->paginate(8, 'item'),
            'pager' => $this->itemModel->pager,
            'cr' => $this->corousel
        ]);
    }

    public function kategori($kategori)
    {
        return view('web/kategori', [
            'data' => $this->itemModel->where('kategori_item', str_replace('_', ' ', $kategori))->orderBy('id_item', 'DESC')->paginate(8, 'item'),
            'pager' => $this->itemModel->pager,
            'cr' => $this->corousel
        ]);
    }

    public function item_detail($id)
    {
        return view('web/item_detail', [
            'data' => $this->itemModel->find($id),
            'cr' => $this->corousel
        ]);
    }

    public function cart()
    {
        return view('web/cart', [
            'cr' => $this->corousel
        ]);
    }

    public function add_item()
    {
        // $get = $this->itemModel->find($this->request->getPost('id'));
        $get = $this->db->table('item')->where('id_item', $this->request->getPost('id'))->get()->getRowArray();

        // dd($this->request->getPost('id'));

        $this->cart->insert([
            'id' => $get['id_item'],
            'qty' => 1,
            'price' => $get['harga_item'],
            'name' => $get['nama_item'],
            'gambar' => $get['gambar_item'],
            'stok' => $get['stok_item']
        ]);

        return $this->response->setJSON(['msg' => 'Item berhasil masuk ke keranjang']);
    }

    public function remove_item($rowId)
    {
        $this->cart->remove($rowId);

        return redirect()->to(base_url('Cart'));
    }

    public function clear_cart()
    {
        $destroy = new \CodeIgniterCart\Config\Services;

        $destroy->cart()->destroy();
        $_SESSION['diskon'] = 0;
        $_SESSION['id_diskon'] = null;

        return redirect()->to(base_url('Cart'));
    }

    public function update_cart()
    {
        $rowid = $this->request->getPost('rowid');
        $qty = $this->request->getPost('qtybutton');
        $stok = $this->request->getPost('stok');
        $status = true;

        for ($i = 1; $i <= count($this->cart->contents()); $i++) {
            if ($qty[$i] > $stok[$i]) {
                $status = false;
                break;
            }

            $this->cart->update([
                'rowid' => $rowid[$i],
                'qty' => $qty[$i]
            ]);
        }

        if ($status == false) {
            return redirect()->to(base_url('Cart'))->with('type-status', 'error')
                ->with('message', 'Kuantitas item melebihi stok');
        }

        return redirect()->to(base_url('Cart'))->with('type-status', 'success')
            ->with('message', 'Berhasil diperbaruhi');
    }

    public function diskon_get()
    {
        $session = session();
        if (isset($_SESSION['id_pembeli'])) {
            $get = $this->db->table('voucher_pembeli')
                ->where('id_pembeli', $_SESSION['id_pembeli'])
                ->where('id_pembeli_voucher', $this->request->getPost('id'))
                ->get()
                ->getResultArray();

            if ($get) {
                $session->set([
                    'diskon' => $get[0]['potongan'],
                    'id_pembeli_voucher' => $get[0]['id_pembeli_voucher']
                ]);
                return $this->response->setJSON([
                    'msg' => 'Kode Diskon tersedia!',
                    'id' => $get[0]['id_pembeli_voucher'],
                    'diskon' => $get[0]['potongan']
                ]);
            } else {
                return $this->response->setJSON([
                    'msg' => 'ID tidak ditemukan'
                ]);
            }
        } else {
            return $this->response->setJSON([
                'msg' => 'Anda belum login!, silahkan login terlebih dahulu!'
            ]);
        }
    }
}