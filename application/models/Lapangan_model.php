<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lapangan_model extends CI_Model
{
    public function getLapangan()
    {
        $query = "SELECT * FROM `lapangan`";
        return $this->db->query($query)->result_array();
    }

    public function getLapanganById($id)
    {
        return $this->db->get_where('lapangan', ['id' => $id])->result_array();
    }

    public function hapusLap($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('lapangan');
    }
}
