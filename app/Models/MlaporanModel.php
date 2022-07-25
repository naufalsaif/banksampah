<?php

namespace App\Models;

use CodeIgniter\Model;

class MlaporanModel extends Model
{
    protected $table = 'transaksi';

    public function getLaporan($tahun, $bulan)
    {
        $start = $tahun . '-' . $bulan . '-01 00:00:00';
        $end = $tahun . '-' . $bulan . '-31 00:00:00';

        $builder = $this->table('transaksi');
        $builder->select("(SELECT SUM(total) FROM transaksi WHERE tipe='setoran' AND created_at BETWEEN '$start' AND '$end') AS pendapatan");
        $query = $builder->get();
        return $query->getRowArray();
    }
}