<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use DateTime;

class Dashboard extends BaseController
{
    protected $dashboardModel;
    public function __construct()
    {
        $this->dashboardModel = new DashboardModel();
    }

    public function index()
    {
        $firstDay = new DateTime('first day of this month');
        $lastDay = new DateTime('last day of this month');
        $lastMonthFirstDay = new DateTime('first day of last month');
        $lastMonthLastDay = new DateTime('last day of last month');
        $pendapatanBulanIni = $this->dashboardModel->pendapatanBulanIni($firstDay, $lastDay);
        $pendapatanBulanLalu =  $this->dashboardModel->pendapatanBulanLalu($lastMonthFirstDay, $lastMonthLastDay);
        if (!$pendapatanBulanIni['pendapatan']) {
            $pendapatanBulanIni = [
                'pendapatan' => 0
            ];
        } else {
            $pendapatanBulanIni = $this->dashboardModel->pendapatanBulanIni($firstDay, $lastDay);
        }
        if (!$pendapatanBulanLalu['pendapatan']) {
            $pendapatanBulanLalu = [
                'pendapatan' => 0
            ];
        } else {
            $pendapatanBulanLalu = $this->dashboardModel->pendapatanBulanLalu($lastMonthFirstDay, $lastMonthLastDay);
        }
        $data = [
            'title' => 'Dashboard',
            'pageTitle' => 'Halaman Dashboard',
            'breadCrumb' => ['dashboard'],
            'userProfile' => $this->dashboardModel->getUser(),
            'dataDompet' => $this->dashboardModel->getDompet(),
            'pendapatanBulanIni' => $pendapatanBulanIni,
            'pendapatanBulanLalu' => $pendapatanBulanLalu
        ];
        return view('dashboard/index', $data);
    }
}
