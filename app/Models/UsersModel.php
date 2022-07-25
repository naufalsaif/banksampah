<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';

    public function getUsers($id = false)
    {
        if ($id == false) {
            return $this->orderBy('created_at', 'DESC')->findAll();
        }
        return $this->where(['id_user' => $id])->first();
    }

    public function getUser()
    {
        return $this->db->table('users')->getWhere(['username' => session()->get('username')])->getRowArray();
    }

    public function search($keyword)
    {
        $builder = $this->table('users');
        $builder->like('nama_lengkap', $keyword);
        $builder->orLike('username', $keyword);
        return $builder;
    }

    public function saveUser($data)
    {
        $this->db->table($this->table)->insert($data);
    }

    public function saveDompet($data)
    {
        $this->db->table('dompet')->insert($data);
    }

    public function updateUser($data, $id)
    {
        $this->db->table($this->table)->update($data, ['id_user' => $id]);
    }

    public function aktifUser($data, $id)
    {
        $this->db->table($this->table)->update(['aktif' => $data], ['id_user' => $id]);
    }

    // public function deleteUser($id)
    // {
    //     $this->db->table($this->table)->delete(['id_user' => $id]);
    //     $this->db->table('dompet')->delete(['id_user' => $id]);
    // }
}
