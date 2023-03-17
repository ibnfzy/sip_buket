<?php

namespace App\Models;

use CodeIgniter\Model;

class PemilikModel extends Model
{
    protected $table            = 'pemilik';
    protected $primaryKey       = 'id_pemilik';
    protected $allowedFields    = [
        'username',
        'fullname',
        'password',
        'last_login',
    ];
}