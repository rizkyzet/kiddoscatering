<?php

use Mpdf\Mpdf;

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pemesanan_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Kelas_model');
        $this->load->model('Mycal_model');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('date');
        $params = array('server_key' => 'SB-Mid-server-3_lCIgT7LKhpfV58lr-WUbmt', 'production' => false);
        $this->load->library('veritrans');
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->veritrans->config($params);
        role_logged_in();
        not_logged_in();
    }

    public function index()
    {

        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['pesanan'] = $this->Pemesanan_model->get_pesanan(['nis' => $this->session->userdata('nis')]);


        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('pelanggan/pesanan/form_pesanan_index');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function detail_pembayaran($no_pemesanan)
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['pesanan'] = $this->Pembayaran_model->get_pembayaran_join_pemesanan(['pemesanan.no_pemesanan' => $no_pemesanan]);
        $data['detail_pesanan_pending'] = $this->Pemesanan_model->tampung_detail_pemesanan($no_pemesanan);

        $month = date('m', strtotime($data['pesanan']['tgl_mulai']));
        $data['template_tanggal'] = $this->Pemesanan_model->template_tanggal($month);
        $data['template_hari'] = $this->Pemesanan_model->template_hari($month);


        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        if ($data['pesanan']['status_pembayaran'] == 'settlement') {

            $this->load->view('pelanggan/pesanan/form_pesanan_detail_pembayaran_settlement');
        } elseif ($data['pesanan']['status_pembayaran'] == 'pending') {
            $this->load->view('pelanggan/pesanan/form_pesanan_detail_pembayaran');
        }

        $this->load->view('templates_stisla_dashboard/footer');
    }


    public function detail_pemesanan($no_pemesanan)
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['kelas'] = $this->Kelas_model->get_spesific_kelas(['id_kelas' => $data['siswa']['id_kelas']]);
        $data['pemesanan'] = $this->Pembayaran_model->get_pembayaran_join_pemesanan(['pemesanan.no_pemesanan' => $no_pemesanan]);
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

        $tahun = date('Y', strtotime($data['pemesanan']['tgl_pesan']));
        $bulan = date('m', strtotime($data['pemesanan']['tgl_pesan']));
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
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/pesanan/form_detail_pemesanan');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function edit_pemesanan($no_pemesanan)
    {


        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['pemesanan_header'] = $this->Pemesanan_model->get_pemesanan(['no_pemesanan' => $no_pemesanan]);
        $data['detail_pemesanan'] = $this->Pemesanan_model->get_detail_pemesanan(['no_pemesanan' => $no_pemesanan]);
        $tahun = date('Y', strtotime($data['pemesanan_header']['tgl_pesan']));
        $bulan = date('m', strtotime($data['pemesanan_header']['tgl_pesan']));

        $data['calendar'] = "<tr>
        <th >Min</th>
        <th>Sen</th>
        <th>Sel</th>
        <th>Rab</th>
        <th>Kam</th>
        <th>Jum</th>
        <th>Sab</th>
    </tr>";
        $data['calendar'] .= $this->Mycal_model->getCalendarPemesanan($tahun, $bulan, 'edit', $no_pemesanan);

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/pesanan/form_edit_pemesanan');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function save_edit_pemesanan()
    {
        $tanggal = $this->input->post('tanggal');
        $id = $this->input->post('id');
        $pesan = $this->input->post('pesanan');

        $data = ['pesan' => $pesan];
        $where = ['id' => $id, 'tgl_detail' => $tanggal];

        $this->db->update('detail_pemesanan', $data, $where);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
                <div class="alert-title">Berhasil !</div>
Pesanan tanggal ' . date('d', strtotime($tanggal)) . ' Berhasil Diubah !
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    }

    public function verify_pembayaran($no_pembayaran)
    {
        $result = $this->db->get_where('pembayaran', ['no_pembayaran' => $no_pembayaran])->row_array();
        $check = get_object_vars($this->midtrans->status($no_pembayaran));

        if ($result['status_pembayaran'] !== $check['transaction_status']) {
            $this->db->update('pembayaran', ['status_pembayaran' => $check['transaction_status'], 'tanggal_dibayar' => $check['settlement_time']], ['no_pembayaran' => $no_pembayaran]);
            redirect('pelanggan/pesanan/');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
                <div class="alert-title">Gagal Verify !</div>
Anda belum melakukan pembayaran, mohon segeran dibayar !
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');

            redirect('pelanggan/pesanan/');
        }
    }

    public function batalkan_transaksi($no_pembayaran)
    {
        if ($this->veritrans->cancel($no_pembayaran) == '200') {
            $this->Pembayaran_model->update_pembayaran_cancel($no_pembayaran);
            redirect('pelanggan/pesanan/');
        } else {

            redirect('pelanggan/pesanan/');
        }
    }


    public function print()
    {

        $data['users'] = array(
            array('firstname' => 'Agung', 'lastname' => 'Setiawan', 'email' => 'ag@setiawan.com'),
            array('firstname' => 'Hauril', 'lastname' => 'Maulida Nisfar', 'email' => 'hm@setiawan.com'),
            array('firstname' => 'Akhtar', 'lastname' => 'Setiawan', 'email' => 'akh@setiawan.com'),
            array('firstname' => 'Gitarja', 'lastname' => 'Setiawan', 'email' => 'git@setiawan.com')
        );

        $html = $this->load->view('pelanggan/pesanan/table_report', $data, true);

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }



    public function lihat_pesanan()
    {

        $this->load->model('Mycal_model');

        $no_pemesanan = $this->input->post('no_pemesanan');
        $pemesanan = $this->db->get_where('pemesanan', ['no_pemesanan' => $no_pemesanan])->row_array();
        $year = date('Y', strtotime($pemesanan['tgl_mulai']));
        $month = date('m', strtotime($pemesanan['tgl_mulai']));
        $calendar = "<tr>
        <th >Min</th>
        <th>Sen</th>
        <th>Sel</th>
        <th>Rab</th>
        <th>Kam</th>
        <th>Jum</th>
        <th>Sab</th>
    </tr>";
        $calendar .= $this->Mycal_model->getcalendar($year, $month, $no_pemesanan);

        echo $calendar;
    }
}
