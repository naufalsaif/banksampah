<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'transaksi';

    public function getUser()
    {
        return $this->db->table('users')->getWhere(['username' => session()->get('username')])->getRowArray();
    }

    public function getDompet()
    {
        return $this->db->table('dompet')->getWhere(['id_user' => $this->getUser()['id_user']])->getRowArray();
    }

    public function getLaporan($tahun, $bulan)
    {
        $id_dompet = $this->getDompet()['id_dompet'];

        $start = $tahun . '-' . $bulan . '-01 00:00:00';
        $end = $tahun . '-' . $bulan . '-31 00:00:00';

        $builder = $this->table('transaksi');
        $builder->select("(SELECT SUM(total) FROM transaksi WHERE tipe='setoran' AND id_dompet='$id_dompet' AND created_at BETWEEN '$start' AND '$end') AS pendapatan");
        $query = $builder->get();
        return $query->getRowArray();
    }
}