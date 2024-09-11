 <div class="modal-header">
     <h5 class="modal-title"><?= $title ?></h5>
     <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
 </div>
 <div class="modal-body text-left">
     <form id="add_submit">
         <input type="hidden" name="action" value="<?= $action ?>" />
         <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
         Name:<br />
         <input type="text" name="name" value="<?php if (isset($detail['name'])) echo $detail['name']; ?>" class="form form-control form-50" size="40" /> <br>

         <span id="report"></span>

         <input type="submit" name="submit" value="<?= $tombol ?>" class="btn btn-primary mt-3" />
     </form>
 </div>
 <script>
     utils.$document.ready(function() {
         var datetimepicker = $('.datetimepicker');
         datetimepicker.length && datetimepicker.each(function(index, value) {
             var $this = $(value);
             var options = $.extend({
                 dateFormat: 'd/m/y',
                 disableMobile: true
             }, $this.data('options'));
             $this.flatpickr(options);
         });
     });

     utils.$document.ready(function() {
         var select2 = $('.selectpicker');
         select2.length && select2.each(function(index, value) {
             var $this = $(value);
             var options = $.extend({
                 link: 'bootstrap4'
             }, $this.data('options'));
             $this.select2(options);
         });
     });
     utils.$document.ready(function() {
         $('.custom-file-input').on('change', function(e) {
             var $this = $(e.currentTarget);
             var fileName = $this.val().split('\\').pop();
             $this.next('.custom-file-label').addClass('selected').html(fileName);
         });
     });
     $('#customFile1').on('change', function() {
         var input = this;
         if (input.files && input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
                 $('#link_icon').attr('href', e.target.result);
                 $('#icon').attr('src', e.target.result);
             }
             reader.readAsDataURL(input.files[0]);
         }
     })
     $(document).ready(function() {
         $('#add_submit').submit(function(e) {
             e.preventDefault(); // Mencegah perilaku default formulir

             var form = $(this)[0]; // Mendapatkan elemen formulir HTML mentah
             var formData = new FormData(form); // Membuat objek FormData baru

             // Mengirim permintaan AJAX
             $.ajax({
                 type: 'POST',
                 url: "<?= site_url('admin2045/pendidikan/submitdata') ?>",
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data: formData, // Menggunakan objek FormData sebagai data
                 processData: false, // Mencegah jQuery memproses data
                 contentType: false, // Mencegah jQuery menetapkan tipe konten
                 success: function(response) {
                     // Menutup modal setelah permintaan berhasil
                     $('#add').modal('hide');
                     $('#add_submit input[type="text"]').val('');
                     $('#add_submit textarea').val('');
                     dataindex();
                     showToast("success", response.message);
                 },
                 error: function(xhr, status, error) {
                     // Menutup modal setelah permintaan gagal
                     $('#add').modal('hide');
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