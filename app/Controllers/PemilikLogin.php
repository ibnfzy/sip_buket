<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemilikModel;

class PemilikLogin extends BaseController
{
    protected $pemilikModel;

    public function __construct()
    {
        $this->pemilikModel = new PemilikModel();
    }

    public function index()
    {
        return view('login/pemilik_login');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = ($this->request->getPost('password') != null) ? $this->request->getPost('password') : '';

        $data = $this->pemilikModel->where('username', $username)->first();

        if ($data) {
            $password_data = $data['password'];
            $id = $data['id_pemilik'];

            $verify = password_verify($password, $password_data);

            if ($verify) {
                $sessionData = [
                    'id_pemilik' => $data['id_pemilik'],
                    'fullname' => $data['fullname'],
                    'username' => $data['username'],
                    'logged_in_pemilik' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_admin', 1800); //timeout 30 menit

                $data = [
                    'last_login' => date('Y-m-d')
                ];

                $this->pemilikModel->update($id, $data);

                return redirect()->to(base_url('PemilikPanel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname']);
            } else {
                return redirect()->to(base_url('Auth/Pemilik'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Auth/Pemilik'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logout()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Auth/Pemilik'));

        // return view('login/admin_login');
    }
}