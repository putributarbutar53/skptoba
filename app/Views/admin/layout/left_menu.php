<nav class="navbar navbar-vertical navbar-expand-xl navbar-light navbar-vibrant">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation">
                <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
            </button>
        </div>
        <a class="navbar-brand" href="<?php echo site_url('admin2045/dashboard') ?>">
            <div class="d-flex align-items-center py-3">
                <img class="mr-2" src="<?= base_url() ?>assets/img/logos/logo.svg" alt="" height="38" />
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content perfect-scrollbar scrollbar ">
            <ul class="navbar-nav flex-column">
                <li class="nav-item<?php if (current_url() === site_url('admin2045/dashboard')) { ?> active<?php } ?>">
                    <a class="nav-link" href="<?php echo site_url('admin2045/dashboard') ?>">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-home"></span></span>
                            <span class="nav-link-text">Dashboard</span>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="navbar-vertical-divider">
                <hr class="navbar-vertical-hr my-2" />
                <?php if (session()->get('admin_role') == 'superadmin') { ?>
                    <ul class="navbar-nav flex-column">

                        <li class="nav-item<?php if (current_url() === site_url('admin2045/question')) { ?> active<?php } ?>">
                            <a class="nav-link" href="<?php echo site_url('admin2045/question') ?>">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><span class="fas fa-question-circle"></span></span>
                                    <span class="nav-link-text">List Pertanyaan</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                    <hr class="navbar-vertical-hr my-2" />
                <?php } ?>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2045/laporan')) { ?> active<?php } ?>"><a class="nav-link" href="<?php echo site_url('admin2045/laporan') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fas fa-book"></i></span><span class="nav-link-text">Hasil Survey</span>
                            </div>
                        </a>
                    </li>
                </ul>

                <hr class="navbar-vertical-hr my-2" />
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2045/laporan/chart')) { ?> active<?php } ?>"><a class="nav-link" href="<?php echo site_url('admin2045/laporan/chart') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fas fa-chart-area"></i></span><span class="nav-link-text">Charts</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <hr class="navbar-vertical-hr my-2" />
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2045/laporan/qst')) { ?> active<?php } ?>"><a class="nav-link" href="<?php echo site_url('admin2045/laporan/qst') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fas fa-chart-pie"></i></span><span class="nav-link-text">Charts Berdasarkan Pertanyaan</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <hr class="navbar-vertical-hr my-2" />
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2045/pendidikan')) { ?> active<?php } ?>"><a class="nav-link" href="<?php echo site_url('admin2045/pendidikan') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fas fa-graduation-cap"></i></span><span class="nav-link-text">Pendidikan Terakhir</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2045/pekerjaan')) { ?> active<?php } ?>"><a class="nav-link" href="<?php echo site_url('admin2045/pekerjaan') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fas fa-briefcase"></i></span><span class="nav-link-text">Pekerjaan</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item<?php if (current_url() === site_url('admin2045/layanan')) { ?> active<?php } ?>"><a class="nav-link" href="<?php echo site_url('admin2045/layanan') ?>">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fas fa-hands-helping"></i></span><span class="nav-link-text">Jenis Layanan</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="navbar-vertical-divider">
                    <hr class="navbar-vertical-hr my-2" />
                    <ul class="navbar-nav flex-column">
                        <?php if (session()->get('admin_role') == 'superadmin') { ?>
                            <li class="nav-item<?php if (current_url() === site_url('admin2045/admin')) { ?> active<?php } ?>">
                                <a class="nav-link" href="<?= site_url('admin2045/admin') ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><i class="fas fa-users-cog"></i></span>
                                        <span class="nav-link-text">Admins</span>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
</nav>