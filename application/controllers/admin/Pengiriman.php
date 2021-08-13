<?php

class Pengiriman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model('Kelas_model');
        $this->load->model('Pemesanan_model');
        $this->load->model('Menu_pengganti_model');
        $this->load->model('Sekolah_model');
    }

    public function data_pengiriman_old($id_sekolah)
    {
        $data['user'] = $this->User_model->get_user_by_login();

        $data['kelas'] = $this->Kelas_model->get_spesific_kelas_result(['id_sekolah' => $id_sekolah]);
        $id_kelas = $data['kelas'][0]['id_kelas'];
        $tanggal = date('Y-m-d');


        // cek menu hari ini
        $data['menu_hari_ini'] = $this->db->get_where('detail_jadwal', ['tanggal_jadwal' => '2020-06-22'])->row_array();


        // cek pemesanan pagi
        $where_pagi = ['kelas.id_kelas' => $id_kelas, 'detail_pemesanan.tgl_detail' => '2020-06-22', 'detail_pemesanan.pesan' => 'p'];
        $pagi = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_pagi);
        $jum_pagi = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_pagi);

        // cek pemesanan siang
        $where_siang = ['kelas.id_kelas' => $id_kelas, 'detail_pemesanan.tgl_detail' => '2020-06-22', 'detail_pemesanan.pesan' => 's'];
        $siang = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_siang);
        $jum_siang = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_siang);

        // cek apakah pagi ada yg tidak suka menu hari ini
        $data_tdk_suka = ['pagi' => [], 'siang' => []];
        foreach ($pagi as $cek_pagi) {
            $where = ['ganti_menu.nis' => $cek_pagi['nis'], 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
            $tdk_suka_pagi = $this->Menu_pengganti_model->cek_ganti_menu($where);
            if ($tdk_suka_pagi) {
                $data_tdk_suka['pagi'][] = $tdk_suka_pagi;
            }
        }

        // cek apakah siang ada yg tidak suka menu hari ini
        foreach ($siang as $cek_siang) {
            $where = ['ganti_menu.nis' => $cek_siang['nis'], 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
            $tdk_suka_siang = $this->Menu_pengganti_model->cek_ganti_menu($where);
            if ($tdk_suka_siang) {
                $data_tdk_suka['siang'][] = $tdk_suka_siang;
            }
        }
        $text_pagi = '';
        foreach ($data_tdk_suka['pagi'] as $ganti_menu_pagi) {

            $text_pagi .= $ganti_menu_pagi['nama_siswa'] . ' ganti ' . $ganti_menu_pagi['menu_pengganti'] . ', ';
        }

        $text_siang = '';
        foreach ($data_tdk_suka['siang'] as $ganti_menu_siang) {

            $text_siang .= $ganti_menu_siang['nama_siswa'] . ' ganti ' . $ganti_menu_siang['menu_pengganti'] . ', ';
        }

        $data['jum_pagi'] = $jum_pagi;
        $data['jum_siang'] = $jum_siang;
        $data['catatan_pagi'] = rtrim($text_pagi, ', ');
        $data['catatan_siang'] = rtrim($text_siang, ', ');




        // $this->db->where($where);
        // $this->db->query("select 
        //     ganti_menu.*
        //   , a.nama_makanan AS menu_tidak_suka
        //   , b.nama_makanan AS menu_pengganti 
        //   FROM ganti_menu 
        //   INNER JOIN menu_makanan as a ON a.id_makanan = ganti_menu.id_makanan 
        //   INNER JOIN menu_makanan as b ON b.id_makanan = ganti_menu.id_makanan_pengganti ")->result_array();




        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/pengiriman/form_data_pengiriman');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function data_pengiriman($id_sekolah)
    {
        $tanggal = date('Y-m-d');

        // if (date('D', strtotime($tanggal)) == 'Sun' || date('D', strtotime($tanggal)) == 'Sat') {
        //     echo "<h1>libur</h1>";
        //     die;
        // }
        $data['user'] = $this->User_model->get_user_by_login();
        $data['tanggal'] = $tanggal;
        $data['id_sekolah'] = $id_sekolah;
        // $data['sekolah'] = $this->Sekolah_model->get_all_sekolah();
        $data['kelas'] = $this->Kelas_model->get_spesific_kelas_result(['id_sekolah' => $id_sekolah]);
        $data['menu_hari_ini'] = $this->db->get_where('detail_jadwal', ['tanggal_jadwal' => $tanggal])->row_array();



        if ($data['menu_hari_ini']) {
            $data['nama_makanan_hari_ini'] = $this->db->get_where('menu_makanan', ['id_makanan' => $data['menu_hari_ini']['id_makanan']])->row_array();
        } else {
            // echo "<h1>Menu Bulan ini belum ditentukan, Segera Buat Menu Bulan Ini!</h1>";
            alert('Pengiriman error!, Menu belum ditentukan!, silahkan buat jadwal menu terlebih dahulu', 'fail');
            redirect('admin/jadwal_menu');
        }



        foreach ($data['kelas'] as $kelas) {

            $where_pagi = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'p', 'pemesanan.status_pemesanan' => 'settlement'];
            $where_siang = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 's', 'pemesanan.status_pemesanan' => 'settlement'];
            $where_dobel = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'ps', 'pemesanan.status_pemesanan' => 'settlement'];
            // jumlah
            $jum_pagi = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_pagi);
            $jum_siang = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_siang);
            $jum_dobel = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_dobel);



            $order[] = ['nama_kelas' => $kelas['nama_kelas'], 'pagi' => $jum_pagi + $jum_dobel, 'siang' => $jum_siang + $jum_dobel];


            // $pagi = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_pagi);
            // $siang = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_siang);
            // $dobel = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_dobel);

        }

        //jika hari sabtu atau minggu
        if (date('D', strtotime($tanggal)) == 'Sun' || date('D', strtotime($tanggal)) == 'Sat') {
            $data['holiday'] = true;
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/pengiriman/form_data_pengiriman');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $data['holiday'] = false;


            foreach ($data['kelas'] as $kelas) {


                $where_pagi = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'p', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
                $where_siang = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 's', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
                $where_dobel = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'ps', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
                // jumlah


                $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
                $this->db->from('sekolah');
                $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
                $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
                $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
                $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
                $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
                $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
                $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
                $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

                $this->db->where($where_pagi);
                $pagi = $this->db->get()->result_array();

                $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
                $this->db->from('sekolah');
                $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
                $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
                $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
                $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
                $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
                $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
                $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
                $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

                $this->db->where($where_siang);
                $siang = $this->db->get()->result_array();

                $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
                $this->db->from('sekolah');
                $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
                $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
                $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
                $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
                $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
                $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
                $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
                $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

                $this->db->where($where_dobel);
                $dobel = $this->db->get()->result_array();


                $tampung_catatan_pagi[] = $pagi;
                $tampung_catatan_siang[] = $siang;
                $tampung_catatan_dobel[] = $dobel;
            }



            // merge jumlah pesanan dengan catatan
            foreach ($order as $index => $o) {
                $pengiriman[] = array_merge($o, ['catatan_pagi' => $tampung_catatan_pagi[$index], 'catatan_siang' => $tampung_catatan_siang[$index]]);

                if ($tampung_catatan_dobel) {
                    foreach ($tampung_catatan_dobel[$index] as $dobel) {
                        array_push($pengiriman[$index]['catatan_pagi'], $dobel);
                        array_push($pengiriman[$index]['catatan_siang'], $dobel);
                    }
                }
            };


            $data['pengiriman'] = $pengiriman;

            // foreach ($pengiriman as $dta) {
            //     echo $dta['nama_kelas'] . " pagi " . $dta['pagi'] . " siang " . $dta['siang'] . "<br>";
            //     foreach ($dta['catatan_pagi'] as $p) {
            //         echo $p['nama_siswa'] . $p['menu_pengganti'] . "<br>";
            //     }
            // }

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/pengiriman/form_data_pengiriman');
            $this->load->view('templates_stisla_dashboard/footer');
        }
    }

    public function get_table_pengiriman()
    {
        $tanggal = $this->input->post('tanggal');


        if (date('D', strtotime($tanggal)) == 'Sun' || date('D', strtotime($tanggal)) == 'Sat') {
            echo json_encode(['status' => 'Holiday', 'htmlEl' => '<h1>Libur</h1>']);
            die;
        }

        $data['tanggal'] = $tanggal;
        $id_sekolah = $this->input->post('id_sekolah');
        $data['id_sekolah'] = $id_sekolah;
        $data['kelas'] = $this->Kelas_model->get_spesific_kelas_result(['id_sekolah' => $id_sekolah]);
        $data['menu_hari_ini'] = $this->db->get_where('detail_jadwal', ['tanggal_jadwal' => $tanggal])->row_array();

        if ($data['menu_hari_ini']) {
            $data['nama_makanan_hari_ini'] = $this->db->get_where('menu_makanan', ['id_makanan' => $data['menu_hari_ini']['id_makanan']])->row_array();
        } else {
            // echo "<h1>Menu Bulan ini belum ditentukan, Segera Buat Menu Bulan Ini!</h1>";
            echo json_encode(['status' => 'Menu not created', 'htmlEl' => '<h1>Menu Bulan ini belum dibuat, Segera Buat Menu Bulan Ini!</h1>']);
            die;
        }

        foreach ($data['kelas'] as $kelas) {

            $where_pagi = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'p', 'pemesanan.status_pemesanan' => 'settlement'];
            $where_siang = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 's', 'pemesanan.status_pemesanan' => 'settlement'];
            $where_dobel = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'ps', 'pemesanan.status_pemesanan' => 'settlement'];
            // jumlah
            $jum_pagi = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_pagi);
            $jum_siang = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_siang);
            $jum_dobel = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_dobel);



            $order[] = ['nama_kelas' => $kelas['nama_kelas'], 'pagi' => $jum_pagi + $jum_dobel, 'siang' => $jum_siang + $jum_dobel];


            // $pagi = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_pagi);
            // $siang = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_siang);
            // $dobel = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_dobel);
        }




        foreach ($data['kelas'] as $kelas) {
            $data['user'] = $this->User_model->get_user_by_login();

            $where_pagi = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'p', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
            $where_siang = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 's', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
            $where_dobel = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'ps', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
            // jumlah


            $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
            $this->db->from('sekolah');
            $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
            $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
            $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
            $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
            $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
            $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
            $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
            $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

            $this->db->where($where_pagi);
            $pagi = $this->db->get()->result_array();

            $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
            $this->db->from('sekolah');
            $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
            $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
            $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
            $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
            $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
            $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
            $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
            $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

            $this->db->where($where_siang);
            $siang = $this->db->get()->result_array();

            $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
            $this->db->from('sekolah');
            $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
            $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
            $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
            $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
            $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
            $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
            $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
            $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

            $this->db->where($where_dobel);
            $dobel = $this->db->get()->result_array();


            $tampung_catatan_pagi[] = $pagi;
            $tampung_catatan_siang[] = $siang;
            $tampung_catatan_dobel[] = $dobel;
        }



        // merge jumlah pesanan dengan catatan
        foreach ($order as $index => $o) {
            $pengiriman[] = array_merge($o, ['catatan_pagi' => $tampung_catatan_pagi[$index], 'catatan_siang' => $tampung_catatan_siang[$index]]);

            if ($tampung_catatan_dobel) {
                foreach ($tampung_catatan_dobel[$index] as $dobel) {
                    array_push($pengiriman[$index]['catatan_pagi'], $dobel);
                    array_push($pengiriman[$index]['catatan_siang'], $dobel);
                }
            }
        };

        $data['pengiriman'] = $pengiriman;
        $this->load->view('admin/pengiriman/ajax_form_data_pengiriman', $data);
    }


    public function print()
    {

        $tanggal = $this->input->post('tanggal');
        $id_sekolah = $this->input->post('id_sekolah');
        $data['tanggal'] = $tanggal;
        $data['kelas'] = $this->Kelas_model->get_spesific_kelas_result(['id_sekolah' => $id_sekolah]);
        $data['menu_hari_ini'] = $this->db->get_where('detail_jadwal', ['tanggal_jadwal' => $tanggal])->row_array();
        $data['nama_makanan_hari_ini'] = $this->db->get_where('menu_makanan', ['id_makanan' => $data['menu_hari_ini']['id_makanan']])->row_array();
        $data['sekolah'] = $this->db->get_where('sekolah', ['id_sekolah' => $id_sekolah])->row_array();


        foreach ($data['kelas'] as $kelas) {

            $where_pagi = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'p', 'pemesanan.status_pemesanan' => 'settlement'];
            $where_siang = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 's', 'pemesanan.status_pemesanan' => 'settlement'];
            $where_dobel = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'ps', 'pemesanan.status_pemesanan' => 'settlement'];
            // jumlah
            $jum_pagi = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_pagi);
            $jum_siang = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_siang);
            $jum_dobel = $this->Pemesanan_model->get_join_pemesananV2_by_num($where_dobel);



            $order[] = ['nama_kelas' => $kelas['nama_kelas'], 'pagi' => $jum_pagi + $jum_dobel, 'siang' => $jum_siang + $jum_dobel];


            // $pagi = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_pagi);
            // $siang = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_siang);
            // $dobel = $this->Pemesanan_model->get_join_pemesananV2_by_result($where_dobel);

        }

        foreach ($data['kelas'] as $kelas) {


            $where_pagi = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'p', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
            $where_siang = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 's', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
            $where_dobel = ['kelas.id_kelas' => $kelas['id_kelas'], 'detail_pemesanan.tgl_detail' => $tanggal, 'detail_pemesanan.pesan' => 'ps', 'ganti_menu.id_makanan' => $data['menu_hari_ini']['id_makanan']];
            // jumlah


            $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
            $this->db->from('sekolah');
            $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
            $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
            $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
            $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
            $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
            $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
            $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
            $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

            $this->db->where($where_pagi);
            $pagi = $this->db->get()->result_array();

            $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
            $this->db->from('sekolah');
            $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
            $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
            $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
            $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
            $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
            $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
            $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
            $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

            $this->db->where($where_siang);
            $siang = $this->db->get()->result_array();

            $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail,ganti_menu.id_ganti_menu, a.nama_makanan AS menu_tidak_suka , b.nama_makanan AS menu_pengganti ');
            $this->db->from('sekolah');
            $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
            $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
            $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
            $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
            $this->db->join('detail_jadwal', 'detail_jadwal.tanggal_jadwal=detail_pemesanan.tgl_detail');
            $this->db->join('ganti_menu', 'ganti_menu.nis=siswa.nis');
            $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
            $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');

            $this->db->where($where_dobel);
            $dobel = $this->db->get()->result_array();


            $tampung_catatan_pagi[] = $pagi;
            $tampung_catatan_siang[] = $siang;
            $tampung_catatan_dobel[] = $dobel;
        }


        // merge jumlah pesanan dengan catatan
        foreach ($order as $index => $o) {
            $pengiriman[] = array_merge($o, ['catatan_pagi' => $tampung_catatan_pagi[$index], 'catatan_siang' => $tampung_catatan_siang[$index]]);

            if ($tampung_catatan_dobel) {
                foreach ($tampung_catatan_dobel[$index] as $dobel) {
                    array_push($pengiriman[$index]['catatan_pagi'], $dobel);
                    array_push($pengiriman[$index]['catatan_siang'], $dobel);
                }
            }
        };


        $data['pengiriman'] = $pengiriman;

        // total
        $this->db->select('detail_pemesanan.*,sekolah.nama_sekolah');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where(['detail_pemesanan.pesan' => 'p', 'detail_pemesanan.tgl_detail' => $tanggal, 'sekolah.id_sekolah' => $id_sekolah]);
        $total_pagi = $this->db->get()->num_rows();

        $this->db->select('detail_pemesanan.*,sekolah.nama_sekolah');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where(['detail_pemesanan.pesan' => 's', 'detail_pemesanan.tgl_detail' => $tanggal, 'sekolah.id_sekolah' => $id_sekolah]);
        $total_siang = $this->db->get()->num_rows();

        $this->db->select('detail_pemesanan.*,sekolah.nama_sekolah');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where(['detail_pemesanan.pesan' => 'ps', 'detail_pemesanan.tgl_detail' => $tanggal, 'sekolah.id_sekolah' => $id_sekolah]);
        $total_dobel = $this->db->get()->num_rows();

        $total = $total_pagi + $total_siang + $total_dobel;


        $data['total'] = [
            'total_pagi' => $total_pagi + $total_dobel,
            'total_siang' => $total_siang + $total_dobel,
            'total_pemesanan' => $total
        ];



        $html = $this->load->view('admin/pengiriman/pengiriman_report', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->WriteHTML($html);
        $mpdf->Output('pengiriman.pdf', 'I');
    }

    public function tes()
    {
        $faker = Faker\Factory::create('id_ID');
        for ($i = 0; $i <= 100; $i++) {

            var_dump($faker->name);
            var_dump($faker->address);
            var_dump($faker->phoneNumber);
            var_dump($faker->text);
            echo "<hr>";
        };
    }
}
