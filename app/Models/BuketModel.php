<?php

namespace App\Models;

use CodeIgniter\Model;

class BuketModel extends Model
{
    protected $table            = 'buket';
    protected $primaryKey       = 'id_buket';
    protected $allowedFields    = [
        'nama_buket',
        'gambar_buket',
        'desc_buket',
        'harga_buket',
        'kategori_buket',
        'stok_buket',
        'jam_tgl_upload',
    ];
}