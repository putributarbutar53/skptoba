<!-- home.php -->
<?php $this->extend('lapor/layout/main') ?>

<?php $this->section('content') ?>
<section class="no-page layout-pt-lg layout-pb-lg bg-beige-1">
  <div class="container">
    <div class="row y-gap-50 justify-between items-center">
      <div class="col-lg-6">
        <div class="no-page__img">
          <img src="<?= base_url() ?>/lapor/img/404/1.svg" alt="image">
        </div>
      </div>

      <div class="col-xl-5 col-lg-6">
        <div class="no-page__content">
          <h1 class="no-page__main text-dark-1">
            40<span class="text-purple-1">4</span>
          </h1>
          <h2 class="text-35 lh-12 mt-5">Ups! Sepertinya Anda tersesat.</h2>
          <div class="mt-10">Halaman yang Anda cari tidak tersedia. Coba telusuri lagi<br> atau Anda dapat buka.</div>
          <button class="button -md -purple-1 text-white mt-20">Kembali ke Beranda</button>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->endsection() ?>