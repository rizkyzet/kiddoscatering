<?php

class Master_sekolah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sekolah_model');
        role_logged_in();
        not_logged_in();
    }

    public function index()
    {

        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['sekolah'] = $this->Sekolah_model->get_all_sekolah();
        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_sekolah/form_sekolah_index');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function tambah_sekolah()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);

        $nama = $this->input->post('nama_sekolah');
        $alamat = $this->input->post('alamat_sekolah');
        $kontak = $this->input->post('kontak_sekolah');

        $this->form_validation->set_rules('nama_sekolah', 'Nama sekolah', 'required|trim');
        $this->form_validation->set_rules('alamat_sekolah', 'Alamat sekolah', 'required|trim');
        $this->form_validation->set_rules('kontak_sekolah', 'Kontak sekolah', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_sekolah/form_tambah_sekolah');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $data = ['nama_sekolah' => $nama, 'alamat_sekolah' => $alamat, 'kontak_sekolah' => $kontak];
            $this->Sekolah_model->insert_sekolah($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Berhasil!</div>
          Sekolah berhasil ditambahkan!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('admin/master_sekolah');
        }
    }

    public function edit_sekolah($id)
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['sekolah'] = $this->Sekolah_model->get_specific_sekolah($id);

        $this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'required|trim');
        $this->form_validation->set_rules('alamat_sekolah', 'Alamat Sekolah', 'required|trim');
        $this->form_validation->set_rules('kontak_sekolah', 'Kontak Sekolah', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_sekolah/form_edit_sekolah');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {


            $nama = $this->input->post('nama_sekolah');
            $alamat = $this->input->post('alamat_sekolah');
            $kontak = $this->input->post('kontak_sekolah');

            $data = ['nama_sekolah' => $nama, 'alamat_sekolah' => $alamat, 'kontak_sekolah' => $kontak];
            $where = ['id_sekolah' => $id];
            $this->Sekolah_model->update_sekolah($data, $where);

            if ($this->db->affected_rows() > 0) {

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
                <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                <div class="alert-body">
                  <div class="alert-title">Berhasil!</div>
              Sekolah berhasil diubah!
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>');
                redirect('admin/master_sekolah');
            } else {
                redirect('admin/master_sekolah');
            }
        }
    }

    public function detail_sekolah($id)
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['sekolah'] = $this->Sekolah_model->get_specific_sekolah($id);


        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_sekolah/form_detail_sekolah');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function delete_sekolah($id)
    {
        $this->Sekolah_model->delete_sekolah($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
      Sekolah berhasil dihapus!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
        redirect('admin/master_sekolah');
    }
}
