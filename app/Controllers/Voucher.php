<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VoucherModel;

class Voucher extends BaseController
{
    protected $voucherModel;

    public function __construct()
    {
        helper('form');
        $this->voucherModel = new VoucherModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin/voucher', [
            'title' => 'Table Voucher',
            'parentdir' => 'voucher',
            'voucher' => $this->voucherModel->findAll()
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('admin/voucher_add', [
            'title' => 'Tambah Voucher',
            'parentdir' => 'voucher'
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
            'title' => 'required|min_length[15]|max_length[30]',
            'persen' => 'required|min_length[1]|max_length[2]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Voucher/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'title_voucher' => $this->request->getPost('title'),
            'persen' => $this->request->getPost('persen'),
            'up_datetime' => date('Y-m-d H:i:s')
        ];

        $this->voucherModel->save($data);

        return redirect()->to(base_url('AdmPanel/Voucher'))->with('type-status', 'info')
            ->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        return view('admin/voucher_edit', [
            'title' => 'Edit Voucher',
            'parentdir' => 'voucher',
            'data' => $this->voucherModel->find($id)
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $rules = [
            'title' => 'required|min_length[15]|max_length[30]',
            'persen' => 'required|min_length[1]|max_length[2]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Voucher/' . $id . '/edit'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'title_voucher' => $this->request->getPost('title'),
            'persen' => $this->request->getPost('persen'),
            'up_datetime' => date('Y-m-d H:i:s')
        ];

        $this->voucherModel->update($id, $data);

        return redirect()->to(base_url('AdmPanel/Voucher'))->with('type-status', 'success')
            ->with('message', 'Data berhasil diperbarui');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->voucherModel->delete($id);

        return redirect()->to(base_url('AdmPanel/Voucher'))->with('type-status', 'info')
            ->with('message', 'Data berhasil terhapus');
    }
}
