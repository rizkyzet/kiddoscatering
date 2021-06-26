<?php
class Master_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('*,user_role.id as id_role,user.id as id_user');
        $this->db->from('user');
        $this->db->join('user_role', 'user.role_id=user_role.id');
        $this->db->where_not_in('email', $this->session->userdata('email'));
        $data['users'] = $this->db->get()->result_array();

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_user/form_index_master_user');
        $this->load->view('templates_stisla_dashboard/footer');
    }


    public function tambah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('*');
        $this->db->from('user_role');
        $this->db->where_not_in('id', 2);
        $data['role'] = $this->db->get()->result_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]|valid_email');
        $this->form_validation->set_rules('no_hp', 'No. Handphone', 'required|min_length[12]');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_user/form_tambah_master_user');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {

            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'role_id' => $this->input->post('role_id'),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Berhasil!</div>
          User berhasil ditambahkan!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('admin/master_user');
        }
    }

    public function detail($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['masterUser'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_user/form_detail_master_user');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function edit($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['editUser'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->db->select('*');
        $this->db->from('user_role');
        $this->db->where_not_in('id', 2);
        $data['role'] = $this->db->get()->result_array();

        $is_unique = $this->input->post('email') == $data['editUser']['email'] ? '' : '|is_unique[user.email]';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email' . $is_unique);
        $this->form_validation->set_rules('no_hp', 'No. Handphone', 'required|min_length[12]|numeric');
        $this->form_validation->set_rules('role_id', 'Role', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_user/form_edit_master_user');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $set = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp'),
                'role_id' => $this->input->post('role_id'),
            ];

            if (!empty($this->input->post('password'))) {
                $set =  array_merge($set, ['password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)]);
                $pesan = 'Data dan password user berhasil diubah!';
            } else {
                $pesan = 'User berhasil diubah!';
            }

            $this->db->update('user', $set, ['id' => $id]);
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
            redirect('admin/master_user');
        }
    }


    public function hapus($id)
    {
        $this->db->delete('user', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
      User berhasil dihapus!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
        redirect('admin/master_user');
    }
}
