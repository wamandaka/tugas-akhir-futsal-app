<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message') ?>
    <!-- Content Row -->
    <div class="row">


        <?php
        $query = "SELECT SUM(total_harga) FROM booking";
        $sum = $this->db->query($query)->result_array(); ?>
        <!-- Earnings (Monthly) Card Example -->
        <?php foreach ($sum as $s) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Pendapatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($s['SUM(total_harga)'], 0, '', '.') ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


        <!-- Earnings (Monthly) Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Earnings (Monthly) Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <!-- Pending Requests Card Example -->
        <?php
        $query = "SELECT SUM(status_bayar = 'Pending') as sb FROM pembayaran";
        $sum = $this->db->query($query)->result_array(); ?>
        <?php foreach ($sum as $s) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $s["sb"] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="table-responsive">
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">KD Book</th>
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col">Nama Lap</th>
                    <th scope="col">Tgl Booking</th>
                    <th scope="col">Tgl Main</th>
                    <th scope="col">Jam Mulai</th>
                    <th scope="col">Jam Berakhir</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Status Main</th>
                    <th scope="col">Status Pembayaran</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                $tanggal = date('Y-m-d', time() + 60 * 60 * 5); //variabel dengan nilai date/tanggal sekarang
                $jam = date('H:i:s', time() + 60 * 60 * 5); ////variabel dengan nilai time/jam sekarang
                ?>
                <?php foreach ($konfirmasi as $km) : ?>
                    <tr>
                        <th scope="row"><?= $i;
                                        $i++; ?></th>
                        <td><?= $km['id_book'] ?></td>
                        <td><?= $km['nama'] ?></td>
                        <td><?= $km['nama_lap'] ?></td>
                        <td><?= $km['tgl_book'] ?></td>
                        <td><?= $km['tgl_main'] ?></td>
                        <td><?= $km['jam_mulai'] ?></td>
                        <td><?= $km['jam_berakhir'] ?></td>
                        <td>Rp. <?= number_format($km['total_harga'], 0, '', '.') ?></td>

                        <!-- Status Main -->
                        <?php if ($km['tgl_main'] > $tanggal && $km['status_bayar'] == 'Confirmed') : ?>
                            <td><?= $km['status'] ?></td>
                        <?php elseif ($tanggal > $km['tgl_main'] && $km['status_bayar'] == 'Confirmed') : ?>
                            <?php $data = ['status' => 'Selesai'];
                            $this->db->where('id_book', $km['id_book']);
                            $this->db->update('booking', $data); ?>
                            <td><?= $km['status'] ?></td>
                        <?php elseif ($jam >= $km['jam_berakhir'] && $km['status_bayar'] == 'Confirmed') : ?>
                            <?php $data = ['status' => 'Selesai'];
                            $this->db->where('id_book', $km['id_book']);
                            $this->db->update('booking', $data); ?>
                            <td><?= $km['status'] ?></td>
                        <?php elseif ($jam >= $km['jam_mulai'] && $km['status_bayar'] == 'Confirmed') : ?>
                            <?php $data = ['status' => 'Sedang Bermain'];
                            $this->db->where('id_book', $km['id_book']);
                            $this->db->update('booking', $data); ?>
                            <td><?= $km['status'] ?></td>
                        <?php else : ?>
                            <td><?= $km['status'] ?></td>
                        <?php endif; ?>

                        <!-- Status Bayar -->
                        <?php if ($km['status_bayar'] == 'Confirmed') : ?>
                            <td class="badge badge-success"><?= $km['status_bayar'] ?></td>
                        <?php else : ?>
                            <td class="badge badge-danger"><?= $km['status_bayar'] ?></td>
                        <?php endif; ?>

                        <!-- Aksi -->
                        <?php if ($km['status_bayar'] == 'Confirmed') : ?>
                            <td></td>
                        <?php else : ?>
                            <td><a type="button" href="<?= base_url('admin/konfirmasi/') . $km['id_book'] ?>" class="badge badge-primary">Cek</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->