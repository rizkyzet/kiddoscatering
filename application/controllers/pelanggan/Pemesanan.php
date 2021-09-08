<?php


class Pemesanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Pemesanan_model');
        $this->load->model('Mycal_model');
        $this->load->helper('date');

        date_default_timezone_set('Asia/Jakarta');

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
        $this->db->where('nis', $this->session->userdata('nis'));
        // $this->db->where_in('status_pemesanan', ['pending', 'settlement']);
        $this->db->order_by('tanggal_dibuat', 'DESC');
        $data['pemesanan'] = $this->db->get('pemesanan')->result_array();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/pemesanan/form_index');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function daftar()
    {

        $data['user'] = $this->User_model->get_user_by_login();

        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);



        for ($m = 1; $m <= 12; $m++) {


            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $month_number = date('m', mktime(0, 0, 0, $m, 1, date('Y')));


            // $cek_bulan = $this->db->get_where('pemesanan', ['month(tanggal_mulai)' => $month_number, 'year(tanggal_mulai)' => date('Y'), 'nis' => $this->session->userdata('nis'), 'status_pemesanan' => 'settlement'])->row_array();

            $this->db->where('month(tanggal_mulai)', $month_number);
            $this->db->where('year(tanggal_mulai)', date('Y'));
            $this->db->where('nis', $this->session->userdata('nis'));
            $this->db->where('tipe', 'bulanan');
            $this->db->where_in('status_pemesanan', ['settlement', 'pending']);
            $cek_bulan = $this->db->get('pemesanan')->row_array();

            // jika ada pemesanan
            if ($cek_bulan) {
                $tampung_data_bulan[] = ['bulan' => $month, 'status' => $cek_bulan['status_pemesanan']];
                // jika bulan yang dilooping kurang dari bulan sekarang
            } elseif ($m < date('n')) {
                $tampung_data_bulan[] = ['bulan' => $month, 'status' => 'lewat'];
                // jika bulan yang dilooping sama dengan bulan saat ini dan tanggal ssat ini lebih dari tanggal 15
            } elseif ($m == date('n') && date('d') >= '15') {
                $tampung_data_bulan[] = ['bulan' => $month, 'status' => 'lewat'];
            } else {
                $tampung_data_bulan[] = ['bulan' => $month, 'status' => 'belum pesan'];
            }
        }

        $data['bulan'] = $tampung_data_bulan;

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/pemesanan/form_daftar');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function buat($month)
    {

        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['combo_kelas'] = $this->Kelas_model->get_combo_kelas();

        if ($month == date('F')) {

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
        } else {
            $tahun_now = date('Y');
            $bulan_now = $month;
            $tanggal_now = '01';

            $tanggal = date('Y-m-d', strtotime("$tanggal_now-$bulan_now-$tahun_now"));

            if (date('l', strtotime($tanggal)) == 'Saturday') {

                $data['tgl_mulai'] = date('Y-m-d', strtotime("$tanggal +2 days"));
            } elseif (date('l', strtotime($tanggal)) == 'Sunday') {
                $data['tgl_mulai'] = date('Y-m-d', strtotime("$tanggal +1 days"));
            } else {
                $data['tgl_mulai'] = date('Y-m-d', strtotime("$tanggal"));
            }
        }





        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/pemesanan/form_buat');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function pembayaran()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_siswa_join_kelas_sekolah(['siswa.nis' => $this->session->userdata('nis')]);

        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $pesanan = $this->Pemesanan_model->tampung_pesanan($tanggal_mulai, $this->input->post());

        $data['tanggal_template'] = $this->Pemesanan_model->template_tanggal(date('m', strtotime($tanggal_mulai)));
        $data['hari_template'] = $this->Pemesanan_model->template_hari(date('m', strtotime($tanggal_mulai)));
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['pesanan'] = $pesanan;
        $data['detail_bayar'] = $this->Pemesanan_model->tampung_detail_pembayaran($pesanan);
        $data['no_psn'] = no_pemesanan();
        $data['pesanan_json'] = json_encode($pesanan);
        // $data['hari_template'] = date(strtotime($data['tanggal_template']))
        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/pemesanan/form_pembayaran');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function token()
    {


        $user = $this->User_model->get_user_by_login();
        $tgl_mulai = $this->input->post('tanggal_mulai');
        $total_byr = $this->input->post('total_byr');
        $no_psn = $this->input->post('no_psn');

        $item_details = array(
            'id' => $no_psn,
            'price' => $total_byr,
            'quantity' => 1,
            'name' => "Pembayaran Catering Bulan " . getMonthIndo(date('F', strtotime($tgl_mulai)))
        );

        $transaction_details = array(
            'order_id' => $no_psn,
            'gross_amount' => $total_byr, // no decimal allowed for creditcard

        );

        // Optional
        $item_details = [$item_details];



        // Optional
        $customer_details = array(
            'first_name'    => $user['nama_siswa'] . ' (' . $user['nis'] . ')',
            'nis' => $user['nis']
            // 'email'         => $user['email'],
            // 'phone' => $user['no_hp']

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
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $pesanan = json_decode($this->input->post('pesanan'), true);

        $result = json_decode($this->input->post('result_data'), true);


        $data_pemesanan = [
            'no_pemesanan' => $no_pesanan,
            'nis' => $this->session->userdata('nis'),
            'tipe' => 'bulanan',
            'jenis_pembayaran' => $result['payment_type'],
            'bank' => $result['va_numbers'][0]['bank'],
            'va_number' => $result['va_numbers'][0]['va_number'],
            'total_bayar' => $result['gross_amount'],
            'tanggal_dibuat' => $result['transaction_time'],
            'tanggal_dibayar' => '',
            'tanggal_mulai' => $tanggal_mulai,
            'instruksi' => $result['pdf_url'],
            'status_pemesanan' => $result['transaction_status']
        ];



        $this->Pemesanan_model->insert_pemesanan($data_pemesanan);
        $this->Pemesanan_model->insert_detail_pemesanan($no_pesanan, $pesanan);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pemesanan berhasil dibuat, silahkan segera melakukan pembayaran !
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>');
        redirect('pelanggan/pemesanan');
    }

    public function detail($no_pemesanan)
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['kelas'] = $this->Kelas_model->get_spesific_kelas(['id_kelas' => $data['siswa']['id_kelas']]);
        $data['pemesanan'] = $this->db->get_where('pemesanan', ['pemesanan.no_pemesanan' => $no_pemesanan])->row_array();

        $data['cekTipe'] = $data['pemesanan']['tipe'];
        $data['pesanan_pagi'] = $this->db->get_where('detail_pemesanan', ['no_pemesanan' => $no_pemesanan, 'pesan' => 'p'])->num_rows();
        $data['pesanan_siang'] = $this->db->get_where('detail_pemesanan', ['no_pemesanan' => $no_pemesanan, 'pesan' => 's'])->num_rows();
        $data['pesanan_dobel'] = $this->db->get_where('detail_pemesanan', ['no_pemesanan' => $no_pemesanan, 'pesan' => 'ps'])->num_rows();

        if ($data['cekTipe'] == 'bulanan') {

            $data['detail_pembayaran'] = [
                'qty_pagi' => $data['pesanan_pagi'],
                'qty_siang' => $data['pesanan_siang'],
                'qty_dobel' => $data['pesanan_dobel'],
                'total_pagi' => $data['pesanan_pagi'] * 12000,
                'total_siang' => $data['pesanan_siang'] * 12000,
                'total_dobel' => $data['pesanan_dobel'] * 24000,
            ];
        } else {
            $data['detail_pembayaran'] = [
                'qty_pagi' => $data['pesanan_pagi'],
                'qty_siang' => $data['pesanan_siang'],
                'qty_dobel' => $data['pesanan_dobel'],
                'total_pagi' => $data['pesanan_pagi'] * 15000,
                'total_siang' => $data['pesanan_siang'] * 15000,
                'total_dobel' => $data['pesanan_dobel'] * 24000,
            ];
        }

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
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/pemesanan/form_detail');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function verify_pembayaran($no_pemesanan)
    {
        $result = $this->db->get_where('pemesanan', ['no_pemesanan' => $no_pemesanan])->row_array();
        $check = get_object_vars($this->midtrans->status($no_pemesanan));

        if ($result['status_pemesanan'] !== $check['transaction_status']) {
            $this->db->update('pemesanan', ['status_pemesanan' => $check['transaction_status'], 'tanggal_dibayar' => $check['settlement_time']], ['no_pemesanan' => $no_pemesanan]);
            redirect('pelanggan/pemesanan');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
                <div class="alert-title">Gagal Verify !</div>
Anda belum melakukan pembayaran, mohon segera dibayar !
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');

            redirect('pelanggan/pemesanan');
        }
    }

    public function batalkan_transaksi($no_pemesanan)
    {


        if ($this->veritrans->cancel($no_pemesanan) == '200') {
            $this->db->update('pemesanan', ['status_pemesanan' => 'cancel'], ['no_pemesanan' => $no_pemesanan]);
            // $this->db->delete('pemesanan', ['no_pemesanan' => $no_pemesanan]);
            redirect('pelanggan/pemesanan/');
        } else {

            redirect('pelanggan/pemesanan/');
        }
    }

    public function edit($no_pemesanan)
    {

        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['pemesanan_header'] = $this->Pemesanan_model->get_pemesanan(['no_pemesanan' => $no_pemesanan]);
        $data['detail_pemesanan'] = $this->Pemesanan_model->get_detail_pemesanan(['no_pemesanan' => $no_pemesanan]);

        $tahun = date('Y', strtotime($data['pemesanan_header']['tanggal_mulai']));
        $bulan = date('m', strtotime($data['pemesanan_header']['tanggal_mulai']));

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
        $data['bulanText'] = getMonthIndo(date('F', strtotime($data['pemesanan_header']['tanggal_mulai'])));
        $data['tahunText'] = date('Y', strtotime($data['pemesanan_header']['tanggal_mulai']));

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/pemesanan/form_edit');
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







    // harian
    public function pesan_harian()
    {

        $data['user'] = $this->User_model->get_user_by_login();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $this->session->userdata('nis')]);
        $data['kelas'] = $this->db->get_where('kelas', ['id_kelas' => $data['siswa']['id_kelas']])->row_array();
        $data['sekolah'] = $this->db->get_where('sekolah', ['id_sekolah' => $data['kelas']['id_sekolah']])->row_array();
        $data['combo_kelas'] = $this->Kelas_model->get_combo_kelas();




        $this->form_validation->set_rules('tanggal_pesan', 'Tanggal Pesan', 'callback_tgl_pesan');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
            $this->load->view('pelanggan/pemesanan/form_buat_harian');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $data['tanggal_pesan'] = $this->input->post('tanggal_pesan');
            $data['waktu_pesan'] = $this->input->post('waktu_pesan');
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
            $this->load->view('pelanggan/pemesanan/form_rincian_harian');
            $this->load->view('templates_stisla_dashboard/footer');
        }
    }

    // FORM VALIDATION
    public function tgl_pesan($value)
    {
        if ($value == '') {
            $this->form_validation->set_message('tgl_pesan', 'tanggal belum diisi!');
            return false;
        } else {
            $this->db->select('*');
            $this->db->from('detail_pemesanan');
            $this->db->join('pemesanan', 'detail_pemesanan.no_pemesanan=pemesanan.no_pemesanan');
            $this->db->join('siswa', 'pemesanan.nis=siswa.nis');
            $this->db->where(['pemesanan.nis' => $this->session->userdata('nis'), 'tgl_detail' => $value]);
            $apakahAdaPesanan = $this->db->get()->result_array();

            if ($apakahAdaPesanan) {
                $this->form_validation->set_message('tgl_pesan', 'Anda sudah memesan di tanggal ' . $value);
                return false;
            } else {

                if (date('l', strtotime($value)) == 'Saturday' || date('l', strtotime($value)) == 'Saturday') {
                    $this->form_validation->set_message('tgl_pesan', 'Hari libur!');
                    return false;
                } else {

                    if (strtotime(date('Y-m-d')) > strtotime($value)) {
                        $this->form_validation->set_message('tgl_pesan', 'Tanggal sudah lewat!');
                        return false;
                    } else {
                        if (date('Y-m-d') == $value && date('H') > 8) {
                            $this->form_validation->set_message('tgl_pesan', 'Jam sudah lewat!');
                            return false;
                        }
                    }
                }
            }
        }
    }


    public function token_harian()
    {
        $user = $this->User_model->get_user_by_login();
        $waktu_pesan = $this->input->post('waktu_pesan');
        $tanggal_pesan = $this->input->post('tanggal_pesan');
        $total_byr = $waktu_pesan == 'ps' ? 30000 : 15000;
        $no_psn = no_pemesanan_harian();

        $item_details = array(
            'id' => $no_psn,
            'price' => $total_byr,
            'quantity' => 1,
            'name' => "Catering Harian " . getFullTextWaktuPesanan($waktu_pesan) . " tgl $tanggal_pesan"
        );

        $transaction_details = array(
            'order_id' => $no_psn,
            'gross_amount' => $total_byr, // no decimal allowed for creditcard

        );

        // Optional
        $item_details = [$item_details];



        // Optional
        $customer_details = array(
            'first_name'    => $user['nama_siswa'] . ' (' . $user['nis'] . ')',
            'nis' => $user['nis']
            // 'email'         => $user['email'],
            // 'phone' => $user['no_hp']

        );


        $credit_card['secure'] = true;
        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => 60
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

    public function save_order_harian()
    {
        $siswa = $this->db->get_where('siswa', ['nis' => $this->input->post('nis')])->row_array();
        $tanggal_pesan = $this->input->post('tanggal_pesan');
        $waktu_pesan = $this->input->post('waktu_pesan');
        $result = json_decode($this->input->post('result_data'), TRUE);

        $data_pemesanan = [
            'no_pemesanan' => $result['order_id'],
            'nis' => $siswa['nis'],
            'tipe' => 'harian',
            'jenis_pembayaran' => $result['payment_type'],
            'bank' => $result['va_numbers'][0]['bank'],
            'va_number' => $result['va_numbers'][0]['va_number'],
            'total_bayar' => $result['gross_amount'],
            'tanggal_dibuat' => $result['transaction_time'],
            'tanggal_dibayar' => '',
            'tanggal_mulai' => $tanggal_pesan,
            'instruksi' => $result['pdf_url'],
            'status_pemesanan' => $result['transaction_status']
        ];

        $data_detail = [
            'no_pemesanan' => $result['order_id'],
            'tgl_detail' => $tanggal_pesan,
            'pesan' => $waktu_pesan
        ];

        $this->Pemesanan_model->insert_pemesanan($data_pemesanan);
        $this->db->insert('detail_pemesanan', $data_detail);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pemesanan berhasil dibuat, silahkan segera melakukan pembayaran !
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>');
        redirect('pelanggan/pemesanan');
    }
}
