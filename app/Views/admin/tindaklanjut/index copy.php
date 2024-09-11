<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>/assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">List Tindak Lanjut</h3>
            </div>
        </div>
    </div>
</div>


<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col">
                <button class="btn btn-danger" onclick="location.href=('#')"><i class="fas fa-file-pdf"></i> Export PDF</button>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <div class="row list">
            <div class="col">
                <table id="tableid" width="100%" class="">
                    <thead>
                        <tr>

                            <th rowspan="2">No</th>
                            <th rowspan="2">Judul Pengaduan</th>
                            <th rowspan="2">Tindak Lanjut</th>
                            <th rowspan="2">Tgl Tindak Lanjut</th>
                            <th rowspan="2">Gambar</th>
                            <th colspan="2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $i = 1;
                        foreach ($row as $tindak) :
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><a href="#" onclick="detaildata(<?= $tindak['lapor_id']; ?>)"><?= $tindak['title']; ?></a></td>
                                <td><?= $tindak['solution']; ?></td>
                                <td><?= date('d F Y', strtotime($tindak['tgl_tindak'])); ?></td>
                                <td>
                                    <?php if (!empty($tindak['tindak_picture'])) : ?>
                                        <a href="<?= base_url() . getenv('dir.upload.tindak') . $tindak['tindak_picture']; ?>" data-fancybox data-caption="<?= $tindak['title']; ?>">
                                            <img src="<?= base_url() . getenv('dir.upload.tindak') . $tindak['tindak_picture']; ?>" class="rounded" width="80" alt="<?= $tindak['title']; ?>">
                                        </a>
                                    <?php else : ?>
                                        ----
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ($tindak['status'] == 1) : ?>
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
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->endsection() ?>
<?php $this->section('script') ?>

<script>
    $(document).ready(function() {
        $('#tableid').DataTable().columns.adjust();
        setTimeout(function() {}, 100);
    });

    function detaildata(iddata) {
        $.get("<?= site_url('admin2045/laporan/detail') ?>/" + iddata, function(data, status) {
            $("#detail_data").html(data);
            $('#detail').modal('toggle');
        });
    }

    function lihattindak(iddata) {
        $.get("<?= site_url('admin2045/tindak/lihattanggapan') ?>/" + iddata, function(data, status) {
            $("#editor_add_xl").html(data);
            $('#add-xl').modal('toggle');
        });
    }
</script>
<?php $this->endsection() ?>