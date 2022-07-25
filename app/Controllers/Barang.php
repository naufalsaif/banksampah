<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $barangModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $currentPage = $this->request->getGet('page_barang') ? $this->request->getGet('page_barang') : 1;

        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $barang = $this->barangModel->search($keyword);
        } else {
            $barang = $this->barangModel;
        }


        $data = [
            'title' => 'Barang',
            'dataBarang' => $barang->paginate(10, 'barang'),
            'pager' => $this->barangModel->pager,
            'pageTitle' => 'Halaman Barang',
            'breadCrumb' => ['dashboard', 'barang'],
            'currentPage' => $currentPage
        ];
        return view('barang/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Barang',
            'pageTitle' => 'Halaman Tambah Barang',
            'breadCrumb' => ['dashboard', 'barang', 'tambah'],
            'validation' => \Config\Services::validation()
        ];

        return view('barang/tambah', $data);
    }

    public function simpan()
    {
        // validasi input
        if (!$this->validate([
            'id_barang' => [
                'rules' => 'required|alpha_numeric_space|is_unique[barang.id_barang]',
                'errors' => [
                    'required' => 'Kode barang harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka',
                    'is_unique' => 'Kode barang sudah terdaftar'
                ]
            ],
            'nama_barang' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama barang harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka'
                ]
            ],
            'harga' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Harga harus diisi!',
                    'integer' => 'Hanya boleh angka'
                ]
            ]
        ])) {
            return redirect()->to('barang/tambah')->withInput();
        }

        $data = [
            'id_barang' => trim($this->request->getPost('id_barang')),
            'nama_barang' => trim($this->request->getPost('nama_barang')),
            'harga' => trim($this->request->getPost('harga'))
        ];

        $this->barangModel->saveBarang($data);

        session()->setFlashdata('success', 'Berhasil menambah data baru');
        return redirect()->to('barang');
    }

    public function ubah($id)
    {
        $data = [
            'title' => 'Ubah Barang',
            'pageTitle' => 'Halaman Ubah Barang',
            'breadCrumb' => ['dashboard', 'barang', 'ubah'],
            'dataBarang' => $this->barangModel->getBarang($id),
            'validation' => \Config\Services::validation()
        ];

        return view('barang/ubah', $data);
    }

    public function perbarui($id)
    {
        $barangLama = $this->barangModel->getBarang($id);
        if ($barangLama['id_barang'] == $id) {
            $rule_id_barang = 'required|alpha_numeric_space';
        } else {
            $rule_id_barang = 'required|alpha_numeric_space|is_unique[barang.id_barang]';
        }

        // validasi input
        if (!$this->validate([
            'id_barang' => [
                'rules' => $rule_id_barang,
                'errors' => [
                    'required' => 'Kode barang harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka',
                    'is_unique' => 'Kode barang sudah terdaftar'
                ]
            ],
            'nama_barang' => [
                'rules' => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => 'Nama barang harus diisi!',
                    'alpha_numeric_space' => 'Hanya boleh huruf dan angka'
                ]
            ],
            'harga' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Harga harus diisi!',
                    'integer' => 'Hanya boleh angka'
                ]
            ]
        ])) {
            return redirect()->to('barang/tambah')->withInput();
        }

        $updated_at = date('Y-m-d H:i:s');
        $data = [
            'id_barang' => trim($this->request->getPost('id_barang')),
            'nama_barang' => trim($this->request->getPost('nama_barang')),
            'harga' => trim($this->request->getPost('harga')),
            'updated_at' => $updated_at
        ];
        $this->barangModel->updateBarang($data, $id);

        session()->setFlashdata('success', 'Berhasil perbarui data');
        return redirect()->to('barang');
    }

    public function aktifBarang($id)
    {
        $barang = $this->barangModel->getBarang($id);
        if ($barang['aktif'] == 1) {
            $this->barangModel->aktifBarang('0', $id);
            session()->setFlashdata('success', 'Berhasil Menonaktifkan data');
        } else {
            $this->barangModel->aktifBarang('1', $id);
            session()->setFlashdata('success', 'Berhasil Mengaktifkan data');
        }
        return redirect()->to('barang');
    }

    // public function hapus($id)
    // {
    //     $this->barangModel->deleteBarang($id);

    //     session()->setFlashdata('success', 'Berhasil menghapus data');
    //     return redirect()->to('barang');
    // }
}