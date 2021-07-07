<?php
class Tes extends CI_Controller
{

    public function index()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required');

        $this->load->view('_tes/index-view');

        var_dump($this->session->flashdata());

        // if ($this->form_validation->run() == false) {
        //     var_dump(validation_errors());

        //     $this->load->view('_tes/index-view');
        // } else {
        //     echo "berhasil";
        // }
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('tes');
        } else {
            echo "berhasil";
            var_dump($this->input->post());
        }
    }

    public function coba_join()
    {
        $this->db->select('*');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah=sekolah.id_sekolah', 'right');
        $this->db->join('siswa', 'siswa.id_kelas=kelas.id_kelas', 'right');
        $this->db->join('pemesanan', 'siswa.nis=pemesanan.nis', 'right');
        $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan', 'right');
        $this->db->where(['tgl_detail' => date('Y-m-d'), 'kelas.id_kelas' => 48]);
        $join = $this->db->get()->result_array();


        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas=siswa.id_kelas');
        $this->db->where('kelas.id_kelas', 48);
        $this->db->order_by('siswa.nama_siswa', 'ASC');
        $siswa = $this->db->get()->result_array();

        // $array = [];
        // for ($i = 0; $i <= 15; $i++) {
        //     $array[$i]['pesan'] = $i;
        //     $array[]['alamat'] = $i;
        // }
        // var_dump($array);
        // die;

        // foreach ($siswa as $index => $s) {
        //     $tampung[] = $s;
        //     $this->db->select('detail_pemesanan.pesan,detail_pemesanan.tgl_detail');
        //     $this->db->from('pemesanan');
        //     $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan');
        //     $this->db->where(['nis' => $s['nis'], 'detail_pemesanan.tgl_detail' => date('Y-m-d')]);
        //     $pemesanan = $this->db->get()->result_array();

        //     foreach ($pemesanan as $p) {
        //         $tampung[$index]['pesan'][] = $p;
        //     };
        // };

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


        $this->load->view('templates_homepage/header', $data);
        $this->load->view('templates_homepage/navbar');
        $this->load->view('tes/jadwal');
        $this->load->view('templates_homepage/footer');
    }

    public function galang()
    {

        // $this->load->view('_tes/galang');

        $mpdf = new Mpdf\Mpdf();
        $mpdf->AddPage(
            'P'
        );
        $view = $this->load->view('tes/galang', [], TRUE);

        $mpdf->writeHTML($view);
        $mpdf->Output();
    }
}
