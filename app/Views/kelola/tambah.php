<?php
$this->extend('template/index');
?>

<?php $this->section('content');
?>

<div class="page-content">
    <!-- untuk kembali ke barang -->
    <?php $jumlah_breadCrumb = count($breadCrumb) - 2; ?>
    <?php for ($i = 0; $i <= $jumlah_breadCrumb; $i++) : ?>
    <?php if ($i == $jumlah_breadCrumb) : ?>
    <a href="<?= base_url("$breadCrumb[$i]"); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i></a>
    <?php endif; ?>
    <?php endfor; ?>
    <!-- end -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Kelola</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" id="username" class="form-control" name="username"
                                                value="<?= $dataUser['username']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="barang">Barang</label>
                                            <select class="form-select" id="barang" name="barang">
                                                <option disabled selected value="">--- Pilih Barang ---</option>
                                                <?php foreach ($dataBarang as $d) : ?>
                                                <option id="keybarang<?= $d['id_barang']; ?>"
                                                    value="<?= $d['id_barang']; ?>"
                                                    data-namabarang="<?= $d['nama_barang']; ?>"
                                                    data-harga="<?= $d['harga']; ?>"><?= $d['id_barang']; ?> -
                                                    <?= $d['nama_barang']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback invalid_barang" id="invalid_barang">
                                                <i class="bx bx-radio-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="id_barang">Berat Barang(kg)</label>
                                            <input type="number" id="berat" class="form-control" name="berat"
                                                placeholder="cth: 0.2 / 1">
                                            <div class="invalid-feedback invalid_berat" id="invalid_berat">
                                                <i class="bx bx-radio-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <input type="hidden" name="row_id" id="hidden_row_id" />
                                        <button type="submit" class="btn btn-primary me-1 mb-1" name="save"
                                            id="save">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <!-- table striped -->
                        <form action="<?= base_url('kelola/simpan/' . $dataUser['id_user']); ?>" method="post"
                            id="user_form">
                            <?= csrf_field(); ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Berat Barang</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user_data">
                                    </tbody>
                                </table>
                            </div>
                            <h5 id="tampiltotal" class="my-3 float-md-end">Total 0</h5>
                            <input type="hidden" class="form-control" id="id_user" name="id_user"
                                value="<?= $dataUser['id_user']; ?>">
                            <input type="hidden" class="form-control" id="total" name="total" value="0">
                            <input type="submit" name="simpan" id="simpan" class="btn btn-primary my-2"
                                value="Simpan" />
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>

<?php $this->endSection(); ?>

<?php $this->section('javascript'); ?>
<script src="<?= base_url(); ?>/assets/vendors/library/dselect.js"></script>
<script>
let select_box_element = document.querySelector('#barang');

dselect(select_box_element, {
    search: true
});

