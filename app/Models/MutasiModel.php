<?php

namespace App\Models;

use CodeIgniter\Model;

class MutasiModel extends Model
{
    protected $table      = 'transaksi';
    public function getUser()
    {
        return $this->db->table('users')->getWhere(['username' => session()->get('username')])->getRowArray();
    }

    public function getDompet()
    {
        return $this->db->table('dompet')->getWhere(['id_user' => $this->getUser()['id_user']])->getRowArray();
    }

    public function search($keyword)
    {
        $builder = $this->table('transaksi');
        $builder->like('id_transaksi', $keyword);
        $builder->where('id_dompet', $this->getDompet()['id_dompet']);
        $builder->orderBy('created_at', 'DESC');
        return $builder;
    }

    public function getAll()
    {
        $builder = $this->table('transaksi');
        $builder->where('id_dompet', $this->getDompet()['id_dompet']);
        $builder->orderBy('created_at', 'DESC');
        return $builder;
    }
}
