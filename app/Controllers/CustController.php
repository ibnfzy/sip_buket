<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class CustController extends BaseController
{
    protected $cart;
    protected $db;
    protected $produkModel;

    public function __construct()
    {
        $this->cart = \Config\Services::cart();
        $this->db = \Config\Database::connect();
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        //
    }

    public function checkout()
    {
        helper('text');
        $diskon = 0;
        $potonganOngkir = 0;

        $subtotal = $_SESSION['subtotal'];
        $getStatusPelanggan = $this->db->table('customer_informasi')->where('id_customer', $_SESSION['id_customer'])->get()->getRowArray();
        $getOngkir = $this->db->table('website_setting')->where('id_website_setting', '01')->get()->getRowArray();
        $getPelanggan = $this->db->table('keranjang_beli')->where('id_user', $_SESSION['id_user'])->get()->getResultArray();
        $getItem = $this->db->table('produk')->orderBy('rand()')->where('kategori_produk', $_SESSION['kategori'])->limit(1)->get()->getRowArray();

        if ($getStatusPelanggan['status_customer'] == 'Customer Baru' && $getStatusPelanggan['kota_domisili'] == 'Makassar') {
            $potonganOngkir = $getOngkir['biaya_ongkir'];
        }

        if (isset($_SESSION['logged_in_pelanggan']) and $_SESSION['logged_in_pelanggan'] == TRUE) {
            $q = 0;
            $get = [];
            $data = [];
            $rowid = random_string('alnum', 15);
            foreach ($this->cart->contents() as $item) {
                $produk = $this->produkModel->find($item['id']);
                $get[] = $produk;
                $get[$q]['qty'] = $item['qty'];
                $get[$q]['total_harga'] = $item['qty'] * $item['price'];
                $stok = $produk['stok_produk'] - $item['qty'];
                $this->produkModel->update($item['id'], [
                    'stok_produk' => $stok
                ]);
                $q++;
            }

            foreach ($get as $item) {
                $data[] = [
                    'id_produk' => $item['id_produk'],
                    'id_user' => $_SESSION['id_user'],
                    'rowid' => $rowid,
                    'fullname' => $_SESSION['fullname'],
                    'nama_produk' => $item['nama_produk'],
                    'total_harga' => $item['total_harga'],
                    'transaksi_datetime' => date('D, d M Y H:i:s'),
                    'qty_transaksi' => $item['qty'],
                ];
            }

            $dataKeranjang = [
                'id_user' => session()->get('id_user'),
                'rowid' => $rowid,
                'total_produk' => $this->cart->totalItems(),
                'total_bayar' => $subtotal - $potonganOngkir,
                'status_bayar' => 'Menunggu Bukti Bayar',
                'tgl_checkout' => date('Y-m-d'),
            ];

            if ($getStatusPelanggan['status_customer'] == 'Customer+' && $this->cart->totalItems > 1) {
                $data[] = [
                    'id_produk' => $getItem['id_produk'],
                    'id_user' => $_SESSION['id_user'],
                    'rowid' => $rowid,
                    'fullname' => $_SESSION['fullname'],
                    'nama_produk' => $getItem['nama_produk'],
                    'total_harga' => 0,
                    'transaksi_datetime' => date('D, d M Y H:i:s'),
                    'qty_transaksi' => 1,
                ];
            }

            $this->db->table('transaksi')->insertBatch($data);
            $this->db->table('keranjang_produk')->insert($dataKeranjang);

            $home = new Home;
            $home->clear_cart();

            return redirect()->to(base_url('CustomerPanel/invoice/' . $rowid));
        } else {
            return redirect()->to(base_url('Keranjang'))->with('type-status', 'error')
                ->with('message', 'Gagal melakukan checkout, sesi login tidak ditemukan');
        }
    }
}