$(document).ready(function() {

    let count = 0;
    let total = 0;
    $('#save').click(function() {
        let invalid_barang = '';
        let invalid_berat = '';
        let barang = '';
        let berat = '';
        let harga = '';
        if ($('#barang').val() == null) {
            invalid_barang = 'Barang harus diisi!';
            $('#invalid_barang').text(invalid_barang);
            $('#barang').addClass('is-invalid');
            barang = '';
        } else {
            invalid_barang = '';
            $('#invalid_barang').text(invalid_barang);
            $('#barang').removeClass('is-invalid');
            barang = $('#barang').val();
        }
        if ($('#berat').val() == '') {
            invalid_berat = 'Berat harus diisi!';
            $('#invalid_berat').text(invalid_berat);
            $('#berat').addClass('is-invalid');
            berat = '';
        } else {
            invalid_berat = '';
            $('#invalid_berat').text(invalid_berat);
            $('#berat').removeClass('is-invalid');
            berat = parseFloat($('#berat').val());
        }
        if (invalid_barang != '' || invalid_berat != '') {
            return false;
        } else {
            if ($('#save').text() == 'Submit') {
                const nama_barang = $('#keybarang' + barang).data('namabarang');
                const harga = $('#keybarang' + barang).data('harga');
                let jumlah = harga * berat;
                count = count + 1;
                output = '<tr id="row_' + count + '">';
                output += '<td>' + barang + '-' + nama_barang +
                    ' <input type="hidden" name="hidden_id_barang[]" id="id_barang' + count +
                    '" class="barang" value="' + barang + '" /></td>';
                output += '<td>' + berat + ' kg' +
                    ' <input type="hidden" name="hidden_berat[]" id="berat' + count + '" value="' +
                    berat + '" /></td>';
                output += '<td>' + harga + '</td>';
                output += '<td>' + jumlah + ' <input type="hidden" name="hidden_harga[]" id="harga' +
                    count + '" value="' + jumlah + '" /></td>';
                output +=
                    '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' +
                    count + '"><i class="fa-solid fa-pen-to-square"></i></button></td>';
                output +=
                    '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' +
                    count + '"><i class="fa-solid fa-trash"></i></button></td>';
                output += '</tr>';
                $('#user_data').append(output);
                total += jumlah;
                let tampiltotal = 'Total ' + total;
                $('#tampiltotal').text(tampiltotal);
                $('#total').val(total);
            } else {
                const nama_barang = $('#keybarang' + barang).data('namabarang');
                const harga = $('#keybarang' + barang).data('harga');
                let row_id = $('#hidden_row_id').val();
                let jumlahBaru = harga * berat;
                let jumlahLama = $('#harga' + row_id).val();
                let jumlah = jumlahBaru - jumlahLama;
                output = '<td>' + barang + '-' + nama_barang +
                    ' <input type="hidden" name="hidden_id_barang[]" id="id_barang' + row_id +
                    '" class="barang" value="' + barang + '" /></td>';
                output += '<td>' + berat + ' kg' +
                    ' <input type="hidden" name="hidden_berat[]" id="berat' + row_id + '" value="' +
                    berat + '" /></td>';
                output += '<td>' + harga + ' </td>';
                output += '<td>' + jumlahBaru +
                    ' <input type="hidden" name="hidden_harga[]" id="harga' + row_id + '" value="' +
                    jumlahBaru + '" /></td>';
                output +=
                    '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' +
                    row_id + '"><i class="fa-solid fa-pen-to-square"></i></button></td>';
                output +=
                    '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' +
                    row_id + '"><i class="fa-solid fa-trash"></i></button></td>';
                $('#row_' + row_id + '').html(output);
                console.log(jumlah);
                total = total + jumlah;
                let tampiltotal = 'Total ' + total;
                $('#tampiltotal').text(tampiltotal);
                $('#total').val(total);
            }

            $('#barang').val('');
            $('#berat').val('');
            $('#barang').removeClass('is-invalid');
            $('#berat').removeClass('is-invalid');
            $('#invalid_barang').text('');
            $('#invalid_berat').text('');
            $('#save').text('Submit');

        }
    });

    $(document).on('click', '.view_details', function() {
        let row_id = $(this).attr("id");
        let barang = $('#id_barang' + row_id + '').val();
        let berat = $('#berat' + row_id + '').val();
        $('#barang').val(barang);
        $('#berat').val(berat);
        $('#save').text('Edit');
        $('#hidden_row_id').val(row_id);
    });

    $(document).on('click', '.remove_details', function() {
        let row_id = $(this).attr("id");
        let harga = $('#harga' + row_id).val();

        const sweetalert_hapus = $('.tombol-hapus').data('sweetalert-hapus');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-warning',
                cancelButton: 'btn btn-primary me-3'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            text: 'Apakah anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // document.location.href = href;
                total = total - harga;
                let tampiltotal = 'Total ' + total;
                $('#tampiltotal').text(tampiltotal);
                $('#total').val(total);

                $('#row_' + row_id + '').remove();

                Swal.fire({
                    // title: 'Selamat!',
                    text: 'Berhasil menghapus data!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
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
        // if (confirm("Are you sure you want to remove this row data?")) {
        //     total = total - harga;
        //     let tampiltotal = 'Total ' + total;
        //     $('#tampiltotal').text(tampiltotal);
        //     $('#total').val(total);

        //     $('#row_' + row_id + '').remove();

        // } else {
        //     return false;
        // }
    });
});

// // sweetalert
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

// //  tombol hapus
// const sweetalert_hapus = $('.tombol-hapus').data('sweetalert-hapus');
// $('.tombol-hapus').on('click', function(e) {
//     e.preventDefault();
//     const href = $(this).attr('href');

//     const swalWithBootstrapButtons = Swal.mixin({
//         customClass: {
//             confirmButton: 'btn btn-warning',
//             cancelButton: 'btn btn-primary me-3'
//         },
//         buttonsStyling: false
//     })

//     swalWithBootstrapButtons.fire({
//         text: sweetalert_hapus,
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Ya, hapus',
//         cancelButtonText: 'Batalkan',
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.location.href = href;
//         } else if (
//             /* Read more about handling dismissals below */
//             result.dismiss === Swal.DismissReason.cancel
//         ) {
//             swalWithBootstrapButtons.fire(
//                 '',
//                 'Dibatalkan',
//                 'error'
//             )
//         }
//     })

// });

// //  tombol setujui
// const sweetalert_setujui = $('.tombol-setujui').data('sweetalert-setujui');
// $('.tombol-setujui').on('click', function(e) {
//     e.preventDefault();
//     const href = $(this).attr('href');

//     const swalWithBootstrapButtons = Swal.mixin({
//         customClass: {
//             confirmButton: 'btn btn-success',
//             cancelButton: 'btn btn-primary me-3'
//         },
//         buttonsStyling: false
//     })

//     swalWithBootstrapButtons.fire({
//         text: sweetalert_setujui,
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Ya, Setuju',
//         cancelButtonText: 'Batalkan',
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.location.href = href;
//         } else if (
//             /* Read more about handling dismissals below */
//             result.dismiss === Swal.DismissReason.cancel
//         ) {
//             swalWithBootstrapButtons.fire(
//                 '',
//                 'Dibatalkan',
//                 'error'
//             )
//         }
//     })

// });
</script>
<?php $this->endSection(); ?>