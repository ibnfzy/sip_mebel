<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CorouselModel;

class Corousel extends BaseController
{
    protected $corousel;

    public function __construct()
    {
        helper('form');
        $this->corousel = new CorouselModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin/corousel', [
            'title' => 'Table Corousel',
            'parentdir' => 'corousel',
            'data' => $this->corousel->findAll()
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('admin/corousel_add', [
            'title' => 'Tambah Corousel',
            'parentdir' => 'corousel'
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'file' => 'is_image[file]|max_size[file,2048]',
            'link' => 'required',
            'header' => 'required|min_length[5]|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Corousel/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'gambar' => $this->request->getFile('file')->getName(),
            'link_to' => $this->request->getPost('link'),
            'header' => $this->request->getPost('header')
        ];

        if (!$this->request->getFile('file')->hasMoved()) {
            $this->request->getFile('file')->move('uploads');
        }

        $this->corousel->save($data);

        return redirect()->to(base_url('AdmPanel/Corousel'))->with('type-status', 'info')
            ->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        return view('admin/corousel_edit', [
            'title' => 'Edit Corousel',
            'parentdir' => 'corousel',
            'data' => $this->corousel->find($id),
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if ($this->request->getFile('file')->isValid()) {
            $rules = [
                'file' => 'is_image[file]|max_size[file,2048]',
                'link' => 'required',
                'header' => 'required|min_length[5]|max_length[50]'
            ];

            $data = [
                'gambar' => $this->request->getFile('file')->getName(),
                'link_to' => $this->request->getPost('link'),
                'header' => $this->request->getPost('header')
            ];
        } else {
            $rules = [
                'link' => 'required',
                'header' => 'required|min_length[5]|max_length[50]'
            ];

            $data = [
                'link_to' => $this->request->getPost('link'),
                'header' => $this->request->getPost('header')
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Produk/' . $id . '/edit'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        if ($this->request->getFile('file')->isValid() && !$this->request->getFile('file')->hasMoved()) {
            $this->request->getFile('file')->move('file');
        }

        $this->corousel->update($id, $data);

        return redirect()->to(base_url('AdmPanel/Corousel'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diubah');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->corousel->delete($id);

        return redirect()->to(base_url('AdmPanel/Corousel'))->with('type-status', 'info')
            ->with('message', 'Data berhasil terhapus');
    }
}
