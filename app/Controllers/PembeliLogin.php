<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembeliModel;

class PembeliLogin extends BaseController
{
    protected $db;
    protected $pembeliModel;

    public function __construct()
    {
        $this->pembeliModel = new PembeliModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/pembeli_login');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');


        $data = $this->pembeliModel->where('username', $username)->first();

        if ($data) {
            $password_data = $data['password'];
            $id = $data['id_pembeli'];

            $verify = password_verify($password ?? '', $password_data);
            // dd($verify);

            if ($verify) {
                $sessionData = [
                    'id_pembeli' => $data['id_pembeli'],
                    'fullname' => $data['fullname'],
                    'username' => $data['username'],
                    'logged_in_pelanggan' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_admin', 1800); //timeout 30 menit

                $data = [
                    'last_login' => date('Y-m-d')
                ];

                $this->pembeliModel->update($id, $data);

                return redirect()->to(base_url('PembeliPanel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname']);
            } else {
                return redirect()->to(base_url('Auth/Pembeli'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Auth/Pembeli'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logout()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Auth/Pembeli'));
        // return view('login/user_login');
    }

    public function registration()
    {
       helper('form');
        $option = [];
        $w = 1;

        foreach ($this->db->table('biaya_ongkir')->get()->getResultArray() as $item) {
            $option[$item['nama_kota']] = $w . '. ' . $item['nama_kota'];
            $w++;
        }
      
        return view('login/pembeli_registration', [
            'ongkir' => $option
        ]);
    }

    public function signup()
    {
        $rules = [
            'fullname' => 'required|min_length[5]|max_length[30]',
            'username' => 'required|min_length[5]|max_length[16]|is_unique[pembeli.username]',
            'password' => 'required|min_length[5]|max_length[16]',
            'confirmPassword' => 'required|matches[password]',
          'kota' => 'required',
            'alamat' => 'required|min_length[5]|max_length[254]',
            'nomor' => 'required|min_length[10]|max_length[13]',
            'desa' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Auth/Pembeli/Registration'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'password' => password_hash($this->request->getPost('password') ?? '', PASSWORD_DEFAULT),
            'last_login' => date('Y-m-d H:i:s')
        ];

        $this->pembeliModel->save($data);

        $getUser = $this->pembeliModel->where('username', $this->request->getPost('username'))->first();

        $dataV = [
            'id_pembeli' => $getUser['id_pembeli'],
            'poin' => 0
        ];

        $dataInfo = [
            'id_pembeli' => $getUser['id_pembeli'],
          'kota' => $this->request->getPost('kota'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_hp' => $this->request->getPost('nomor'),
            'kec_desa' => $this->request->getPost('desa'),
            'kode_pos' => $this->request->getPost('kode_pos'),
        ];

        $this->db->table('voucher_sistem')->insert($dataV);
        $this->db->table('pembeli_informasi')->insert($dataInfo);

        return redirect()->to(base_url('Auth/Pembeli'))->with('type-status', 'success')
            ->with('message', 'Registrasi berhasil, silahkan login untuk memulai session');
    }
}
