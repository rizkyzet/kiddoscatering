<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_logged_in();
        role_logged_in();
    }
    public function index()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('templates_stisla_dashboard/blank');
        $this->load->view('templates_stisla_dashboard/footer');
    }
}
