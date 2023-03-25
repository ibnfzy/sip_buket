<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangProdukModel extends Model
{
    protected $table            = 'keranjang_produk';
    protected $primaryKey       = 'id_keranjang_produk';
    protected $allowedFields    = [
        'id_customer',
        'id_customer_voucher',
        'rowid',
        'total_items',
        'total_bayar',
        'bukti_bayar',
        'status_bayar',
        'tgl_checkout',
    ];
}
