<?php

namespace App\Models;

use CodeIgniter\Model;

class WebsiteSettingModel extends Model
{
    protected $table            = 'website_setting';
    protected $primaryKey       = 'id_website_setting';
    protected $allowedFields    = [
        'alamat_toko',
        'kontak_toko',
        'biaya_ongkir',
    ];
}