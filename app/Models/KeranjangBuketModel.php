<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangBuketModel extends Model
{
    protected $table            = 'keranjang_buket';
    protected $primaryKey       = 'id_keranjang_buket';
    protected $allowedFields    = [
        'id_customer',
        'id_customer_voucher',
        'rowid',
        'total_items',
        'potongan',
        'total_bayar',
        'bukti_bayar',
        'status_bayar',
        'tgl_checkout',
    ];
}