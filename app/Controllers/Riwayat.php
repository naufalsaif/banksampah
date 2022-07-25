<?php

namespace App\Controllers;

use App\Models\RiwayatModel;

class Riwayat extends BaseController
{
    protected $riwayatModel;
    public function __construct()
    {
        $this->riwayatModel = new RiwayatModel();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_riwayat') ? $this->request->getGet('page_riwayat') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $riwayat = $this->riwayatModel->search($keyword);
        } else {
            $riwayat = $this->riwayatModel->getAll();
        }

        $data = [
            'title' =>  'Riwayat',
            'dataRiwayat' => $riwayat->paginate(10, 'riwayat'),
            'pager' => $this->riwayatModel->pager,
            'pageTitle' => 'Halaman Riwayat',
            'breadCrumb' => ['dashboard', 'riwayat'],
            'currentPage' => $currentPage
        ];
        return view('riwayat/index', $data);
    }
}
