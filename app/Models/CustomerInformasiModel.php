<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerInformasiModel extends Model
{
    protected $table            = 'customer_informasi';
    protected $primaryKey       = 'id_customer_detail';
    protected $allowedFields    = [
        'id_customer',
        'alamat',
        'nomor_hp',
        'status_customer',
        'kota_domisili',
    ];
}
