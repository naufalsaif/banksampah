<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_users') ? $this->request->getGet('page_users') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $users = $this->usersModel->search($keyword);
        } else {
            $users = $this->usersModel;
        }

        $data = [
            'title' => 'Master Users',
            'dataUsers' => $users->paginate(10, 'users'),
            'pager' => $this->usersModel->pager,
            'pageTitle' => 'Halaman Master Users',
            'breadCrumb' => ['dashboard', 'users'],
            'currentPage' => $currentPage
        ];
        return view('users/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah User',
            'pageTitle' => 'Halaman Tambah User',
            'breadCrumb' => ['dashboard', 'users', 'tambah'],
            'validation' => \Config\Services::validation()
        ];

        return view('users/tambah', $data);
    }

    public function simpan()
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
            'username' => [
                'rules' => 'required|alpha_numeric|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi!',
                    'alpha_numeric' => 'Hanya boleh huruf, angka dan tidak boleh spasi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length' => 'Minimal 8 karakter'
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
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to('users/tambah')->withInput();
        }

        $id_user = 'U' . time() . rand(100, 999);
        $id_dompet = 'D' . time() . rand(100, 999);
        $data = [
            'id_user' => $id_user,
            'nama_lengkap' => trim($this->request->getPost('nama_lengkap')),
            'username' => trim($this->request->getPost('username')),
            'password' => trim($this->request->getPost('password')),
            'telepon' => trim($this->request->getPost('telepon')),
            'blok' => trim(strtoupper($this->request->getPost('blok'))),
            'level' => trim($this->request->getPost('level'))
        ];
        $this->usersModel->saveUser($data);

        $data2 = [
            'id_dompet' => $id_dompet,
            'id_user' => $id_user,
            'saldo' => 0
        ];
        $this->usersModel->saveDompet($data2);

        session()->setFlashdata('success', 'Berhasil menambah user baru');
        return redirect()->to('users');
    }

    public function ubah($id)
    {
        $data = [
            'title' => 'Ubah User',
            'pageTitle' => 'Halaman Ubah User',
            'breadCrumb' => ['dashboard', 'users', 'ubah'],
            'dataUser' => $this->usersModel->getUsers($id),
            'validation' => \Config\Services::validation()
        ];

        return view('users/ubah', $data);
    }

    public function perbarui($id)
    {
        $username = $this->request->getPost('username');
        $telepon = $this->request->getPost('telepon');
        $password = $this->request->getPost('password');

        $userLama = $this->usersModel->getUsers($id);
        if ($userLama['username'] == $username) {
            $rule_username = 'required|alpha_numeric';
        } else {
            $rule_username = 'required|alpha_numeric|is_unique[users.username]';
        }

        if ($userLama['telepon'] == $telepon) {
            $rule_telepon = 'required|integer';
        } else {
            $rule_telepon = 'required|integer|is_unique[users.telepon]';
        }

        if (!$password) {
            $rule_password = 'min_length[0]';
        } else {
            $rule_password = 'required|min_length[8]';
        }

        // validasi input
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka'
                ]
            ],
            'username' => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => 'Username harus diisi!',
                    'alpha_numeric' => 'Hanya boleh huruf, angka dan tidak boleh spasi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => $rule_password,
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length' => 'Minimal 8 karakter'
                ]
            ],
            'telepon' => [
                'rules' => $rule_telepon,
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
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to('users/ubah')->withInput();
        }

        $updated_at = date('Y-m-d H:i:s');
        if (!$password) {
            $data = [
                'nama_lengkap' => trim($this->request->getPost('nama_lengkap')),
                'username' => trim($this->request->getPost('username')),
                'telepon' => trim($this->request->getPost('telepon')),
                'blok' => trim(strtoupper($this->request->getPost('blok'))),
                'level' => trim($this->request->getPost('level')),
                'updated_at' => $updated_at
            ];
        } else {
            $data = [
                'nama_lengkap' => trim($this->request->getPost('nama_lengkap')),
                'username' => trim($this->request->getPost('username')),
                'password' => trim($this->request->getPost('password')),
                'telepon' => trim($this->request->getPost('telepon')),
                'blok' => trim(strtoupper($this->request->getPost('blok'))),
                'level' => trim($this->request->getPost('level')),
                'updated_at' => $updated_at
            ];
        }
        $this->usersModel->updateUser($data, $id);

        session()->setFlashdata('success', 'Berhasil perbarui data');
        return redirect()->to('users');
    }

    public function aktif($id)
    {
        $user = $this->usersModel->getUsers($id);
        if ($user['aktif'] == 1) {
            $this->usersModel->aktifUser('0', $id);
            session()->setFlashdata('success', 'Berhasil Menonaktifkan data');
        } else {
            $this->usersModel->aktifUser('1', $id);
            session()->setFlashdata('success', 'Berhasil Mengaktifkan data');
        }

        return redirect()->to('users');
    }

    // public function hapus($id)
    // {
    //     $this->usersModel->deleteUser($id);

    //     session()->setFlashdata('success', 'Berhasil menghapus data');
    //     return redirect()->to('users');
    // }
}