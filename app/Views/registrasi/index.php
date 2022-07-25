<?php
$this->extend('template/auth');
$this->section('content');
?>

<form action="<?= base_url('registrasi/validation'); ?>" method="POST">
    <div class="form-group position-relative has-icon-left mb-0">
        <input type="text" class="form-control form-control-xl <?= ($validation->hasError('nama_lengkap') ? 'is-invalid' : ''); ?>" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= old('nama_lengkap'); ?>" <?= (old('nama_lengkap') ? '' : 'autofocus'); ?>>
        <div class="form-control-icon">
            <i class="bi bi-file-person"></i>
        </div>
    </div>
    <?php if ($validation->hasError('nama_lengkap')) : ?>
        <div class="mb-4">
            <span class="text-danger"><?= $validation->getError('nama_lengkap'); ?></span>
        </div>
    <?php else : ?>
        <div class="mb-4"></div>
    <?php endif; ?>
    <div class="form-group position-relative has-icon-left mb-0">
        <input type="number" class="form-control form-control-xl <?= ($validation->hasError('telepon') ? 'is-invalid' : ''); ?>" name="telepon" placeholder="Telephone" value="<?= old('telepon'); ?>" <?= (old('telepon') ? '' : 'autofocus'); ?>>
        <div class="form-control-icon">
            <i class="bi bi-phone"></i>
        </div>
    </div>
    <?php if ($validation->hasError('telepon')) : ?>
        <div class="mb-4">
            <span class="text-danger"><?= $validation->getError('telepon'); ?></span>
        </div>
    <?php else : ?>
        <div class="mb-4"></div>
    <?php endif; ?>
    <div class="form-group position-relative has-icon-left mb-0">
        <input type="text" class="form-control form-control-xl <?= ($validation->hasError('blok') ? 'is-invalid' : ''); ?>" name="blok" placeholder="Blok cth: A7 NO 9" value="<?= old('blok'); ?>" <?= (old('blok') ? '' : 'autofocus'); ?>>
        <div class="form-control-icon">
            <i class="bi bi-geo"></i>
        </div>
    </div>
    <?php if ($validation->hasError('blok')) : ?>
        <div class="mb-4">
            <span class="text-danger"><?= $validation->getError('blok'); ?></span>
        </div>
    <?php else : ?>
        <div class="mb-4"></div>
    <?php endif; ?>
    <div class="form-group position-relative has-icon-left mb-0">
        <input type="text" class="form-control form-control-xl <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>" name="username" placeholder="Username" value="<?= old('username'); ?>" <?= (old('username') ? '' : 'autofocus'); ?>>
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
    </div>
    <?php if ($validation->hasError('username')) : ?>
        <div class="mb-4">
            <span class="text-danger"><?= $validation->getError('username'); ?></span>
        </div>
    <?php else : ?>
        <div class="mb-4"></div>
    <?php endif; ?>
    <div class="form-group position-relative has-icon-left mb-0">
        <input type="password" class="form-control form-control-xl <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" name="password" placeholder="Password" value="<?= old('password'); ?>" <?= (old('password') ? '' : 'autofocus'); ?>>
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <?php if ($validation->hasError('password')) : ?>
        <div class="mb-4">
            <span class="text-danger"><?= $validation->getError('password'); ?></span>
        </div>
    <?php else : ?>
        <div class="mb-4"></div>
    <?php endif; ?>
    <div class="form-group position-relative has-icon-left mb-0">
        <input type="password" class="form-control form-control-xl <?= ($validation->hasError('confirm_password') ? 'is-invalid' : ''); ?>" name="confirm_password" placeholder="Confirm Password" value="<?= old('confirm_password'); ?>" <?= (old('confirm_password') ? '' : 'autofocus'); ?>>
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <?php if ($validation->hasError('confirm_password')) : ?>
        <div class="mb-4">
            <span class="text-danger"><?= $validation->getError('confirm_password'); ?></span>
        </div>
    <?php else : ?>
        <div class="mb-4"></div>
    <?php endif; ?>
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
</form>
<div class="text-center mt-5 text-lg fs-4">
    <p class='text-gray-600'>Sudah memiliki akun? <a href="<?= base_url("login"); ?>" class="font-bold">Login</a></p>
</div>

<?php $this->endSection(); ?>