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
                        <h4 class="card-title">Form User</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical"
                                action="<?= base_url('users/perbarui/' . $dataUser['id_user']); ?>" method="post">
                                <div class="form-body">
                                    <div class="row">
                                        <?= csrf_field(); ?>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <input type="text" id="nama_lengkap"
                                                    class="form-control <?= ($validation->hasError('nama_lengkap') ? 'is-invalid' : ''); ?>"
                                                    name="nama_lengkap"
                                                    value="<?= (old('nama_lengkap') ? old('nama_lengkap') : $dataUser['nama_lengkap']); ?>"
                                                    placeholder="masukkan nama lengkap..."
                                                    <?= (old('nama_lengkap') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('nama_lengkap'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" id="username"
                                                    class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>"
                                                    name="username"
                                                    value="<?= (old('username') ? old('username') : $dataUser['username']); ?>"
                                                    placeholder="masukkan username..."
                                                    <?= (old('username') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('username'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password">Password(Opsional)</label>
                                                <input type="password" id="password"
                                                    class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>"
                                                    name="password" value="" placeholder="masukkan password..."
                                                    <?= (old('password') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('password'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="telepon">Telepon</label>
                                                <input type="number" id="telepon"
                                                    class="form-control <?= ($validation->hasError('telepon') ? 'is-invalid' : ''); ?>"
                                                    name="telepon"
                                                    value="<?= (old('telepon') ? old('telepon') : $dataUser['telepon']); ?>"
                                                    placeholder="masukkan telepon..."
                                                    <?= (old('telepon') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('telepon'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="blok">Blok</label>
                                                <input type="text" id="blok"
                                                    class="form-control <?= ($validation->hasError('blok') ? 'is-invalid' : ''); ?>"
                                                    name="blok"
                                                    value="<?= (old('blok') ? old('blok') : $dataUser['blok']); ?>"
                                                    placeholder="masukkan blok cth: A7 NO 9..."
                                                    <?= (old('blok') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('blok'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="level">Level User</label>
                                                <select
                                                    class="form-select <?= ($validation->hasError('level') ? 'is-invalid' : ''); ?>"
                                                    id="level" name="level">
                                                    <option disabled selected value="">--- Pilih Level ---</option>
                                                    <?php if ($validation->hasError('level')) : ?>
                                                    <option value="anggota"
                                                        <?= (old('level') == 'anggota' ? 'selected' : ''); ?>>Anggota
                                                    </option>
                                                    <option value="admin"
                                                        <?= (old('level') == 'admin' ? 'selected' : ''); ?>>Admin
                                                    </option>
                                                    <?php else : ?>
                                                    <option value="anggota"
                                                        <?= ($dataUser['level'] == 'anggota' ? 'selected' : ''); ?>>
                                                        Anggota</option>
                                                    <option value="admin"
                                                        <?= ($dataUser['level'] == 'admin' ? 'selected' : ''); ?>>Admin
                                                    </option>
                                                    <?php endif; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('blok'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <?php if ($dataUser['aktif'] == 1) : ?>
                                            <a href="<?= base_url('users/aktif/' . $dataUser['id_user']); ?>"
                                                class="btn btn-danger me-1 mb-1 tombol-setujui"
                                                data-sweetalert-setujui="Apakah anda ingin menonaktfikan akun ini?">Inactive</a>
                                            <?php else : ?>
                                            <a href="<?= base_url('users/aktif/' . $dataUser['id_user']); ?>"
                                                class="btn btn-success me-1 mb-1 tombol-setujui"
                                                data-sweetalert-setujui="Apakah anda ingin mengaktifkan akun ini?">Active</a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
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

//  tombol hapus
const sweetalert_hapus = $('.tombol-hapus').data('sweetalert-hapus');
$('.tombol-hapus').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-warning',
            cancelButton: 'btn btn-primary me-3'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        text: sweetalert_hapus,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batalkan',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                '',
                'Dibatalkan',
                'error'
            )
        }
    })

});

//  tombol setujui
const sweetalert_setujui = $('.tombol-setujui').data('sweetalert-setujui');
$('.tombol-setujui').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-primary me-3'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        text: sweetalert_setujui,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Setuju',
        cancelButtonText: 'Batalkan',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                '',
                'Dibatalkan',
                'error'
            )
        }
    })

});
</script>
<?php $this->endSection(); ?>