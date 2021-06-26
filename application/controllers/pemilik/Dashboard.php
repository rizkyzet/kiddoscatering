<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // not_logged_in();
        // role_logged_in();
    }
    public function index()
    {
        var_dump($this->uri->segment(1));
        var_dump($this->session->userdata());
    }
}
