<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AdminLogin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        return view('login/admin_login');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->adminModel->where('username', $username)->first();

        if ($data) {
            $password_data = $data['password'];
            $id = $data['id_admin'];

            $verify = password_verify($password ?? '', $password_data);

            if ($verify) {
                $sessionData = [
                    'id_admin' => $data['id_admin'],
                    'fullname' => $data['fullname'],
                    'username' => $data['username'],
                    'logged_in_admin' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_admin', 1800); //timeout 30 menit

                $data = [
                    'last_login' => date('Y-m-d')
                ];

                $this->adminModel->update($id, $data);

                return redirect()->to(base_url('AdmPanel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname']);
            } else {
                return redirect()->to(base_url('Auth/Admin'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Auth/Admin'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logout()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Auth/Admin'));

        // return view('login/admin_login');
    }
}
