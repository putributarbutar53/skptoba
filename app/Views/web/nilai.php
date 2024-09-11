<!-- home.php -->
<!-- <?php $this->extend('web/layout/main') ?> -->

<?php $this->section('content') ?>


<!-- Indek Kepuasan Masyarakat (IKM) area start -->
<section class="tp-testimonial-3-area pt-115 pb-90">
  <div class="container">
    <div class="row">
      <div class="tp-section-title-wrapper mb-50 text-center wow fadeInUp">
        <span class="tp-section-subtitle tp-section-subtitle-3">Indek Kepuasan Masyarakat (IKM)</span>
        <h5 class="tp-section-title style-2">Nilai IKM<br> Pemerintah Kabupaten Toba</h5>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="tp-testimonial-3-wrapper tp-testimonial-3-wrapper-2 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
          <div class="tp-testimonial-3-box tp-testimonial-inner-box">
            <div class="tp-testimonial-3-member-top mb-20">
              <div class="tp-testimonial-3-member d-flex">
                <div class="tp-testimonial-3-img-content">
                  <h4>Rekapitulasi</h4>
                  <p>Survey Kepuasan Masyarakat (SKM) Kab. Toba</p>
                </div>
              </div>
              <div class="tp-testimonial-3-member-icon">
                <span><i class="fa-sharp fa-solid fa-quote-right"></i></span>
              </div>
            </div>
            <div class="tp-testimonial-3-content">
              <h5><i class="fas fa-users"></i> Responden Berdasarkan : </h5>
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="card-title">Jenis Kelamin</h6>
                      <canvas id="genderChart" style="max-height: 300px;"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="card-title">Pendidikan</h6>
                      <canvas id="educationChart" style="max-height: 300px;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Tabel -->
              <br>
              <h6 class="card-title">Tabel Indeks Kepuasan Masyarakat (IKM) Toba</h6>
              <br>
              <form method="get" action="" style="margin-top: -20px;">
                <label for="tahun" style="font-weight: bold; margin-right: 10px;">Pilih Tahun:</label>
                <select name="tahun" id="tahun" onchange="this.form.submit()" style="padding: 8px 12px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; outline: none; transition: border-color 0.3s;">
                  <?php for ($year = date('Y'); $year >= 2023; $year--) : ?>
                    <option value="<?= $year ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $year) ? 'selected' : '' ?>><?= $year ?></option>
                  <?php endfor; ?>
                </select>
              </form>
              <br>
              <div class="table-responsive">
                <table class="table" border="1" style="overflow-x: auto;">
                  <thead>
                    <tr>
                      <th rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">Bulan</th>
                      <th colspan="<?= count($pendidikan) ?>" style="text-align: center; vertical-align: middle; border: 1px solid black;">Pendidikan</th>
                      <th rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">Total</th>
                      <th colspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">Nilai</th>
                    </tr>
                    <tr>
                      <?php foreach ($pendidikan as $row) : ?>
                        <th style="text-align: center; vertical-align: middle; border: 1px solid black;"><?= $row['name'] ?></th>
                      <?php endforeach; ?>
                      <th style="text-align: center; vertical-align: middle; border: 1px solid black;">Indeks</th>
                      <th style="text-align: center; vertical-align: middle; border: 1px solid black;">Ket.</th>
                    </tr>
                  </thead>
                  <tbody id="table-body">
                    <?php foreach ($bulan as $bln) : ?>
                      <tr>
                        <td style="text-align: center; vertical-align: middle; border: 1px solid black;"><?= $bln ?></td>
                        <?php foreach ($pendidikan as $pend) : ?>
                          <td style="text-align: center; vertical-align: middle; border: 1px solid black;">
                            <?= isset($jumlahResponden[$bln][$pend['name']]) ? $jumlahResponden[$bln][$pend['name']] : 0 ?>
                          </td>
                        <?php endforeach; ?>
                        <td style="text-align: center; vertical-align: middle; border: 1px solid black;">
                          <?= isset($totalRespondenPerBulan[$bln]) ? $totalRespondenPerBulan[$bln] : 0 ?>
                        </td>
                        <td style="text-align: center; vertical-align: middle; border: 1px solid black;">
                          <?= isset($indeksKepuasanPerBulan[$bln]) && $indeksKepuasanPerBulan[$bln] > 0 ? number_format($indeksKepuasanPerBulan[$bln], 2) : '' ?>
                        </td>
                        <td style="text-align: center; vertical-align: middle; border: 1px solid black;">
                          <?= isset($keteranganPerBulan[$bln]) && $keteranganPerBulan[$bln] != 'Tidak Baik' ? $keteranganPerBulan[$bln] : '' ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="tp-chose-us-5-area pt-115 pb-130 p-relative" data-background="<?= base_url() ?>/lapor/img/chose-us/chose-us-5-bg.jpg">
  <div class="tp-chose-us-5-bg-shape">
    <img class="tp-chose-us-5-bg-shape1" src="<?= base_url() ?>/lapor/img/chose-us/chose-us-5-shape1.png" alt="">
    <img class="tp-chose-us-5-bg-shape2" src="<?= base_url() ?>/lapor/img/chose-us/chose-us-5-shape2.png" alt="">
    <img class="tp-chose-us-5-bg-shape3" src="<?= base_url() ?>/lapor/img/chose-us/chose-us-5-shape3.png" alt="">
  </div>
  <div class="container">
    <div class="row">
      <div class="tp-section-4-title-wrapper mb-100 wow fadeInUp">
        <span class="tp-section-4-subtitle">Bagaimana Pendapat Masyarakat Toba Terkait Pelayanan di Pemerintah Kabupaten Toba?</span>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
        <div class="tp-step-wrapper p-relative mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
          <div class="tp-step-icon-box d-flex align-items-center">
            <div class="tp-step-icon">
              <span><i class="fas fa-laugh-beam"></i></span>
            </div>
            <div class="tp-step-number">
              <span><?= $countOption4 ?></span>
            </div>
          </div>
          <div class="tp-step-content">
            <h4 class="tp-step-title"><a href="service-details.html">Sangat Puas</a></h4>
            <p class="tp-step-paragraph">Masyarakat merasa sangat puas dengan layanan yang diberikan.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
        <div class="tp-step-wrapper p-relative mb-30 wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
          <div class="tp-step-icon-box d-flex align-items-center">
            <div class="tp-step-icon">
              <span><i class="fas fa-smile-beam"></i></span>
            </div>
            <div class="tp-step-number">
              <span><?= $countOption3 ?></span>
            </div>
          </div>
          <div class="tp-step-content">
            <h4 class="tp-step-title"><a href="service-details.html">Puas</a></h4>
            <p class="tp-step-paragraph">Masyarakat merasa puas dengan layanan yang diberikan.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
        <div class="tp-step-wrapper p-relative mb-30 wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s">
          <div class="tp-step-icon-box d-flex align-items-center">
            <div class="tp-step-icon">
              <span><i class="fas fa-smile"></i></span>
            </div>
            <div class="tp-step-number">
              <span><?= $countOption2 ?></span>
            </div>
          </div>
          <div class="tp-step-content">
            <h4 class="tp-step-title"><a href="service-details.html">Kurang Puas</a></h4>
            <p class="tp-step-paragraph">Masyarakat merasa kurang puas dengan layanan yang diberikan.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
        <div class="tp-step-wrapper tp-step-lt-mb p-relative mb-30 wow fadeInUp" data-wow-delay=".9s" data-wow-duration="1s">
          <div class="tp-step-icon-box d-flex align-items-center">
            <div class="tp-step-icon">
              <span><i class="fas fa-meh"></i></span>
            </div>
            <div class="tp-step-number">
              <span><?= $countOption1 ?></span>
            </div>
          </div>
          <div class="tp-step-content">
            <h4 class="tp-step-title"><a href="service-details.html">Tidak Puas</a></h4>
            <p class="tp-step-paragraph">Masyarakat merasa tidak puas dengan layanan yang diberikan.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Indek Kepuasan Masyarakat (IKM) area end -->

