<?php $this->extend('template/index'); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/mystyle.css">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="page-content">
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- untuk kembali ke barang -->
                <?php $jumlah_breadCrumb = count($breadCrumb) - 2; ?>
                <?php for ($i = 0; $i <= $jumlah_breadCrumb; $i++) : ?>
                    <?php if ($i == $jumlah_breadCrumb) : ?>
                        <a href="<?= base_url("$breadCrumb[$i]"); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
                    <?php endif; ?>
                <?php endfor; ?>
                <!-- end -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ubah Foto Profile</h4>
                    </div>
                    <div class="card-body">
                        <!-- form tema -->
                        <form action="<?= base_url('setting/simpan_foto'); ?>" method="POST" class="mt-3">
                            <?= csrf_field(); ?>
                            <div class="main-container-tema">
                                <div class="radio-buttons-tema">

                                    <?php foreach ($faceImages as $f) : ?>
                                        <label class="custom-radio-tema">
                                            <input type="radio" name="image" <?= ($dataUser['image'] == $f['name_image']) ? "checked" : "" ?> value="<?= $f['name_image']; ?>">
                                            <span class="radio-btn-tema"><i class="fas fa-check"></i>
                                                <div class="hobbies-icon">
                                                    <img src="<?= base_url(); ?>/assets/images/faces/<?= $f['name_image']; ?>" alt="<?= $f['name']; ?>" class="gambar-tema">
                                                    <h3><?= $f['name']; ?></h3>
                                                </div>
                                            </span>
                                        </label>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="simpan" class="btn btn-primary my-3">Simpan</button>
                            </div>
                        </form>
                        <!-- end form tema -->
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<?php $this->endSection(); ?>