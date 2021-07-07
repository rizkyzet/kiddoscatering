<?php

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pemesanan_model');
        $this->load->model('Kelas_model');
        $this->load->model('Sekolah_model');
        $this->load->helper('date');
    }
    public function laporan_pemesanan($id_sekolah)
    {
        role_logged_in();

        $data['id_sekolah'] = $id_sekolah;
        $data['user'] = $this->User_model->get_user_by_login();
        $data['sekolah'] = $this->Sekolah_model->get_specific_sekolahV2(['id_sekolah' => $id_sekolah]);
        $data['kelas'] = $this->Kelas_model->get_spesific_kelas_result(['id_sekolah' => $id_sekolah]);
        $id_kelas = $data['kelas'][0]['id_kelas'];
        $data['siswa'] = $this->db->get_where('siswa', ['id_kelas' => $id_kelas])->result_array();
        $data['combobox'] = $this->Kelas_model->get_combo_kelas();
        $data['id_sekolah'] = $id_sekolah;

        $range = $this->Pemesanan_model->template_tanggal_v2();

        foreach ($data['siswa'] as $index => $siswa) {
            foreach ($range as $rng) {
                $where = ['siswa.nis' => $siswa['nis'], 'tgl_detail' => $rng, 'pemesanan.status_pemesanan' => 'settlement'];
                $pemesanan = $this->Pemesanan_model->get_join_pemesanan_by($where);
                if ($pemesanan == null) {
                    $tampung[$index][] = ['tanggal' => $rng, 'pesan' => ''];
                } else {

                    $pemesanan = array_merge(['tanggal' => $rng], $pemesanan);
                    $tampung[$index][] = $pemesanan;
                }
            }
        }

        foreach ($range as $rng) {
            $where_pagi = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 'p', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $where_siang = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 's', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $where_dobel = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 'ps', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $pagi = $this->Pemesanan_model->get_jumlah_pesanan($where_pagi);
            $siang = $this->Pemesanan_model->get_jumlah_pesanan($where_siang);
            $dobel = $this->Pemesanan_model->get_jumlah_pesanan($where_dobel);
            $jumlah_pagi[] = $pagi;
            $jumlah_siang[] = $siang;
            $jumlah_dobel[] = $dobel;
        }


        $data['jumlah_pagi'] = $jumlah_pagi;
        $data['jumlah_siang'] = $jumlah_siang;
        $data['jumlah_dobel'] = $jumlah_dobel;

        $data['pemesanan'] = $tampung;

        $pagi = 0;
        $siang = 0;
        foreach ($data['jumlah_pagi'] as $index => $p) {
            $pagi += $p + $data['jumlah_dobel'][$index];
        }

        foreach ($data['jumlah_siang'] as $index => $s) {
            $siang += $s + $data['jumlah_dobel'][$index];
        }


        $data['col_tanggal'] = $this->Pemesanan_model->template_tanggal_v2();
        $data['total_order'] = ['pesan' => $pagi + $siang, 'colspan' => count($data['col_tanggal'])];


        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/laporan/laporan_pemesanan');
        $this->load->view('templates_stisla_dashboard/footer');
    }


    public function ajax_lap_pemesanan()
    {

        $id_kelas = $this->input->post('id_kelas');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data['kelas'] = $this->db->get_where('kelas', ['id_kelas' => $id_kelas])->row_array();
        $data['siswa'] = $this->db->get_where('siswa', ['id_kelas' => $id_kelas])->result_array();

        if ($data['siswa'] == null) {
            echo "siswa kosong";
            die;
        }
        $range = $this->Pemesanan_model->template_tanggal_v2($bulan, $tahun);

        foreach ($data['siswa'] as $index => $siswa) {
            foreach ($range as $rng) {
                $where = ['siswa.nis' => $siswa['nis'], 'tgl_detail' => $rng, 'pemesanan.status_pemesanan' => 'settlement'];
                $pemesanan = $this->Pemesanan_model->get_join_pemesanan_by($where);
                if ($pemesanan == null) {
                    $tampung[$index][] = ['tanggal' => $rng, 'pesan' => ''];
                } else {

                    $pemesanan = array_merge(['tangggal' => $rng], $pemesanan);
                    $tampung[$index][] = $pemesanan;
                }
            }
        }

        foreach ($range as $rng) {
            $where_pagi = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 'p', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $where_siang = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 's', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $where_dobel = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 'ps', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $pagi = $this->Pemesanan_model->get_jumlah_pesanan($where_pagi);
            $siang = $this->Pemesanan_model->get_jumlah_pesanan($where_siang);
            $dobel = $this->Pemesanan_model->get_jumlah_pesanan($where_dobel);
            $jumlah_pagi[] = $pagi;
            $jumlah_siang[] = $siang;
            $jumlah_dobel[] = $dobel;
        }


        $data['jumlah_pagi'] = $jumlah_pagi;
        $data['jumlah_siang'] = $jumlah_siang;
        $data['jumlah_dobel'] = $jumlah_dobel;

        $data['pemesanan'] = $tampung;

        $pagi = 0;
        $siang = 0;
        foreach ($data['jumlah_pagi'] as $index => $p) {
            $pagi += $p + $data['jumlah_dobel'][$index];
        }

        foreach ($data['jumlah_siang'] as $index => $s) {
            $siang += $s + $data['jumlah_dobel'][$index];
        }

        $data['col_tanggal'] = $this->Pemesanan_model->template_tanggal_v2($bulan, $tahun);
        $data['total_order'] = ['pesan' => $pagi + $siang, 'colspan' => count($data['col_tanggal'])];

        $this->load->view('admin/laporan/ajax_table_pesanan', $data);
    }


    public function cetak_lap_pemesanan()
    {

        role_logged_in();

        $id_sekolah = $this->input->post('id_sekolah');
        $id_kelas = $this->input->post('kelas');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data['kelas'] = $this->db->get_where('kelas', ['id_kelas' => $id_kelas])->row_array();
        $data['siswa'] = $this->db->get_where('siswa', ['id_kelas' => $id_kelas])->result_array();

        if ($data['siswa'] == null) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Gagal Cetak!</div>
         Siswa Kosong!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('admin/laporan/laporan_pemesanan/' . $id_sekolah);
        }
        $range = $this->Pemesanan_model->template_tanggal_v2($bulan, $tahun);

        foreach ($data['siswa'] as $index => $siswa) {
            foreach ($range as $rng) {
                $where = ['siswa.nis' => $siswa['nis'], 'tgl_detail' => $rng, 'pemesanan.status_pemesanan' => 'settlement'];
                $pemesanan = $this->Pemesanan_model->get_join_pemesanan_by($where);
                if ($pemesanan == null) {
                    $tampung[$index][] = ['tanggal' => $rng, 'pesan' => ''];
                } else {

                    $pemesanan = array_merge(['tangggal' => $rng], $pemesanan);
                    $tampung[$index][] = $pemesanan;
                }
            }
        }

        foreach ($range as $rng) {
            $where_pagi = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 'p', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $where_siang = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 's', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $where_dobel = ['detail_pemesanan.tgl_detail' => $rng, 'detail_pemesanan.pesan' => 'ps', 'kelas.id_kelas' => $id_kelas, 'pemesanan.status_pemesanan' => 'settlement'];
            $pagi = $this->Pemesanan_model->get_jumlah_pesanan($where_pagi);
            $siang = $this->Pemesanan_model->get_jumlah_pesanan($where_siang);
            $dobel = $this->Pemesanan_model->get_jumlah_pesanan($where_dobel);
            $jumlah_pagi[] = $pagi;
            $jumlah_siang[] = $siang;
            $jumlah_dobel[] = $dobel;
        }



        $data['jumlah_pagi'] = $jumlah_pagi;
        $data['jumlah_siang'] = $jumlah_siang;
        $data['jumlah_dobel'] = $jumlah_dobel;

        $pagi = 0;
        $siang = 0;
        foreach ($data['jumlah_pagi'] as $index => $p) {
            $pagi += $p + $data['jumlah_dobel'][$index];
        }

        foreach ($data['jumlah_siang'] as $index => $s) {
            $siang += $s + $data['jumlah_dobel'][$index];
        }

        $data['pemesanan'] = $tampung;


        $data['col_tanggal'] = $this->Pemesanan_model->template_tanggal_v2($bulan, $tahun);
        $data['total_order'] = ['pesan' => $pagi + $siang, 'colspan' => count($data['col_tanggal'])];





        $html = $this->load->view('admin/laporan/cetak_lap_pemesanan', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage(
            'L' // L - landscape, P - portrait

        ); // margin footer
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function laporan_pendapatan($id_sekolah)
    {
        role_logged_in();


        $data['tanggal_awal'] = date('Y-m-01');
        $data['tanggal_akhir'] = date('Y-m-t');


        $data['user'] = $this->User_model->get_user_by_login();
        $this->db->select('sekolah.nama_sekolah,siswa.nis,siswa.nama_siswa,kelas.nama_kelas,pemesanan.tanggal_dibayar,pemesanan.total_bayar,pemesanan.tanggal_mulai');
        $this->db->from('pemesanan');
        $this->db->join('siswa', 'pemesanan.nis=siswa.nis');
        $this->db->join('kelas', 'siswa.id_kelas=kelas.id_kelas');
        $this->db->join('sekolah', 'kelas.id_sekolah=sekolah.id_sekolah');

        $this->db->where('pemesanan.tanggal_dibayar BETWEEN "' . $data['tanggal_awal'] . '" AND "' . $data['tanggal_akhir'] . '"');
        $data['pendapatan'] = $this->db->get()->result_array();

        if ($data['pendapatan']) {
            foreach ($data['pendapatan'] as $dapat) {
                $tampung_bayar[] = $dapat['total_bayar'];
            };
            $data['total_pendapatan'] = array_sum($tampung_bayar);
        } else {
            $data['total_pendapatan'] = 0;
        }

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/laporan/laporan_pendapatan');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function get_table_pendapatan()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');

        $data['user'] = $this->User_model->get_user_by_login();
        $this->db->select('sekolah.nama_sekolah,siswa.nis,siswa.nama_siswa,kelas.nama_kelas,pemesanan.tanggal_dibayar,pemesanan.total_bayar,pemesanan.tanggal_mulai');
        $this->db->from('pemesanan');
        $this->db->join('siswa', 'pemesanan.nis=siswa.nis');
        $this->db->join('kelas', 'siswa.id_kelas=kelas.id_kelas');
        $this->db->join('sekolah', 'kelas.id_sekolah=sekolah.id_sekolah');

        $this->db->where('pemesanan.tanggal_dibayar BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        $this->db->where('pemesanan.status_pemesanan', 'settlement');

        // $this->db->where('pemesanan.tanggal_dibayar >=', $tanggal_awal);
        // $this->db->where('pemesanan.tanggal_dibayar <=', $tanggal_akhir);

        $data['pendapatan'] = $this->db->get()->result_array();
        if ($data['pendapatan']) {
            foreach ($data['pendapatan'] as $dapat) {
                $tampung_bayar[] = $dapat['total_bayar'];
            };

            $data['total_pendapatan'] = array_sum($tampung_bayar);
        } else {
            $data['total_pendapatan'] = 0;
        }
        $this->load->view('admin/laporan/ajax_laporan_pendapatan', $data);
    }

    public function cetak_lap_pendapatan()
    {
        role_logged_in();

        $mpdf = new \Mpdf\Mpdf();

        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');

        $this->db->select('sekolah.nama_sekolah,siswa.nis,siswa.nama_siswa,kelas.nama_kelas,pemesanan.tanggal_dibayar,pemesanan.total_bayar,pemesanan.tanggal_mulai');
        $this->db->from('pemesanan');
        $this->db->join('siswa', 'pemesanan.nis=siswa.nis');
        $this->db->join('kelas', 'siswa.id_kelas=kelas.id_kelas');
        $this->db->join('sekolah', 'kelas.id_sekolah=sekolah.id_sekolah');

        $this->db->where('pemesanan.tanggal_dibayar BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        $this->db->where('pemesanan.status_pemesanan', 'settlement');
        // $this->db->where('pemesanan.tanggal_dibayar >=', $tanggal_awal);
        // $this->db->where('pemesanan.tanggal_dibayar <=', $tanggal_akhir);
        $data['pendapatan'] = $this->db->get()->result_array();
        if ($data['pendapatan']) {

            foreach ($data['pendapatan'] as $dapat) {
                $tampung_bayar[] = $dapat['total_bayar'];
            };

            $data['total_pendapatan'] = array_sum($tampung_bayar);
        } else {
            $data['total_pendapatan'] = 0;
        }
        $html = $this->load->view('admin/laporan/cetak_lap_pendapatan', $data, true);

        $mpdf->AddPage(
            'L' // L - landscape, P - portrait

        ); // margin footer
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
