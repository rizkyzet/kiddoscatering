<?php

class Master_kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function redirectHome()
    {
        return redirect('admin/master_kategori');
    }

    public function index()
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[kategori.nama_kategori]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_kategori/form_kategori_index');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $post = [
                'nama_kategori' => $this->input->post('nama_kategori')
            ];

            $this->db->insert('kategori', $post);

            alert('Data kategori berhasil ditambah!', 'success');
            $this->redirectHome();
        }
    }


    public function edit($id)
    {
        $data['user'] = $this->User_model->get_spesific_user(['email' => $this->session->userdata('email')]);
        $data['kategori'] = $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();

        $nama_kategori = $this->input->post('nama_kategori');
        $is_unique =  $nama_kategori == $data['kategori']['nama_kategori'] ? '' : '|is_unique[kategori.nama_kategori]';

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required' . $is_unique);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_stisla_dashboard/header', $data);
            $this->load->view('templates_stisla_dashboard/navbar');
            $this->load->view('templates_stisla_dashboard/sidebar_admin');
            $this->load->view('admin/master_kategori/form_edit_kategori');
            $this->load->view('templates_stisla_dashboard/footer');
        } else {
            $post = [
                'nama_kategori' => $this->input->post('nama_kategori')
            ];

            $this->db->update('kategori', $post, ['id_kategori' => $id]);
            if ($this->db->affected_rows()) {

                alert('Data kategori berhasil ditambah!', 'success');
            }

            $this->redirectHome();
        }
    }

    public function delete($id)
    {
        $this->db->delete('kategori', ['id_kategori' => $id]);
        alert('Data kategori berhasil dihapus!', 'success');
        $this->redirectHome();
    }
}
