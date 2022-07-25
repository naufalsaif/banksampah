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
                    <div class="col-lg-5 col-md-8">
                        <form action="<?= base_url('riwayat'); ?>" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="masukkan id transaksi"
                                    name="keyword">
                                <button class="btn btn-outline-primary" type="submit" id="search">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <a href="<?= base_url('riwayat'); ?>" class="btn btn-primary mb-3"><i
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
                                <th>Id Transaksi</th>
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
                                <td><?= $d['username']; ?></td>
                                <td><?= $d['id_transaksi']; ?></td>
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
            <?= $pager->links('riwayat', 'bank_pagination'); ?>
        </div>

    </section>
</div>

<?php $this->endSection(); ?>