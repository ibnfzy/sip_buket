<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class CustLogin extends BaseController
{
    protected $db;
    protected $CustomerModel;

    public function __construct()
    {
        $this->CustomerModel = new CustomerModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('login/user_login');
    }

    public function auth()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = ($this->request->getPost('password') != null) ? $this->request->getPost('password') : '';

        $data = $this->CustomerModel->where('username', $username)->first();

        if ($data) {
            $password_data = $data['password'];
            $id = $data['id_customer'];

            $verify = password_verify($password, $password_data);

            if ($verify) {
                $sessionData = [
                    'id_customer' => $data['id_customer'],
                    'fullname' => $data['fullname'],
                    'username' => $data['username'],
                    'logged_in_pelanggan' => TRUE
                ];

                $session->set($sessionData);
                // $session->markAsTempdata('logged_in_admin', 1800); //timeout 30 menit

                $data = [
                    'last_login' => date('Y-m-d')
                ];

                $this->CustomerModel->update($id, $data);

                return redirect()->to(base_url('CustomerPanel'))->with('type-status', 'info')
                    ->with('message', 'Selamat Datang Kembali ' . $sessionData['fullname']);
            } else {
                return redirect()->to(base_url('Auth/User'))->with('type-status', 'error')
                    ->with('message', 'Password tidak benar');
            }
        } else {
            return redirect()->to(base_url('Auth/User'))->with('type-status', 'error')
                ->with('message', 'Username tidak benar');
        }
    }

    public function logout()
    {
        $session = session();

        $session->destroy();

        return redirect()->to(base_url('Auth/Customer'));
        // return view('login/user_login');
    }

    public function registration()
    {
        return view('login/user_daftar');
    }

    public function signup()
    {
        $rules = [
            'fullname' => 'required|min_length[5]|max_length[30]',
            'username' => 'required|min_length[5]|max_length[16]|is_unique[customer.username]',
            'password' => 'required|min_length[5]|max_length[16]',
            'confirmPassword' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('Auth/Customer/Registration'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $password = ($this->request->getPost('password') != null) ? $this->request->getPost('password') : '';

        $data = [
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'last_login' => date('Y-m-d H:i:s')
        ];

        $this->CustomerModel->save($data);

        $getUser = $this->CustomerModel->where('username', $this->request->getPost('username'))->first();

        // $dataV = [
        //     'id_customer' => $getUser['id_customer'],
        //     'poin' => 0
        // ];

        $dataInfo = [
            'id_customer' => $getUser['id_customer']
        ];

        // $this->db->table('voucher_sistem')->insert($dataV);
        $this->db->table('customer_informasi')->insert($dataInfo);

        return redirect()->to(base_url('Auth/Customer'))->with('type-status', 'success')
            ->with('message', 'Registrasi berhasil, silahkan login untuk memulai session');
    }
}
