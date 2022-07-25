<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table      = 'users';
    public function getUser()
    {
        return $this->db->table('users')->getWhere(['username' => session()->get('username')])->getRowArray();
    }

    public function updateUser($nama, $value)
    {
        $this->db->table($this->table)->update([$nama => $value], ['username' => session()->get('username')]);
    }
}
