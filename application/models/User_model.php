<?php

class User_model extends CI_Model
{
    public function getUser()
    {
        return $this->db->get('user')->result_array();
    }

    public function getUserById($id)
    {
        return $this->db->get_where('user ', ['id' => $id])->row_array();
    }

    public function editUser()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');

        $this->db->set('name', $name);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function getById($id_book)
    {
        return $this->db->get_where('booking', ['id_book' => $id_book])->row_array();
    }

    public function riwayat()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $user['id'];

        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('booking', 'booking.id_book = pembayaran.id_book');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get()->result_array();
        return $query;

        // $query = "SELECT transaksi.id_user,pembayaran.id_book,transaksi.nama,transaksi.id_lap,transaksi.nama_lap,transaksi.tgl_book,transaksi.tgl_main,transaksi.jam_mulai,transaksi.jam_berakhir,transaksi.total_harga,transaksi.status,pembayaran.upload_bukti,pembayaran.status_bayar
        // FROM transaksi
        // JOIN pembayaran ON pembayaran.id_book=transaksi.id_book WHERE id_user = $id_user
        // ";
        // return $this->db->query($query)->result_array();
    }
}
