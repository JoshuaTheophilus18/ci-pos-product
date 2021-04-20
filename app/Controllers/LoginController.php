<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class LoginController extends BaseController
{
    public function __construct() {
        $this->model = new User;
    }

    public function index()
    {
        return view('login');
    }

    public function process()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
       
        $cekLogin = $this->model->getLogin($username);
        if ($cekLogin) {
            if (password_verify($password, $cekLogin['password'])) {
                session()->set(
                    [
                        'username' => $cekLogin['username'],
                        'name' => $cekLogin['name'],
                        'logged_in' => true,
                    ]
                );
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
