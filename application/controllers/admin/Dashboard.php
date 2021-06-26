<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        role_logged_in();
        not_logged_in();
    }
    public function index()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $tanggal = date('Y-m-d');

        // menu hari ini
        $this->db->select('detail_jadwal.*,menu_makanan.nama_makanan,menu_makanan.image_makanan');
        $this->db->from('detail_jadwal');
        $this->db->join('menu_makanan', 'menu_makanan.id_makanan=detail_jadwal.id_makanan');

        $this->db->where(['detail_jadwal.tanggal_jadwal' => $tanggal]);
        $data['menu_hari_ini'] = $this->db->get()->row_array();



        // jumlah pesanan pagi dan siang
        $pagi = $this->db->get_where('detail_pemesanan', ['tgl_detail' => $tanggal, 'pesan' => 'p'])->num_rows();
        $siang = $this->db->get_where('detail_pemesanan', ['tgl_detail' => $tanggal, 'pesan' => 's'])->num_rows();
        $dobel = $this->db->get_where('detail_pemesanan', ['tgl_detail' => $tanggal, 'pesan' => 'ps'])->num_rows();
        $jum_pagi = $pagi + $dobel;
        $jum_siang = $siang + $dobel;



        // var_dump(date("F j, Y", time() - 60 * 60 * 24));
        // die;

        // chart
        for ($bulan = 01; $bulan <= 12; $bulan++) {
            $nama_bulan = date('F', strtotime("01-$bulan-2020"));
            $this->db->select('detail_pemesanan.*,pemesanan.status_pemesanan');
            $this->db->from('pemesanan');
            $this->db->where(['month(detail_pemesanan.tgl_detail)' => $bulan, 'year(detail_pemesanan.tgl_detail)' => date('Y'), 'pemesanan.status_pemesanan' => 'settlement']);
            $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan');
            $jumlah = $this->db->get()->num_rows();
            $tampung_jumlah[strtolower($nama_bulan)] = $jumlah;
        }

        // hitung jumlah bulan kemarin
        $bulan_kemarin = date('m', strtotime('last month'));
        $this->db->select('detail_pemesanan.*,pemesanan.status_pemesanan');
        $this->db->from('pemesanan');
        $this->db->where(['month(detail_pemesanan.tgl_detail)' => $bulan_kemarin, 'year(detail_pemesanan.tgl_detail)' => date('Y'), 'pemesanan.status_pemesanan' => 'settlement']);
        $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan');
        $jum_bulan_kemarin = $this->db->get()->num_rows();


        // hitung jumlah bulan sekarang
        $bulan_sekarang = date('m');
        $this->db->select('detail_pemesanan.*,pemesanan.status_pemesanan');
        $this->db->from('pemesanan');
        $this->db->where(['month(detail_pemesanan.tgl_detail)' => $bulan_sekarang, 'year(detail_pemesanan.tgl_detail)' => date('Y'), 'pemesanan.status_pemesanan' => 'settlement']);
        $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan');
        $jum_bulan_sekarang = $this->db->get()->num_rows();


        $data['jumlah'] = [
            'pagi' => $jum_pagi,
            'siang' => $jum_siang,
            'bulan_kemarin' => $jum_bulan_kemarin,
            'bulan_sekarang' =>  $jum_bulan_sekarang,
            'selisih' => $jum_bulan_sekarang - $jum_bulan_kemarin
        ];

        $data['chart'] = $tampung_jumlah;


        for ($bulan = 01; $bulan <= 12; $bulan++) {
            $nama_bulan = date('F', strtotime("01-$bulan-2020"));
            $where = [
                'status_pemesanan' => 'settlement',
                'month(tanggal_dibayar)' => $bulan,
                'year(tanggal_dibayar)' => date('Y')
            ];
            $this->db->select('SUM(total_bayar) AS total');
            $this->db->from('pemesanan');
            $this->db->where($where);
            $pendapatan = $this->db->get()->row_array();
            // $pendapatan_format = thousandsCurrencyFormat($pendapatan['total']);
            if ($pendapatan['total'] == null) {

                $tampung_pendapatan[strtolower($nama_bulan)] = 0;
            } else {
                $tampung_pendapatan[strtolower($nama_bulan)] = $pendapatan['total'];
            }
        };

        $data['chart_pendapatan'] = $tampung_pendapatan;


        $where_pendapatan_kemarin = [
            'status_pemesanan' => 'settlement',
            'month(tanggal_dibayar)' => $bulan_kemarin,
            'year(tanggal_dibayar)' => date('Y')
        ];
        $this->db->select('SUM(total_bayar) AS total');
        $this->db->from('pemesanan');
        $this->db->where($where_pendapatan_kemarin);
        $pendapatan_kemarin = $this->db->get()->row_array();

        $where_pendapatan_sekarang = [
            'status_pemesanan' => 'settlement',
            'month(tanggal_dibayar)' => $bulan_sekarang,
            'year(tanggal_dibayar)' => date('Y')
        ];
        $this->db->select('SUM(total_bayar) AS total');
        $this->db->from('pemesanan');
        $this->db->where($where_pendapatan_sekarang);
        $pendapatan_sekarang = $this->db->get()->row_array();
        // Rumus : Persentase (%) = (akhir – awal) / awal x 100%

        if ($pendapatan_sekarang['total'] == null and  $pendapatan_kemarin['total'] == null) {
            $data['detail_pendapatan'] = [
                'pendapatan_kemarin' => null,
                'pendapatan_sekarang' => null,
                'persentase_pendapatan' => null
            ];
        } elseif ($pendapatan_sekarang['total'] !== null and  $pendapatan_kemarin['total'] == null) {
            $data['detail_pendapatan'] = [
                'pendapatan_kemarin' => null,
                'pendapatan_sekarang' => $pendapatan_sekarang['total'],
                'persentase_pendapatan' => null
            ];
        } else {

            $persentase = ($pendapatan_sekarang['total'] - $pendapatan_kemarin['total']) / $pendapatan_kemarin['total'] * 100;
            $data['detail_pendapatan'] = [
                'pendapatan_kemarin' => $pendapatan_kemarin['total'],
                'pendapatan_sekarang' => $pendapatan_sekarang['total'],
                'persentase_pendapatan' => $persentase
            ];
        }



        // pie chart
        $pagi = $this->db->get_where('detail_pemesanan', ['pesan' => 'p'])->num_rows();
        $siang = $this->db->get_where('detail_pemesanan', ['pesan' => 's'])->num_rows();
        $dobel = $this->db->get_where('detail_pemesanan', ['pesan' => 'ps'])->num_rows();

        $data['pie_chart'] = ['pagi' => $pagi, 'siang' => $siang, 'dobel' => $dobel];




        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/dashboard');
        $this->load->view('templates_stisla_dashboard/footer');
        $this->load->view('templates_stisla_dashboard/js_chartjs');
    }
}
