<header data-anim="fade" data-add-bg="bg-dark-1" class="header -type-1 js-header">


    <div class="header__container">
        <div class="row justify-between items-center">

            <div class="col-auto">
                <div class="header-left" style="display: flex; align-items: center;">
                    <div class="header__logo">
                        <a data-barba href="index.html">
                            <img src="<?= base_url() ?>/lapor/img/general/logo-admin.png" alt="logo" style="width: 75px; height: 75px;">
                        </a>
                    </div>

                    <div id="clock" style="font-size: 36px; font-family: Arial, sans-serif; text-align: center; margin-top: 0; margin-left: 10px;">
                        <?php echo date("H:i:s"); ?>
                    </div>
                </div>
            </div>



            <div class="header-menu js-mobile-menu-toggle ">
                <div class="header-menu__content">
                    <div class="mobile-bg js-mobile-bg"></div>

                    <div class="d-none xl:d-flex items-center px-20 py-20 border-bottom-light">
                        <a href="<?= site_url('about') ?>" class="text-dark-1">Tentang</a>
                    </div>
                    <div class="d-none xl:d-flex items-center px-20 py-20 border-bottom-light">
                        <a href="<?= site_url('report') ?>" class="text-dark-1">Pengaduan Saya</a>
                    </div>
                    <div class="d-none xl:d-flex items-center px-20 py-20 border-bottom-light">
                        <a href="<?= site_url('logout') ?>" class="text-dark-1">Log Out</a>
                    </div>

                    <div class="menu js-navList">
                        <ul class="menu__nav text-white -is-active">
                            <!-- <li>
                                <a data-barba href="<?= base_url() ?>">Home</a>
                            </li>
                            <li>
                                <a data-barba href="<?= site_url('about') ?>">Tentang</a>
                            </li> -->
                        </ul>
                    </div>
                    <!-- 
                    <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">

                        <div class="mobile-socials mt-10">

                            <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                                <i class="fa fa-instagram"></i>
                            </a>

                            <a href="#" class="d-flex items-center justify-center rounded-full size-40">
                                <i class="fa fa-linkedin"></i>
                            </a>

                        </div>
                    </div> -->
                </div>

                <div class="header-menu-close" data-el-toggle=".js-mobile-menu-toggle">
                    <div class="size-40 d-flex items-center justify-center rounded-full bg-white">
                        <div class="icon-close text-dark-1 text-16"></div>
                    </div>
                </div>

                <div class="header-menu-bg"></div>
            </div>


            <div class="col-auto">
                <div class="header-right d-flex items-center">
                    <div class="header-right__icons text-white d-flex items-center">
                        <div class="d-none xl:d-block ml-20">
                            <button class="text-white items-center" data-el-toggle=".js-mobile-menu-toggle">
                                <i class="text-11 icon icon-mobile-menu"></i>
                            </button>
                        </div>
                    </div>
                    <div class="header-right__buttons d-flex items-center ml-30 md:d-none">
                        <a href="<?= site_url('about') ?>" class="button -underline text-white">Tentang</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?= site_url('report') ?>" class="button -underline text-white">Pengaduan Anda</a>
                        <a href="<?= base_url('logout') ?>" class="button -sm -white text-dark-1 ml-30"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Log Out</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</header>
<script>
    // Fungsi untuk memperbarui jam
    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        hours = ('0' + hours).slice(-2);
        minutes = ('0' + minutes).slice(-2);
        seconds = ('0' + seconds).slice(-2);
        document.getElementById('clock').innerText = hours + ':' + minutes + ':' + seconds;
    }

    // Memperbarui jam setiap detik
    setInterval(updateClock, 1000);

    // Panggil fungsi updateClock untuk pertama kali
    updateClock();
</script>
<?php
// Set zona waktu PHP ke Waktu Indonesia Barat (WIB)
date_default_timezone_set('Asia/Jakarta');
?>