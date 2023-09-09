<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InformasiTokoModel;

class InformasiToko extends BaseController
{
    protected $settingsModel;

    public function __construct()
    {
        $this->settingsModel = new InformasiTokoModel();
    }

    public function index()
    {
        helper('form');
        // dd($this->settingsModel->find($id));
        return view('admin/web_setting', [
            'title' => 'Informasi Settings',
            'parentdir' => 'settings',
            'data' => $this->settingsModel->find('01')
        ]);
    }

    public function update()
    {
        helper('form');
        $rules = [
            'alamat' => 'required|min_length[5]|max_length[254]',
            'nomor' => 'required|min_length[10]|max_length[13]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdmPanel/Settings'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'alamat_toko' => $this->request->getPost('alamat'),
            'kontak_toko' => $this->request->getPost('nomor'),
        ];

        $this->settingsModel->update('01', $data);

        return redirect()->to(base_url('AdmPanel/Settings'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diperbarui');
    }
}
