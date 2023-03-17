<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table            = 'profile';
    protected $primaryKey       = 'id_profile';
    protected $allowedFields    = [
        'tgl_upload',
        'isi_profile',
        'kontak',
        'alamat_kontak',
        'email',
    ];
}