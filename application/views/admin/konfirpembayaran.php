<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message') ?>

    <!-- <div class="container"> -->
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" class="form-control mb-3" id="id_book" name="id_book" value="<?= $konfirmasi['id_book'] ?>" readonly>
                    <label for="status_bayar">Bukti</label>
                    <div class="div">
                        <img src="<?= base_url('assets/img/bukti_bayar/') . $konfirmasi['upload_bukti'] ?>" width="500">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="status_bayar">Status Bayar</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Confirmed" id="status_bayar" name="status_bayar">
                        <label class="form-check-label" for="status_bayar">
                            Konfirmasi
                        </label>
                    </div>
                    <?= form_error('status_bayar', '<small class="text-danger pl-3">', '</small>') ?>
                </div> -->
                <a href="<?= base_url('admin') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary" value="Confirmed" id="status_bayar" name="status_bayar">Konfirmasi</button>
            </form>
        </div>
    </div>
</div>


</div>
<!-- End of Main Content -->