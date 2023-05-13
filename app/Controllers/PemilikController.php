<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WebsiteSettingModel;
use CodeIgniter\Database\RawSql;

class PemilikController extends BaseController
{
    protected $db;

    public function __construct()
    {
        helper('form');
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('owner/dashboard');
    }

    public function laporanproduk()
    {
        return view('owner/laporan_produk');
    }

    public function laporanprodukprint()
    {
        $date = $this->request->getPost('date');
        $getData = $this->db->table('transaksi')
            ->select(new RawSql('DISTINCT id_produk, fullname, COUNT(id_produk) as total_transaksi, transaksi_datetime'))
            ->like('transaksi_datetime', $date ?? '')
            ->groupBy('id_produk')->get()->getResultArray();

        // dd($getData);

        return view('owner/print_laporan_produk', ['data' => $getData]);
    }

    public function laporanpenjualan()
    {
        return view('owner/laporan_penjualan');
    }

    public function laporanpenjualanprint()
    {
        $date1 = $this->request->getPost('val1');
        $date2 = $this->request->getPost('val2');
        $converDate1 = date('D, d M Y H:i:s', strtotime($date1 ?? ''));
        $converDate2 = date('D, d M Y H:i:s', strtotime($date2 ?? ''));

        $getData = $this->db->table('transaksi')
            ->where('transaksi_datetime BETWEEN "' . $converDate1 . '" and "' . $converDate2 . '"')
            ->get()->getResultArray();

        return view('owner/print_laporan_penjualan', ['data' => $getData]);
    }

    public function laporanpelanggan()
    {
        return view('owner/laporan_pelanggan');
    }

    public function laporanpelangganprint()
    {
        $date = $this->request->getPost('date');
        $getData = $this->db->table('transaksi')
            ->select(new RawSql('DISTINCT id_customer, COUNT(id_customer) as total_transaksi, transaksi_datetime'))
            ->like('transaksi_datetime', $date ?? '')
            ->groupBy('id_customer')->get()->getResultArray();

        return view('owner/print_laporan_pelanggan', ['data' => $getData]);
    }

    public function setting()
    {
        $web = new WebsiteSettingModel();
        $get = $web->find(01);

        return view('owner/setting', [
            'data' => $get
        ]);
    }

    public function setting_save()
    {
        $web = new WebsiteSettingModel();

        $rules = [
            'alamat' => 'required|min_length[5]|max_length[254]',
            'nomor' => 'required|min_length[10]|max_length[13]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/WebSetting'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'alamat_toko' => $this->request->getPost('alamat'),
            'kontak_toko' => $this->request->getPost('nomor'),
        ];

        $web->update('01', $data);

        return redirect()->to(base_url('AdminPanel/WebSetting'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diperbarui');
    }
}
