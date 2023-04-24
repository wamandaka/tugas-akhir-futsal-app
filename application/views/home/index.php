<!-- Topbar Navbar -->



<div class="container">
    <!-- <div class="preloader">
        <div class="loading">
            <img src="" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div> -->

    <?= $this->session->flashdata('message') ?>

    <!-- heading -->
    <div class="row">
        <h1 class="d-flex justify-content-center heading">Selamat datang!</h1>
    </div>
    <!-- end of heading -->

    <!-- Hero/carousel -->
    <div class="row">
        <div id="carouselExampleControls" class="carousel slide hero" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= base_url('') ?>assets/img/lapangan1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('') ?>assets/img/lapangan.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('') ?>assets/img/lapangan2.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- end of Hero -->


    <div class="row">
        <h1 class="d-flex justify-content-center heading">List Lapangan</h1>
    </div>

    <!-- card/lapangan -->
    <div data-aos="fade-up">
        <div class="row card-lp">
            <?php foreach ($lapangan as $lp) : ?>
                <div class="col-lg-6">
                    <div class="card mb-3 shadow">
                        <img src="<?= base_url('assets/img/' . $lp['gambar']) ?>" class="card-img-top" height="200px" alt="...">
                        <div class="card-body">
                            <h4 class="card-title mb-3"><?= $lp['nama'] ?></h4>
                            <p class="card-text">Jenis: <?= $lp['jenis'] ?></p>
                            <p class="card-text">Harga: Rp. <?= $lp['harga'] ?> /jam</p>
                            <p class="card-text">Harga Malam <b>(00:00 - 05:00)</b>: Rp. <?= $lp['harga_malam'] ?> /jam </p>
                            <?php if ($this->session->userdata('email') == true) : ?>
                                <a href="<?= base_url('home/booking/' . $lp['id']) ?>" class="btn btn-primary">Booking</a>
                            <?php else : ?>
                                <a class="btn btn-primary" onclick="Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Harap login terlebih dahulu!',
                                    footer: '<a href=auth>Klik disini untuk Login.</a>'
                                })">Booking</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- end of lapangan -->


    <!-- end container -->
</div>