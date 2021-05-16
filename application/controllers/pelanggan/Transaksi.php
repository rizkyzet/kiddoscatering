<?php

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('Kelas_model');
        $this->load->model('Pemesanan_model');
        $this->load->model('Pembayaran_model');

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
        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/transaksi/form_transaksi_index');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function list_pesanan()
    {


        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);



        for ($m = 1; $m <= 12; $m++) {
            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $month_number = date('m', mktime(0, 0, 0, $m, 1, date('Y')));

            $cek_bulan = $this->db->get_where('pemesanan', ['month(tgl_mulai)' => $month_number, 'year(tgl_mulai)' => date('Y'), 'nis' => $this->session->userdata('nis')])->num_rows();

            if ($cek_bulan > 0) {

                $bulan[] = ['bulan' => $month, 'status' => 'sudah pesan'];
            } else {
                $bulan[] = ['bulan' => $month, 'status' => 'belum pesan'];
            }
        };


        $data['bulan'] = $bulan;

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/transaksi/form_transaksi_list');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function daftar($month)
    {

        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['combo_kelas'] = $this->Kelas_model->get_combo_kelas();


        $tahun_now = date('Y');
        $bulan_now = $month;
        $tanggal_now = date('d');

        $tanggal = date('Y-m-d', strtotime("$tanggal_now-$bulan_now-$tahun_now"));

        if (date('l') == 'Saturday') {
            $data['tgl_mulai'] = date('Y-m-d', strtotime("$tanggal +2 days"));
        } elseif (date('l') == 'Friday') {
            $data['tgl_mulai'] = date('Y-m-d', strtotime("$tanggal +3 days"));
        } else {
            $data['tgl_mulai'] = date('Y-m-d', strtotime("$tanggal +1 days"));
        }



        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/transaksi/form_transaksi_daftar');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function payment()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_siswa_join_kelas_sekolah(['siswa.nis' => $this->session->userdata('nis')]);


        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $pesanan = $this->Pemesanan_model->tampung_pesanan($tanggal_mulai, $this->input->post());
        $data['tanggal_template'] = $this->Pemesanan_model->template_tanggal();
        $data['hari_template'] = $this->Pemesanan_model->template_hari();
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['pesanan'] = $pesanan;
        $data['detail_bayar'] = $this->Pemesanan_model->tampung_detail_pembayaran($pesanan);
        $data['no_psn'] = no_pemesanan();
        $data['pesanan_json'] = json_encode($pesanan);
        // $data['hari_template'] = date(strtotime($data['tanggal_template']))

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/transaksi/form_transaksi_payment');
        $this->load->view('templates_stisla_dashboard/footer');
    }


    public function token()
    {

        if (!$this->input->post()) redirect('pelanggan/transaksi');

        $user = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $tgl_mulai = $this->input->post('tgl_mulai');
        $total_byr = $this->input->post('total_byr');
        $no_psn = $this->input->post('no_psn');

        $item_details = array(
            'id' => $no_psn,
            'price' => $total_byr,
            'quantity' => 1,
            'name' => "Pembayaran Catering Bulan " . getMonthIndo(date('F', strtotime($tgl_mulai)))
        );

        $transaction_details = array(
            'order_id' => no_pembayaran(),
            'gross_amount' => $total_byr, // no decimal allowed for creditcard

        );

        // Optional
        $item_details = [$item_details];



        // Optional
        $customer_details = array(
            'first_name'    => $user['nama'],
            'email'         => $user['email'],
            'phone' => $user['no_hp']

        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;
        // waktu
        $awal  = strtotime(date("Y-m-d H:i:s O", time()));
        $akhir = strtotime($tgl_mulai . ' 00:00:00');
        $diff  = $akhir - $awal;
        $jam   = floor($diff / (60 * 60));
        $menit = $diff - $jam * 60;


        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => floor($menit / 60)
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry,
            'enabled_payments' => array('bca_va', 'bni_va')
        );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }

    public function save_order()
    {


        $no_pesanan = $this->input->post('no_psn');
        $tanggal_mulai = $this->input->post('tgl_mulai');
        $pesanan = json_decode($this->input->post('pesanan'), true);
        $result = json_decode($this->input->post('result_data'), true);


        $data_pembayaran = [
            'no_pembayaran' => $result['order_id'],
            'no_pemesanan' => $no_pesanan,
            'jenis_pembayaran' => $result['payment_type'],
            'bank' => $result['va_numbers'][0]['bank'],
            'va_number' => $result['va_numbers'][0]['va_number'],
            'total_bayar' => $result['gross_amount'],
            'tanggal_dibuat' => $result['transaction_time'],
            'instruksi' => $result['pdf_url'],
            'status_pembayaran' => $result['transaction_status']
        ];

        $this->Pembayaran_model->insert_pembayaran($data_pembayaran);

        $data_pemesanan = [
            'no_pemesanan' => $no_pesanan,
            'nis' => $this->session->userdata('nis'),
            'tgl_pesan' => date('Y-m-d'),
            'tgl_mulai' => $tanggal_mulai,
            'status' => 0
        ];

        $this->Pemesanan_model->insert_pemesanan($data_pemesanan);
        $this->Pemesanan_model->insert_detail_pemesanan($no_pesanan, $pesanan);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pemesanan berhasil dibuat, silahkan segera melakukan pembayaran !
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>');
        redirect('pelanggan/pesanan');
    }
}
