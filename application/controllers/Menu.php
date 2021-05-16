<?php
class Menu extends CI_Controller
{

    public function index()
    {

        $data['user'] = $this->User_model->get_user_by_login();
        $data['kategori'] = $this->db->get('kategori')->result_array();

        foreach ($data['kategori'] as $index => $kategori) {
            $menu_makanan[] = ['nama_kategori' => $kategori['nama_kategori']];
            $menu_makanan[$index]['menu_makanan'] = $this->db->get_where('menu_makanan', ['id_kategori' => $kategori['id_kategori']])->result_array();
        }


        $data['menu_makanan'] = $menu_makanan;

        $this->load->view('templates_homepage/header', $data);
        $this->load->view('templates_homepage/navbar');
        $this->load->view('homepage/menu/menu');
        $this->load->view('templates_homepage/footer');
    }
}
