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
                        <h4 class="card-title">Form Barang</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="<?= base_url('barang/simpan'); ?>" method="post">
                                <div class="form-body">
                                    <div class="row">
                                        <?= csrf_field(); ?>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="id_barang">Kode Barang</label>
                                                <input type="text" id="id_barang"
                                                    class="form-control <?= ($validation->hasError('id_barang') ? 'is-invalid' : ''); ?>"
                                                    name="id_barang" value="<?= old('id_barang'); ?>"
                                                    placeholder="masukkan kode barang..."
                                                    <?= (old('id_barang') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('id_barang'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_barang">Nama Barang</label>
                                                <input type="text" id="nama_barang"
                                                    class="form-control <?= ($validation->hasError('nama_barang') ? 'is-invalid' : ''); ?>"
                                                    name="nama_barang" value="<?= old('nama_barang'); ?>"
                                                    placeholder="masukkan nama barang..."
                                                    <?= (old('nama_barang') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('nama_barang'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="number" id="harga"
                                                    class="form-control <?= ($validation->hasError('harga') ? 'is-invalid' : ''); ?>"
                                                    name="harga" value="<?= old('harga'); ?>"
                                                    placeholder="masukkan harga barang..."
                                                    <?= (old('harga') ? '' : 'autofocus'); ?>>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= $validation->getError('harga'); ?>
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