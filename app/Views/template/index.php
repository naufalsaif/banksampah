<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.css">


    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/app.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/favicon.svg" type="image/x-icon">
    <?= $this->renderSection('css'); ?>
</head>

<body>
    <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
    <div class="flash-data-wrong" data-flashdata="<?= session()->getFlashdata('wrong'); ?>"></div>
    <?php $request = \Config\Services::request(); ?>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?= base_url('dashboard'); ?>">
                                <h3 style="color: #435ebe;"><i class="fas fa-university"></i> Bank Sampah</h3>
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li
                            class="sidebar-item <?= ($request->uri->getSegment('1') == 'dashboard' ? 'active' : ''); ?>">
                            <a href="<?= base_url('dashboard'); ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <?php if (session()->get('level') == 'admin') : ?>
                        <hr>

                        <li class="sidebar-title">Admin</li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'kelola' ? 'active' : ''); ?>">
                            <a href="<?= base_url('kelola'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-square-plus"></i>
                                <span>Kelola</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'mmutasi' ? 'active' : ''); ?>">
                            <a href="<?= base_url('mmutasi'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-book"></i>
                                <span>Master Mutasi</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'mriwayat' ? 'active' : ''); ?>">
                            <a href="<?= base_url('mriwayat'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-receipt"></i>
                                <span>Master Riwayat</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'barang' ? 'active' : ''); ?>">
                            <a href="<?= base_url('barang'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-box"></i>
                                <span>Master Barang</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'users' ? 'active' : ''); ?>">
                            <a href="<?= base_url('users'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-user-group"></i>
                                <span>Master Users</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item <?= ($request->uri->getSegment('1') == 'pencairan' ? 'active' : ''); ?>">
                            <a href="<?= base_url('pencairan'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-coins"></i>
                                <span>Pencairan Uang</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'mlaporan' ? 'active' : ''); ?>">
                            <a href="<?= base_url('mlaporan'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-print"></i>
                                <span>Master Laporan</span>
                            </a>
                        </li>
                        <?php endif; ?>


                        <?php if (session()->get('level') == 'anggota') : ?>
                        <hr>

                        <li class="sidebar-title">User</li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'mutasi' ? 'active' : ''); ?>">
                            <a href="<?= base_url('mutasi'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-book"></i>
                                <span>Mutasi Rekening</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'riwayat' ? 'active' : ''); ?>">
                            <a href="<?= base_url('riwayat'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <span>Riwayat</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'saldo' ? 'active' : ''); ?>">
                            <a href="<?= base_url('saldo'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-wallet"></i>
                                <span>Saldo</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'laporan' ? 'active' : ''); ?>">
                            <a href="<?= base_url('laporan'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-print"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="sidebar-item <?= ($request->uri->getSegment('1') == 'setting' ? 'active' : ''); ?>">
                            <a href="<?= base_url('setting'); ?>" class='sidebar-link'>
                                <i class="fa-solid fa-gear"></i>
                                <span>Setting</span>
                            </a>
                        </li>

                        <hr>

                        <li class="sidebar-item ">
                            <a href="#" class='sidebar-link' data-bs-toggle="modal" data-bs-target="#logout">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><?= $pageTitle; ?></h3>
                            <!-- <p class="text-subtitle text-muted">For user to check they list</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                                <ol class="breadcrumb">
                                    <?php $jumlah_breadCrumb = count($breadCrumb) - 1; ?>
                                    <?php for ($i = 0; $i <= $jumlah_breadCrumb; $i++) : ?>
                                    <?php if ($i == $jumlah_breadCrumb) : ?>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $breadCrumb[$i]; ?></li>
                                    <?php else : ?>
                                    <li class="breadcrumb-item"><a
                                            href="<?= base_url("{$breadCrumb[$i]}"); ?>"><?= $breadCrumb[$i]; ?></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->renderSection('content'); ?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p><?= date('Y'); ?> &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted by <a href="http://ahmadsaugi.com">A. Saugi</a>, Dev by <a href="#">Novtech06</a> And
                            <a href="#">PapayaLifes</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>



    <div class="modal fade text-left" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #435ebe;">
                    <h5 class="modal-title white" id="myModalLabel160">Apakah yakin ingin logout?
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Tekan "Logout" di bawah jika anda ingin keluar.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <span>Cancel</span>
                    </button>
                    <form action="<?= base_url('logout'); ?>" method="post">
                        <button type="submit" class="btn btn-primary ml-1">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url(); ?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?= base_url(); ?>/assets/js/bootstrap.bundle.min.js"></script> -->

    <!-- <script src="<?= base_url(); ?>/assets/vendors/apexcharts/apexcharts.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/assets/js/pages/dashboard.js"></script> -->

    <!-- <script src="<?= base_url(); ?>/assets/js/extensions/sweetalert2.js"></script> -->

    <script src="<?= base_url(); ?>/assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="<?= base_url(); ?>/assets/vendors/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/mazer.js"></script>

    <?= $this->renderSection('javascript'); ?>

</body>

</html>