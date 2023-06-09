<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerInformasiModel;
use App\Models\KeranjangProdukModel;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use App\Models\WebsiteSettingModel;

class CustController extends BaseController
{
    protected $cart;
    protected $db;
    protected $produkModel;
    protected $userInformasi;
    protected $transaksi;
    protected $keranjang;
    protected $settingsModel;

    public function __construct()
    {
        $this->cart = \Config\Services::cart();
        $this->db = \Config\Database::connect();
        $this->produkModel = new ProdukModel();
        $this->userInformasi = new CustomerInformasiModel();
        $this->transaksi = new TransaksiModel();
        $this->keranjang = new KeranjangProdukModel();
        $this->settingsModel = new WebsiteSettingModel();
    }

    public function index()
    {
        return view('user/dashboard', [
            'transaksi' => count($this->keranjang->where('id_customer', $_SESSION['id_customer'])->findAll()),
            'proses' => count($this->keranjang->where('id_customer', $_SESSION['id_customer'])->where('status_bayar', 'Proses')->findAll()),
            'status' => $this->userInformasi->where('id_customer', $_SESSION['id_customer'])->first(),
            'kirim'  => count($this->keranjang->where('id_customer', $_SESSION['id_customer'])->where('status_bayar', 'Dalam Pengiriman')->findAll())
        ]);
    }

    public function checkout()
    {
        helper('text');
        $diskon = 0;
        $potonganOngkir = 0;

        $subtotal = $_SESSION['subtotal'];
        $getStatusPelanggan = $this->db->table('customer_informasi')->where('id_customer', $_SESSION['id_customer'])->get()->getRowArray();
        $getOngkir = $this->db->table('website_setting')->where('id_website_setting', '01')->get()->getRowArray();
        $getPelanggan = $this->db->table('keranjang_produk')->where('id_customer', $_SESSION['id_customer'])->get()->getResultArray();
        $getItem = $this->db->table('produk')->orderBy('rand()')->where('kategori_produk', $_SESSION['kategori'])->limit(1)->get()->getRowArray();


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
                    'id_customer' => $_SESSION['id_customer'],
                    'rowid' => $rowid,
                    'fullname' => $_SESSION['fullname'],
                    'nama_produk' => $item['nama_produk'],
                    'total_harga' => $item['total_harga'],
                    'transaksi_datetime' => date('D, d M Y H:i:s'),
                    'qty_transaksi' => $item['qty'],
                ];
            }

            $dataKeranjang = [
                'id_customer' => session()->get('id_customer'),
                'rowid' => $rowid,
                'total_items' => $this->cart->totalItems(),
                'total_bayar' => $subtotal,
                'status_bayar' => 'Menunggu Bukti Bayar',
                'tgl_checkout' => date('Y-m-d'),
            ];

            if ($this->cart->totalItems() > 1) {
                $data[] = [
                    'id_produk' => $getItem['id_produk'],
                    'id_customer' => $_SESSION['id_customer'],
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

    public function invoice($rowid)
    {
        helper('form');
        $get = $this->userInformasi->where('id_customer', $_SESSION['id_customer'])->first();
        $getTransaksi = $this->transaksi->where('rowid', $rowid)->first();
        $getKeranjang = $this->keranjang->where('rowid', $rowid)->first();

        $getTransaksiData = $this->db->table('transaksi')
            ->where('rowid', $rowid)
            ->get()
            ->getResultArray();

        $tgl_batas = date('Y-m-d', strtotime('+2 days', strtotime($getKeranjang['tgl_checkout'])));

        return view('user/invoice', [
            'title' => 'Invoice',
            'parentdir' => 'transaksi',
            'rowid' => $rowid,
            'dataToko' => $this->settingsModel->find(01),
            'dataUser' => $get,
            'transaksi' => $getTransaksi,
            'keranjang' => $getKeranjang,
            'batas' => $tgl_batas,
            'data' => $getTransaksiData
        ]);
    }

    public function upload($id)
    {
        helper('form');
        $rules = [
            'gambar' => 'is_image[gambar]|max_size[gambar,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('CustomerPanel/transaksi'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'bukti_bayar' => $this->request->getFile('gambar')->getName(),
            'status_bayar' => 'Menunggu Validasi Bukti Bayar',
        ];

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads');
        }

        $this->keranjang->update($id, $data);

        return redirect()->to(base_url('CustomerPanel/transaksi'))->with('type-status', 'info')
            ->with('message', 'Bukti Bayar berhasil diupload');
    }

    public function informasi()
    {
        helper('form');
        $option = [];
        $w = 1;

        foreach ($this->db->table('biaya_ongkir')->get()->getResultArray() as $item) {
            $option[$item['nama_kota']] = $w . '. ' . $item['nama_kota'];
            $w++;
        }

        return view('user/informasi', [
            'title' => 'Informasi Pelanggan',
            'parentdir' => 'setting',
            'data' => $this->userInformasi->where('id_customer', $_SESSION['id_customer'])->first(),
            'ongkir' => $option
        ]);
    }

    public function update_informasi($id)
    {
        helper('form');
        $rules = [
            'alamat' => 'required|min_length[5]|max_length[254]',
            'nomor' => 'required|min_length[10]|max_length[13]',
            'kota' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('CustomerPanel/informasi'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'alamat' => $this->request->getPost('alamat'),
            'nomor_hp' => $this->request->getPost('nomor'),
            'kota_domisili' => $this->request->getPost('kota'),
        ];

        $this->userInformasi->update($id, $data);

        return redirect()->to(base_url('CustomerPanel/informasi'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diperbarui');
    }

    public function updateStatusSelesai()
    {
        $data = [
            'status_bayar' => $this->request->getPost('status_bayar')
        ];

        $this->db->table('customer_informasi')->where('id_customer', $_SESSION['id_customer'])->update(['status_customer' => 'Pelanggan']);

        $this->keranjang->update($this->request->getPost('keranjang_produk'), $data);

        return $this->response->setJSON(['msg' => 'Berhasil merubah status bayar']);
    }

    public function transaksi()
    {
        $getKeranjang = $this->db->table('keranjang_produk')
            ->where('id_customer', $_SESSION['id_customer'])
            ->get()
            ->getResultArray();

        $getTransaksi = $this->db->table('transaksi')
            ->where('id_customer', $_SESSION['id_customer'])
            ->get()
            ->getResultArray();

        return view('user/transaksi', [
            'transaksi' => $getTransaksi,
            'keranjang' => $getKeranjang,
            ''
        ]);
    }
}
