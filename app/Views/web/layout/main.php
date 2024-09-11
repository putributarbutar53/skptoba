<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from html.hixstudio.net/techub-prev/techub/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 03:53:43 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SKM Toba - Pemerintah Kabupaten Toba</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/lapor/img/logo/favicon.ico">

    <!-- CSS here -->

    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/animate.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/swiper-bundle.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/slick.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/font-awesome-pro.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/spacing.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/main.css">
    <script src="<?= base_url() ?>assets/lib/echarts/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url() ?>assets/lib/chart.js/Chart.min.js"></script>
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->





    <!-- pre loader area start -->
    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="loder-section left-section"></div>
        <div class="loder-section right-section"></div>
        <div class="loader-brand-icon"><img src="<?= base_url() ?>/lapor/img/logo/favicon.ico" alt=""></div>
    </div>
    <!-- pre loader area end -->



    <!-- back to top start -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <!-- back to top end -->



    <!-- Start Search Popup Section -->
    <div class="search-popup">
        <button class="close-search style-two"><span class="flaticon-multiply"><i class="far fa-times-circle"></i></span></button>
        <button class="close-search"><i class="fa-light fa-arrow-up"></i></button>
        <form method="post" action="#">
            <div class="form-group">
                <input type="search" name="search-field" value="" placeholder="Search Here" required="">
                <button type="submit"><i class="fal fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- Start Search Popup Section -->




    <!-- tp-offcanvus-area-start -->
    <div class="tpoffcanvas-area">
        <div class="tpoffcanvas">
            <div class="tpoffcanvas__close-btn">
                <button class="close-btn"><i class="fal fa-times"></i></button>
            </div>
            <div class="tpoffcanvas__logo">
                <a href="index.html">
                    <img src="<?= base_url() ?>/lapor/img/logo/logo2.png" alt="">
                </a>
            </div>
            <div class="tpoffcanvas__title">
                <p>Survey Kepuasan Masyarakat Toba Terhadap Pelayanan di Pemerintah Kabupaten Toba</p>
            </div>
            <div class="tp-main-menu-mobile d-xl-none"></div>
            <div class="tpoffcanvas__contact-info">
                <div class="tpoffcanvas__contact-title">
                    <h5>Contact us</h5>
                </div>
                <ul>
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <a href="https://www.google.com/maps/@23.8223586,90.3661283,15z" target="_blank">Jl. Soposurung KM 2 Balige</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:diskominfo@tobakab.go.id"><span class="__cf_email__">diskominfo@tobakab.go.id</span></a>
                    </li>
                    <li>
                        <i class="fa-solid fa-phone-flip"></i>
                        <a href="tel:+48555223224">(+00) 678 345 98568</a>
                    </li>
                </ul>
            </div>
            <div class="tpoffcanvas__input">
                <div class="tpoffcanvas__input-title">
                    <h4>Get UPdate</h4>
                </div>
                <form action="#">
                    <div class="p-relative">
                        <input type="text" placeholder="Enter mail">
                        <button>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="tpoffcanvas__social">
                <div class="social-icon">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="body-overlay"></div>
    <!-- tp-offcanvus-area-end -->




    <?= $this->include('web/layout/top_menu') ?>



    <main>
        <?= $this->renderSection('content') ?>
    </main>
    <?= $this->include('web/layout/footer') ?>
    <!-- Footer area end -->





    <!-- JS here -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url() ?>/lapor/js/vendor/jquery.js"></script>
    <script src="<?= base_url() ?>/lapor/js/vendor/waypoints.js"></script>
    <script src="<?= base_url() ?>/lapor/js/bootstrap-bundle.js"></script>
    <script src="<?= base_url() ?>/lapor/js/swiper-bundle.js"></script>
    <script src="<?= base_url() ?>/lapor/js/slick.js"></script>
    <script src="<?= base_url() ?>/lapor/js/range-slider.js"></script>
    <script src="<?= base_url() ?>/lapor/js/magnific-popup.js"></script>
    <script src="<?= base_url() ?>/lapor/js/nice-select.js"></script>
    <script src="<?= base_url() ?>/lapor/js/purecounter.js"></script>
    <script src="<?= base_url() ?>/lapor/js/wow.js"></script>
    <script src="<?= base_url() ?>/lapor/js/isotope-pkgd.js"></script>
    <script src="<?= base_url() ?>/lapor/js/imagesloaded-pkgd.js"></script>
    <script src="<?= base_url() ?>/lapor/js/ajax-form.js"></script>
    <script src="<?= base_url() ?>/lapor/js/main.js"></script>
    <?= $this->renderSection('script') ?>
</body>


<!-- Mirrored from html.hixstudio.net/techub-prev/techub/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 03:54:03 GMT -->

</html>