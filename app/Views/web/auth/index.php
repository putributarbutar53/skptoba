  <!-- home.php -->
  <?php $this->extend('web/auth/layout/main') ?>

  <?php $this->section('content') ?>

  <section class="masthead -type-1 js-mouse-move-container">
      <div class="masthead__bg">
          <img src="img/home-1/hero/bg.png" alt="image">
      </div>

      <svg class="svg-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
              <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="svg-waves__parallax">
              <use xlink:href="#gentle-wave" x="48" y="0" />
              <use xlink:href="#gentle-wave" x="48" y="3" />
              <use xlink:href="#gentle-wave" x="48" y="5" />
              <use xlink:href="#gentle-wave" x="48" y="7" />
          </g>
      </svg>
  </section>
  <section class="layout-pt-md layout-pb-lg">
      <div data-anim-wrap class="container">
          <div class="row y-gap-50 justify-between">
              <div class="col-lg-8 offset-lg-2">
                  <div class="px-40 py-40 bg-white border-light shadow-1 rounded-8 contact-form-to-top">

                      <div id="greeting" class="text-28 text-center" style="font-weight: bold;">

                      </div>
                      <h3 class="text-24 text-center" style="font-weight: bold;">Sampaikan Pengaduan Anda</h3>
                      <p class="mt-25 text-center">Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang</p>
                      <form id="laporan_submit" class="contact-form row y-gap-30 pt-60 lg:pt-40">
                          <input type="hidden" name="action" value="<?= $action ?>" />
                          <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
                          <input type="hidden" name="id_users" value="<?= user()->id ?>" />

                          <div class="col-12">
                              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Nama</label>
                              <input type="text" name="name" placeholder="Nama" autofocus>
                          </div>
                          <div class="col-12">
                              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Alamat</label>
                              <input type="text" name="address" placeholder="Alamat" required>
                          </div>
                          <div class="col-12">
                              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">No Whatsapp</label>
                              <div class="row" style="margin-bottom: -19px;">
                                  <div class="col-md-2">
                                      <input type="text" name="country_code" value="+62" class="form-control" disabled>
                                  </div>
                                  <div class="col-md-10">
                                      <input type="text" name="no_hpe" placeholder="88212345678" class="form-control" required>
                                  </div>
                              </div>
                              <small>tindak lanjut akan diinformasikan melalui nomor whatsapp. pastikan memasukkan nomor whatsapp yang aktif</small>
                          </div>
                          <div class="col-12">
                              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Tujuan Instansi</label>
                              <select name="id_skpd" id="id_skpd" value="<?php if (isset($detail['id_skpd'])) echo $detail['id_skpd']; ?>" class="form-control form-50">
                                  <option value="i">pilih SKPD</option>
                                  <?php foreach ($skpd as $skpds) : ?>
                                      <option value="<?= $skpds['id'] ?>">
                                          <?= $skpds['name'] ?>
                                      </option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="col-12" style="margin-top: -30px;">
                              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Judul Laporan</label>
                              <input type="text" name="title" placeholder="Ketik Judul Laporan Anda" required>
                          </div>
                          <div class="col-12">
                              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Laporan</label>
                              <textarea name="report" placeholder="Ketik Isi Laporan Anda" rows="8"></textarea>
                          </div>
                          <div class="col-12">
                              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Lampiran</label>
                              <input class="form-control" name="picture" type="file" id="customFile" multiple>
                          </div>
                          <div class="col-12">
                              <div class="col">
                                  <a id="link_image" href="<?php if (isset($detail['picture'])) echo base_url() . getenv('dir.uploads.report') . $detail['picture'];
                                                            else echo "#" ?>" data-fancybox data-caption="Image caption">
                                      <img class="rounded w-100" src="<?php if (isset($detail['picture'])) echo base_url() . getenv('dir.uploads.report') . $detail['picture'];
                                                                        else echo base_url() . "" ?>" alt="" id="picture" style="height:200px; object-fit:cover;">
                                  </a>
                              </div>
                          </div>
                          <div class="col-12">
                              <button type="submit" name="submit" value="send Feedback" id="submit" class="button -md -dark-2 text-white">
                                  Send Message
                              </button>
                          </div>
                      </form>
                  </div>
              </div>

          </div>
      </div>
  </section>
  <section class="layout-pt-lg layout-pb-lg" style="margin-top: -150px;">
      <div data-anim-wrap class="container">
          <div class="row justify-center text-center">
              <div class="col-auto">

                  <div class="sectionTitle ">

                      <h2 class="sectionTitle__title ">Jumlah Pengaduan dan Tindak Lanjut</h2>

                      <p class="sectionTitle__text ">Data di bawah merupakan jumlah pengaduan yang telah dibuat oleh masyarakat dan jumlah data pengaduan yang telah ditindak lanjuti oleh SKPD terkait.</p>

                  </div>

              </div>
          </div>

          <div class="row y-gap-30 justify-between pt-60 lg:pt-50">

              <div class="col-lg-6 col-md-6">
                  <div class="coursesCard -type-2 text-center pt-50 pb-40 px-30 bg-white rounded-8">
                      <div class="coursesCard__image">
                          <img src="<?= base_url() ?>/lapor/img/home-5/learning/complaint.png" style="width: 80px; height: 80px;" alt="image">
                      </div>
                      <div class="coursesCard__content mt-30">
                          <h5 class="coursesCard__title text-18 lh-1 fw-500">Jumlah Pengaduan</h5><br>
                          <h2 class="sectionTitle__title "><?= $jumlah_lapor ?></h2>
                      </div>
                  </div>
              </div>

              <div class="col-lg-6 col-md-6">
                  <div class="coursesCard -type-2 text-center pt-50 pb-40 px-30 bg-white rounded-8">
                      <div class="coursesCard__image">
                          <img src="<?= base_url() ?>/lapor/img/home-5/learning/checklist.png" style="width: 80px; height: 80px;" alt="image">
                      </div>
                      <div class="coursesCard__content mt-30">
                          <h5 class="coursesCard__title text-18 lh-1 fw-500">Jumlah Pengaduan yang Telah Ditindak Lanjuti</h5><br>
                          <h2 class="sectionTitle__title "><?= $jumlah_tindak_lanjut ?></h2>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </section>

  <!-- tempat yang di cut -->

  <?php $this->endsection() ?>

  <?php $this->section('script') ?>

  <script>
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
          $('#laporan_submit').submit(function(e) {
              e.preventDefault();
              var form = $(this)[0];
              var formData = new FormData(form);

              $.ajax({
                  type: "post",
                  url: "<?= site_url('home/submitreport') ?>",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                      $('#laporan_submit')[0].reset();
                      $('#link_image').attr('href', '#'); // Set link href to #
                      $('#picture').attr('src', '<?php echo base_url() . "assets/img/illustrations/bg-card-shape.jpg" ?>'); // Reset image src to default
                      Swal.fire({
                          icon: 'success',
                          title: 'Terimakasih!',
                          text: 'Laporan Anda segera diproses'
                      });
                  },
                  error: function(xhr, status, error) {
                      console.error(xhr.responseText);
                      Swal.fire({
                          icon: 'error',
                          title: 'Error!',
                          text: 'Terjadi kesalahan saat menyimpan data'
                      });
                  }
              });
          });
      });
      // Fungsi untuk menampilkan ucapan sesuai dengan waktu
      function showGreeting() {
          var now = new Date();
          var hour = now.getHours();

          if (hour < 12) {
              document.getElementById('greeting').innerText = 'Halo <?= user()->username ?>.. Selamat pagi!';
          } else if (hour < 18) {
              document.getElementById('greeting').innerText = 'Halo <?= user()->username ?>.. Selamat siang!';
          } else {
              document.getElementById('greeting').innerText = 'Halo <?= user()->username ?>.. Selamat malam!';
          }
      }

      // Memanggil fungsi showGreeting saat halaman dimuat
      showGreeting();
  </script>
  </script>
  <?php $this->endSection() ?>