<?php

namespace App\Controllers;

use App\Models\KelolaModel;

class Kelola extends BaseController
{
    protected $kelolaModel;
    public function __construct()
    {
        $this->kelolaModel = new KelolaModel();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_kelola') ? $this->request->getGet('page_kelola') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $users = $this->kelolaModel->search($keyword);
        } else {
            $users = $this->kelolaModel->getAll();
        }

        $data = [
            'title' => 'Kelola',
            'dataUsers' => $users->paginate(10, 'kelola'),
            'pager' => $this->kelolaModel->pager,
            'pageTitle' => 'Halaman Kelola',
            'breadCrumb' => ['dashboard', 'kelola'],
            'currentPage' => $currentPage
        ];
        return view('kelola/index', $data);
    }

    public function tambah_redirect()
    {
        $id = $this->request->getPost('id_user');
        $user = $this->kelolaModel->getUser($id);
        if ($user) {
            return redirect()->to('kelola/tambah/' . $user['id_user']);
        } else {
            session()->setFlashdata('wrong', 'Anggota tidak ditemukan');
            return redirect()->to('kelola');
        }
    }

    public function tambah($id)
    {
        $data = [
            'title' => 'Kelola',
            'pageTitle' => 'Halaman Kelola',
            'breadCrumb' => ['dashboard', 'kelola', 'tambah'],
            'dataBarang' => $this->kelolaModel->getBarang(),
            'dataUser' => $this->kelolaModel->getUser($id)
        ];
        return view('kelola/tambah', $data);
    }

    public function simpan($id)
    {
        if ($this->request->getPost('hidden_id_barang') && $this->request->getPost('hidden_berat') && $this->request->getPost('hidden_harga') && $this->request->getVar('simpan') == 'Simpan') {
            if ($this->kelolaModel->saveAll($this->request->getVar()) != true) {
                session()->setFlashdata('wrong', 'Masukkan data terlebih dahulu!');
                return redirect()->to('kelola/tambah/' . $id);
            } else {
                session()->setFlashdata('success', 'Data Berhasil disimpan!');
                return redirect()->to('kelola/tambah/' . $id);
            }
        } else {
            session()->setFlashdata('wrong', 'Masukkan data terlebih dahulu!');
            return redirect()->to('kelola/tambah/' . $id);
        }
    }
}