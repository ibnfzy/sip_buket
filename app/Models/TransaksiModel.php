<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $allowedFields    = [
        'id_buket',
        'id_customer',
        'rowid',
        'fullname',
        'nama_buket',
        'total_harga',
        'transaksi_datetime',
        'qty_transaksi',
    ];
}