<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lapangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
    }

    public function index()
    {
        if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        }
        // untuk menampilkan title pada view
        $data['title'] = 'Lapangan';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // mengambil data dari database table lapangan
        $data['lapangan'] = $this->db->get('lapangan')->result_array();

        // membuat rule form validation
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('harga_malam', 'Harga Malam', 'required');
        // $this->form_validation->set_rules('gambar', 'Gambar', 'required');

        // jika form validation = false maka tampilkan view lapangan
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/lapangan', $data);
            $this->load->view('templates/footer');
        } else {

            // variable config
            $config = [
                'upload_path' => './assets/img',
                'allowed_types' => 'jpg|png'
            ];
            // memanggil library
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $g = $this->upload->data();
                $gambar = $g['file_name'];
                // jika berhasil maka lakukan input data kedalam table lapangan
                $data = [
                    'nama' => $this->input->post('nama'),
                    'jenis' => $this->input->post('jenis'),
                    'harga' => $this->input->post('harga'),
                    'harga_malam' => $this->input->post('harga_malam'),
                    'gambar' => $gambar
                ];
                $this->db->insert('lapangan', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Lapangan baru berhasil ditambahkan!</div>');
                redirect('lapangan');
            }
        }
    }

    public function hapuslapangan($id)
    {
        // me-load model lapangan model
        $this->load->model('Lapangan_model', 'lapangan');
        // memanggil function hapus lapangan dari model lapangan_model
        $this->lapangan->hapusLap($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Lapangan berhasil dihapus.</div>');
        redirect('lapangan');
    }
}
