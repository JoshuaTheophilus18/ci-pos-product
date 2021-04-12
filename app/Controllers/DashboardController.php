<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'headerTitle' => 'Dashboard',
        ];

        return view('dashboard', $data); 
    }
}
