<?php

namespace App\Models;

use CodeIgniter\Model;

class MriwayatModel extends Model
{
    protected $table      = 'transaksi';

    public function search($keyword)
    {
        $builder = $this->table('transaksi');
        $builder->select('transaksi.id_transaksi as id_transaksi, users.username as username, barang.nama_barang as nama_barang, detail_setoran.berat as berat, barang.harga as harga, transaksi.created_at as created_at');
        $builder->join('dompet', 'dompet.id_dompet = transaksi.id_dompet');
        $builder->join('users', 'users.id_user = dompet.id_user');
        $builder->join('detail_setoran', 'detail_setoran.id_transaksi = transaksi.id_transaksi');
        $builder->join('barang', 'barang.id_barang = detail_setoran.id_barang');
        $builder->like('transaksi.id_transaksi', $keyword);
        $builder->orlike('users.username', $keyword);
        $builder->orlike('barang.nama_barang', $keyword);
        $builder->where('users.level', 'anggota');
        $builder->orderBy('transaksi.created_at', 'DESC');
        return $builder;
    }

    public function getAll()
    {
        $builder = $this->table('transaksi');
        $builder->select('transaksi.id_transaksi as id_transaksi, users.username as username, barang.nama_barang as nama_barang, detail_setoran.berat as berat, barang.harga as harga, transaksi.created_at as created_at');
        $builder->join('dompet', 'dompet.id_dompet = transaksi.id_dompet');
        $builder->join('users', 'users.id_user = dompet.id_user');
        $builder->join('detail_setoran', 'detail_setoran.id_transaksi = transaksi.id_transaksi');
        $builder->join('barang', 'barang.id_barang = detail_setoran.id_barang');
        $builder->where('users.level', 'anggota');
        $builder->orderBy('transaksi.created_at', 'DESC');
        return $builder;
        // $query = $builder->get();
        // return $query->getResult();
    }
}