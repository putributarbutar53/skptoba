<?= $this->extend('admin/layout/main'); ?>

<?= $this->section('content'); ?>
<div class="row">

    <!-- Chart Jenis Kelamin -->
    <div class="col-sm-6 mb-4">
        <div class="card bg-light">
            <div class="card-body">
                <div class="card-title">Jumlah Responden Berdasarkan Jenis Kelamin</div>
                <p class="card-text">
                    <canvas class="max-w-100" id="chart-pie-gender"></canvas>
                </p>
            </div>
        </div>
    </div>

    <!-- Chart Pekerjaan -->
    <div class="col-sm-6 mb-4">
        <div class="card bg-light">
            <div class="card-body">
                <div class="card-title">Jumlah Responden Berdasarkan Pekerjaan</div>
                <p class="card-text">
                    <canvas class="max-w-100" id="chart-pie-job"></canvas>
                </p>
            </div>
        </div>
    </div>

    <!-- Chart Pendidikan -->
    <div class="col-sm-6 mb-4">
        <div class="card bg-light">
            <div class="card-body">
                <div class="card-title">Jumlah Responden Berdasarkan Pendidikan</div>
                <p class="card-text">
                    <canvas class="max-w-100" id="chart-pie-education"></canvas>
                </p>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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

    // Chart Pekerjaan
    var ctxJob = document.getElementById('chart-pie-job').getContext('2d');
    var jobCounts = <?= json_encode($jobCounts) ?>;

    var jobLabels = [];
    var jobData = [];

    jobCounts.forEach(function(item) {
        jobLabels.push(item.pekerjaan);
        jobData.push(item.count);
    });

    new Chart(ctxJob, {
        type: 'pie',
        data: {
            labels: jobLabels,
            datasets: [{
                label: 'Jumlah Responden',
                data: jobData,
                backgroundColor: ['#ffcd56', '#ff6384', '#36a2eb', '#cc65fe', '#ff9f40'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Chart Pendidikan
    var ctxEducation = document.getElementById('chart-pie-education').getContext('2d');
    var educationCounts = <?= json_encode($educationCounts) ?>;

    var educationLabels = [];
    var educationData = [];

    educationCounts.forEach(function(item) {
        educationLabels.push(item.pendidikan);
        educationData.push(item.count);
    });

    new Chart(ctxEducation, {
        type: 'pie',
        data: {
            labels: educationLabels,
            datasets: [{
                label: 'Jumlah Responden',
                data: educationData,
                backgroundColor: ['#36a2eb', '#4bc0c0', '#ffcd56', '#ff6384', '#9966ff', '#ff9f40'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

<?= $this->endSection(); ?>