<?php
$this->extend('template/index');
$this->section('content');
?>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                List Riwayat
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <a href="<?= base_url('kelola'); ?>" class="btn btn-outline-primary mb-3"><i
                                class="fa-solid fa-square-plus"></i> Kelola</a>
                        <a href="<?= base_url('mriwayat'); ?>" class="btn btn-primary mb-3"><i
                                class="fas fa-fw fa-sync-alt"></i></a>
                    </div>
                    <div class="col">
                        <form action="<?= base_url('mriwayat'); ?>" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search..." name="keyword">
                                <button class="btn btn-outline-primary" type="submit" id="search">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- table striped -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Transaksi</th>
                                <th>Username</th>
                                <th>Nama Barang</th>
                                <th>Berat</th>
                                <th>Harga</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                            <?php foreach ($dataRiwayat as $d) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $d['id_transaksi']; ?></td>
                                <td><?= $d['username']; ?></td>
                                <td><?= $d['nama_barang']; ?></td>
                                <td><?= $d['berat']; ?></td>
                                <td>Rp.<?= number_format($d['harga']); ?></td>
                                <td><?= $d['created_at']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?= $pager->links('mriwayat', 'bank_pagination'); ?>
        </div>

    </section>
</div>

<?php $this->endSection(); ?>