<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->

<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">Dashboard</h3>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
            <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Dashboard</h5>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="container">
            <div class="row">
                <div class="col-sm"><a href="<?= site_url('admin2045/dashboard') ?>"><img src="<?= base_url() ?>assets/icon/1797890_62.png" /></a><br />Dashboard</div>
                <div class="col-sm"><a href="<?= site_url('admin2045/skpd') ?>"><img src="<?= base_url() ?>assets/icon/1797890_89.png" /></a><br />SKPD</div>
                <div class="col-sm"><a href="<?= site_url('admin2045/laporan') ?>"><img src="<?= base_url() ?>assets/icon/1797890_90.png" /></a><br />Pengaduan</div>
                <div class="col-sm"><a href="<?= site_url('admin2045/tindak') ?>"><img src="<?= base_url() ?>assets/icon/1797890_44.png" /></a><br />Tindak Lanjut</div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
            <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Account</h5>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="container">
            <div class="row">
                <?php if (session()->get('admin_role') == 'superadmin') { ?>
                    <div class="col-sm"><a href="<?= site_url('admin2045/admin') ?>"><img src="<?= base_url() ?>assets/icon/1797890_86.png" /></a><br />Admin</div>
                <?php } ?>
                <div class="col-sm"><a href="<?= site_url('admin2045/profile') ?>"><img src="<?= base_url() ?>assets/icon/1797890_22.png" /></a><br />Profile</div>
                <div class="col-sm"><a href="<?= site_url('admin2045/logout') ?>"><img src="<?= base_url() ?>assets/icon/1797890_46.png" /></a><br />Logout</div>
            </div>
        </div>
    </div>
</div>
<?php $this->endsection() ?>