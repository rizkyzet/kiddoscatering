<?php

class Profile extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Image_model');
        $this->load->model('Validation_model');
        not_logged_in();
        role_logged_in();
    }

    public function index()
    {

        $data['user'] = $this->User_model->get_user_by_login();

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/profile/form_profile_index');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function edit_profile()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No. Handphone', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/profile/form_edit_profile');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $email = $this->input->post('email');
            $nama = $this->input->post('nama');
            $no_hp = $this->input->post('no_hp');
            $upload = $_FILES['image']['name'];
            $old_image = $data['user']['image'];

            $set = ['nama' => $nama, 'no_hp' => $no_hp];

            if ($upload) {

                $this->Image_model->upload_path = './assets/upload/profile';
                $this->Image_model->unlink_path = 'assets/upload/profile/';
                if ($this->Image_model->do_upload_update_image_user($old_image) == true) {
                    $new_image = ['image' => $this->upload->data('file_name')];
                    $set = array_merge($set, $new_image);
                } else {

                    $this->session->set_flashdata('pesan_upload', '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Upload failed!</h4><p>' . $this->upload->display_errors() . '</p></div>');
                }
            }

            $where = ['email' => $email];
            $this->User_model->update_user($set, $where);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
       Profile berhasil diubah!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
                redirect('admin/profile');
            } else {
                redirect('admin/profile');
            }
        }
    }


    public function change_password()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);

        $my_password = $this->input->post('my_password');
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');

        $this->form_validation->set_rules('my_password', 'Password saat ini', [['my_password_check', [$this->Validation_model, 'my_password_check']]]);
        $this->form_validation->set_rules('password', 'Password baru', 'required', ['required' => 'Password harus diisi!']);
        $this->form_validation->set_rules('password2', 'Konfirmasi password', 'required|matches[password]', ['required' => 'Password harus diisi!', 'matches' => 'Konfirmasi password tidak cocok!']);
        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/profile/form_ganti_password');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $set = ['password' => $hash];
            $where = ['email' => $this->session->userdata('email')];

            $this->User_model->update_user($set, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Berhasil!</div>
           Password berhasil diubah!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
            redirect('admin/profile/change_password');
        }
    }
}
