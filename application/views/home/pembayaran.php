<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">


    <!-- navbar -->
    <!-- <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url('home') ?>">
                    <img src="<?= base_url('') ?>assets/img/soccer-ball.png" alt="" width="30" class="d-inline-block align-text-top">
                    Tiki Taka
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if ($this->session->userdata('email') == false) : ?>
                        <li class="nav-item">
                            <a class="nav-link register tombol" href="<?= base_url('auth/registration') ?>">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger tombol" href="<?= base_url('auth') ?>">Login</a>
                        </li>
                    <?php else : ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown"><img class="rounded-circle" width="30" height="30px" src="<?= base_url('assets/img/profile/' . $user['image']) ?>" alt=""> <?= $user['name'] ?></a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <?php if ($user['role_id'] == 1) : ?>
                                    <li><a class="dropdown-item" href="<?= base_url('admin') ?>">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a></li>
                                <?php else : ?>
                                    <li><a class="dropdown-item" href="<?= base_url('user') ?>">My Profile</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </nav> -->

    <!-- end of navbar -->
    <div class="container">
        <!-- heading -->
        <div class="row mt-3">
            <h1 class="d-flex justify-content-center heading">Silahkan lakukan pembayaran</h1>
        </div>
        <?php $kd = $this->input->get('kd'); ?>
        <!-- end of heading -->
        <div class="row">
            <div class="d-flex justify-content-center">
                <?= form_open_multipart('home/pembayaran') ?>
                <?= $this->session->flashdata('message') ?>
                <div class="form-group mb-3">
                    <label for="kode-booking">Kode Booking</label>
                    <input type="text" class="form-control" id="kode-booking" name="kode-booking" value="<?= set_value('kode-booking') . $kd; ?>" readonly required>
                    <?= form_error('kode-booking', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group mb-3">
                    <label for="rekening-pengirim">Rekening Pengirim</label>
                    <input type="text" class="form-control" id="rekening-pengirim" name="rekening-pengirim" required>
                    <?= form_error('rekening-pengirim', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <label for="rekening-penerima">Rekening Tujuan</label>
                <div class="form-group mb-3">
                    <input class="form-group-input" type="radio" name="rekening-tujuan" id="rekening-tujuan1" value="bca">
                    <label class="form-group-label" for="rekening-tujuan1"><img src="<?= base_url('assets/img/bca.png') ?>" width="100px" alt=""> (xxxx-xxxx-xxxx-xxxx) A/n. fulan</label>
                </div>
                <?= form_error('rekening-tujuan1', '<small class="text-danger pl-3">', '</small>') ?>
                <div class="form-group mb-3">
                    <input class="form-group-input" type="radio" name="rekening-tujuan" id="rekening-tujuan2" value="bri">
                    <label class="form-group-label" for="rekening-tujuan2"><img src="<?= base_url('assets/img/bri.jpg') ?>" width="100px" height="40" alt=""> (xxxx-xxxx-xxxx-xxxx) A/n. fulan</label>
                </div>
                <?= form_error('rekening-tujuan2', '<small class="text-danger pl-3">', '</small>') ?>
                <div class="form-group mb-3">
                    <input class="form-group-input" type="radio" name="rekening-tujuan" id="rekening-tujuan3" value="ovo">
                    <label class="form-group-label" for="rekening-tujuan3"><img src="<?= base_url('assets/img/ovo.png') ?>" width="100px" height="40" alt=""> (xxxx-xxxx-xxxx-xxxx) A/n. fulan</label>
                </div>
                <?= form_error('rekening-tujuan2', '<small class="text-danger pl-3">', '</small>') ?>
                <div class="form-group mb-3">
                    <input class="form-group-input" type="radio" name="rekening-tujuan" id="rekening-tujuan4" value="dana">
                    <label class="form-group-label" for="rekening-tujuan4"><img src="<?= base_url('assets/img/dana.jpg') ?>" width="100px" height="40" alt=""> (xxxx-xxxx-xxxx-xxxx) A/n. fulan</label>
                </div>
                <?= form_error('rekening-tujuan2', '<small class="text-danger pl-3">', '</small>') ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <label for="image" class="form-group-label">Upload bukti</label>
                                <input class="form-group-input" type="file" id="image" name="image">
                                <small>Max 2mb</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-3">Bayar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- end container -->
    </div>