<!-- Testimonial inner 1 area start -->
<section class="tp-testimonial-inner-1-area pt-160 pb-160" data-background="<?= base_url() ?>/lapor/img/testimonial/testi-inr-1-bg.jpg">
  <div class="container">
    <div class="row align-items-center mb-50">
      <div class="col-xl-6 col-lg-7 col-md-8">
        <h2>
          Apa kata masyarakat Toba? <br>
          Terkait Pelayanan Pemkab Toba
        </h2>
      </div>
      <div class="col-xl-6 col-lg-5 col-md-4">
        <div class="tp-testimonial-inner2-arrow-box d-flex justify-content-end">
          <button class="slider-prev" tabindex="0" aria-label="Previous slide">
            <i class="fa-regular fa-arrow-left"></i>
          </button>
          <button class="slider-next" tabindex="0" aria-label="Next slide">
            <i class="fa-regular fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-xl-5 col-lg-4">
        <div class="tp-testimonial-inner-1-thumb">
          <img src="<?= base_url() ?>/lapor/img/testimonial/conversation.png" alt="" style="width: 100%;" height="400px">
        </div>
      </div>

      <div class="col-xl-6 col-lg-7">
        <div class="row">
          <div class="col-xxl-12">
            <div class="tp-testimonial-inner-slider p-relative wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1.2s">
              <div class="tp-testimonial-inner-slider-active swiper-container">
                <div class="swiper-wrapper">
                  <?php foreach ($data as $row) : ?>
                    <div class="tp-testimonial-inner-1-item swiper-slide">
                      <div class="tp-testimonial-inner-1-content">
                        <p>“<?= $row['saran'] ?>”</p>
                        <div class="tp-testimonial-inner-1-details">
                          <h4><?= $row['nama'] ?></h4>
                          <p><?= $row['pekerjaan'] ?></p>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-1"></div>
    </div>
  </div>
