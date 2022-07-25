<?php

namespace App\Controllers;

use App\Models\SaldoModel;

class Saldo extends BaseController
{
    protected $saldoModel;
    public function __construct()
    {
        $this->saldoModel = new SaldoModel();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_saldo') ? $this->request->getGet('page_saldo') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $saldo = $this->saldoModel->search($keyword);
        } else {
            $saldo = $this->saldoModel->getAll();
        }

        $data = [
            'title' => 'Saldo',
            'dataTransaksi' => $saldo->paginate(10, 'saldo'),
            'pager' => $this->saldoModel->pager,
            'pageTitle' => 'Halaman Saldo',
            'breadCrumb' => ['dashboard', 'saldo'],
            'currentPage' => $currentPage,
            'dataDompet' => $this->saldoModel->getDompet(),
            'dataUser' => $this->saldoModel->getUser()
        ];
        return view('saldo/index', $data);
    }
}
