<?php
defined('BASEPATH') or exit('No direct script access allowed');


use Dompdf\Dompdf;



class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model');
    }

    public function index()
    {
        // menampilkan title pada view
        $data['title'] = 'My Profile';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // tampikan view 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        // tampilkan title pada view
        $data['title'] = 'Edit Profile';
        // mengmbil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        // membuat rules form validation
        $this->form_validation->set_rules('name', 'Full name', 'required|trim');

        // jika form validation = false maka tampilkan view
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
            // jika berhasil maka lakukan fungi edituser
        } else {
            $this->User_model->editUser();

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                    $email = $this->input->post('email');
                    $this->db->where('email', $email);
                    $this->db->update('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user');
                }
            }

            // --jika tidak menggunakan model--
            // $name = $this->input->post('name');
            // $email = $this->input->post('email');

            // $this->db->set('name', $name);
            // $this->db->where('email', $email);
            // $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function changepassword()
    {
        // tampilkan title pada view
        $data['title'] = 'Change Password';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // membuat rules formvalidation
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[4]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[4]|matches[new_password1]');

        // jika form validation = false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            // jika password yg di masukan tidak sama dengan password current/yg lama
            if (!password_verify($current_password, $data['user']['password'])) {
                // maka tampilkan pesan gagal ubah password lalu
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
                // kembalikan ke tampilan changepassword
                redirect('user/changepassword');
                // jika password baru sama dengan password yg lama
            } else {
                if ($current_password == $new_password) {
                    // maka tampilakan pesan password tidak boleh sama
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same as Current Password!</div>');
                    // lalu dikembalikan ke tampilan changepassword
                    redirect('user/changepassword');
                } else {
                    // jika password sudah oke
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user');
                }
            }
        }
    }


    public function riwayat()
    {
        // tampilkan title pada view
        $data['title'] = 'Riwayat Pemesanan';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // memanggil fungsi riwayat yg ada pada model user_model
        $data['riwayat'] = $this->User_model->riwayat();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/riwayat', $data);
        $this->load->view('templates/footer');
    }

    public function cetak($id_book)
    {
        $data['title'] = 'Detail Riwayat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['detail'] = $this->User_model->getById($id_book);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/cetak', $data);
        $this->load->view('templates/footer');

        $this->load->library('pdf');
        $html = $this->load->view('user/cetak', $data, true);
        $this->pdf->createPDF($html, 'mypdf', false);
    }

    // public function pdf()
    // {


    //     // $dompdf = new Dompdf();
    //     // $data['title'] = 'Detail Riwayat';
    //     // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     // $data['detail'] = $this->User_model->riwayat();
    //     // $view = $this->load->view('user/cetak', []);
    //     // // $html = $this->output->get_output();
    //     // $dompdf->loadHtml($view);

    //     // // (Optional) Setup the paper size and orientation
    //     // $dompdf->setPaper('A4', 'portrait');

    //     // // Render the HTML as PDF
    //     // $dompdf->render();

    //     // // Output the generated PDF to Browser
    //     // $dompdf->stream('doc.pdf', ['Attachment' => false]);


    //     $data['title'] = 'Detail Riwayat';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['detail'] = $this->User_model->riwayat();
    //     $this->load->library('pdf');
    //     $html = $this->load->view('user/cetak', [], true);
    //     $this->pdf->createPDF($html, 'mypdf', false);
    // }
}
