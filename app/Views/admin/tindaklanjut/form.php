<div class="modal-header">
    <h5 class="modal-title">
        <?= $title ?>
    </h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_submit">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <input type="hidden" name="id" value="id" />
        <input type="hidden" name="id_lapor" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" class="form form-control form-50" size="40" />
        Tindak Lanjut:<br />
        <input type="text" name="solution" class="form form-control form-50" size="40" /> <br>

        Lampiran:
        <div class="custom-file">
            <input class="custom-file-input" id="customFile" name="picture" type="file">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <div class="col-12">
            <div class="col">
                <a id="link_image" data-fancybox data-caption="Image caption">
                    <img class="rounded w-100" src="<?php echo base_url() . "assets/img/illustrations/bg-card-shape.jpg" ?>" alt="" id="picture" style="height:200px; object-fit:cover;">
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="custom-control custom-switch">
                <input class="custom-control-input" id="status" type="checkbox">
                <label class="custom-control-label" for="status">Tandai Sudah Ditindak Lanjuti</label>
            </div>
        </div>
        <span id="report"></span>

        <input type="submit" name="submit" value="<?= $tombol ?>" class="btn btn-primary mt-3" />
    </form>
</div>
<script>
    utils.$document.ready(function() {
        $('.custom-file-input').on('change', function(e) {
            var $this = $(e.currentTarget);
            var fileName = $this.val().split('\\').pop();
            $this.next('.custom-file-label').addClass('selected').html(fileName);
        });
    });
    $(document).ready(function() {

        $('#customFile').on('change', function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#link_image').attr('href', e.target.result);
                    $('#picture').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        })
        $('#add_submit').submit(function(e) {
            e.preventDefault();
            tinyMCE.triggerSave();
            var form = $(this)[0];
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: "<?= site_url('admin2045/tindak/submitdata') ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Bersihkan form input setelah submit
                    $('#add_submit input[type="text"]').val('');
                    $('#add_submit textarea').val('');
                    $('#add-xl').modal('hide');

                    // Tampilkan pesan sukses
                    showToast("success", response.message);

                    // Lakukan refresh halaman
                    location.reload(); // Ini akan menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    var response = xhr.responseJSON;
                    showToastError('Error', response);
                }
            });
        });


    });
    $('#add').on('hidden.bs.modal', function() {
        dataindex();
        $('#report_edit').html('');
    });
</script>