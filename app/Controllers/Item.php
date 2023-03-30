<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\KategoriItemModel;

class Item extends BaseController
{
    protected $itemModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->kategoriModel = new KategoriItemModel();
    }

    public function index()
    {
        $data = [
            'item' => $this->itemModel->findAll()
        ];

        return view('admin/item', $data);
    }

    public function new()
    {
        helper('form');

        $option = [];

        foreach ($this->kategoriModel->findAll() as $item) {
            $option[$item['nama_kategori']] = $item['id_kategori'] . '. ' . $item['nama_kategori'];
        }

        $data = [
            'title' => 'Tambah item',
            'parentdir' => 'item',
            'option' => $option
        ];

        return view('admin/item_add', $data);
    }

    public function create()
    {
        helper('form');
        $rules = [
            'nama' => 'required|min_length[5]|max_length[50]',
            'harga' => 'required|min_length[1]|max_length[7]',
            'stok_item' => 'required|min_length[1]|max_length[2]',
            'kategori' => 'required',
            'gambar' => 'is_image[gambar]|max_size[gambar,2048]',
            'desc' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/item/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_item' => $this->request->getPost('nama'),
            'gambar_item' => $this->request->getFile('gambar')->getName(),
            'desc_item' => $this->request->getPost('desc'),
            'harga_item' => $this->request->getPost('harga'),
            'stok_item' => $this->request->getPost('stok_item'),
            'kategori_item' => $this->request->getPost('kategori'),
            'last_login' => date('D, d M Y H:i:s')
        ];

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads');
        }

        $this->itemModel->save($data);

        return redirect()->to(base_url('AdmPanel/item'))->with('type-status', 'info')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        helper('form');
        $option = [];

        foreach ($this->kategoriModel->findAll() as $item) {
            $option[$item['nama_kategori']] = $item['id_kategori'] . '. ' . $item['nama_kategori'];
        }
        $data = [
            'title' => 'Edit item',
            'parentdir' => 'item',
            'item' => $this->itemModel->find($id),
            'option' => $option
        ];

        return view('admin/item_edit', $data);
    }

    public function update($id)
    {
        helper('form');
        if ($this->request->getFile('gambar')->isValid()) {
            $rules = [
                'nama' => 'required|min_length[5]|max_length[50]',
                'harga' => 'required|min_length[1]|max_length[7]',
                'stok_item' => 'required|min_length[1]|max_length[2]',
                'kategori' => 'required',
                'gambar' => 'is_image[gambar]|max_size[gambar,2048]',
                'desc' => 'required',
            ];

            $data = [
                'nama_item' => $this->request->getPost('nama'),
                'gambar_item' => $this->request->getFile('gambar')->getName(),
                'desc_item' => $this->request->getPost('desc'),
                'stok_item' => $this->request->getPost('stok_item'),
                'harga_item' => $this->request->getPost('harga'),
                'kategori_item' => $this->request->getPost('kategori'),
                'last_login' => date('D, d M Y H:i:s')
            ];
        } else {
            $rules = [
                'nama' => 'required|min_length[5]|max_length[50]',
                'harga' => 'required|min_length[1]|max_length[7]',
                'stok_item' => 'required|min_length[1]|max_length[2]',
                'kategori' => 'required',
                'desc' => 'required',
            ];

            $data = [
                'nama_item' => $this->request->getPost('nama'),
                'desc_item' => $this->request->getPost('desc'),
                'harga_item' => $this->request->getPost('harga'),
                'stok_item' => $this->request->getPost('stok_item'),
                'kategori_item' => $this->request->getPost('kategori'),
                'last_login' => date('D, d M Y H:i:s')
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/item/' . $id . '/edit'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        if ($this->request->getFile('gambar')->isValid() && !$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads');
        }

        $this->itemModel->update($id, $data);

        return redirect()->to(base_url('AdmPanel/item'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $this->itemModel->delete($id);

        return redirect()->to(base_url('AdmPanel/item'))->with('type-status', 'info')
            ->with('message', 'Data berhasil terhapus');
    }
}