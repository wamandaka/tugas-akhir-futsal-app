<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>



    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif ?>

            <?= $this->session->flashdata('message') ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#TambahLapangan">Tambah Lapangan</a>
            <div class="table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Harga (Rp)</th>
                            <th scope="col">Harga Malam(Rp)</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($lapangan as $lp) : ?>
                            <tr>
                                <th scope="row"><?= $i ?><?php $i++ ?></th>
                                <td><?= $lp['nama'] ?></td>
                                <td><?= $lp['jenis'] ?></td>
                                <td><?= $lp['harga'] ?></td>
                                <td><?= $lp['harga_malam'] ?></td>
                                <td><img src="<?= base_url('assets/img/' . $lp['gambar']) ?>" width="100px" alt=""></td>
                                <td>
                                    <a href="" class="badge badge-warning">edit</a>
                                    <a href="<?= base_url('lapangan/hapuslapangan/' . $lp['id']) ?>" class="badge badge-danger" onclick="return confirm('yakin?')">delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modal -->
<div class="modal fade" id="TambahLapangan" tabindex="-1" aria-labelledby="TambahLapanganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahLapanganLabel">Tambah Lapangan</h5>
            </div>
            <form action="<?= base_url('lapangan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="harga_malam" name="harga_malam" placeholder="Harga malam">
                    </div>
                    <div class="custom-file">
                        <input class="custom-file-input" type="file" id="gambar" name="gambar">
                        <label for="gambar" class="custom-file-label">Choose File</label>
                        <small>Max 2mb</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>