<?php

class User_model extends CI_Model
{
    public function get_spesific_user($where)
    {
        $query = $this->db->get_where('user', $where)->row_array();
        return $query;
    }

    public function update_user($data, $where)
    {
        $this->db->update('user', $data, $where);
    }


    public function get_user_by_login()
    {

        if ($this->session->userdata('email')) {

            $email = $this->session->userdata('email');
            $query = $this->db->get_where('user', ['email' => $email])->row_array();
            return $query;
        } else {
            $nis = $this->session->userdata('nis');
            $query = $this->db->get_where('siswa', ['nis' => $nis])->row_array();
            return $query;
        }
    }
}
