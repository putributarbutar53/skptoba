<div class="modal-header">
    <h5 class="modal-title"><i class="fas fa-info-circle mr-2"></i>Detail Tindak Lanjut</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">
                    <b><i class="fas fa-check mr-1"></i> Pengaduan Telah Ditindak Lanjuti Pada Tanggal <?= date('d F Y', strtotime($detail['created_at'])) ?></b>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12"><b><i class="fas fa-comment mr-1"></i> Tindak Lanjut</b></div>
            </div>
            <div class="row mb-3">
                <div class="col-12"><?= $detail['solution'] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-12"><b><i class="fas fa-paperclip mr-1"></i> Lampiran Tindak Lanjut</b></div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <?php if (!empty($detail['picture'])) : ?>
                        <img class="d-block mx-auto max-w-full h-auto rounded-xl mt-6" style="width: 900px; height: 200px; " src="<?= base_url() . getenv('dir.upload.tindak') . $detail['picture'] ?>" alt="<?= $detail['id_lapor'] ?>">
                    <?php else : ?>
                        <img class="d-block mx-auto max-w-full h-auto rounded-xl mt-6" style="width: 25%; height: 25%;" src="<?= base_url() ?>/assets/img/gallery/noim.png" alt="No Image">
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="row mb-3">
        </div>
    </div>
</div>
</div>