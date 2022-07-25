<?php $this->extend('template/index'); ?>

<?php $this->section('css'); ?>
<style>
@media only screen and (min-width: 992px) {
    #img-width {
        width: 300px;
        height: 300px;
    }
}

#qrcode {
    width: 160px;
    height: 160px;
    margin: 0 auto;
}
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<?php if (session()->get('level') == "admin") :  ?>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="assets/images/faces/<?= $userProfile['image']; ?>" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?= $userProfile['nama_lengkap']; ?></h5>
                            <h6 class="text-muted mb-0">@<?= $userProfile['username']; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <h5>Halo selamat datang admin <?= $userProfile['nama_lengkap']; ?> 👋</h5>
                </div>
            </div>
        </div>
    </section>
</div>
<?php else : ?>
<div class="page-content">
    <section class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="assets/images/faces/<?= $userProfile['image']; ?>" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?= $userProfile['nama_lengkap']; ?></h5>
                            <h6 class="text-muted mb-0">@<?= $userProfile['username']; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-body px-5 py-4">
                    <div class="row mb-3">
                        <div class="col-md-1">
                            <div class="stats-icon dark">
                                <i class="fa-solid fa-qrcode"></i>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <h6 class="text-muted font-semibold">QR CODE</h6>
                            <h6 class="font-extrabold mb-0">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#nama_lengkap"><i
                                        class="fa-solid fa-eye"></i> Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?= base_url('saldo'); ?>">
                                <div class="stats-icon blue">
                                    <i class="fa-solid fa-wallet"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Saldo</h6>
                            <h6 class="font-extrabold mb-0"><?= 'Rp.' . number_format($dataDompet['saldo']); ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Pendapatan Bulan Ini</h6>
                            <?php if ($pendapatanBulanIni['pendapatan'] > $pendapatanBulanLalu['pendapatan']) : ?>
                            <h6 class="font-extrabold mb-0" style="color: #16c784;"><i class="fa-solid fa-sort-up"></i>
                                <?= 'Rp.' . number_format($pendapatanBulanIni['pendapatan']); ?></h6>
                            <?php elseif ($pendapatanBulanIni['pendapatan'] == $pendapatanBulanLalu['pendapatan']) : ?>
                            <h6 class="font-extrabold mb-0">
                                <?= 'Rp.' . number_format($pendapatanBulanIni['pendapatan']); ?></h6>
                            <?php else : ?>
                            <h6 class="font-extrabold mb-0" style="color: #ea3943;"><i
                                    class="fa-solid fa-sort-down"></i>
                                <?= 'Rp.' . number_format($pendapatanBulanIni['pendapatan']); ?></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon red">
                                <i class="fa-solid fa-money-bill"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Pendapatan Bulan Lalu</h6>
                            <h6 class="font-extrabold mb-0">
                                <?= 'Rp.' . number_format($pendapatanBulanLalu['pendapatan']); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php endif; ?>



<?php $this->endSection(); ?>

<?php $this->section('javascript'); ?>
<!-- QR Code Modal -->
<div class="modal fade text-left" id="nama_lengkap" tabindex="-1" role="dialog" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel160">QR CODE</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <input type="hidden" id="id_user" value="<?= $userProfile['id_user']; ?>">
                    <div>
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end QR Code -->

<script src="<?= base_url(); ?>/assets/vendors/qrcode/qrcode.min.js"></script>
<script>
// qrcode
const id_user = $('#id_user').val();
let qrcode = new QRCode(document.getElementById("qrcode"), {
    width: 158,
    height: 158,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H
});
qrcode.makeCode(id_user);
</script>
<?php $this->endSection(); ?>