<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriBuketModel extends Model
{
    protected $table            = 'kategori_buket';
    protected $primaryKey       = 'id_kategori';
    protected $allowedFields    = [
        'nama_kategori'
    ];
}