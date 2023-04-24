<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        // untuk menampilkan title pada view
        $data['title'] = 'Home';
        // untuk menampilkan titlenav pada view
        $data['titlenav'] = 'FUTSAL';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // mengambil data dari database table lapangan
        $data['lapangan'] = $this->db->get('lapangan')->result_array();

        // menampilkan halaman view index
        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_navbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/home_footer');
    }

    // fungsi booking berdasarkan id lapangan
    public function booking($id)
    {
        // menampikan title booking pada view
        $data['title'] = 'Booking';
        // untuk menampilkan titlenav pada view
        $data['titlenav'] = 'FUTSAL';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // memanggil model lapangan_model
        $this->load->model('Lapangan_model');
        // memanggil fungsi getLapanganById dari model lapangan_model
        $data['lapangan'] = $this->Lapangan_model->getLapanganById($id);
        // memanggil model Booking_model
        $this->load->model('Booking_model');
        // memanggil fungsi cek pada Booking_model lalu di masukan ke alam variable $cek
        $cek = $this->Booking_model->cek();


        // jika session = false atau belum login maka tidak bisa melakukan booking dan akan dikembalikan ke halaman home
        if ($this->session->userdata('email') == false) {
            redirect('home');
        }

        // membuat rule form-validation
        $this->form_validation->set_rules('tanggal-main', 'Tanggal Main', 'required');
        $this->form_validation->set_rules('jam-mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required');

        $tgl_book = date('Y-m-d,H:i:s', time() + 60 * 60 * 5); //tanggal dan jam sekarang
        $batas_bayar = date('Y-m-d,H:i:s', time() + 60 * 60 * 6); //tanggal sekarang dan jam lewat 1 jam
        $jam_mulai = $this->input->post('jam-mulai', true);
        $durasi = $this->input->post('durasi', true);
        $id_book = $this->input->post('kode-booking', true);
        $id_user = $this->input->post('id_user', true);
        $id_lap = $this->input->post('id-lapangan', true);
        $nama_lap = $this->input->post('nama-lapangan', true);
        $nama = $this->input->post('nama', true);
        $tgl_main = $this->input->post('tanggal-main', true);
        $total_harga = $this->input->post('total_harga', true);
        $status = 'Belum Main';
        $tanggal = date('Y-m-d', time() + 60 * 60 * 5); //variabel dengan nilai date/tanggal sekarang
        $jam = date('H:i:s', time() + 60 * 60 * 5); ////variabel dengan nilai time/jam sekarang

        // jika form validation = false maka tampilkan view
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/home_header', $data);
            $this->load->view('templates/home_navbar', $data);
            $this->load->view('home/booking', $data);
            $this->load->view('templates/home_footer');

            // jika variable cek lebih besar dari nol maka tampilkan pesan
        } elseif ($cek > '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jam mulai sudah dipesan orang lain!</div>');
            redirect('home/booking/' . $id_lap);

            // jika tgl main yg dipilih = tgl sekarang dan jam mulai lebih kecil dari jam sekarang maka tampilkan pesan
        } elseif ($tgl_main == $tanggal && $jam_mulai < $jam) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jam mulai Kadaluarsa!</div>');
            redirect('home/booking/' . $id_lap);

            // jika tgl main yg dipilih lebih kecil dari tgl sekarang maka tampilkan pesan
        } elseif ($tgl_main < $tanggal) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tanggal main kadaluarsa!</div>');
            redirect('home/booking/' . $id_lap);

            // jika sekiranya data sudah bisa untuk melakukan pemesanan maka lakukan input data kedalam database table Booking
        } else {
            $jam_berakhir = $jam_mulai + $durasi . ":00:00";
            $data = [
                'id_book' => $id_book,
                'id_user' => $id_user,
                'nama' => $nama,
                'id_lap' => $id_lap,
                'nama_lap' => $nama_lap,
                'tgl_book' => $tgl_book,
                'batas_bayar' => $batas_bayar,
                'tgl_main' => $tgl_main,
                'jam_mulai' => $jam_mulai,
                'jam_berakhir' => $jam_berakhir,
                'total_harga' => $total_harga,
                'status' => $status
            ];
            $this->db->insert('booking', $data);
            redirect('home/pembayaran?kd=' . $id_book);
        }
    }

    // fungsi pembayaran
    public function pembayaran()
    {
        // menampilkan title di view
        $data['title'] = 'Pembayaran';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // vatiable id_book berupa input post
        $id_book = $this->input->post('kode-booking');

        // jika session = false atau belum login maka akan dikirim ke view home
        if ($this->session->userdata('email') == false) {
            redirect('home');
        }

        // membuat rules form validation
        $this->form_validation->set_rules('kode-booking', 'Kode Booking', 'required');
        $this->form_validation->set_rules('rekening-pengirim', 'Rekening Pengirim', 'required');
        $this->form_validation->set_rules('rekening-tujuan1', 'Rekening Tujuan', 'required');
        $this->form_validation->set_rules('rekening-tujuan2', 'Rekening Tujuan', 'required');

        // jika form validation = false maka tampilkan view pembayaran
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/home_header', $data);
            $this->load->view('home/pembayaran', $data);
            $this->load->view('templates/home_footer');
        }

        // variable config
        $config = [
            'upload_path' => './assets/img/bukti_bayar',
            'allowed_types' => 'jpg|png'
        ];
        // memanggil library
        $this->load->library('upload', $config);

        // jika upload gagal maka tampilkan pesan error
        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            // jika upload berhasil maka lakukan input data kedalam database table pembayaran
        } else {
            $upload_bukti = $this->upload->data();
            $gambar = $upload_bukti['file_name'];
            $id_book = $this->input->post('kode-booking', true);
            $rek_pengirim = $this->input->post('rekening-pengirim', true);
            $rek_tujuan = $this->input->post('rekening-tujuan', true);
            $status  = 'Pending';

            $data = [
                'id_book' => $id_book,
                'rek_pengirim' => $rek_pengirim,
                'rek_tujuan' => $rek_tujuan,
                'upload_bukti' => $gambar,
                'status_bayar' => $status
            ];

            $this->db->insert('pembayaran', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran berhasil! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('home');
        }
    }
}
