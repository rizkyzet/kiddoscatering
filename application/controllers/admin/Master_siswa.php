<?php

class Master_siswa extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Sekolah_model');
        not_logged_in();
        role_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['siswa'] = $this->Siswa_model->get_all_join_kelas_sekolah();


        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_siswa/form_siswa_index');
        $this->load->view('templates_stisla_dashboard/footer');
    }


    public function detail($nis)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'siswa.id_kelas=kelas.id_kelas');
        $this->db->join('sekolah', 'kelas.id_sekolah=sekolah.id_sekolah');
        $this->db->where('siswa.nis', $nis);
        $data['siswa'] = $this->db->get()->row_array();

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_siswa/form_detail_siswa');
        $this->load->view('templates_stisla_dashboard/footer');
    }


    public function tambah_siswa()
    {

        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        // $data['combobox'] = $this->Kelas_model->get_all_join_sekolah();
        $sekolah = $this->Sekolah_model->get_all_sekolah();
        $data['combobox'] = $this->Kelas_model->get_combo_kelas();



        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|is_unique[siswa.nis]');
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('alamat_siswa', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('pwd', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_siswa/form_tambah_siswa');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {

            $data = [
                'nis' => $this->input->post('nis'),
                'image' => 'default.png',
                'nama_siswa' => $this->input->post('nama_siswa'),
                'id_kelas' => $this->input->post('id_kelas'),
                'alamat_siswa' => $this->input->post('alamat_siswa'),
                'jk' => $this->input->post('jk'),
                'account_id' => 0,
                'password' => password_hash($this->input->post('pwd'), PASSWORD_DEFAULT)
            ];

            $this->Siswa_model->insert_siswa($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Berhasil!</div>
          Siswa berhasil ditambahkan!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('admin/master_siswa');
        }
    }

    public function edit_siswa($nis)
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['combobox'] = $this->Kelas_model->get_combo_kelas();
        $data['siswa'] = $this->Siswa_model->get_specific_siswa(['nis' => $nis]);
        $nis = $this->input->post('nis');

        if ($data['siswa']['nis'] == $nis) {
            $is_unique = '';
        } else {
            $is_unique = '|is_unique[siswa.nis]';
        }



        $this->form_validation->set_rules('nis', 'NIS', 'required|trim' . $is_unique);
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('alamat_siswa', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('admin/master_siswa/form_edit_siswa');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {

            $set = [
                'nis' => $this->input->post('nis'),
                'nama_siswa' => $this->input->post('nama_siswa'),
                'id_kelas' => $this->input->post('id_kelas'),
                'alamat_siswa' => $this->input->post('alamat_siswa'),
                'jk' => $this->input->post('jk'),
                'account_id' => $this->input->post('account_id')
            ];
            if (!empty($this->input->post('pwd'))) {
                $set = array_merge($set, ['password' => password_hash($this->input->post('pwd'), PASSWORD_DEFAULT)]);
                $pesan = 'Siswa dan password siswa berhasil diubah !';
            } else {
                $pesan = 'Siswa berhasil diubah !';
            }

            $where = ['nis' => $nis];
            $this->Siswa_model->update_siswa($set, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Berhasil!</div>
       ' . $pesan . '
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('admin/master_siswa');
        }
    }

    public function delete_siswa($nis)
    {

        $this->Siswa_model->delete_siswa(['nis' => $nis]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
      Siswa berhasil dihapus!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
        redirect('admin/master_siswa');
    }
}
