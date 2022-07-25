<?php

namespace App\Models;

use CodeIgniter\Model;

class MmutasiModel extends Model
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

    public function getUser()
    {
        $builder = $this->table('users');
        $builder->join('dompet', 'users.id_user = dompet.id_user');
        $builder->where('level', 'anggota');
        return $builder;
    }
}