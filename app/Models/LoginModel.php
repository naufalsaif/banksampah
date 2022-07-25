<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function getUser($username)
    {
        return $this->db->table('users')->getWhere(['username' => $username])->getRowArray();
    }

    public function updateLastActive($date, $username)
    {
        $this->db->table('users')->update(['last_active' => $date], ['username' => $username]);
    }
}
