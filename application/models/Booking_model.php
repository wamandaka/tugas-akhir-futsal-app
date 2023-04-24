<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{



    public function cek()
    {
        $jam_mulai = $this->input->post('jam-mulai');
        $id_lap = $this->input->post('id-lapangan');
        $tgl_main = $this->input->post('tanggal-main');

        $query = "SELECT * FROM booking WHERE id_lap = '$id_lap' && tgl_main = '$tgl_main' && jam_mulai <= '$jam_mulai' && jam_berakhir > '$jam_mulai' ORDER BY tgl_book";
        return $this->db->query($query)->row_array();
    }

    public function konfirmasi()
    {
        $this->db->select('*');
        $this->db->from('booking');
        $this->db->join('pembayaran', 'pembayaran.id_book=booking.id_book');
        $this->db->order_by('tgl_book');
        $query = $this->db->get()->result_array();
        return $query;

        // $query = "SELECT Booking.id_user,pembayaran.id_book,transaksi.nama,transaksi.id_lap,transaksi.nama_lap,transaksi.tgl_book,transaksi.tgl_main,transaksi.jam_mulai,transaksi.jam_berakhir,transaksi.total_harga,transaksi.status,pembayaran.upload_bukti,pembayaran.status_bayar
        // FROM transaksi
        // JOIN pembayaran ON pembayaran.id_book=transaksi.id_book ORDER BY tgl_main, jam_mulai asc
        // ";

        // return $this->db->query($query)->result_array();

    }

    public function getById($id_book)
    {
        return $this->db->get_where('pembayaran', ['id_book' => $id_book])->row_array();
    }

    public function ubahStatus()
    {
        $data = [
            "status_bayar" => $this->input->post('status_bayar')
        ];

        $this->db->where('id_book', $this->input->post('id_book'));
        $this->db->update('pembayaran', $data);
    }
}
