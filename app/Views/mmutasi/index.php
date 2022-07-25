<?php
$this->extend('template/index');
$this->section('content');
?>

<div class="page-content">
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Master Mutasi Rekening</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <form action="<?= base_url('mmutasi'); ?>" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" placeholder="masukkan keyword"
                                            name="keyword">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="search">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <a href="<?= base_url('mmutasi'); ?>" class="btn btn-primary mb-3"><i
                                        class="fas fa-fw fa-sync-alt"></i></a>
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
                                        <th>Saldo</th>
                                        <th>Mutasi</th>
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
                                        <td>Rp.<?= number_format($d['saldo']); ?></td>
                                        <td><a href="<?= base_url('mmutasi/mutasi/' . $d['id_user']); ?>"
                                                class="btn btn-primary"><i class="fa-solid fa-eye"></i> Detail</a></td>
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