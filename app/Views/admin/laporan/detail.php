<div class="modal-header">
    <h5 class="modal-title"><i class="fas fa-info-circle mr-2"></i><?= $title ?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><b><i class="fas fa-id-card mr-1"></i> NIK</b></div>
                        <div class="col-6">: <?= $detail['nik'] ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><b><i class="fas fa-user mr-1"></i> Nama</b></div>
                        <div class="col-6">: <?= $detail['nama'] ?></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><b><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</b></div>
                        <div class="col-6">: <?= $detail['jk'] == 1 ? 'Laki-Laki' : 'Perempuan' ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><b><i class="fas fa-phone mr-1"></i> Nomor HP</b></div>
                        <div class="col-6">: <?= $detail['no_hp'] ?></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><b><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</b></div>
                        <div class="col-6">: <?= $detail['pendidikan'] ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><b><i class="fas fa-briefcase mr-1"></i> Pekerjaan</b></div>
                        <div class="col-6">: <?= $detail['pekerjaan'] ?></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><b><i class="fas fa-concierge-bell mr-1"></i> Jenis Layanan</b></div>
                        <div class="col-6">: <?= $detail['jenis_layanan'] ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><b><i class="fas fa-building mr-1"></i> Tempat Layanan</b></div>
                        <div class="col-6">: <?= $detail['tempat_layanan'] ?></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2"><b><i class="fas fa-comments mr-1"></i> Saran</b></div>
                        <div class="col-10">: <?= $detail['saran'] ?></div>
                    </div>
                </div>
            </div>


            <div class="row mb-3">
                <?php foreach ($pertanyaan as $row) : ?>
                    <div class="col-12"><?= $row['question'] ?></div>
                    <div class="col-12">
                        <?php
                        $found = false; // Inisialisasi variabel untuk menandai apakah data pertanyaan ditemukan

                        foreach ($surveyData as $data) : ?>
                            <?php if ($row['id'] == $data['id_question']) : ?>
                                <?php $found = true; // Menandai bahwa data pertanyaan ditemukan 
                                ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" id="customRadio<?= $row['id'] ?>Inline1" type="radio" name="customRadio<?= $row['id'] ?>Inline" <?php echo $data['option1'] == 1 ? 'checked' : ''; ?> disabled>
                                    <label class="custom-control-label" for="customRadio<?= $row['id'] ?>Inline1"><?= $row['option1'] ?></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" id="customRadio<?= $row['id'] ?>Inline2" type="radio" name="customRadio<?= $row['id'] ?>Inline" <?php echo $data['option2'] == 1 ? 'checked' : ''; ?> disabled>
                                    <label class="custom-control-label" for="customRadio<?= $row['id'] ?>Inline2"><?= $row['option2'] ?></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" id="customRadio<?= $row['id'] ?>Inline3" type="radio" name="customRadio<?= $row['id'] ?>Inline" <?php echo $data['option3'] == 1 ? 'checked' : ''; ?> disabled>
                                    <label class="custom-control-label" for="customRadio<?= $row['id'] ?>Inline3"><?= $row['option3'] ?></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" id="customRadio<?= $row['id'] ?>Inline4" type="radio" name="customRadio<?= $row['id'] ?>Inline" <?php echo $data['option4'] == 1 ? 'checked' : ''; ?> disabled>
                                    <label class="custom-control-label" for="customRadio<?= $row['id'] ?>Inline4"><?= $row['option4'] ?></label>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if (!$found) : // Jika tidak ada data pertanyaan yang cocok, tampilkan opsi tanpa tanda cek 
                        ?>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" id="customRadio<?= $row['id'] ?>Inline1" type="radio" name="customRadio<?= $row['id'] ?>Inline" disabled>
                                <label class="custom-control-label" for="customRadio<?= $row['id'] ?>Inline1"><?= $row['option1'] ?></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" id="customRadio<?= $row['id'] ?>Inline2" type="radio" name="customRadio<?= $row['id'] ?>Inline" disabled>
                                <label class="custom-control-label" for="customRadio<?= $row['id'] ?>Inline2"><?= $row['option2'] ?></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" id="customRadio<?= $row['id'] ?>Inline3" type="radio" name="customRadio<?= $row['id'] ?>Inline" disabled>
                                <label class="custom-control-label" for="customRadio<?= $row['id'] ?>Inline3"><?= $row['option3'] ?></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" id="customRadio<?= $row['id'] ?>Inline4" type="radio" name="customRadio<?= $row['id'] ?>Inline" disabled>
                                <label class="custom-control-label" for="customRadio<?= $row['id'] ?>Inline4"><?= $row['option4'] ?></label>
                            </div>
                        <?php endif; ?>
                    </div>
                    <br>
                    <br>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>