<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\RESTful\ResourceController;

class Customer extends ResourceController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new CustomerModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Table Pelanggan',
            'parentdir' => 'Pelanggan',
            'pelanggan' => $this->pelangganModel->findAll()
        ];

        return view('admin/pelanggan', $data);
    }
}
