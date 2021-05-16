<?php

class Validation_model extends CI_Model
{


    public function my_password_check($password)
    {
        $user_password = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($password) {
            if (password_verify($password, $user_password['password'])) {
                return true;
            } else {
                $this->form_validation->set_message('my_password_check', 'Bukan password anda!');
                return false;
                die;
            }
        } else {
            $this->form_validation->set_message('my_password_check', 'Password harus diisi!');
            return false;
        }
    }
}
