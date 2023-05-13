<?php

namespace App\Controllers;

use App\Models\CorouselModel;
use App\Models\ProdukModel;
use App\Models\WebsiteSettingModel;

class Home extends BaseController
{
    protected $produkModel;
    protected $db;
    protected $cart;
    protected $web;
    protected $corousel;

    public function __construct()
    {
        $this->cart = \Config\Services::cart();
        $this->produkModel = new ProdukModel();
        $this->db = \Config\Database::connect();
        $this->web = new WebsiteSettingModel();
        $this->corousel = new CorouselModel();
    }

    public function index()
    {
        return view('web/home', [
            'cr' => $this->corousel->findAll(),
            'rekom' => $this->produkModel->orderBy('rand()')->findAll(3)
        ]);
    }

    public function katalog()
    {
        return view('web/katalog', [
            'data' => $this->produkModel->orderBy('id_produk', 'DESC')->paginate(9, 'produk'),
            'pager' => $this->produkModel->pager
        ]);
    }

    public function keranjang()
    {
        return view('web/cart', [
            'data' => $this->web->find('01')
        ]);
    }

    public function detail($id)
    {
        return view('web/detail', [
            'data' => $this->produkModel->find($id)
        ]);
    }

    public function add_item()
    {
        $get = $this->produkModel->find($this->request->getPost('id'));

        $this->cart->insert([
            'id' => $get['id_produk'],
            'qty' => 1,
            'price' => $get['harga_produk'],
            'name' => $get['nama_produk'],
            'gambar' => $get['gambar_produk'],
            'stok' => $get['stok_produk']
        ]);

        $_SESSION['kategori'] = $get['kategori_produk'];

        return $this->response->setJSON(['msg' => 'Produk berhasil masuk ke keranjang']);
    }

    public function remove_item($rowId)
    {
        $this->cart->remove($rowId);

        return redirect()->to(base_url('Keranjang'));
    }

    public function clear_cart()
    {
        $destroy = new \CodeIgniterCart\Config\Services;

        $destroy->cart()->destroy();
        $_SESSION['diskon'] = 0;
        $_SESSION['id_diskon'] = null;

        return redirect()->to(base_url('Keranjang'));
    }

    public function update_cart()
    {
        $rowid = $this->request->getPost('rowid');
        $qty = $this->request->getPost('qtybutton');
        $stok = $this->request->getPost('stok');
        $status = true;

        for ($i = 1; $i <= count($this->cart->contents()); $i++) {
            if ($qty[$i] > $stok[$i]) {
                $status = false;
                break;
            }

            $this->cart->update([
                'rowid' => $rowid[$i],
                'qty' => $qty[$i]
            ]);
        }

        if ($status == false) {
            return redirect()->to(base_url('Keranjang'))->with('type-status', 'error')
                ->with('message', 'Kuantitas produk melebihi stok');
        }

        return redirect()->to(base_url('Keranjang'))->with('type-status', 'success')
            ->with('message', 'Berhasil diperbaruhi');
    }
}
