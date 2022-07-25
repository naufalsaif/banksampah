<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'users';

    public function getUser()
    {
        return $this->db->table('users')->getWhere(['username' => session()->get('username')])->getRowArray();
    }

    public function getDompet()
    {
        return $this->db->table('dompet')->getWhere(['id_user' => $this->getUser()['id_user']])->getRowArray();
    }

    public function pendapatanBulanIni($firstDay, $lastDay)
    {
        $firstDay->setTime(00, 00, 00, 0);
        $lastDay->setTime(00, 00, 00, 0);
        $one = $firstDay->format('Y-m-d H:i:s');
        $two = $lastDay->format('Y-m-d H:i:s');
        $id_dompet = $this->getDompet()['id_dompet'];
        $builder = $this->table('transaksi');
        $builder->select("(SELECT SUM(total) FROM transaksi WHERE tipe='setoran' AND id_dompet='$id_dompet' AND created_at BETWEEN '$one' AND '$two') AS pendapatan");
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function pendapatanBulanLalu($lastMonthFirstDay, $lastMonthLastDay)
    {
        $lastMonthFirstDay->setTime(00, 00, 00, 0);
        $lastMonthLastDay->setTime(00, 00, 00, 0);
        $one = $lastMonthFirstDay->format('Y-m-d H:i:s');
        $two = $lastMonthLastDay->format('Y-m-d H:i:s');
        $id_dompet = $this->getDompet()['id_dompet'];
        $builder = $this->table('transaksi');
        $builder->select("(SELECT SUM(total) FROM transaksi WHERE tipe='setoran' AND id_dompet='$id_dompet' AND created_at BETWEEN '$one' AND '$two') AS pendapatan");
        $query = $builder->get();
        return $query->getRowArray();
    }
}
