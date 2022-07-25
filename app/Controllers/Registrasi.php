<?php

namespace App\Controllers;

use App\Models\RegistrasiModel;

class Registrasi extends BaseController
{
    protected $registrasiModel;
    public function __construct()
    {
        $this->registrasiModel = new RegistrasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Registrasi',
            'authTitle' => 'Registrasi',
            'namePage' => 'registrasi',
            'authSubtitle' => 'Masukkan data Anda untuk mendaftar ke website kami.',
            'validation' => \Config\Services::validation()
        ];
        return view('registrasi/index', $data);
    }

    public function validation()
    {

        // validasi input
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka'
                ]
            ],
            'telepon' => [
                'rules' => 'required|integer|is_unique[users.telepon]',
                'errors' => [
                    'required' => 'Telepon harus diisi!',
                    'integer' => 'Hanya boleh angka',
                    'is_unique' => 'Telepon sudah terdaftar'
                ]
            ],
            'blok' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Blok harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka'
                ]
            ],
            'username' => [
                'rules' => 'required|alpha_numeric|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi!',
                    'alpha_numeric' => 'Hanya boleh huruf, angka dan tidak boleh spasi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|matches[confirm_password]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length' => 'Minimal 8 karakter',
                    'matches' => 'Password berbeda!'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|min_length[8]|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password harus diisi!',
                    'min_length' => 'Minimal 8 karakter',
                    'matches' => ''
                ]
            ]
        ])) {
            return redirect()->to('registrasi')->withInput();
        }

        $id_user = 'U' . time() . rand(100, 999);
        $id_dompet = 'D' . time() . rand(100, 999);
        $password = password_hash(trim($this->request->getPost('password')), PASSWORD_DEFAULT);
        $data = [
            'id_user' => $id_user,
            'nama_lengkap' => trim($this->request->getPost('nama_lengkap')),
            'blok' => trim(strtoupper($this->request->getPost('blok'))),
            'telepon' => trim($this->request->getPost('telepon')),
            'username' => trim($this->request->getPost('username')),
            'password' => $password
        ];
        $this->registrasiModel->saveUser($data);

        $data2 = [
            'id_dompet' => $id_dompet,
            'id_user' => $id_user,
            'saldo' => 0
        ];
        $this->registrasiModel->saveDompet($data2);

        session()->setFlashdata('success', 'Selamat anda berhasil melakukan registrasi!');
        return redirect()->to('login');
    }
}
