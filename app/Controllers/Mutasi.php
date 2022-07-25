<?php

namespace App\Controllers;

use App\Models\MutasiModel;

class Mutasi extends BaseController
{
    protected $MutasiModel;
    public function __construct()
    {
        $this->mutasiModel = new MutasiModel();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_saldo') ? $this->request->getGet('page_saldo') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $mutasi = $this->mutasiModel->search($keyword);
        } else {
            $mutasi = $this->mutasiModel->getAll();
        }

        $data = [
            'title' => 'Mutasi',
            'dataTransaksi' => $mutasi->paginate(10, 'mutasi'),
            'pager' => $this->mutasiModel->pager,
            'pageTitle' => 'Halaman Mutasi Rekening',
            'breadCrumb' => ['dashboard', 'mutasi'],
            'currentPage' => $currentPage,
            'dataDompet' => $this->mutasiModel->getDompet(),
            'dataUser' => $this->mutasiModel->getUser()
        ];
        return view('mutasi/index', $data);
    }
}
