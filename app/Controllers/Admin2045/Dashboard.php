<?php

namespace App\Controllers\Admin2045;

use App\Controllers\BaseController;
use CodeIgniter\Config\Config;

class Dashboard extends BaseController
{
    public function index() {
        echo view("admin/dashboard");
    }
}
