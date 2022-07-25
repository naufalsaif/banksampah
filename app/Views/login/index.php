<?php
$this->extend('template/auth');
$this->section('content');
?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible show fade">
        <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<form action="<?= base_url('login/validation'); ?>" method="POST">
    <div class="form-group position-relative has-icon-left mb-0">
        <input type="text" class="form-control form-control-xl <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>" name="username" value="<?= old('username'); ?>" placeholder="Username" <?= (old('username') ? '' : 'autofocus'); ?>>
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
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
</form>
<div class="text-center mt-5 text-lg fs-4">
    <p class="text-gray-600">Tidak punya akun? <a href="<?= base_url("registrasi"); ?>" class="font-bold">Registrasi</a></p>
</div>

<?php $this->endSection(); ?>