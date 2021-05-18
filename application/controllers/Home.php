<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller

{

	public function __construct()
	{

		parent::__construct();
		$this->encryption->initialize(
			array(
				'cipher' => 'aes-256',
				'mode' => 'ctr',
				'key' => 'fc725b30f37d52c46c478d23cda80e7d'
			)
		);
	}


	public function index()
	{



		$data['user'] = $this->User_model->get_user_by_login();
		$this->load->view('templates_homepage/header', $data);
		$this->load->view('templates_homepage/navbar');
		$this->load->view('homepage/beranda/beranda');
		$this->load->view('templates_homepage/footer');
	}
}
