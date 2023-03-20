<?php

namespace App\Controllers;

use App\Models\KategoriProdukModel;
use CodeIgniter\RESTful\ResourceController;

class KategoriProduk extends ResourceController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Table Kategori Produk',
            'parentdir' => 'Produk',
            'kategori' => $this->kategoriModel->findAll()
        ];

        return view('admin/kategori', $data);
    }

    public function new()
    {
        helper('form');
        $data = [
            'title' => 'Tambah Kategori',
            'parentdir' => 'Produk',
        ];

        return view('admin/kategori_add', $data);
    }

    public function create()
    {
        helper('form');
        $rules = [
            'kategori' => 'required|min_length[5]|max_length[25]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/Kategori/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_kategori' => $this->request->getPost('kategori'),
        ];

        $this->kategoriModel->save($data);

        return redirect()->to(base_url('AdminPanel/Kategori'))->with('type-status', 'info')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function edit($id = null)
    {
        helper('form');
        $data = [
            'title' => 'Edit Kategori Produk',
            'parentdir' => 'Produk',
            'data' => $this->kategoriModel->find($id)
        ];

        return view('admin/kategori_edit', $data);
    }

    public function update($id = null)
    {
        helper('form');
        $rules = [
            'kategori' => 'required|min_length[5]|max_length[25]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/Kategori/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_kategori' => $this->request->getPost('kategori'),
        ];

        $this->kategoriModel->save($data);

        return redirect()->to(base_url('AdminPanel/Kategori'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diperbarui');
    }

    public function delete($id = null)
    {
        $this->kategoriModel->delete($id);

        return redirect()->to(base_url('AdminPanel/Kategori'))->with('type-status', 'info')
            ->with('message', 'Data berhasil terhapus');
    }
}