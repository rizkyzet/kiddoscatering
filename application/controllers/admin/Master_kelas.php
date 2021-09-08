<?php

class Master_kelas extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Sekolah_model');
        role_logged_in();
        not_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['kelas'] = $this->Kelas_model->get_all_join_sekolah();

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_kelas/form_kelas_index');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function tambah_kelas()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['combobox'] = $this->Sekolah_model->get_all_sekolah();

        $sekolah = $this->input->post('sekolah');
        $nama_kelas = $this->input->post('nama_kelas');
        // $wali_kelas = $this->input->post('wali_kelas');
        // $kontak = $this->input->post('kontak_wali_kelas');


        $apakahNamaKelasSama = $this->db->get_where('kelas', ['id_sekolah' => $sekolah, 'nama_kelas' => $nama_kelas])->row_array();
        if ($apakahNamaKelasSama) {
            $is_unique = '|is_unique[kelas.nama_kelas]';
        } else {
            $is_unique = '';
        }



        $this->form_validation->set_rules('sekolah', 'Sekolah', 'required');
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required' . $is_unique);
        // $this->form_validation->set_rules('wali_kelas', 'Wali Kelas', 'required');
        // $this->form_validation->set_rules('kontak_wali_kelas', 'Kontak', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_kelas/form_tambah_kelas');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $data = [
                'id_sekolah' => $sekolah,
                'nama_Kelas' => $nama_kelas
                // 'wali_kelas' => $wali_kelas,
                // 'kontak_wali_kelas' => $kontak
            ];

            $this->Kelas_model->insert_kelas($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Berhasil!</div>
          Kelas berhasil ditambahkan!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('admin/master_kelas');
        }
    }

    public function edit_kelas($id)
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['kelas'] = $this->Kelas_model->get_spesific_kelas(['id_kelas' => $id]);
        $data['combobox'] = $this->Sekolah_model->get_all_sekolah();


        $sekolah = $this->input->post('id_sekolah');
        $nama_kelas = $this->input->post('nama_kelas');


        if (!is_null($sekolah)) {
            if ($data['kelas']['nama_kelas'] == $nama_kelas && $data['kelas']['id_sekolah'] == $sekolah) {
                $is_unique = '';
            } else {
                $apakahNamaKelasSama = $this->db->get_where('kelas', ['id_sekolah' => $sekolah, 'nama_kelas' => $nama_kelas])->row_array();
                if ($apakahNamaKelasSama) {
                    $is_unique = '|is_unique[kelas.nama_kelas]';
                } else {
                    $is_unique = '';
                }
            }
        } else {
            $is_unique = '';
        }



        $this->form_validation->set_rules('id_sekolah', 'Sekolah', 'required|trim');
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim' . $is_unique);
        // $this->form_validation->set_rules('wali_kelas', 'Wali Kelas', 'required|trim');
        // $this->form_validation->set_rules('kontak_wali_kelas', 'Kontak', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_kelas/form_edit_kelas');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {


            $set = [
                'id_sekolah' => $this->input->post('id_sekolah'),
                'nama_kelas' => $this->input->post('nama_kelas'),
                // 'wali_kelas' => $this->input->post('wali_kelas'),
                // 'kontak_wali_kelas' => $this->input->post('kontak_wali_kelas')

            ];

            $where = ['id_kelas' => $id];
            $this->Kelas_model->update_kelas($set, $where);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
                <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                <div class="alert-body">
                  <div class="alert-title">Berhasil!</div>
              Kelas berhasil diubah!
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>');
                redirect('admin/master_kelas');
            } else {
                redirect('admin/master_kelas');
            }
        }
    }

    public function delete_kelas($id)
    {
        $where = ['id_kelas' => $id];
        $this->Kelas_model->delete_kelas($where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Berhasil!</div>
          Kelas berhasil dihapus!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
        redirect('admin/master_kelas');
    }
}
