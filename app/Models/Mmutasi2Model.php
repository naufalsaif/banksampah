<?php

namespace App\Models;

use CodeIgniter\Model;

class Mmutasi2Model extends Model
{
    protected $table = 'transaksi';

    public function getUser2($id)
    {
        return $this->db->table('users')->getWhere(['id_user' => $id])->getRowArray();
    }

    public function getDompet2($id)
    {
        return $this->db->table('dompet')->getWhere(['id_user' => $id])->getRowArray();
    }

    public function search($keyword, $id)
    {
        $builder = $this->table('transaksi');
        $builder->like('id_transaksi', $keyword);
        $builder->where('id_dompet', $this->getDompet2($id)['id_dompet']);
        $builder->orderBy('created_at', 'DESC');
        return $builder;
    }

    public function getAll($id)
    {
        $builder = $this->table('transaksi');
        $builder->where('id_dompet', $this->getDompet2($id)['id_dompet']);
        $builder->orderBy('created_at', 'DESC');
        return $builder;
    }
}