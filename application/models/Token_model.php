<?php

class Token_model extends CI_Model
{
    public function get_spesific_token($where)
    {
        $query = $this->db->get_where('user_token', $where)->row_array();
        return $query;
    }

    public function insert_token($data_token)
    {
        $query = $this->db->insert('user_token', $data_token);
    }

    public function delete_token($where)
    {

        $query = $this->db->delete('user_token', $where);
    }
}
