<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">


    <div class="container">
        <!-- heading -->
        <div class="row mt-3">
            <h1 class="d-flex justify-content-center heading">Silahkan pilih jadwal main</h1>
        </div>
        <!-- end of heading -->
        <div class="row mt-3 mb-3">
            <?php foreach ($lapangan as $lp) : ?>
                <div class="col-lg-4 animate__animated animate__pulse">
                    <div class="card mb-3 shadow">
                        <img src="<?= base_url('assets/img/' . $lp['gambar']) ?>" class="card-img-top" height="200px" alt="...">
                        <div class="card-body">
                            <h4 class="card-title mb-3"><?= $lp['nama'] ?></h4>
                            <p class="card-text">Jenis: <?= $lp['jenis'] ?></p>
                            <p class="card-text">Harga: Rp. <?= $lp['harga'] ?> /jam</p>
                            <p class="card-text">Harga Malam: Rp. <?= $lp['harga_malam'] ?> /jam</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 shadow">
                    <form method="post" action="" name="booking">

                        <?php
                        // mengambil data barang dengan kode paling besar
                        $query = "SELECT max(id_book) as kodeTerbesar FROM booking";
                        $data = $this->db->query($query)->row_array();

                        // $koneksi = new mysqli('localhost', 'root', '', 'futsal');
                        // $query = mysqli_query($koneksi, "SELECT max(id_book) as kodeTerbesar FROM booking");
                        // $data = mysqli_fetch_array($query);
                        $kodeBooking = $data['kodeTerbesar'];

                        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
                        // dan diubah ke integer dengan (int)
                        $urutan = (int) substr((string)$kodeBooking, 3, 8);

                        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                        $urutan++;

                        // membentuk kode barang baru
                        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
                        $huruf = "KB";
                        $kodeBooking = $huruf . sprintf("%07s", $urutan); ?>
                        <?php

                        ?>
                        <!-- <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message') ?>"></div> -->
                        <?= $this->session->flashdata('message') ?>

                        <div class="form-group mb-3">
                            <label for="kode-booking">Kode Booking <label style="color:red">*</label></label>
                            <input type="text" class="form-control" id="kode-booking" name="kode-booking" value="<?= $kodeBooking ?>" readonly required>
                        </div>
                        <div class="form-group mb-3">
                            <!-- <label for="nama">ID USER</label> -->
                            <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $user['id'] ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Nama Pemesan <label style="color:red">*</label></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['name'] ?>" readonly required>
                        </div>
                        <div class="form-group mb-3">
                            <!-- <label for="id-lapangan">ID Lapangan</label> -->
                            <input type="hidden" class="form-control" id="id-lapangan" name="id-lapangan" value="<?= $lp['id'] ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id-lapangan">Nama Lapangan <label style="color:red">*</label></label>
                            <input type="text" class="form-control" id="nama-lapangan" name="nama-lapangan" value="<?= $lp['nama'] ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <!-- <label for="harga">Harga</label> -->
                            <input type="hidden" class="form-control" name="harga" id="harga" value="<?= $lp['harga'] ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <!-- <label for="harga">Harga Malam</label> -->
                            <input type="hidden" class="form-control" name="harga_malam" id="harga_malam" value="<?= $lp['harga_malam'] ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="tanggal-main">Tanggal Main <label style="color:red">*</label></label>
                                    <input type="date" class="form-control datepicker" id="tanggal-main" name="tanggal-main">
                                    <?= form_error('tanggal-main', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group col-md-12 mb-3">
                                    <label for="jam-mulai">Mulai <label style="color:red">*</label></label>
                                    <select id="jam_mulai" class="form-select" name="jam-mulai">
                                        <?php $x = 0 ?>
                                        <?php for ($i = 0; $i < 10; $i++) : ?>
                                            <option>0<?= $x;
                                                        $x++ ?>:00</option>
                                        <?php endfor; ?>

                                        <?php for ($i = 0; $i < 14; $i++) : ?>
                                            <option><?= $x;
                                                    $x++ ?>:00</option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group col-md-12 mb-3">
                                    <label for="inputState">Durasi <label style="color:red">*</label></label>
                                    <select id="durasi" class="form-select" name="durasi" onFocus="startCalc();" onBlur="stopCalc();">
                                        <option value="">Pilih Durasi</option>
                                        <option value="1">1 jam</option>
                                        <option value="2">2 jam</option>
                                        <option value="3">3 jam</option>
                                    </select>
                                    <?= form_error('durasi', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Total Harga</label>
                            <input type="text" class="form-control" id="total_harga" name="total_harga" value="0" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Lanjutkan</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- <div class="row-mt-3">
            <div class="col-lg-3">
                <input type="date" class="form-control" name="" id="">
            </div>
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Harga (Rp)</th>
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </div>

    <!-- end container -->

    </div>