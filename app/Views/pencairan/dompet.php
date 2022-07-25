<?php
$this->extend('template/index');
$this->section('content');
?>

<div class="page-content">
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-md-8 col-12">
                <!-- untuk kembali ke barang -->
                <?php $jumlah_breadCrumb = count($breadCrumb) - 2; ?>
                <?php for ($i = 0; $i <= $jumlah_breadCrumb; $i++) : ?>
                <?php if ($i == $jumlah_breadCrumb) : ?>
                <a href="<?= base_url("$breadCrumb[$i]"); ?>" class="btn btn-primary mb-3"><i
                        class="fas fa-arrow-left"></i></a>
                <?php endif; ?>
                <?php endfor; ?>
                <!-- end -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Pencairan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical"
                                action="<?= base_url('pencairan/simpan/' . $dataUser['id_user']); ?>" method="post">
                                <div class="form-body">
                                    <div class="row">
                                        <?= csrf_field(); ?>
                                        <div class="col-12">
                                            <input type="hidden" name="id_user" value="<?= $dataUser['id_user']; ?>">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" id="username" class="form-control" name="username"
                                                    value="<?= $dataUser['username']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="saldo">Saldo</label>
                                                <input type="text" id="saldo" class="form-control" name="saldo"
                                                    value="<?= $dataUser['saldo']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" id="jumlah"
                                                    class="form-control <?= ($validation->hasError('jumlah') ? 'is-invalid' : ''); ?>"
                                                    name="jumlah" value="<?= old('jumlah'); ?>"
                                                    placeholder="masukkan jumlah yang ingin dicairkan..."
                                                    <?= (old('jumlah') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('jumlah'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password">Password Konfirmasi</label>
                                                <input type="password" id="password"
                                                    class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>"
                                                    name="password" value="<?= old('password'); ?>"
                                                    placeholder="masukkan password..."
                                                    <?= (old('password') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('password'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<?php $this->endSection(); ?>

<?php $this->section('javascript'); ?>
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