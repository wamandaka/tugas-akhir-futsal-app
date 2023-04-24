<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Booking_model');
    }

    public function index()
    {
        // untuk menampilkan title pada view
        $data['title'] = 'Dashboard';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // me-load data dari model Booking pada function konfirmasi
        $data['konfirmasi'] = $this->Booking_model->konfirmasi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        // untuk menampilkan title pada view
        $data['title'] = 'Role';
        // mengambil data dari database table user 
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // mengambil data dari database table user_role
        $data['role'] = $this->db->get('user_role')->result_array();

        // membuat rule form validation
        $this->form_validation->set_rules('role', 'Role', 'required');

        // jika form validation = false maka tampilkan view
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            // jika berhasil maka lakukan input data
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role has been added.</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    {
        // untuk menampilkan title pada view
        $data['title'] = 'Role Access';
        // mengambil data dari database table user 
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // mengambil data dari database table user_role
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/footer');
    }

    // fungsi hapus role
    public function deleterole($id)
    {
        // memanggil data dari model role_model lalu menginisialisasi menjadi role
        $this->load->model('Role_model', 'role');
        // memanggil fungsi deleterole dari model
        $this->role->deleteRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been successfully deleted.</div>');
        redirect('admin/role');
    }

    // fungsi ubah role
    public function updaterole($id)
    {
        // memanggil model role_model
        $this->load->model('Role_model');
        // memanggil fungsi getrole dari model role_model
        $data['role'] = $this->role_model->getRole($id);
        // memanggil fungsi update role pada model
        $this->Role_model->updateRole();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been successfully updated.</div>');
        redirect('admin/role');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access changed!</div>');
    }

    // public function lapangan()
    // {
    //     // untuk menampilkan title pada view
    //     $data['title'] = 'Lapangan';
    //     // mengambil data dari database table user
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     // mengambil data dari database table lapangan
    //     $data['lapangan'] = $this->db->get('lapangan')->result_array();

    //     // membuat rule form validation
    //     $this->form_validation->set_rules('nama', 'Nama', 'required');
    //     $this->form_validation->set_rules('jenis', 'Jenis', 'required');
    //     $this->form_validation->set_rules('harga', 'Harga', 'required');
    //     $this->form_validation->set_rules('harga_weekend', 'Harga Weekend', 'required');
    //     $this->form_validation->set_rules('gambar', 'Gambar', 'required');

    //     // jika form validation = false maka tampilkan view lapangan
    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('admin/lapangan', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         // jika berhasil maka lakukan input data kedalam table lapangan
    //         $data = [
    //             'nama' => $this->input->post('nama'),
    //             'jenis' => $this->input->post('jenis'),
    //             'harga' => $this->input->post('harga'),
    //             'gambar' => $this->input->post('gambar')
    //         ];
    //         $this->db->insert('lapangan', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Lapangan baru berhasil ditambahkan!</div>');
    //         redirect('admin/lapangan');
    //     }
    // }

    public function hapuslapangan($id)
    {
        // me-load model lapangan model
        $this->load->model('Lapangan_model', 'lapangan');
        // memanggil function hapus lapangan dari model lapangan_model
        $this->lapangan->hapusLap($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Lapangan berhasil dihapus.</div>');
        redirect('admin/lapangan');
    }

    public function konfirmasi($id_book)
    {
        // untuk menampilkan title pada view
        $data['title'] = 'Konfirmasi Pembayaran';
        // mengambil data dari databse table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // memanggil fungsi getbyid dari model Booking_model
        $data['konfirmasi'] = $this->Booking_model->getById($id_book);

        // membuat rule form validation
        $this->form_validation->set_rules('status_bayar', 'Status Bayar', 'required');

        // jika form validation = false maka tampilkan view konfirpembayaran
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/konfirpembayaran', $data);
            $this->load->view('templates/footer');
        } else {
            // jika berhasil maka jalankan fungsi ubahStatus yang ada pada model Booking_model
            $this->Booking_model->ubahStatus();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Konfirmasi berhasil!</div>');
            redirect('admin');
        }
    }
}
