<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    protected $loginModel;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Login',
            'authTitle' => 'Login',
            'namePage' => 'login',
            'authSubtitle' => 'Login dengan data anda yang anda masukkan saat pendaftaran.',
            'validation' => \Config\Services::validation()
        ];

        return view('login/index', $data);
    }

    public function validation()
    {

        // validasi input
        if (!$this->validate([
            'username' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'Username harus diisi!',
                    'alpha_numeric' => 'Hanya boleh huruf, angka dan tidak boleh spasi'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length' => 'Minimal 8 karakter'
                ]
            ]
        ])) {
            return redirect()->to('login')->withInput();
        }

        $username = $this->request->getPost('username');
        $user = $this->loginModel->getUser($username);
        $date = date('Y-m-d H:i:s');
        if ($user) {
            if (password_verify($this->request->getPost('password'), $user['password'])) {
                if ($user['aktif'] == 1) {
                    // jika semua valid
                    $this->loginModel->updateLastActive($date, $user['username']);
                    session()->set('username', $user['username']);
                    session()->set('level', $user['level']);
                    return redirect()->to('dashboard');
                } else {
                    session()->setFlashdata('error', 'Akun anda tidak aktif!');
                    return redirect()->to('login')->withInput();
                }
            } else {
                session()->setFlashdata('error', 'Password yang anda masukkan tidak valid!');
                return redirect()->to('login')->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('login')->withInput();
        }
    }
}
