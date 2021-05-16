<?php

class Jadwal_menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mycal_model');
        $this->load->model('Menu_makanan_model');
        $this->load->model('Jadwal_model');
    }

    public function index()
    {

        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['jadwal'] = $this->Jadwal_model->get_all_jadwal();
        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/jadwal_menu/form_index');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function buat_jadwal()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/jadwal_menu/form_buat');
        $this->load->view('templates_stisla_dashboard/footer');
    }


    public function pilih_jadwal()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $cek = $this->db->get_where('jadwal', ['tahun' => $tahun, 'bulan' => $bulan])->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-times-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Gagal!</div>
          Jadwal Sudah Dibuat!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('admin/jadwal_menu/buat_jadwal');
        }
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['menu'] = $this->Menu_makanan_model->get_all_makanan();

        $data['calendar'] = "<tr>
        <th >Min</th>
        <th>Sen</th>
        <th>Sel</th>
        <th>Rab</th>
        <th>Kam</th>
        <th>Jum</th>
        <th>Sab</th>
    </tr>";
        $data['calendar'] .= $this->Mycal_model->getCalendarJadwal($data['tahun'],  $data['bulan'], "buat");

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/jadwal_menu/form_pilih');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    // ajax
    public function get_data_menu()
    {
        $data['tanggal'] = $this->input->post('tanggal');
        $data['menu'] = $this->Menu_makanan_model->get_all_makanan();
        $this->load->view('admin/jadwal_menu/modal_pilih_menu', $data);
    }


    public function save_jadwal()
    {
        $post = $this->input->post();
        $data = ['bulan' => $post['bulan'], 'tahun' => $post['tahun']];
        $this->db->insert('jadwal', $data);

        $id_jadwal = $this->db->insert_id();

        unset($post['bulan']);
        unset($post['tahun']);

        $post = array_values($post);

        foreach ($post as $data) {
            $data = json_decode($data, true);
            $data = ['id_jadwal' => $id_jadwal, 'tanggal_jadwal' => $data['tanggal'], 'id_makanan' => $data['id_makanan']];
            $this->db->insert('detail_jadwal', $data);
        }

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
      Jadwal Berhasil Dibuat!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
        redirect('admin/jadwal_menu');
    }

    public function tampil_jadwal($id_jadwal)
    {
        $jadwal_header = $this->db->get_where('jadwal', ['id_jadwal' => $id_jadwal])->row_array();
        $data['bulan'] = $jadwal_header['bulan'];
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['calendar'] = "<tr>
        <th >Min</th>
        <th>Sen</th>
        <th>Sel</th>
        <th>Rab</th>
        <th>Kam</th>
        <th>Jum</th>
        <th>Sab</th>
    </tr>";
        $data['calendar'] .= $this->Mycal_model->getCalendarJadwal($jadwal_header['tahun'],  $jadwal_header['bulan'], "tampil", $jadwal_header['id_jadwal']);

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/jadwal_menu/form_tampil');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function edit_jadwal($id_jadwal)
    {

        $jadwal_header = $this->db->get_where('jadwal', ['id_jadwal' => $id_jadwal])->row_array();
        $data['bulan'] = $jadwal_header['bulan'];
        $data['id_jadwal'] = $id_jadwal;
        $data['menu'] = $this->Menu_makanan_model->get_all_makanan();
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['calendar'] = "<tr>
        <th >Min</th>
        <th>Sen</th>
        <th>Sel</th>
        <th>Rab</th>
        <th>Kam</th>
        <th>Jum</th>
        <th>Sab</th>
    </tr>";
        $data['calendar'] .= $this->Mycal_model->getCalendarJadwal($jadwal_header['tahun'],  $jadwal_header['bulan'], "edit", $jadwal_header['id_jadwal']);

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/jadwal_menu/form_edit');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function save_edit_jadwal()
    {

        $data = [
            'id_makanan' => $this->input->post('id_makanan')
        ];
        $where = [
            'id_detail_jadwal' => $this->input->post('id_detail_jadwal')
        ];


        $this->db->update('detail_jadwal', $data, $where);




        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
      Jadwal Tanggal ' . $this->input->post('tanggal') . ' Berhasil Diubah!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
        redirect('admin/jadwal_menu/edit_jadwal/' . $this->input->post('id_jadwal'));
    }


    public function hapus_jadwal($id_jadwal)
    {

        $this->db->delete('jadwal', ['id_jadwal' => $id_jadwal]);
        $this->db->delete('detail_jadwal', ['id_jadwal' => $id_jadwal]);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
      Jadwal Berhasil Dihapus!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
        redirect('admin/jadwal_menu');
    }
}
