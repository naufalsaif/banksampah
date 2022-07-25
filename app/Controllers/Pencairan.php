<?php

namespace App\Controllers;

use App\Models\PencairanModel;

class Pencairan extends BaseController
{
    protected $pencairanModel;
    public function __construct()
    {
        $this->pencairanModel = new PencairanModel();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_pencairan') ? $this->request->getGet('page_pencairan') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $users = $this->pencairanModel->search($keyword);
        } else {
            $users = $this->pencairanModel->getAll();
        }

        $data = [
            'title' => 'Pencairan Uang',
            'dataUsers' => $users->paginate(10, 'pencairan'),
            'pager' => $this->pencairanModel->pager,
            'pageTitle' => 'Halaman Pencairan Uang',
            'breadCrumb' => ['dashboard', 'pencairan'],
            'currentPage' => $currentPage
        ];
        return view('pencairan/index', $data);
    }

    public function dompet_redirect()
    {
        $id = $this->request->getPost('id_user');
        $user = $this->pencairanModel->getUser3($id);
        if ($user) {
            return redirect()->to('pencairan/dompet/' . $user['id_user']);
        } else {
            session()->setFlashdata('wrong', 'Anggota tidak ditemukan');
            return redirect()->to('pencairan');
        }
    }

    public function dompet($id)
    {
        $data = [
            'title' => 'Pencairan',
            'dataUser' => $this->pencairanModel->getUser($id),
            'pageTitle' => 'Halaman Pencairan',
            'breadCrumb' => ['dashboard', 'pencairan', 'dompet'],
            'validation' => \Config\Services::validation()
        ];

        return view('pencairan/dompet', $data);
    }

    public function simpan($id)
    {
        // validasi input
        if (!$this->validate([
            'jumlah' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Jumlah harus diisi!',
                    'integer' => 'Hanya boleh angka'
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
            return redirect()->to('pencairan/dompet/' . $id)->withInput();
        }

        $password = password_verify($this->request->getPost('password'), $this->pencairanModel->getUser2()['password']);

        if (!$password) {
            session()->setFlashdata('wrong', 'Password yang anda masukkan salah');
            return redirect()->to('pencairan/dompet/' . $id)->withInput();
        }

        $user = $this->pencairanModel->getUser($id);
        $jumlah = $this->request->getPost('jumlah');
        if ($jumlah <= '0') {
            session()->setFlashdata('wrong', 'Jumlah saldo anda tidak mencukupi');
            return redirect()->to('pencairan/dompet/' . $id)->withInput();
        }
        if ($jumlah > $user['saldo']) {
            session()->setFlashdata('wrong', 'Jumlah yang dicairkan melebihi saldo');
            return redirect()->to('pencairan/dompet/' . $id)->withInput();
        }

        $this->pencairanModel->saveAll($this->request->getVar());
        session()->setFlashdata('success', 'Pencairan dana ' . $user['username'] . ' Rp. ' . number_format($this->request->getPost('jumlah')) . ' berhasil');
        return redirect()->to('pencairan');
    }
}