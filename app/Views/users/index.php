<?php
$this->extend('template/index');
$this->section('content');
?>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                List Users
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <a href="<?= base_url('users/tambah'); ?>" class="btn btn-outline-primary mb-3"><i class="fa-solid fa-plus"></i> Users</a>
                        <a href="<?= base_url('users'); ?>" class="btn btn-primary mb-3"><i class="fas fa-fw fa-sync-alt"></i></a>
                    </div>
                    <div class="col">
                        <form action="<?= base_url('users'); ?>" method="post">
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
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Blok</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th>Level</th>
                                <th>Edit</th>
                                <!-- <th>Delete</th> -->
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
                                    <td><?= $d['created_at']; ?></td>
                                    <td><?= $d['updated_at']; ?></td>
                                    <td>
                                        <?php if ($d['aktif'] > 0) : ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else : ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $d['level']; ?></td>
                                    <td><a href="<?= base_url('users/ubah/' . $d['id_user']); ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                    <!-- <td><a href="" class="btn btn-danger tombol-hapus" data-sweetalert-hapus="Apakah anda yakin?"><i class="fa-solid fa-trash"></i></a></td> -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?= $pager->links('users', 'bank_pagination'); ?>
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