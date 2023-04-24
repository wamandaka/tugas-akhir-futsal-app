      <!-- footer -->
      <div class="row-lg footer">
          <div class="copyright text-center my-auto">
              <br><br><br>
              <span> &copy; Waman D. Wardani TA <?= date('Y') ?></span>
          </div>
      </div>
      <!-- end of footer -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
      </a>

      <!-- Core plugin JavaScript-->
      <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

      <!-- Bootstrap JS -->
      <script src="<?= base_url() ?>assets/vendor/jquery/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

      <!-- AOS -->
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script>
          AOS.init();
      </script>

      <!-- SweetAlert JS -->
      <script src="<?= base_url('assets/dist/sweetalert2.all.min.js') ?>"></script>
      <script>
          $('.tombol-logout').on('click', function(e) {
              e.preventDefault();
              const href = $(this).attr('href');

              Swal.fire({
                  title: 'Anda yakin?',
                  text: "klik tombol logout untuk keluar",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Logout'
              }).then((result) => {
                  if (result.isConfirmed) {
                      document.location.href = href;
                  }
              })
          })
      </script>
      <!-- <script>
          Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1500
          })
      </script> -->


      <!-- My Custom JS -->
      <script src="<?= base_url('assets/dist/myscript.js') ?>"></script>

      <!-- Total Harga -->
      <script>
          function startCalc() {

              interval = setInterval("calc()", 1);
          }

          function calc() {
              var jam_mulai = document.booking.jam_mulai.value;

              one = document.booking.harga.value;

              two = document.booking.durasi.value;

              three = document.booking.harga_malam.value;

              if (jam_mulai == '00:00') {
                  document.booking.total_harga.value = (three * 1) * (two * 1);
              } else if (jam_mulai == '01:00') {
                  document.booking.total_harga.value = (three * 1) * (two * 1);
              } else if (jam_mulai == '02:00') {
                  document.booking.total_harga.value = (three * 1) * (two * 1);
              } else if (jam_mulai == '03:00') {
                  document.booking.total_harga.value = (three * 1) * (two * 1);
              } else if (jam_mulai == '04:00') {
                  document.booking.total_harga.value = (three * 1) * (two * 1);
              } else if (jam_mulai == '05:00') {
                  document.booking.total_harga.value = (three * 1) * (two * 1);
              } else {
                  document.booking.total_harga.value = (one * 1) * (two * 1);
              }

          }

          function stopCalc() {

              clearInterval(interval);
          }
      </script>

      </body>

      </html>