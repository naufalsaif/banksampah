<?php

namespace App\Models;

use CodeIgniter\Model;

class KelolaModel extends Model
{
    protected $table = 'users';

    public function search($keyword)
    {
        $builder = $this->table('users');
        $builder->like('nama_lengkap', $keyword);
        $builder->orLike('username', $keyword);
        $builder->where('level', 'anggota');
        return $builder;
    }

    public function getAll()
    {
        $builder = $this->table('users');
        $builder->where('level', 'anggota');
        return $builder;
    }

    public function getBarang()
    {
        return $this->db->table('barang')->getWhere(['aktif' => '1'])->getResultArray();
    }

    public function getDompet($id)
    {
        return $this->db->table('dompet')->getWhere(['id_user' => $id])->getRowArray();
    }

    public function getUser($id)
    {
        return $this->db->table('users')->getWhere(['id_user' => $id])->getRowArray();
    }

    public function saveAll($data)
    {
        $this->db->transStart();
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_setoran');
        $id_user = $data['id_user'];
        $id_transaksi = 'T' . time() . rand(100, 999);
        $dataDompet = $this->getDompet($id_user);
        $id_dompet = $dataDompet['id_dompet'];
        $saldo = $dataDompet['saldo'] + $data['total'];
        $total = $data['total'];


        $data1 = [
            'id_transaksi' => $id_transaksi,
            'id_dompet' => $id_dompet,
            'tipe' => 'setoran',
            'total' => $total,
            'saldo_terakhir' => $saldo
        ];
        $this->db->table('transaksi')->insert($data1);

        for ($count = 0; $count < count($data['hidden_id_barang']); $count++) {
            $data2[] = [
                'id_transaksi' => $id_transaksi,
                'id_barang' => $data['hidden_id_barang'][$count],
                'berat' => $data['hidden_berat'][$count]
            ];
        }
        $builder->insertBatch($data2);

        $data3 = [
            'saldo' => $saldo
        ];
        $this->db->table('dompet')->update($data3, ['id_dompet' => $id_dompet]);
        $this->db->transComplete();
        return true;
    }
}