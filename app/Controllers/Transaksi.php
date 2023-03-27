<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeranjangProdukModel;
use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    protected $transaksiModel;
    protected $keranjangModel;
    protected $db;
    protected $voucherSistem;

    public function __construct()
    {
        helper('form');
        $this->db = \Config\Database::connect();
        $this->transaksiModel = new TransaksiModel();
        $this->keranjangModel = new KeranjangProdukModel();
    }

    public function index()
    {
        return view('admin/transaksi', [
            'order' => $this->transaksiModel->findAll(),
            'keranjang' => $this->keranjangModel->findAll()
        ]);
    }

    public function show($id)
    {
        $get = $this->keranjangModel->find($id);
        // dd($get);
        return view('admin/invoice', [
            'data' => $get
        ]);
    }

    public function validasi_bb($id)
    {
        $data = [
            'status_bayar' => 'Diproses'
        ];

        $this->keranjangModel->update($id, $data);

        return redirect()->to(base_url('AdminPanel/TransaksiCustomer'))->with('type-status', 'success')
            ->with('message', 'Data berhasil divalidasi');
    }

    public function update_kirim($id)
    {
        $data = [
            'status_bayar' => 'Dalam Pengiriman'
        ];

        $this->keranjangModel->update($id, $data);

        return redirect()->to(base_url('AdminPanel/TransaksiCustomer'))->with('type-status', 'success')
            ->with('message', 'Status Berhasil diubah');
    }
}
