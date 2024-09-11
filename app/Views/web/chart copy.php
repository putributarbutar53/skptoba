<?php $this->extend('web/layout/main') ?> <?= $this->section('content'); ?> <div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>/assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h5 class="mb-0">Jumlah Survey Berdasarkan Pertanyaan : </h5>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Chart Kepuasan -->
    <div class="col-6 mb-4">
        <div class="card bg-light">
            <div class="card-body">
                <div class="card-title">Jumlah Survey Berdasarkan Kepuasan</div>
                <div class="row">
                    <div class="col-md-12">
                        <canvas class="max-w-100" id="chart-pie-satisfaction"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($questionCounts as $question) : ?>
        <div class="col-sm-6 mb-4">
            <div class="card bg-light">
                <div class="card-body">
                    <p class="card-text" style="margin-top: -18px;">
                        <?= $question['question'] ?>
                    </p>
                    <p class="card-text">
                        <canvas class="max-w-100" id="chart-pie-question-<?= $question['id_question'] ?>"></canvas>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Kepuasan
        var ctxSatisfaction = document.getElementById('chart-pie-satisfaction').getContext('2d');
        var satisfactionCounts = <?= json_encode($satisfactionCounts) ?>;

        new Chart(ctxSatisfaction, {
            type: 'pie',
            data: {
                labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Tidak Puas'],
                datasets: [{
                    label: 'Jumlah',
                    data: [satisfactionCounts.sangat_puas, satisfactionCounts.puas, satisfactionCounts.kurang_puas, satisfactionCounts.tidak_puas],
                    backgroundColor: ['#36a2eb', '#4bc0c0', '#ffcd56', '#ff6384'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Chart Jenis Kelamin
        var ctxGender = document.getElementById('chart-pie-gender').getContext('2d');
        var genderCounts = <?= json_encode($genderCounts) ?>;

        var genderLabels = [];
        var genderData = [];

        genderCounts.forEach(function(item) {
            genderLabels.push(item.JK == 1 ? 'Laki-Laki' : 'Perempuan');
            genderData.push(item.count);
        });

        new Chart(ctxGender, {
            type: 'pie',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Jumlah Responden',
                    data: genderData,
                    backgroundColor: ['#36a2eb', '#ff6384'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>

<?php foreach ($questionCounts as $question) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctxQuestion<?= $question['id_question'] ?> = document.getElementById('chart-pie-question-<?= $question['id_question'] ?>').getContext('2d');
            var questionCounts<?= $question['id_question'] ?> = <?= json_encode($question) ?>; // Mengambil data jumlah jawaban untuk pertanyaan tertentu

            var questionLabels<?= $question['id_question'] ?> = [
                '<?= $question['option1_name'] ?>',
                '<?= $question['option2_name'] ?>',
                '<?= $question['option3_name'] ?>',
                '<?= $question['option4_name'] ?>'
            ];
            var questionData<?= $question['id_question'] ?> = [
                questionCounts<?= $question['id_question'] ?>['count_option1'],
                questionCounts<?= $question['id_question'] ?>['count_option2'],
                questionCounts<?= $question['id_question'] ?>['count_option3'],
                questionCounts<?= $question['id_question'] ?>['count_option4']
            ];

            new Chart(ctxQuestion<?= $question['id_question'] ?>, {
                type: 'pie',
                data: {
                    labels: questionLabels<?= $question['id_question'] ?>,
                    datasets: [{
                        label: 'Jumlah',
                        data: questionData<?= $question['id_question'] ?>,
                        backgroundColor: ['#36a2eb', '#4bc0c0', '#ffcd56', '#ff6384'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
<?php endforeach; ?>

<?= $this->endSection(); ?>