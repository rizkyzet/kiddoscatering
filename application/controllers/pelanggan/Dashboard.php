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

        $this->db->select('*');
        $this->db->from('pemesanan');
        $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan');
        $this->db->where(['tgl_detail' => date('Y-m-d'), 'status_pemesanan' => 'settlement', 'nis' => $data['user']['nis']]);
        $pesananHariIni = $this->db->get()->row_array();
        $data['today'] = $pesananHariIni;

        $this->db->limit(3);
        $this->db->order_by('tanggal_dibuat', 'DESC');
        $data['pending'] = $this->db->get_where('pemesanan', ['nis' => $data['user']['nis'], 'status_pemesanan' => 'pending'])->result_array();

        $this->db->limit(3);
        $this->db->order_by('tanggal_dibuat', 'DESC');
        $data['settlement'] = $this->db->get_where('pemesanan', ['nis' => $data['user']['nis'], 'status_pemesanan' => 'settlement'])->result_array();

        $this->db->limit(3);
        $this->db->order_by('tanggal_dibuat', 'DESC');
        $data['cancel'] = $this->db->get_where('pemesanan', ['nis' => $data['user']['nis'], 'status_pemesanan' => 'cancel'])->result_array();

        $this->db->limit(3);
        $this->db->order_by('tanggal_dibuat', 'DESC');
        $data['expire'] = $this->db->get_where('pemesanan', ['nis' => $data['user']['nis'], 'status_pemesanan' => 'expire'])->result_array();


        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/dashboard');
        $this->load->view('templates_stisla_dashboard/footer');
    }
}
