<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OwnerModel;

class OwnerLogin extends BaseController
{
    protected $ownerModel;

    public function __construct()
    {
        $this->ownerModel = new OwnerModel();
    }

    public function index()
    {
        return view('login/owner_login');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $this->ownerModel->where('username', $username)->first();

        if ($data) {
            $password_data = $data['password'];
            $id = $data['id_owner'];

            $verify = password_verify($password ?? '', $password_data);

            if ($verify) {
                $sessionData = [
                    'id_owner' => $data['id_owner'],
                    'fullname' => $data['fullname'],
                    'username' => $data['username'],
                    'logged_in_owner' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_owner', 1800); //timeout 30 menit

                $data = [
                    'last_login' => date('Y-m-d')
                ];

                $this->ownerModel->update($id, $data);

                return redirect()->to(base_url('OwnerPanel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname']);
            } else {
                return redirect()->to(base_url('Auth/Owner'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Auth/Owner'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logout()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Auth/Owner'));

        // return view('login/owner_login');
    }
}
