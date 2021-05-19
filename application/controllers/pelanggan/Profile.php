<?php

class Profile extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Image_model');
        $this->load->model('Menu_makanan_model');
        $this->load->model('Menu_pengganti_model');
        $this->load->model('Validation_model');

        not_logged_in();
        role_logged_in();
    }

    public function index()
    {

        $data['user'] = $this->User_model->get_user_by_login();
        $data['kelas'] = $this->db->get_where('kelas', ['id_kelas' => $data['user']['id_kelas']])->row_array();
        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/profile/form_profile_index');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function edit_profile()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $data['sekolah'] = $this->db->get('sekolah')->result_array();
        // $data['kelas'] = $this->db->get('kelas')->result_array();
        $data['tes'] = ['khalifa' => ['abu_bakar', 'tes', 'tus']];

        $optgroup = [];
        foreach ($data['sekolah'] as $index => $sklh) {
            $kelas = $this->db->get_where('kelas', ['id_sekolah' => $sklh['id_sekolah']])->result_array();
            $optgroup[$sklh['nama_sekolah']] = $kelas;
        }

        $data['kelas'] = $optgroup;

        // validation rules
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim');
        $this->form_validation->set_rules('nama_siswa', 'Nama', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('alamat_siswa', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
            $this->load->view('pelanggan/profile/form_edit_profile');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {

            var_dump($this->input->post());

            $nama_siswa = $this->input->post('nama_siswa');
            $id_kelas = $this->input->post('id_kelas');
            $alamat_siswa = $this->input->post('alamat_siswa');
            $jk = $this->input->post('jk');
            $upload = $_FILES['image']['name'];
            $old_image = $data['user']['image'];
            $set = ['nama_siswa' => $nama_siswa, 'id_kelas' => $id_kelas, 'alamat_siswa' => $alamat_siswa, 'jk' => $jk];

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
            $where = ['nis' => $this->session->userdata('nis')];
            $this->db->update('siswa', $set, $where);
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
                redirect('pelanggan/profile');
            } else {
                redirect('pelanggan/profile');
            }
            die;

            // salah
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
                redirect('pelanggan/profile');
            } else {
                redirect('pelanggan/profile');
            }
        }
    }


    public function change_password()
    {
        $data['user'] = $this->User_model->get_user_by_login();


        $my_password = $this->input->post('my_password');
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');

        $this->form_validation->set_rules('my_password', 'Password saat ini', [['my_password_check', [$this->Validation_model, 'my_password_check']]]);
        $this->form_validation->set_rules('password', 'Password baru', 'required', ['required' => 'Password harus diisi!']);
        $this->form_validation->set_rules('password2', 'Konfirmasi password', 'required|matches[password]', ['required' => 'Password harus diisi!', 'matches' => 'Konfirmasi password tidak cocok!']);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
            $this->load->view('pelanggan/profile/form_ganti_password');
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
            redirect('pelanggan/profile/change_password');
        }
    }


    public function ganti_menu_makanan()
    {


        $data['user'] = $this->User_model->get_user_by_login();
        $where = ['ganti_menu.nis' => $this->session->userdata('nis')];
        $data['menu_pengganti'] =  $this->Menu_pengganti_model->get_spesific_join_ganti_menu($where);

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
        $this->load->view('pelanggan/profile/form_ganti_menu');
        $this->load->view('templates_stisla_dashboard/footer');
    }

    public function set_ganti_menu()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $data['menu_tidak_suka'] = $this->Menu_makanan_model->get_all_makanan();
        $select = [15, 16];
        $data['menu_pengganti'] = $this->Menu_makanan_model->get_menu_pengganti($select);

        $this->form_validation->set_rules('menu_tidak_suka', 'Menu', 'required');
        $this->form_validation->set_rules('menu_pengganti', 'Menu Pengganti', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_pelanggan');
            $this->load->view('pelanggan/profile/form_set_ganti_menu');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $nis = $this->session->userdata('nis');
            $id_makanan = $this->input->post('id_menu_tidak_suka');
            $id_pengganti = $this->input->post('id_menu_pengganti');
            $cek = $this->db->get_where('ganti_menu', ['id_makanan' => $id_makanan, 'nis' => $nis])->row_array();

            if ($cek) {
                $menu = $this->db->get_where('menu_makanan', ['id_makanan' => $cek['id_makanan']])->row_array();
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-has-icon alert-dismissible fade show" role="alert">
                <div class="alert-icon"><i class="fas fa-times-circle"></i></div>
                <div class="alert-body">
                  <div class="alert-title">Gagal!</div>
               Menu pengganti ' . $menu['nama_makanan'] . ' sudah terdata!
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>');
                redirect('pelanggan/profile/ganti_menu_makanan');
            } else {

                $data = ['nis' => $nis, 'id_makanan' => $id_makanan, 'id_makanan_pengganti' => $id_pengganti];
                $this->Menu_pengganti_model->insert_ganti_menu($data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
                <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                <div class="alert-body">
                  <div class="alert-title">Berhasil!</div>
               Menu pengganti berhasil ditambahkan!
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>');
                redirect('pelanggan/profile/ganti_menu_makanan');
            }
        }
    }

    public function hapus_ganti_menu($id)
    {
        $where = ['id_ganti_menu' => $id];
        $this->Menu_pengganti_model->delete_ganti_menu($where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
       Menu pengganti berhasil dihapus!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
        redirect('pelanggan/profile/ganti_menu_makanan');
    }
}
