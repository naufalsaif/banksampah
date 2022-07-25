<?php

namespace App\Controllers;

use App\Models\LaporanModel;

class Laporan extends BaseController
{
    protected $laporanModel;
    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Riwayat Laporan',
            'pageTitle' => 'Halaman Laporan',
            'breadCrumb' => ['dashboard', 'laporan'],
        ];
        return view('laporan/index', $data);
    }

    public function print()
    {
        if (!$this->request->getVar('bulan_tahun')) {
            session()->setFlashdata('wrong', 'Data tidak ditemukan!');
            return redirect()->to('laporan');
        }
        $tahun = explode('-', $this->request->getPost('bulan_tahun'))['0'];
        $bulan = explode('-', $this->request->getPost('bulan_tahun'))['1'];
        $laporan = $this->laporanModel->getLaporan($tahun, $bulan);
        if ($laporan['pendapatan'] == null) {
            session()->setFlashdata('wrong', 'Data tidak ditemukan!');
            return redirect()->to('laporan');
        }

        $data = [
            'title' => 'Laporan Bank Sampah',
            'tanggal' => $this->request->getPost('bulan_tahun'),
            'user' => $this->laporanModel->getUser(),
            'pendapatan' => $laporan['pendapatan'],
        ];
        return view('laporan/print', $data);
    }
}