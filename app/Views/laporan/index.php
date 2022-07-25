<?php
$this->extend('template/index');
$this->section('content');
?>

<div class="page-content">
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Riwayat Laporan</h4>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" action="<?= base_url('laporan/print'); ?>" method="post">
                            <div class="form-body">
                                <div class="row">
                                    <?= csrf_field(); ?>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="bulan_tahun">Bulan Tahun</label>
                                            <input type="month" id="bulan_tahun" class="form-control" name="bulan_tahun"
                                                placeholder="masukkan nama lengkap...">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1"><i
                                                class="fa-solid fa-print"></i> Print</button>
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