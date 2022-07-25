<?php
$this->extend('template/index');
$this->section('content');
?>

<div class="page-content">
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="<?= base_url(); ?>/assets/images/faces/<?= $dataUser['image']; ?>" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold"><?= $dataUser['nama_lengkap']; ?></h5>
                                <h6 class="text-muted mb-0">@<?= $dataUser['username']; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Setting Profile</h4>
                    </div>

                    <div class="card-body">
                        <?php if ($validation->hasError('nama_lengkap') || $validation->hasError('username') || $validation->hasError('blok') || $validation->hasError('telepon') || $validation->hasError('password') || $validation->hasError('telepon_lama') || $validation->hasError('confirm_password')) : ?>
                            <div class="alert alert-danger alert-dismissible show fade">
                                <?= $validation->listErrors(); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6 class="mb-1">Foto Profile</h6>
                                <a href="<?= base_url('setting/foto_profile'); ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6 class="mb-1">Nama Lengkap: <?= $dataUser['nama_lengkap']; ?></h6>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nama_lengkap"><i class="fa-solid fa-pen-to-square"></i></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6 class="mb-1">Username: @<?= $dataUser['username']; ?></h6>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#username"><i class="fa-solid fa-pen-to-square"></i></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6 class="mb-1">Blok: <?= $dataUser['blok']; ?></h6>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#blok"><i class="fa-solid fa-pen-to-square"></i></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6 class="mb-1">Telepon: <?= $dataUser['telepon']; ?></h6>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#telepon"><i class="fa-solid fa-pen-to-square"></i></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6 class="mb-1">Password: *****</h6>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#password"><i class="fa-solid fa-pen-to-square"></i></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->endSection(); ?>


<?php $this->section('javascript'); ?>
<!-- nama lengkap Modal -->
<div class="modal fade text-left" id="nama_lengkap" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel160">Form Ubah Nama</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('setting/simpan_nama'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <label>Nama Lengkap: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="masukkan nama lengkap..." value="<?= $dataUser['nama_lengkap']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <span class="">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <span class="">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end nama lengkap -->

<!-- username Modal -->
<div class="modal fade text-left" id="username" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel160">Form Ubah Username</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('setting/simpan_username'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <label>Username: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="masukkan username..." value="<?= $dataUser['username']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <span class="">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <span class="">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end username -->

<!-- blok Modal -->
<div class="modal fade text-left" id="blok" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel160">Form Ubah Blok</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('setting/simpan_blok'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <label>Blok: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="blok" id="blok" placeholder="masukkan blok..." value="<?= $dataUser['blok']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <span class="">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <span class="">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end blok -->

<!-- telepon Modal -->
<div class="modal fade text-left" id="telepon" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel160">Form Ubah Telepon</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('setting/simpan_telepon'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <label>Telepon: </label>
                    <div class="form-group">
                        <input type="number" class="form-control" name="telepon" id="telepon" placeholder="masukkan telepon..." value="<?= $dataUser['telepon']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <span class="">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <span class="">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end telepon -->

<!-- password Modal -->
<div class="modal fade text-left" id="password" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel160">Form Ubah Password</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('setting/simpan_password'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <label>Password Lama: </label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="masukkan password lama...">
                    </div>
                    <label>Password Baru: </label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="masukkan password...">
                    </div>
                    <label>Confirm Password: </label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="masukkan confirm password...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <span class="">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <span class="">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end password -->

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
</script>
<?php $this->endSection(); ?>