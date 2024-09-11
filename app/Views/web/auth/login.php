<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet%401.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/vendors.css">
    <link rel="stylesheet" href="<?= base_url() ?>/lapor/css/main.css">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url() ?>/favicons/site.webmanifest">
    <title>lapor Toba | Login</title>
</head>

<body class="preloader-visible" data-barba="wrapper">
    <!-- preloader start -->
    <div class="preloader js-preloader">
        <div class="preloader__bg"></div>
    </div>
    <!-- preloader end -->


    <main class="main-content  
  bg-beige-1
">

        <header data-anim="fade" data-add-bg="" class="header -base js-header">


            <div class="header__container py-10">
                <div class="row justify-between items-center">

                    <div class="col-auto">
                        <div class="header-left">

                            <div class="header__logo ">
                                <a data-barba href="<?= base_url() ?>">
                                </a>
                            </div>

                        </div>
                    </div>


                    <div class="col-auto">
                        <div class="header-right d-flex items-center">
                            <div class="mr-30">

                                <div class="d-none xl:d-block ml-20">
                                    <button class="text-dark-1 items-center" data-el-toggle=".js-mobile-menu-toggle">
                                        <i class="text-11 icon icon-mobile-menu"></i>
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </header>


        <div class="content-wrapper  js-content-wrapper">

            <section class="form-page js-mouse-move-container">
                <div class="form-page__img bg-dark-1">
                    <div class="form-page-composition" style="margin-top: 320px;">
                        <div class="-bg"><img data-move="30" class="js-mouse-move" src="<?= base_url() ?>/lapor/img/login/bg.png" alt="bg"></div>
                        <div class="-el-1"><img data-move="20" class="js-mouse-move" src="<?= base_url() ?>/lapor/img/home-9/hero/bg.png" alt="image"></div>
                        <div class="-el-2"><img data-move="40" class="js-mouse-move" src="<?= base_url() ?>/lapor/img/home-9/hero/7.png" alt="icon"></div>
                    </div>
                </div>

                <div class="form-page__content lg:py-50">
                    <div class="container">
                        <div class="row justify-center items-center">
                            <div class="col-xl-6 col-lg-8">
                                <div class="px-50 py-50 md:px-25 md:py-25 bg-white shadow-1 rounded-16">
                                    <h3 class="text-30 lh-13"><?= lang('Auth.loginTitle') ?></h3>
                                    <p class="mt-10">Don't have an account? <a href="<?= url_to('register') ?>" class="text-purple-1">Register for free</a></p>
                                    <?= view('Myth\Auth\Views\_message_block') ?>
                                    <form class="contact-form respondForm__form row y-gap-20 pt-30" action="<?= url_to('login') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <?php if ($config->validFields === ['email']) : ?>
                                            <div class="form-group">
                                                <label for="login"><?= lang('Auth.email') ?></label>
                                                <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.login') ?>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="form-group">
                                                <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                                <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.login') ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group" style="margin-top: -30px;">
                                            <label for="password"><?= lang('Auth.password') ?></label>
                                            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.password') ?>
                                            </div>
                                        </div>

                                        <?php if ($config->allowRemembering) : ?>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                                    <?= lang('Auth.rememberMe') ?>
                                                </label>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12">
                                            <button type="submit" name="submit" id="submit" class="button -md -dark-1 text-light-1 fw-500 w-1/1">
                                                <?= lang('Auth.loginAction') ?>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="<?= base_url() ?>/lapor/js/vendors.js"></script>
    <script src="<?= base_url() ?>/lapor/js/main.js"></script>
</body>



</html>