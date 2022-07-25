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
                            <form class="form form-vertical" action="<?= base_url('users/simpan'); ?>" method="post">
                                <div class="form-body">
                                    <div class="row">
                                        <?= csrf_field(); ?>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <input type="text" id="nama_lengkap"
                                                    class="form-control <?= ($validation->hasError('nama_lengkap') ? 'is-invalid' : ''); ?>"
                                                    name="nama_lengkap" value="<?= old('nama_lengkap'); ?>"
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
                                                    name="username" value="<?= old('username'); ?>"
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
                                                <label for="password">Password</label>
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
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="telepon">Telepon</label>
                                                <input type="number" id="telepon"
                                                    class="form-control <?= ($validation->hasError('telepon') ? 'is-invalid' : ''); ?>"
                                                    name="telepon" value="<?= old('telepon'); ?>"
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
                                                    name="blok" value="<?= old('blok'); ?>"
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
                                                    <option value="anggota"
                                                        <?= (old('level') == 'anggota' ? 'selected' : ''); ?>>Anggota
                                                    </option>
                                                    <option value="admin"
                                                        <?= (old('level') == 'admin' ? 'selected' : ''); ?>>Admin
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('blok'); ?>
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