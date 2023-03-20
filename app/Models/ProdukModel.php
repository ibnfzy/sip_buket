<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $allowedFields    = [
        'nama_produk',
        'gambar_produk',
        'desc_produk',
        'harga_produk',
        'kategori_produk',
        'stok_produk',
        'jam_tgl_upload',
    ];
}
