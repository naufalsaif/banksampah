<?php
$this->extend('template/index');
$this->section('content');
?>

<div class="page-content">
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="<?= base_url(); ?>/assets/images/faces/<?= $dataUser['image']; ?>"
                                    alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold"><?= $dataUser['nama_lengkap']; ?></h5>
                                <h6 class="text-muted mb-0">@<?= $dataUser['username']; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mutasi Rekening</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <form action="<?= base_url('mutasi'); ?>" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" placeholder="masukkan id transaksi"
                                            name="keyword">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="search">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <a href="<?= base_url('mutasi'); ?>" class="btn btn-primary mb-3"><i
                                        class="fas fa-fw fa-sync-alt"></i></a>
                            </div>
                        </div>
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-dark">#</th>
                                        <th class="text-dark">Created At</th>
                                        <th class="text-dark">Id Transaksi</th>
                                        <th class="text-dark">Keterangan</th>
                                        <th class="text-dark">Debit</th>
                                        <th class="text-dark">Kredit</th>
                                        <th class="text-dark">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                    <?php foreach ($dataTransaksi as $d) : ?>
                                    <tr>
                                        <td class="text-dark"><?= $i++; ?></td>
                                        <td class="text-dark"><?= $d['created_at']; ?></td>
                                        <td class="text-dark"><?= $d['id_transaksi']; ?></td>
                                        <?php if ($d['tipe'] == 'setoran') : ?>
                                        <td class="text-dark">Transaksi setoran <?= $d['id_transaksi']; ?> berhasil</td>
                                        <?php elseif ($d['tipe'] == 'pembayaran') : ?>
                                        <td class="text-dark">Pencairan uang <?= $d['id_transaksi']; ?> berhasil</td>
                                        <?php endif; ?>
                                        <?php if ($d['tipe'] == 'setoran') : ?>
                                        <td class="text-success"></td>
                                        <?php elseif ($d['tipe'] == 'pembayaran') : ?>
                                        <td class="text-danger">Rp.-<?= number_format($d['total']); ?></td>
                                        <?php endif; ?>

                                        <?php if ($d['tipe'] == 'setoran') : ?>
                                        <td class="text-success">Rp.+<?= number_format($d['total']); ?></td>
                                        <?php elseif ($d['tipe'] == 'pembayaran') : ?>
                                        <td class="text-danger"></td>
                                        <?php endif; ?>

                                        <td class="text-dark">Rp.<?= number_format($d['saldo_terakhir']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <?= $pager->links('saldo', 'bank_pagination'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->endSection(); ?>