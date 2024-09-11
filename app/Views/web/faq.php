<!-- home.php -->
<!-- <?php $this->extend('web/layout/main') ?> -->

<?php $this->section('content') ?>

<div class="tp-faq-breadcrumb-area pt-50 pb-190">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="tp-portfolio-breadcrumb-content mt-95">
                            <h2 class="tp-portfolio-breadcrumb-title">Pertanyaan & Jawaban</h2>
                            <p class="tp-portfolio-breadcrumb-body"><span><a href="<?= base_url() ?>">Beranda</a></span> <span class="spacing">/</span> FAQ</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 mb-50">
                        <div class="tp-faq-breadcrumb-img d-flex justify-content-end">
                            <img src="<?= base_url() ?>/lapor/img/faq/faq-bradcream-thumb.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="faq-area pt-100 pb-100">
    <div class="container">
        <div class="tp-faq-item-1 pb-50">
            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="tp-faq-wrapper">
                        <div class="accordion" id="general_faqaccordion">
                            <div class="accordion-item tp-faq-inr-pg-accordion-item">
                                <h2 class="accordion-header" id="faq_one">
                                    <button class="accordion-button tp-faq-inr-pg-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq_collapse_one" aria-expanded="true" aria-controls="faq_collapse_one">
                                        Apa itu Survey Kepuasan Masyarakat (SKM)?
                                    </button>
                                </h2>
                                <div id="faq_collapse_one" class="accordion-collapse collapse show" aria-labelledby="faq_one" data-bs-parent="#general_faqaccordion">
                                    <div class="accordion-body tp-faq-inr-pg-accordion-body">
                                        <p>Survey Kepuasan Masyarakat (SKM) adalah alat yang digunakan untuk mengukur tingkat kepuasan masyarakat terhadap layanan yang diberikan oleh Pemerintah Kabupaten Toba.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item tp-faq-inr-pg-accordion-item">
                                <h2 class="accordion-header" id="faq_two">
                                    <button class="accordion-button collapsed tp-faq-inr-pg-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq_collapse_two" aria-expanded="false" aria-controls="faq_collapse_two">
                                        Bagaimana cara saya mengisi SKM?
                                    </button>
                                </h2>
                                <div id="faq_collapse_two" class="accordion-collapse collapse" aria-labelledby="faq_two" data-bs-parent="#general_faqaccordion">
                                    <div class="accordion-body tp-faq-inr-pg-accordion-body">
                                        <p>Anda dapat mengisi SKM melalui situs web ini dengan mengikuti tautan yang telah disediakan. Pastikan Anda mengisi semua kolom yang diperlukan dengan informasi yang akurat.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item tp-faq-inr-pg-accordion-item">
                                <h2 class="accordion-header" id="faq_three">
                                    <button class="accordion-button collapsed tp-faq-inr-pg-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq_collapse_three" aria-expanded="false" aria-controls="faq_collapse_three">
                                        Apa manfaat dari mengikuti SKM?
                                    </button>
                                </h2>
                                <div id="faq_collapse_three" class="accordion-collapse collapse" aria-labelledby="faq_three" data-bs-parent="#general_faqaccordion">
                                    <div class="accordion-body tp-faq-inr-pg-accordion-body">
                                        <p>Dengan mengikuti SKM, Anda membantu Pemerintah Kabupaten Toba untuk memahami dan meningkatkan kualitas layanan publik yang diberikan. Masukan Anda sangat berharga untuk perbaikan berkelanjutan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item tp-faq-inr-pg-accordion-item">
                                <h2 class="accordion-header" id="faq_four">
                                    <button class="accordion-button collapsed tp-faq-inr-pg-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq_collapse_four" aria-expanded="false" aria-controls="faq_collapse_four">
                                        Apakah data pribadi saya aman?
                                    </button>
                                </h2>
                                <div id="faq_collapse_four" class="accordion-collapse collapse" aria-labelledby="faq_four" data-bs-parent="#general_faqaccordion">
                                    <div class="accordion-body tp-faq-inr-pg-accordion-body">
                                        <p>Ya, data pribadi Anda akan dijaga kerahasiaannya dan hanya akan digunakan untuk keperluan analisis kepuasan masyarakat terkait layanan yang diberikan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item tp-faq-inr-pg-accordion-item">
                                <h2 class="accordion-header" id="faq_five">
                                    <button class="accordion-button collapsed tp-faq-inr-pg-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq_collapse_five" aria-expanded="false" aria-controls="faq_collapse_five">
                                        Bagaimana saya bisa mendapatkan hasil SKM?
                                    </button>
                                </h2>
                                <div id="faq_collapse_five" class="accordion-collapse collapse" aria-labelledby="faq_five" data-bs-parent="#general_faqaccordion">
                                    <div class="accordion-body tp-faq-inr-pg-accordion-body">
                                        <p>Hasil dari SKM akan dipublikasikan di situs web ini setelah analisis selesai dilakukan. Anda bisa memeriksa bagian hasil survei untuk informasi lebih lanjut.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item tp-faq-inr-pg-accordion-item">
                                <h2 class="accordion-header" id="faq_six">
                                    <button class="accordion-button collapsed tp-faq-inr-pg-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq_collapse_six" aria-expanded="false" aria-controls="faq_collapse_six">
                                        Siapa yang dapat saya hubungi jika saya memiliki pertanyaan lebih lanjut?
                                    </button>
                                </h2>
                                <div id="faq_collapse_six" class="accordion-collapse collapse" aria-labelledby="faq_six" data-bs-parent="#general_faqaccordion">
                                    <div class="accordion-body tp-faq-inr-pg-accordion-body">
                                        <p>Jika Anda memiliki pertanyaan lebih lanjut, Anda dapat menghubungi kami melalui informasi kontak yang tersedia di situs web ini. Tim kami siap membantu Anda.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endsection() ?>