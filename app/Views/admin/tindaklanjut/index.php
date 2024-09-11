<?= $this->extend('admin/layout/main'); ?>

<?= $this->section('content'); ?>
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>/assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h5 class="mb-0">Tindak lanjut SKPD terhadap pengaduan masyarakat</h5>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <!-- <div class="card-header">
        <div class="row flex-between-center">
            <div class="col">
                <button class="btn btn-primary" onclick="adddata()"><i class="fas fa-plus-square"></i></button>
            </div>
        </div>
    </div> -->
    <div class="card-body bg-light">
        <div class="row list">
            <div class="col">
                <table id="tindak-table" width="100%" class="table mb-0 table-striped table-dashboard data-table border-bottom border-200">
                    <thead class="bg-200">
                        <tr>
                            <th>No</th>
                            <th>Pengaduan</th>
                            <th>Tujuan</th>
                            <th>Tindak Lanjut</th>
                            <th>Tgl Tindak Lanjut</th>
                            <th>Gambar</th>
                            <!-- <th>Status</th> -->
                            <th data-orderable="false">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($row)) : ?>
                            <?php
                            $i = 1;
                            foreach ($row as $rows) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td style="white-space: normal; word-wrap: break-word; text-align: justify;"><button onclick="detaildata(<?= $rows['lapor_id']; ?>)" class="btn btn-sm btn-falcon-primary mb-1 btn-detail"><i class="fas fa-eye"></i> <?= strlen($rows['title']) > 25 ? substr($rows['title'], 0, 25) . '...' : $rows['title'] ?></button></td>
                                    <td style="white-space: normal; word-wrap: break-word;"><?= $rows['skpd_name']; ?></td>
                                    <td><button onclick="lihattanggapan(<?= $rows['lapor_id'] ?>)" class="btn btn-sm btn-falcon-danger mb-1 btn-detail"><i class="fas fa-folder-open"></i> Lihat Tanggapan</button></td>
                                    <td><?= date('d F Y', strtotime($rows['tgl_tindak'])); ?></td>
                                    <td>
                                        <?php if (!empty($rows['tindak_picture'])) : ?>
                                            <a href="<?= base_url() . getenv('dir.upload.tindak') . $rows['tindak_picture']; ?>" data-fancybox data-caption="<?= $rows['title']; ?>">
                                                <img src="<?= base_url() . getenv('dir.upload.tindak') . $rows['tindak_picture']; ?>" class="rounded" width="80" alt="<?= $rows['title']; ?>">
                                            </a>
                                        <?php else : ?>
                                            ----
                                        <?php endif; ?>
                                    </td>
                                    <!-- <td>
                                        <?php if ($rows['status'] == 1) : ?>
                                            <div class="form-group form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck<?= $i; ?>" checked disabled>
                                                <label class="form-check-label" for="defaultCheck<?= $i; ?>">Telah Ditindak Lanjuti</label>
                                            </div>
                                        <?php else : ?>
                                            <div class="form-group form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck<?= $i; ?>" disabled>
                                                <label class="form-check-label" for="defaultCheck<?= $i; ?>">Belum Ditindak Lanjuti</label>
                                            </div>
                                        <?php endif; ?>
                                    </td> -->
                                    <td>
                                        <button onclick="deletedata(<?php echo $rows['tindak_id']; ?>)" class="btn btn-sm btn-falcon-danger mb-1" title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">Tidak ada data yang tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?php $this->section('script') ?>
<script>
    function dataindex() {
        $('#tindak-table').DataTable({
            'processing': true,
            'serverSide': false,
            'scrollX': true,
            'searchDelay': 350,
            'responsive': false,
            'lengthChange': true,
            'autoWidth': true,
            'language': {
                'emptyTable': 'Belum ada data'
            },
            'destroy': true
        });
    }

    // $(document).ready(function() {
    //     $('#tindak-table').DataTable().columns.adjust();
    //     setTimeout(function() {}, 100);
    // });

    $(document).ready(function() {
        $('#tindak-table').DataTable().columns.adjust();
        setTimeout(function() {
            dataindex();
        }, 100);
    });

    function detaildata(iddata) {
        $.get("<?= site_url('admin2045/laporan/detail') ?>/" + iddata, function(data, status) {
            $("#detail_data").html(data);
            $('#detail').modal('toggle');
        });
    }

    function lihattanggapan(iddata) {
        $.get("<?= site_url('admin2045/tindak/lihattindak') ?>/" + iddata, function(data, status) {
            $("#editor_add_xl").html(data);
            $('#add-xl').modal('toggle');
        });
    }

    function deletedata(iddata) {
        $('#alert_modal').modal('show');
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2045/tindak/deletetindak') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide');
                    // Tanggapan sukses
                    showToast('success', response.message);
                    // Merefresh halaman setelah penghapusan data
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }
</script>
<?php $this->endSection() ?>