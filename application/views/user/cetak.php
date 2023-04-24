<div class="container-lg">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1> -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ID : <?= $detail['id_book'] ?></h5>
                    <p class="card-text">Tanggal Booking : <?= $detail['tgl_book'] ?></p>
                    <p class="card-text">Tanggal Main : <?= $detail['tgl_main'] ?></p>
                    <p class="card-text">Jam Mulai : <?= $detail['jam_mulai'] ?></p>
                    <p class="card-text">Jam Berakhir : <?= $detail['jam_berakhir'] ?></p>
                    <p class="card-text">Total Harga : <?= $detail['total_harga'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>