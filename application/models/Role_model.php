<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    public function getRole($id)
    {
        return $this->db->get_where('user_role ', ['id' => $id])->row_array();
    }

    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }

    public function updateRole()
    {
        $data = [
            "role" => $this->input->post('role', true)
        ];

        $this->db->where('id', $this->uri->segment(3));
        $this->db->update('user_role', $data);
    }
}
