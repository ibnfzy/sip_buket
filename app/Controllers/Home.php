<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    protected $produkModel;
    protected $db;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('web/home');
    }

    public function katalog()
    {
        return view('web/katalog', [
            'data' => $this->produkModel->orderBy('id_produk', 'DESC')->paginate(9, 'produk'),
            'pager' => $this->produkModel->pager
        ]);
    }

    public function detail($id)
    {
        return view('web/detail', [
            'data' => $this->produkModel->find($id)
        ]);
    }
}
