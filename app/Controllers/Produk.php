<?php

namespace App\Controllers;

use App\Models\KategoriProdukModel;
use App\Models\ProdukModel;
use CodeIgniter\RESTful\ResourceController;

class Produk extends ResourceController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Table Produk',
            'parentdir' => 'Produk',
            'produk' => $this->produkModel->findAll()
        ];

        return view('admin/produk', $data);
    }

    public function new()
    {
        helper('form');

        $option = [];

        foreach ($this->kategoriModel->findAll() as $item) {
            $option[$item['nama_kategori']] = $item['id_kategori'] . '. ' . $item['nama_kategori'];
        }

        $data = [
            'title' => 'Tambah Produk',
            'parentdir' => 'Produk',
            'option' => $option
        ];

        return view('admin/produk_add', $data);
    }

    public function create()
    {
        helper('form');
        $rules = [
            'nama' => 'required|min_length[5]|max_length[50]',
            'harga' => 'required|min_length[1]|max_length[7]',
            'stok_produk' => 'required|min_length[1]|max_length[2]',
            'kategori' => 'required',
            'gambar' => 'is_image[gambar]|max_size[gambar,2048]',
            'desc' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/Produk/new'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        $data = [
            'nama_produk' => $this->request->getPost('nama'),
            'gambar_produk' => $this->request->getFile('gambar')->getName(),
            'desc_produk' => $this->request->getPost('desc'),
            'harga_produk' => $this->request->getPost('harga'),
            'stok_produk' => $this->request->getPost('stok_produk'),
            'kategori_produk' => $this->request->getPost('kategori'),
            'last_login' => date('D, d M Y H:i:s')
        ];

        if (!$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads');
        }

        $this->produkModel->save($data);

        return redirect()->to(base_url('AdminPanel/Produk'))->with('type-status', 'info')
            ->with('message', 'Data berhasil ditambahkan');
    }

    public function edit($id = null)
    {
        helper('form');
        $option = [];

        foreach ($this->kategoriModel->findAll() as $item) {
            $option[$item['nama_kategori']] = $item['id_kategori'] . '. ' . $item['nama_kategori'];
        }
        $data = [
            'title' => 'Edit Produk',
            'parentdir' => 'Produk',
            'produk' => $this->produkModel->find($id),
            'option' => $option
        ];

        return view('admin/produk_edit', $data);
    }

    public function update($id = null)
    {
        helper('form');
        if ($this->request->getFile('gambar')->isValid()) {
            $rules = [
                'nama' => 'required|min_length[5]|max_length[50]',
                'harga' => 'required|min_length[1]|max_length[7]',
                'stok_produk' => 'required|min_length[1]|max_length[2]',
                'kategori' => 'required',
                'gambar' => 'is_image[gambar]|max_size[gambar,2048]',
                'desc' => 'required',
            ];

            $data = [
                'nama_produk' => $this->request->getPost('nama'),
                'gambar_produk' => $this->request->getFile('gambar')->getName(),
                'desc_produk' => $this->request->getPost('desc'),
                'stok_produk' => $this->request->getPost('stok_produk'),
                'harga_produk' => $this->request->getPost('harga'),
                'kategori_produk' => $this->request->getPost('kategori'),
                'last_login' => date('D, d M Y H:i:s')
            ];
        } else {
            $rules = [
                'nama' => 'required|min_length[5]|max_length[50]',
                'harga' => 'required|min_length[1]|max_length[7]',
                'stok_produk' => 'required|min_length[1]|max_length[2]',
                'kategori' => 'required',
                'desc' => 'required',
            ];

            $data = [
                'nama_produk' => $this->request->getPost('nama'),
                'desc_produk' => $this->request->getPost('desc'),
                'harga_produk' => $this->request->getPost('harga'),
                'stok_produk' => $this->request->getPost('stok_produk'),
                'kategori_produk' => $this->request->getPost('kategori'),
                'last_login' => date('D, d M Y H:i:s')
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('AdminPanel/Produk/' . $id . '/edit'))->with('type-status', 'error')
                ->with('dataMessage', $this->validator->getErrors());
        }

        if ($this->request->getFile('gambar')->isValid() && !$this->request->getFile('gambar')->hasMoved()) {
            $this->request->getFile('gambar')->move('uploads');
        }

        $this->produkModel->update($id, $data);

        return redirect()->to(base_url('AdminPanel/Produk'))->with('type-status', 'info')
            ->with('message', 'Data berhasil diubah');
    }

    public function delete($id = null)
    {
        $this->produkModel->delete($id);

        return redirect()->to(base_url('AdminPanel/Produk'))->with('type-status', 'info')
            ->with('message', 'Data berhasil terhapus');
    }
}
