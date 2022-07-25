<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrasiModel extends Model
{
    public function saveUser($data)
    {
        $this->db->table('users')->insert($data);
    }

    public function saveDompet($data)
    {
        $this->db->table('dompet')->insert($data);
    }
}
