<?php

namespace App\Controllers;

use App\Models\SettingModel;

class Setting extends BaseController
{
    protected $settingModel;
    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Setting',
            'pageTitle' => 'Halaman Setting',
            'breadCrumb' => ['dashboard', 'setting'],
            'dataUser' => $this->settingModel->getUser(),
            'validation' => \Config\Services::validation()
        ];
        return view('setting/index', $data);
    }

    public function foto_profile()
    {
        $faceImages = [
            [
                'name' => 'Face 1',
                'name_image' => '1.jpg'
            ],
            [
                'name' => 'Face 2',
                'name_image' => '2.jpg'
            ],
            [
                'name' => 'Face 3',
                'name_image' => '3.jpg'
            ],
            [
                'name' => 'Face 4',
                'name_image' => '4.jpg'
            ],
            [
                'name' => 'Face 5',
                'name_image' => '5.jpg'
            ],
            [
                'name' => 'Face 6',
                'name_image' => '6.jpg'
            ],
            [
                'name' => 'Face 7',
                'name_image' => '7.jpg'
            ],
            [
                'name' => 'Face 8',
                'name_image' => '8.jpg'
            ],
        ];

        $data = [
            'title' => 'Foto Profile',
            'pageTitle' => 'Halaman Foto Profile',
            'breadCrumb' => ['dashboard', 'setting', 'foto profile'],
            'dataUser' => $this->settingModel->getUser(),
            'faceImages' => $faceImages

        ];
        return view('setting/foto_profile', $data);
    }

    public function simpan_nama()
    {
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka'
                ]
            ]
        ])) {
            return redirect()->to('setting/index')->withInput();
        }

        $this->settingModel->updateUser('nama_lengkap', $this->request->getPost('nama_lengkap'));
        session()->setFlashdata('success', 'Berhasil mengubah nama lengkap');
        return redirect()->to('setting');
    }

    public function simpan_username()
    {
        $userLama = $this->settingModel->getUser();
        $username =  $this->request->getPost('username');
        if ($userLama['username'] == $username) {
            $rule_username = 'required|alpha_numeric';
        } else {
            $rule_username = 'required|alpha_numeric|is_unique[users.username]';
        }
        if (!$this->validate([
            'username' => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => 'Username harus diisi!',
                    'alpha_numeric' => 'Hanya boleh huruf, angka dan tidak boleh spasi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('setting/index')->withInput();
        }

        $this->settingModel->updateUser('username', $username);
        session()->set('username', null);
        session()->setFlashdata('success', 'Berhasil mengubah username');
        return redirect()->to('login');
    }

    public function simpan_blok()
    {
        if (!$this->validate([
            'blok' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Blok harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka'
                ]
            ]
        ])) {
            return redirect()->to('setting/index')->withInput();
        }

        $this->settingModel->updateUser('blok', strtoupper($this->request->getPost('blok')));
        session()->setFlashdata('success', 'Berhasil mengubah blok');
        return redirect()->to('setting');
    }

    public function simpan_telepon()
    {
        $userLama = $this->settingModel->getUser();
        $telepon =  $this->request->getPost('telepon');
        if ($userLama['telepon'] == $telepon) {
            $rule_telepon = 'required|integer';
        } else {
            $rule_telepon = 'required|integer|is_unique[users.telepon]';
        }
        if (!$this->validate([
            'telepon' => [
                'rules' => $rule_telepon,
                'errors' => [
                    'required' => 'Telepon harus diisi!',
                    'integer' => 'Hanya boleh angka',
                    'is_unique' => 'Telepon sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('setting/index')->withInput();
        }

        $this->settingModel->updateUser('telepon', $this->request->getPost('telepon'));
        session()->setFlashdata('success', 'Berhasil mengubah telepon');
        return redirect()->to('setting');
    }

    public function simpan_password()
    {
        $userLama = $this->settingModel->getUser();
        $passwordLama =  $this->request->getPost('password_lama');
        if (!$this->validate([
            'password_lama' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password Lama harus diisi!',
                    'min_length' => 'Minimal 8 karakter'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|matches[confirm_password]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length' => 'Minimal 8 karakter',
                    'matches' => 'Password baru berbeda!'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|min_length[8]|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password harus diisi!',
                    'min_length' => 'Minimal 8 karakter',
                    'matches' => 'Confirm Password berbeda!'
                ]
            ]
        ])) {
            return redirect()->to('setting/index')->withInput();
        }
        if ($userLama['password'] != $passwordLama) {
            session()->setFlashdata('wrong', 'Password Lama yang anda masukkan salah');
            return redirect()->to('setting');
        }
        if ($userLama['password'] == $this->request->getPost('password')) {
            session()->setFlashdata('wrong', 'Password baru sama dengan password lama');
            return redirect()->to('setting');
        }

        $password =  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $this->settingModel->updateUser('password', $password);
        session()->set('username', null);
        session()->setFlashdata('success', 'Berhasil mengubah password');
        return redirect()->to('login');
    }

    public function simpan_foto()
    {
        $user = $this->settingModel->getUser();
        $image = $this->request->getPost('image');
        if ($user['image'] == $image) {
            return redirect()->to('setting');
        }


        $this->settingModel->updateUser('image', $image);
        session()->setFlashdata('success', 'Berhasil mengubah foto profile');
        return redirect()->to('setting');
    }
}
