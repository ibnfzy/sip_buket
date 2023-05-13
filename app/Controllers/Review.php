<?php

namespace App\Controllers;

use App\Models\PenilaianModel;
use CodeIgniter\RESTful\ResourceController;

class Review extends ResourceController
{
    protected $db;
    protected $reviewModel;

    public function __construct()
    {
        helper('form');
        $this->db = \Config\Database::connect();
        $this->reviewModel = new PenilaianModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('user/review', [
            'title' => 'List penilaian',
            'parentdir' => 'penilaian',
            'data' => $this->db->table('penilaian')
                ->where('id_customer', $_SESSION['id_customer'])
                ->get()->getResultArray()
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $get = $this->db->table('keranjang_produk')
            ->select([
                'keranjang_produk.rowid',
                'transaksi.id_produk',
                'transaksi.nama_produk'
            ])->join('transaksi', 'keranjang_produk.rowid = transaksi.rowid', 'inner')
            ->where('keranjang_produk.status_bayar', 'Selesai')
            ->where('keranjang_produk.id_customer', $_SESSION['id_customer'])
            ->get()->getResultArray();

        $option = [];
        foreach ($get as $data) {
            $option[$data['id_produk']] = $data['nama_produk'];
        }

        return view('user/review_add', [
            'title' => 'Tambah penilaian',
            'parentdir' => 'penilaian',
            'data' => $option
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            'id_produk' => 'required',
            'nilai' => 'required|less_than_equal_to[5]',
            'isi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('CustomerPanel/Review/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'id_produk' => $this->request->getPost('id_produk'),
            'id_customer' => $_SESSION['id_customer'],
            'isi_penilaian' => $this->request->getPost('isi'),
            'bintang' => $this->request->getPost('nilai'),
            'insert_datetime' => date('D, d M Y H:i:s'),
        ];

        $this->reviewModel->save($data);

        return redirect()->to(base_url('CustomerPanel/Review'))->with('type-status', 'info')
            ->with('message', 'penilaian berhasil');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $get = $this->db->table('keranjang_produk')
            ->select([
                'keranjang_produk.rowid',
                'transaksi.id_produk',
                'transaksi.nama_produk'
            ])->join('transaksi', 'keranjang_produk.rowid = transaksi.rowid', 'inner')
            ->where('keranjang_produk.status_bayar', 'Selesai')
            ->where('keranjang_produk.id_customer', $_SESSION['id_customer'])
            ->get()->getResultArray();

        $option = [];
        foreach ($get as $data) {
            $option[$data['id_produk']] = $data['nama_produk'];
        }

        return view('user/review_edit', [
            'title' => 'Tambah penilaian',
            'parentdir' => 'penilaian',
            'data' => $option,
            'item' => $this->reviewModel->find($id)
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $rules = [
            'nilai' => 'required|less_than_equal_to[8]',
            'isi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('CustomerPanel/Review/' . $id . '/edit'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'id_customer' => $_SESSION['id_customer'],
            'isi_penilaian' => $this->request->getPost('isi'),
            'bintang' => $this->request->getPost('nilai'),
            'insert_datetime' => date('D, d M Y H:i:s'),
        ];

        $this->reviewModel->update($id, $data);

        return redirect()->to(base_url('CustomerPanel/Review'))->with('type-status', 'info')
            ->with('message', 'penilaian berhasil');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->reviewModel->delete($id);

        return redirect()->to(base_url('CustomerPanel/Review'))->with('type-status', 'info')
            ->with('message', 'Data berhasil terhapus');
    }
}
