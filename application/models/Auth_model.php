<?php

class Auth_model extends CI_Model
{

    public function cek_login($email)
    {
        $query = $this->db->get_where('user', ['email' => $email])->row_array();
        return $query;
    }

    public function get_siswa_user($account_id)
    {
        $query = $this->db->get_where('siswa', ['account_id' => $account_id])->row_array();
        return $query;
    }

    public function check_nis($nis)
    {
        $query = $this->db->get_where('siswa', ['nis' => $nis]);
        return $query;
    }

    public function register_user($data)
    {
        $query = $this->db->insert('user', $data);
    }

    public function verify_user($email)
    {
        $query = $this->db->update('user', ['aktif' => 1], ['email' => $email]);
    }

    public function verify_user_siswa($user_id, $nis)
    {
        $query = $this->db->update('siswa', ['account_id' => $user_id], ['nis' => $nis]);
    }
}
