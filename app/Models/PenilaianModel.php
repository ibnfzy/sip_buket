<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table            = 'penilaian';
    protected $primaryKey       = 'id_penilaian';
    protected $allowedFields    = [
        'id_produk',
        'id_customer',
        'isi_penilaian',
        'bintang',
        'insert_datetime',
    ];
}