</section>
<!-- Testimonial inner 1 area end -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Data for Gender Chart
  const genderData = {
    labels: ['Perempuan', 'Laki-Laki'],
    datasets: [{
      data: [<?= $countPR ?>, <?= $countJK ?>],
      backgroundColor: ['#36a2eb', '#ff6384', '#ffce56'],
      hoverBackgroundColor: ['#36a2eb', '#ff6384', '#ffce56']
    }]
  };

  // Config for Gender Chart
  const genderConfig = {
    type: 'pie',
    data: genderData,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'right',
        },
      }
    }
  };

  // Render Gender Chart
  const genderChart = new Chart(
    document.getElementById('genderChart'),
    genderConfig
  );

  // Data for Education Chart
  const educationData = {
    labels: [<?php foreach ($counts as $education => $count) {
                echo "'$education',";
              } ?>],
    datasets: [{
      data: [<?php foreach ($counts as $education => $count) {
                echo "$count,";
              } ?>],
      backgroundColor: [
        '#36a2eb', '#ff6384', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40',
        '#ffcd56', '#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236',
        '#166a8f', '#00a950', '#58595b', '#8549ba'
      ],
      hoverBackgroundColor: [
        '#36a2eb', '#ff6384', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40',
        '#ffcd56', '#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236',
        '#166a8f', '#00a950', '#58595b', '#8549ba'
      ]
    }]
  };

  // Config for Education Chart
  const educationConfig = {
    type: 'pie',
    data: educationData,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'right',
        },
      }
    }
  };

  // Render Education Chart
  const educationChart = new Chart(
    document.getElementById('educationChart'),
    educationConfig
  );
</script>


<?php $this->endsection() ?>