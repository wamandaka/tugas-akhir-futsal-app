<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        // menampilkan title pada view
        $data['title'] = 'Menu Management';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // mengambil data pada database table user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // membuat rules form validation
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        // jika form validation = false maka tampilkan view index
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');

            // jika berhasil maka jalankan fungsi insert
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu has been added.</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        // tampilkan title pada view
        $data['title'] = 'Submenu Management';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // memanggil model menu model
        $this->load->model('Menu_model', 'menu');

        // memanggil fungsi getsubmenu pada model menu
        $data['subMenu'] = $this->menu->getSubMenu();
        // mengambil data dari database table user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // membuar rules form validation
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        // jika form validation = false maka tamppilkan view
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');

            // jika berhasil maka jalankan fungsi insert
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu has been added.</div>');
            redirect('menu/submenu');
        }
    }

    public function deletemenu($id)
    {
        // memanggil model menu model
        $this->load->model('Menu_model', 'menu');
        // memanggil fungsi deletemenu
        $this->menu->deleteMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been successfully deleted.</div>');
        redirect('menu');
    }

    public function deletesubmenu($id)
    {
        // memanggil model menu model
        $this->load->model('Menu_model', 'menu');
        // memanggil fjngsi deletesubmenu
        $this->menu->deleteSubMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu has been successfully deleted.</div>');
        redirect('menu/submenu');
    }

    public function edit($id)
    {
        // menampilkan title pada view
        $data['title'] = 'Edit Submenu';
        // mengambil data dari database table user
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // memanggil model menu model
        $this->load->model('Menu_model');
        // memanggil fungsi getsubmenubyid dari model menu model
        $data['submenu'] = $this->Menu_model->getSubMenuById($id);

        // membuat rules form validation
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        // jika form validation = false maka tampilkan view
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editsubmenu', $data);
            $this->load->view('templates/footer');

            // jika berhasil maka jalankan fungsi edit
        } else {
            $this->Menu_model->editsubmenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu hasbeen updated.</div>');
            redirect('menu/submenu');
        }
    }
}
