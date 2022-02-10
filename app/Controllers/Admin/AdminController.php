<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class Dashboard extends BaseController
{

    public function index()
    {
        $this->load->view('admin/dashboard_view');
    }
}