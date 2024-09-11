<!-- home.php -->
<!-- <?php $this->extend('web/layout/main') ?> -->

<?php $this->section('content') ?>
<style>
    .custom-select,
    input[type="text"],
    input[type="number"],
    textarea {
        display: block;
        width: 100%;
        padding: 0.25rem 0.5rem;
        font-size: 0.9rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        margin-bottom: 8px;
        height: 2.25rem;
    }

    .custom-select:focus,
    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    label {
        margin-bottom: 5px;
        font-weight: normal;
        display: block;
        text-align: left;
    }

    textarea {
        height: 80px;
        resize: vertical;
        padding: 0.25rem 0.5rem;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
    }

    .form-col {
        flex: 0 0 48%;
    }

    .question {
        margin-bottom: 15px;
    }

    .options {
        margin-left: 1rem;
    }

    .option {
        position: relative;
        padding-left: 25px;
        margin-bottom: 10px;
        cursor: pointer;
        font-size: 1rem;
        display: block;
    }

    .option input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 2px solid #ced4da;
        border-radius: 50%;
    }

    .option:hover input~.checkmark {
        background-color: #f1f1f1;
    }

    .option input:checked~.checkmark {
        background-color: #007bff;
        border-color: #007bff;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .option input:checked~.checkmark:after {
        display: block;
    }

    .option .checkmark:after {
        top: 5px;
        left: 5px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }

    .tp-contact-submit {
        margin-top: 20px;
    }
</style>
<!-- Team area start -->
<div class="tp-team-area pt-110 pb-55">
    <div class="container">
        <div class="row">
            <div class="tp-section-title-wrapper mb-45 text-center wow fadeInUp">
                <h3 class="tp-section-title tp-about-inr-title">Kuisioner Survey Kepuasan Masyarakat (SKM)</h3>
                <p class="tp-team-section-paragraph">SKM ini menjadi indikator untuk melihat kepuasan masyarakat dalam menerima layanan Pemerintah Kabupaten Toba</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="tp-team-wrapper p-relative wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
                    <div class="tp-team-thumb item5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 mx-auto">
                                    <form id="skm_submit" class="tp-contact-inner-page-wrapper">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>

                                        <div class="tp-contact-box tp-contact-inner-page-box mb-120">
                                            <h5>Isi Data Diri</h5>
                                            <br>
                                            <div class="tp-contact-form tp-contact-form-inner-page wow fadeInUp">
                                                <div class="row">
                                                    <input type="hidden" name="action" value="<?= $action ?>" />

                                                    <div class="form-row">
                                                        <div class="form-col">
                                                            <label for="nik">NIK</label>
                                                            <input name="nik" type="text" id="nik" placeholder="Enter your NIK">
                                                        </div>
                                                        <div class="form-col">
                                                            <label for="nama">Nama</label>
                                                            <input name="nama" type="text" id="nama" placeholder="Enter your name">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-col">
                                                            <label for="jk">Jenis Kelamin</label>
                                                            <select name="jk" id="jk" class="custom-select">
                                                                <option value="" disabled selected>Select Gender</option>
                                                                <option value="1">Laki-laki</option>
                                                                <option value="2">Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-col">
                                                            <label for="umur">Umur</label>
                                                            <input name="umur" type="number" id="umur" placeholder="Enter your age">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-col">
                                                            <label for="no_hp">No HP</label>
                                                            <input name="no_hp" type="text" id="no_hp" placeholder="Enter your phone number">
                                                        </div>
                                                        <div class="form-col">
                                                            <label for="pendidikan">Pendidikan</label>
                                                            <select name="pendidikan" id="pendidikan" class="custom-select">
                                                                <option value="" disabled selected>Select Education</option>
                                                                <?php foreach ($pendidikan as $item) : ?>
                                                                    <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-col">
                                                            <label for="pekerjaan">Pekerjaan</label>
                                                            <select name="pekerjaan" id="pekerjaan" class="custom-select">
                                                                <option value="" disabled selected>Pilih Pekerjaan</option>
                                                                <?php foreach ($pekerjaan as $item) : ?>
                                                                    <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                                                <?php endforeach; ?>
                                                                <option value="Lainnya">Lainnya</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-col">
                                                            <label for="jenis_layanan">Jenis Layanan</label>
                                                            <select name="jenis_layanan" id="jenis_layanan" class="custom-select">
                                                                <option value="" disabled selected>Pilih Jenis Layanan</option>
                                                                <?php foreach ($layanan as $item) : ?>
                                                                    <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                                                <?php endforeach; ?>
                                                                <option value="Lainnya">Lainnya</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="tempat_layanan">Tempat Layanan</label>
                                                        <input name="tempat_layanan" type="text" id="tempat_layanan" placeholder="Enter service location (e.g., Kantor Dinas, Kantor Kecamatan)">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <label for="saran">Pesan</label>
                                                    <textarea name="saran" id="saran" placeholder="Write Your Message"></textarea>
                                                </div>
                                                <h6>MOHON PILIH JAWABAN SESUAI DENGAN YANG DIALAMI BAPAK DAN IBU</h6>
                                                <!-- Survey Questions -->
                                                <!-- Survey Questions -->
                                                <div class="col-xl-12">
                                                    <?php foreach ($tanya as $item) : ?>
                                                        <div class="question">
                                                            <label><?= $item['question'] ?></label>
                                                            <!-- Menggunakan array untuk nama input -->
                                                            <div class="options">
                                                                <label class="option"><?= $item['option1'] ?>
                                                                    <!-- Menggunakan array untuk name input -->
                                                                    <input type="radio" name="answers[<?= $item['id'] ?>]" value="option1">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label class="option"><?= $item['option2'] ?>
                                                                    <input type="radio" name="answers[<?= $item['id'] ?>]" value="option2">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label class="option"><?= $item['option3'] ?>
                                                                    <input type="radio" name="answers[<?= $item['id'] ?>]" value="option3">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label class="option"><?= $item['option4'] ?>
                                                                    <input type="radio" name="answers[<?= $item['id'] ?>]" value="option4">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>


                                                <div class="tp-contact-submit">
                                                    <button class="tp-btn" type="submit" name="submit" id="submit">
                                                        <span><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Send Message</span>
                                                    </button>
                                                    <button class="tp-btn" type="reset">
                                                        <span> <i class="fas fa-undo"></i>&nbsp;&nbsp;Reset</span>
                                                    </button>

                                                </div>
                                                <p class="ajax-response"></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tp-team-thumb-shape">
                                <img src="<?= base_url() ?>/lapor/img/team/team-img-shape.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team area end -->

<?php $this->endSection() ?>
<?php $this->section('script') ?>

<script>
    $(document).ready(function() {
        $('#skm_submit').submit(function(e) {
            e.preventDefault();
            var form = $(this)[0];
            var formData = new FormData(form);

            $.ajax({
                type: "post",
                url: "<?= site_url('home/submitskm') ?>",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#skm_submit')[0].reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Terimakasih!',
                        text: 'Terimakasih atas partisipasi anda'
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
</script>
<?php $this->endSection() ?>