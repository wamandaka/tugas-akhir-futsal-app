<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">KD Book</th>
                            <th scope="col">Tgl Book</th>
                            <th scope="col">Tgl Main</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Berakhir</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Status Main</th>
                            <th scope="col">Status Bayar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($riwayat as $r) : ?>
                            <tr>
                                <th scope="row"><?= $i;
                                                $i++; ?></th>
                                <td><?= $r['id_book'] ?></td>
                                <td><?= $r['tgl_book'] ?></td>
                                <td><?= $r['tgl_main'] ?></td>
                                <td><?= $r['jam_mulai'] ?></td>
                                <td><?= $r['jam_berakhir'] ?></td>
                                <td><?= $r['total_harga'] ?></td>
                                <td><?= $r['status'] ?></td>
                                <!-- Status Bayar -->
                                <?php if ($r['status_bayar'] == 'Confirmed') : ?>
                                    <td>
                                        <div class="badge badge-success"><?= $r['status_bayar'] ?></div>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <div class="badge badge-danger"><?= $r['status_bayar'] ?></div>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <a href="<?= base_url('user/cetak/' . $r['id_book']) ?>" class="badge badge-primary">cetak</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->