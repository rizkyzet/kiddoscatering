<?php

class About extends CI_Controller
{

    public function index()
    {

        $data['user'] = $this->User_model->get_user_by_login();

        $this->load->view('templates_homepage/header', $data);
        $this->load->view('templates_homepage/navbar');
        $this->load->view('homepage/beranda/beranda');
        $this->load->view('templates_homepage/footer');
    }
}
