<?php

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pemesanan_model');
        $this->load->model('Kelas_model');
        $this->load->model('Sekolah_model');
        $this->load->helper('date');
        $this->load->model('Mycal_model');
    }

    public function index()
    {
    }

    public function data_pemesanan()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        // $data['pemesanan_header'] = $this->Pemesanan_model->get_all_pemesanan();
        $this->db->select('pemesanan.*,siswa.nama_siswa');
        $this->db->from('pemesanan');
        $this->db->join('siswa', 'siswa.nis = pemesanan.nis');
        $data['pemesanan_header'] = $this->db->get()->result_array();

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/pemesanan/form_data_pemesanan');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function detail($no_pemesanan)
    {

        $data['user'] = $this->User_model->get_user_by_login();
        $data['pemesanan'] = $this->db->get_where('pemesanan', ['no_pemesanan' => $no_pemesanan])->row_array();
        $data['siswa'] = $this->db->get_where('siswa', ['nis' => $data['pemesanan']['nis']])->row_array();
        $data['kelas'] =  $this->db->get_where('kelas', ['id_kelas' => $data['siswa']['id_kelas']])->row_array();
        $data['pesanan_pagi'] = $this->db->get_where('detail_pemesanan', ['no_pemesanan' => $no_pemesanan, 'pesan' => 'p'])->num_rows();
        $data['pesanan_siang'] = $this->db->get_where('detail_pemesanan', ['no_pemesanan' => $no_pemesanan, 'pesan' => 's'])->num_rows();
        $data['pesanan_dobel'] = $this->db->get_where('detail_pemesanan', ['no_pemesanan' => $no_pemesanan, 'pesan' => 'ps'])->num_rows();
        $data['detail_pembayaran'] = [
            'qty_pagi' => $data['pesanan_pagi'],
            'qty_siang' => $data['pesanan_siang'],
            'qty_dobel' => $data['pesanan_dobel'],
            'total_pagi' => $data['pesanan_pagi'] * 12000,
            'total_siang' => $data['pesanan_siang'] * 12000,
            'total_dobel' => $data['pesanan_dobel'] * 24000,
        ];



        $data['subtotal'] =  $data['detail_pembayaran']['total_pagi'] + $data['detail_pembayaran']['total_siang'] + $data['detail_pembayaran']['total_dobel'];

        $tahun = date('Y', strtotime($data['pemesanan']['tanggal_mulai']));
        $bulan = date('m', strtotime($data['pemesanan']['tanggal_mulai']));
        $data['calendar'] = "<tr>
        <th >Min</th>
        <th>Sen</th>
        <th>Sel</th>
        <th>Rab</th>
        <th>Kam</th>
        <th>Jum</th>
        <th>Sab</th>
    </tr>";
        $data['calendar'] .= $this->Mycal_model->getcalendar($tahun, $bulan, $no_pemesanan);

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/pemesanan/form_detail_pemesanan');
        $this->load->view('templates_stisla_dashboard/footer');
    }
}
