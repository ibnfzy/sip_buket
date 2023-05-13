<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WebsiteSettingModel;

class AdminController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function setting()
    {
        $web = new WebsiteSettingModel();
        $get = $web->find(01);

        return view('admin/web_setting', [
            'data' => $get
        ]);
    }

    public function biaya_ongkir()
    {
        return view('admin/ongkir', [
            'title' => 'Biaya Ongkir',
            'data' => $this->db->table('biaya_ongkir')->get()->getResultArray()
        ]);
    }

    public function add_biaya_ongkir()
    {
        helper('form');
        return view('admin/ongkir_add', [
            'title' => 'Tambah Biaya Onkir'
        ]);
    }

    public function store_biaya_ongkir()
    {
        helper('form');
        $rules = [
            'nama_kota' => 'required',
            'biaya' => 'required|min_length[1]|max_length[7]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/BiayaOngkir/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_kota' => $this->request->getPost('nama_kota'),
            'biaya' => $this->request->getPost('biaya')
        ];

        $this->db->table('biaya_ongkir')->insert($data);

        return redirect()->to(base_url('AdminPanel/BiayaOngkir'))->with('type-status', 'success')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function delete_biaya_ongkir($id)
    {
        $this->db->table('biaya_ongkir')->where('id_biaya_ongkir', $id)->delete();
        return redirect()->to(base_url('AdminPanel/BiayaOngkir'))->with('type-status', 'success')
            ->with('message', 'Data berhasil dihapus');
    }
}