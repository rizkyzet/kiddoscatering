<?php

class Pesanan extends CI_Controller
{

    public function index()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        //sekolah
        $sekolah = $this->db->get('sekolah')->result_array();
        foreach ($sekolah as $index => $sek) {
            $tampung_kelas[$index] = $sek;

            $this->db->select('*');
            $this->db->from('kelas');
            $this->db->where('id_sekolah', $sek['id_sekolah']);
            $this->db->order_by('nama_kelas', 'ASC');
            $kelas = $this->db->get()->result_array();
            foreach ($kelas as $kel) {
                $tampung_kelas[$index]['kelas'][] = $kel;
            }
        }

        $data['kelas'] = $tampung_kelas;

        // siswa
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas=siswa.id_kelas');
        $this->db->where('kelas.id_kelas', 48);
        $this->db->order_by('siswa.nama_siswa', 'ASC');
        $siswa = $this->db->get()->result_array();

        $tampung = [];

        // pemesanan
        foreach ($siswa as $index => $s) {
            $tampung[] = $s;
            $this->db->select('detail_pemesanan.pesan,detail_pemesanan.tgl_detail');
            $this->db->from('pemesanan');
            $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan');
            $this->db->where(['nis' => $s['nis'], 'detail_pemesanan.tgl_detail' => date('Y-m-d')]);
            $pemesanan = $this->db->get()->row_array();
            if ($pemesanan) {
                $pesan = $pemesanan['pesan'] == 'p' ? 'Pagi' : 'Siang';
                $tampung[$index]['pesan'] = $pesan;
            } else {
                $tampung[$index]['pesan'] = null;
            }
        };

        if ($tampung) {
            $data['siswa_order'] = $tampung;
        } else {
            $data['siswa_order'] = [];
        }

        $this->load->view('templates_homepage/header', $data);
        $this->load->view('templates_homepage/navbar');
        $this->load->view('homepage/pesanan/index');
        $this->load->view('templates_homepage/footer2');
    }

    public function get_table_pesanan()
    {
        $id_kelas = $this->input->post('id_kelas');

        // siswa
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas=siswa.id_kelas');
        $this->db->where('kelas.id_kelas', $id_kelas);
        $this->db->order_by('siswa.nama_siswa', 'ASC');
        $siswa = $this->db->get()->result_array();

        // pemesanan
        if ($siswa) {

            foreach ($siswa as $index => $s) {
                $tampung[] = $s;
                $this->db->select('detail_pemesanan.pesan,detail_pemesanan.tgl_detail');
                $this->db->from('pemesanan');
                $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan');
                $this->db->where(['nis' => $s['nis'], 'detail_pemesanan.tgl_detail' => date('Y-m-d')]);
                $pemesanan = $this->db->get()->row_array();
                if ($pemesanan) {
                    $pesan = $pemesanan['pesan'] == 'p' ? 'Pagi' : 'Siang';
                    $tampung[$index]['pesan'] = $pesan;
                } else {
                    $tampung[$index]['pesan'] = null;
                }
            };

            $data['siswa_order'] = $tampung;
        } else {
            $data['siswa_order'] = [];
        }

        $this->load->view('homepage/pesanan/ajax_table_pesanan', $data);
    }
}
