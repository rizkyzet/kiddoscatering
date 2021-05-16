<?php


class Master_makanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sekolah_model');
        $this->load->model('Menu_makanan_model');
        $this->load->model('Menu_pengganti_model');
    }

    public function index()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['makanan'] = $this->Menu_makanan_model->get_all_makanan();

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_makanan/form_index_master_makanan');
        $this->load->view('templates_stisla_dashboard/footer');
    }


    public function tambah_makanan()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $this->form_validation->set_rules('nama_makanan', 'Nama Makanan', 'required|is_unique[menu_makanan.nama_makanan]|trim', ['is_unique' => 'Makanan sudah ada!', 'required' => 'Nama Makanan Harus Diisi!']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Makanan', 'required|trim', ['required' => 'Deskripsi Harus Diisi!']);
        $this->form_validation->set_rules('kategori', 'Kategori Makanan', 'required|trim', ['required' => 'Kategori Harus Diisi!']);
        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_makanan/form_tambah');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {

            // var_dump($this->input->post());
            // var_dump($_FILES['image']);

            $nama_makanan = $this->input->post('nama_makanan');
            $deskripsi = $this->input->post('deskripsi');
            $id_kategori = $this->input->post('kategori');
            // $image = $_FILES['image']['name'];

            $data = ['nama_makanan' => $nama_makanan, 'id_kategori' => $id_kategori, 'deskripsi_makanan' => $deskripsi];

            $new_name = strtolower($this->input->post('nama_makanan'));
            $config['upload_path'] = './assets/upload/menu_makanan';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '2048';
            $config['file_name'] = $new_name;
            $config['remove_spaces'] = true;
            $config['overwrite'] = true;


            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data_image = ['image_makanan' => $this->upload->data('file_name')];
                $data = array_merge($data, $data_image);

                $this->Menu_makanan_model->insert_makanan($data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
                <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                <div class="alert-body">
                  <div class="alert-title">Berhasil!</div>
              Menu Makanan Berhasil Ditambahkan!
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>');
                redirect('admin/Master_makanan');
            } else {

                $this->session->set_flashdata('pesan_upload', '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Upload failed!</h4><p>' . $this->upload->display_errors() . '</p></div>');
                redirect('admin/master_makanan/tambah_makanan');
            }
        }
    }

    public function edit_makanan($id)
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $where = ['id_makanan' => $id];
        $data['makanan'] = $this->Menu_makanan_model->get_specific_makanan($where);
        $data['kategori'] = $this->db->get('kategori')->result_array();


        $this->form_validation->set_rules('nama_makanan', 'Nama Makanan', 'required|trim', ['is_unique' => 'Makanan sudah ada!', 'required' => 'Nama Makanan Harus Diisi!']);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Makanan', 'required|trim', ['required' => 'Deskripsi Harus Diisi!']);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_makanan/form_edit');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $menu = $this->Menu_makanan_model->get_specific_makanan(['id_makanan' => $id]);
            $id_kategori = $this->input->post('kategori');

            $nama_makanan = ucwords($this->input->post('nama_makanan'));
            $deksripsi = $this->input->post('deskripsi');
            $upload = $_FILES['image']['name'];

            $set = ['nama_makanan' => $nama_makanan, 'id_kategori' => $id_kategori, 'deskripsi_makanan' => $deksripsi];

            if ($nama_makanan !== $menu['nama_makanan']) {
                $location = './assets/upload/menu_makanan/';
                $old_name = $menu['image_makanan'];
                $extension = explode('.', $old_name)[1];
                $new_name = strtolower(str_replace(' ', '_', $nama_makanan));

                rename($location . $old_name, $location . $new_name . "." . $extension);
                $set_image = ['image_makanan' => $new_name . "." . $extension];
            } else {
                $set_image = ['image_makanan' => $menu['image_makanan']];
            }


            if ($upload) {
                $new_name = strtolower($this->input->post('nama_makanan'));
                $config['upload_path'] = './assets/upload/menu_makanan';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['file_name'] = $new_name;
                $config['remove_spaces'] = true;
                $config['overwrite'] = true;


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $set_image = ['image_makanan' => $this->upload->data('file_name')];
                    $set = array_merge($set, $set_image);
                    $this->Menu_makanan_model->update_menu_makanan($set, $where);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
                    <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="alert-body">
                      <div class="alert-title">Berhasil!</div>
                  Menu Makanan Berhasil Diubah!
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>');
                    redirect('admin/Master_makanan');
                } else {

                    $this->session->set_flashdata('pesan_upload', '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Upload failed!</h4><p>' . $this->upload->display_errors() . '</p></div>');
                    redirect('admin/master_makanan/edit_makanan/' . $id);
                }
            }


            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
            <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
            <div class="alert-body">
              <div class="alert-title">Berhasil!</div>
          Menu Makanan Berhasil Diubah!
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');

            $set = array_merge($set, $set_image);
            $this->Menu_makanan_model->update_menu_makanan($set, $where);
            redirect('admin/Master_makanan');
        }



        // end of method
    }


    public function hapus_makanan($id)
    {
        $where = ['id_makanan' => $id];
        $menu = $this->Menu_makanan_model->get_specific_makanan($where);

        unlink(FCPATH . 'assets/upload/menu_makanan/' . $menu['image_makanan']);
        $this->Menu_makanan_model->delete_makanan($where);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-has-icon alert-dismissible fade show" role="alert">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Berhasil!</div>
      Menu Makanan Berhasil Dihapus!
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>');
        redirect('admin/master_makanan');
    }


    public function set_menu_mingguan()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['menu'] = $this->Menu_makanan_model->get_all_makanan();

        $this->load->view('templates_stisla_dashboard/header', $data);
        $this->load->view('templates_stisla_dashboard/navbar');
        $this->load->view('templates_stisla_dashboard/sidebar_admin');
        $this->load->view('admin/master_makanan/form_set_mingguan');
        $this->load->view('templates_stisla_dashboard/footer');
    }
}
