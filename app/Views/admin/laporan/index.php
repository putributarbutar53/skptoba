<?= $this->extend('admin/layout/main'); ?>

<?= $this->section('content'); ?>
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>/assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h5 class="mb-0">Laporan Pengaduan Layanan di Lingkungan Pemerintah Kabupaten Toba</h5>
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
                <table id="news_table" width="100%" class="table mb-0 table-striped table-dashboard data-table border-bottom border-200">
                    <thead class="bg-200">
                        <tr>
                            <th>Pengaduan</th>
                            <th>Tujuan Pengaduan</th>
                            <th>Tanggal Pengaduan</th>
                            <th><b>Aksi</b></th>
                            <th data-orderable="false"><b>Status Tindak Lanjut</b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?php $this->section('script') ?>
<script>
    function dataindex() {
        $('#news_table').DataTable({
            'processing': true,
            'serverSide': true,
            'scrollX': true,
            'serverMethod': 'post',
            'searchDelay': '350',
            'responsive': false,
            'lengthChange': true,
            'autoWidth': true,
            'sWrapper': 'falcon-data-table-wrapper',

            'ajax': {
                'url': '<?= site_url('admin2045/laporan/loaddata') ?>',
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            'columns': [{
                    data: 'title',
                    render: function(data, type, row) {
                        return '<a href="#" onclick="detaildata(' + row.id + ')">' + data + '</a>';
                    }
                },
                {
                    data: 'skpd_name',
                }, {
                    data: 'created_at',
                    render: function(data, type, row) {
                        var date = new Date(data);
                        var formattedDate = ('0' + date.getDate()).slice(-2) + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + date.getFullYear();
                        return formattedDate;
                    }
                },
                {
                    data: 'navButton',
                    render: function(data, type, row) {
                        return '<button onclick="tanggapi(' + row.id + ')" class="btn btn-sm btn-falcon-warning mb-1" title="Tanggapi Pengaduan"><i class="fas fa-reply"></i> Tindak Lanjuti</button>&nbsp;<button onclick="lihattanggapan(' + row.id + ')" class="btn btn-sm btn-falcon-danger mb-1" title="Lihat Tanggapan"><i class="fas fa-eye"></i> Lihat Tindak Lanjut</button>';
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        var checked = data == 1 ? 'checked' : '';
                        var disabled = data == 1 ? 'disabled' : '';
                        return '<div class="form-group form-check">' +
                            '<input class="form-check-input" id="customSwitch' + row.id + '" type="checkbox" ' + checked + ' ' + disabled + '>' +
                            '<label class="form-check-label" for="customSwitch' + row.id + '">Sudah ditindaklanjuti</label>' +
                            '</div>';
                    }
                }
            ],
            // 'dom':'Bfrtip',
            // 'buttons':[
            //   'copy','csv','excel','pdf','print'
            // ],	
            'order': [
                [0, 'asc']
            ],
            'language': {
                'emptyTable': 'Belum ada data'
            },
            'destroy': true,
        });
    }
    $(document).ready(function() {
        // Tangani perubahan status checkbox
        $('#costumSwitch').on('change', function() {
            // Periksa apakah checkbox dicentang atau tidak
            var isChecked = $(this).prop('checked');

            // Lakukan sesuatu berdasarkan status checkbox
            if (isChecked) {
                // Checkbox dicentang, lakukan tindakan yang diperlukan
                console.log('Checkbox dicentang');
            } else {
                // Checkbox tidak dicentang, lakukan tindakan yang diperlukan
                console.log('Checkbox tidak dicentang');
            }
        });
    });


    $(document).ready(function() {
        $('#table_index').DataTable().columns.adjust();
        setTimeout(function() {
            dataindex();
        }, 100);
    });

    function deletedata(iddata) {
        $('#alert_modal').modal('show');
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/news/delete') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide');
                    // Tanggapan sukses
                    showToast('success', response.message);
                    // Refresh tabel setelah penghapusan data
                    dataindex();
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    function tanggapi(iddata) {
        $.get("<?= site_url('admin2045/laporan/tanggapi') ?>/" + iddata, function(data, status) {
            $("#editor_add_xl").html(data);
            $('#add-xl').modal('toggle');
        });
    }

    // function lihattanggapan(iddata) {
    //     $.get("<?= site_url('admin2045/tindak/lihattanggapan') ?>/" + iddata, function(data, status) {
    //         $("#editor_add_xl").html(data);
    //         $('#add-xl').modal('toggle');
    //     });
    // }

    function lihattanggapan(iddata) {
        if (iddata) {
            $.get("<?= site_url('admin2045/tindak/lihattanggapan') ?>/" + iddata, function(data, status) {
                $("#editor_add_xl").html(data);
                $('#add-xl').modal('toggle');
            });
        } else {
            var htmlContent = '<div class="alert alert-warning" role="alert">' +
                '<i class="fas fa-times mr-1"></i> Pengaduan Belum Ditindak Lanjuti' +
                '</div>';
            $("#editor_add_xl").html(htmlContent);
            $('#add-xl').modal('toggle');
        }
    }


    function adddata() {
        $('#editor_add_xl').load('<?= site_url('admin2011/news/tambah') ?>', function() {
            $('#add-xl').modal({
                show: true
            });
        });
    }

    function detaildata(iddata) {
        $.get("<?= site_url('admin2045/laporan/detail') ?>/" + iddata, function(data, status) {
            $("#detail_data").html(data);
            $('#detail').modal('toggle');
        });
    }
</script>
<?php $this->endsection() ?>