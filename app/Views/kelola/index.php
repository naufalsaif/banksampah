<?php
$this->extend('template/index');
$this->section('content');
?>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                List User
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <button type="button" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#scanqr" onclick="addClassValue();"><i class="fa-solid fa-qrcode"></i> Scan QR</button>
                        <a href="<?= base_url('kelola'); ?>" class="btn btn-primary mb-3"><i class="fas fa-fw fa-sync-alt"></i></a>
                    </div>
                    <div class="col">
                        <form action="<?= base_url('kelola'); ?>" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search..." name="keyword">
                                <button class="btn btn-outline-primary" type="submit" id="search">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- table striped -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Blok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                            <?php foreach ($dataUsers as $d) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $d['username']; ?></td>
                                    <td><?= $d['nama_lengkap']; ?></td>
                                    <td><?= $d['telepon']; ?></td>
                                    <td><?= $d['blok']; ?></td>
                                    <td><a href="<?= base_url('kelola/tambah/' . $d['id_user']); ?>" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?= $pager->links('kelola', 'bank_pagination'); ?>
        </div>

    </section>
</div>

<?php $this->endSection(); ?>

<?php $this->section('javascript'); ?>
<div class="modal fade text-left" id="scanqr" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Silahkan Scan QR
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="stopCamera()"></button>
            </div>
            <form action="<?= base_url('kelola/tambah_redirect'); ?>" method="POST">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <video id="scan-qrcode" class="mb-1" width="100%" height="auto" style="border: 1px solid black;"></video>
                        <button type="button" onclick="addClassValue()" id="buttonValue" class="invalid btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></button>
                        <div class="form-group mb-0 mt-2">
                            <input type="text" class="form-control" name="id_user" id="id_user" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="munculTombol">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>/assets/vendors/scanner-qrcode/instascan.min.js"></script>
<script>
    // sweetalert
    const flashDataSuccess = $('.flash-data-success').data('flashdata');
    const flashDataWrong = $('.flash-data-wrong').data('flashdata');

    if (flashDataSuccess) {
        Swal.fire({
            // title: 'Selamat!',
            text: flashDataSuccess,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } else if (flashDataWrong) {
        Swal.fire({
            // title: 'Selamat!',
            text: flashDataWrong,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }

    // scanner qrcode
    let buttonValue = document.getElementById('buttonValue');
    let valid = document.getElementsByClassName('valid');
    let invalid = document.getElementsByClassName('invalid');

    let scanner = new Instascan.Scanner({
        video: document.getElementById('scan-qrcode')
    });
    scanner.addListener('scan', function(content) {
        let tombolNext = document.getElementById('tombolNext');
        // alert(content);
        $("#id_user").val(content);
        if (!tombolNext) {
            $('#munculTombol').append('<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" onclick="stopCamera()"><span>Cancel</span></button>');
            $('#munculTombol').append('<button type="submit" class="btn btn-primary ml-1" id="tombolNext" onclick="stopCamera()"><span>Next</span></button>');
        }
    });

    function stopCamera() {
        scanner.stop();
        console.log('berhenti');
    }

    function addClassValue() {
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 1) {
                if (valid.length == 1) {
                    scanner.start(cameras[0]);
                    buttonValue.classList.add('invalid');
                    buttonValue.classList.remove('valid');
                    console.log('sukses invalid');
                } else if (invalid.length == 1) {
                    scanner.start(cameras[1]);
                    buttonValue.classList.add('valid');
                    buttonValue.classList.remove('invalid');
                    console.log('sukses valid');
                }
            } else if (cameras.length == 1) {
                console.log('kamera anda hanya 1');
                scanner.start(cameras[0]);
            } else {
                console.error('No Cameras Found');
            }
        }).catch(function(e) {
            console.error(e.message);
            // console.error(e);
        });
    }
</script>
<?php $this->endSection(); ?>