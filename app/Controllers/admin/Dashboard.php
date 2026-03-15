<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Painel Administrativo';
        
        return view('admin/dashboard/index', $data);
    }
}
