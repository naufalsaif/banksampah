<?php

namespace App\Controllers;

use App\Models\MriwayatModel;

class Mriwayat extends BaseController
{
    protected $mriwayatModel;
    public function __construct()
    {
        $this->mriwayatModel = new MriwayatModel();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_mriwayat') ? $this->request->getGet('page_mriwayat') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $riwayat = $this->mriwayatModel->search($keyword);
        } else {
            $riwayat = $this->mriwayatModel->getAll();
        }

        $data = [
            'title' => 'Master Riwayat',
            'dataRiwayat' => $riwayat->paginate(10, 'mriwayat'),
            'pager' => $this->mriwayatModel->pager,
            'pageTitle' => 'Halaman Master Riwayat',
            'breadCrumb' => ['dashboard', 'mriwayat'],
            'currentPage' => $currentPage
        ];
        return view('mriwayat/index', $data);
    }
}
