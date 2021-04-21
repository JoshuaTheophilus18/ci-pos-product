<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class RegisterController extends BaseController
{
    protected $model;

    /**
     * COnstructor
     */
    public function __construct()
    {
        $this->model = new User();
        helper('form');
    }

    /**
     * Display register page
     *
     * @return void
     */
    public function index()
    {
        $data = [
            "validation" => \Config\Services::validation()
        ];
        return view('register', $data);
    }

    /**
     * Process Current Register Request
     *
     * @return void
     */
    public function process()
    {
        if (!$this->validate(
            [
                'username' => [
                    'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} minimal 4 Karakter',
                        'max_length' => '{field} maksimal 20 Karakter',
                        'is_unique' => 'Username sudah digunakan'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[4]|max_length[50]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} minimal 4 Karakter',
                        'max_length' => '{field} maksimal 50 Karakter',
                    ]
                ],
                'password_conf' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                    ]
                ],
                'name' => [
                    'rules' => 'required|min_length[4]|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} minimal 4 Karakter',
                        'max_length' => '{field} maksimal 100 Karakter',
                    ]
                ],
            ]
        )){
            $validation = \Config\Services::validation();
            return redirect()->to('/register')->withInput()->with('validation', $validation);
        }

        $insert = $this->model->insert([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'name' => $this->request->getVar('name')
        ]);

        if ($insert) {
            $session = session();
            $session->setFlashdata('status', 'Register berhasil dilakukan');
            return redirect()->to('/login');
        }

        $errors = $this->model->errors();
        return view('register', [
            'errors' =>  $errors,
        ]);
    }
}
