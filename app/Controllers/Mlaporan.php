<?php

namespace App\Controllers;

use App\Models\MlaporanModel;

class Mlaporan extends BaseController
{
    protected $mlaporanModel;
    public function __construct()
    {
        $this->mlaporanModel = new MlaporanModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Master Laporan',
            'pageTitle' => 'Halaman Master Laporan',
            'breadCrumb' => ['dashboard', 'mlaporan'],
        ];
        return view('mlaporan/index', $data);
    }

    public function print()
    {
        if (!$this->request->getVar('bulan_tahun')) {
            session()->setFlashdata('wrong', 'Data tidak ditemukan!');
            return redirect()->to('mlaporan');
        }
        $tahun = explode('-', $this->request->getPost('bulan_tahun'))['0'];
        $bulan = explode('-', $this->request->getPost('bulan_tahun'))['1'];
        $laporan = $this->mlaporanModel->getLaporan($tahun, $bulan);
        if ($laporan['pendapatan'] == null) {
            session()->setFlashdata('wrong', 'Data tidak ditemukan!');
            return redirect()->to('mlaporan');
        }

        $data = [
            'title' => 'Laporan Bank Sampah',
            'tanggal' => $this->request->getPost('bulan_tahun'),
            'pendapatan' => $laporan['pendapatan'],
        ];
        return view('mlaporan/print', $data);
    }
}