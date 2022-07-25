<?php

namespace App\Controllers;

use App\Models\Mmutasi2Model;
use App\Models\MmutasiModel;
use Config\Services;

class Mmutasi extends BaseController
{
    protected $MmutasiModel;
    public function __construct()
    {
        $this->mmutasiModel = new MmutasiModel();
        $this->mmutasi2Model = new Mmutasi2Model();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_mmutasi') ? $this->request->getGet('page_mmutasi') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $mutasi = $this->mmutasiModel->search($keyword);
        } else {
            $mutasi = $this->mmutasiModel->getUser();
        }

        $data = [
            'title' => 'Master Mutasi Rekening',
            'dataUsers' => $mutasi->paginate(10, 'kelola'),
            'pager' => $this->mmutasiModel->pager,
            'pageTitle' => 'Halaman Master Mutasi rekening',
            'breadCrumb' => ['dashboard', 'mmutasi'],
            'currentPage' => $currentPage
        ];
        return view('mmutasi/index', $data);
    }

    public function mutasi($id)
    {
        $request = Services::request();
        $uriCurrent = $request->uri->getSegment(3);
        $currentPage = $this->request->getGet('page_mmutasi') ? $this->request->getGet('page_mmutasi') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $mutasi = $this->mmutasi2Model->search($keyword, $id);
        } else {
            $mutasi = $this->mmutasi2Model->getAll($id);
        }

        $data = [
            'title' => 'Mutasi',
            'dataTransaksi' => $mutasi->paginate(10, 'mutasi'),
            'pager' => $this->mmutasi2Model->pager,
            'pageTitle' => 'Halaman Mutasi Rekening',
            'breadCrumb' => ['dashboard', 'mmutasi'],
            'currentPage' => $currentPage,
            'dataUser' => $this->mmutasi2Model->getUser2($id),
            'dataDompet' => $this->mmutasi2Model->getDompet2($id),
            'uriCurrent' => $uriCurrent
        ];
        return view('mmutasi/mutasi', $data);
    }
}