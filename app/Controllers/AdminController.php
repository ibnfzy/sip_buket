<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WebsiteSettingModel;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function setting()
    {
        $web = new WebsiteSettingModel();
        $get = $web->find(01);

        return view('admin/web_setting', [
            'data' => $get
        ]);
    }
}
