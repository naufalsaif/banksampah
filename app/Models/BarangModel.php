<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table      = 'barang';

    public function getBarang($id = false)
    {
        if ($id == false) {
            return $this->orderBy('created_at', 'DESC')->findAll();
        }
        return $this->where(['id_barang' => $id])->first();
    }

    public function search($keyword)
    {
        $builder = $this->table('barang');
        $builder->like('id_barang', $keyword);
        $builder->orLike('nama_barang', $keyword);
        return $builder;
    }

    public function getUser()
    {
        return $this->db->table('users')->getWhere(['username' => session()->get('username')])->getRowArray();
    }

    public function saveBarang($data)
    {
        $this->db->table($this->table)->insert($data);
    }

    public function updateBarang($data, $id)
    {
        $this->db->table($this->table)->update($data, ['id_barang' => $id]);
    }

    public function aktifBarang($data, $id)
    {
        $this->db->table($this->table)->update(['aktif' => $data], ['id_barang' => $id]);
    }

    // public function deleteBarang($id)
    // {
    //     $this->db->table($this->table)->delete(['id_barang' => $id]);
    // }
}
