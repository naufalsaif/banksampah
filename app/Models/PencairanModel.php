<?php

namespace App\Models;

use CodeIgniter\Model;

class PencairanModel extends Model
{
    protected $table = 'dompet';

    public function search($keyword)
    {
        $builder = $this->table('dompet');
        $builder->select('users.id_user as id_user, users.username as username, users.nama_lengkap as nama_lengkap, users.telepon as telepon, users.blok as blok, dompet.saldo as saldo');
        $builder->join('users', 'users.id_user = dompet.id_user');
        $builder->like('users.username', $keyword);
        $builder->orLike('users.nama_lengkap', $keyword);
        $builder->orLike('users.telepon', $keyword);
        $builder->orLike('users.blok', $keyword);
        $builder->orLike('dompet.saldo', $keyword);
        $builder->orderBy('users.created_at', 'DESC');
        return $builder;
    }

    public function getAll()
    {
        $builder = $this->table('dompet');
        $builder->select('users.id_user as id_user, users.username, users.nama_lengkap, users.telepon, users.blok, dompet.saldo');
        $builder->join('users', 'users.id_user = dompet.id_user');
        $builder->orderBy('users.created_at', 'DESC');
        return $builder;
    }

    public function getUser2()
    {
        return $this->db->table('users')->getWhere(['username' => session()->get('username')])->getRowArray();
    }

    public function getUser3($id)
    {
        return $this->db->table('users')->getWhere(['id_user' => $id])->getRowArray();
    }

    public function getUser($id)
    {
        $builder = $this->table('dompet');
        $builder->join('users', 'users.id_user = dompet.id_user');
        $query = $builder->getWhere(['users.id_user' => $id]);
        return $query->getRowArray();
    }

    public function getDompet($id)
    {
        return $this->db->table('dompet')->getWhere(['id_user' => $id])->getRowArray();
    }

    public function saveAll($data)
    {
        $this->db->transStart();
        $id_user = $data['id_user'];
        $id_transaksi = 'T' . time() . rand(100, 999);
        $dataDompet = $this->getDompet($id_user);
        $id_dompet = $dataDompet['id_dompet'];
        $saldo = $dataDompet['saldo'] - $data['jumlah'];


        $data1 = [
            'id_transaksi' => $id_transaksi,
            'id_dompet' => $id_dompet,
            'tipe' => 'pembayaran',
            'total' => $data['jumlah'],
            'saldo_terakhir' => $saldo
        ];
        $this->db->table('transaksi')->insert($data1);

        $data2 = [
            'saldo' => $saldo
        ];
        $this->db->table('dompet')->update($data2, ['id_dompet' => $id_dompet]);
        $this->db->transComplete();
        return true;
    }
}