<?php

class Menu_pengganti_model extends CI_Model
{

    public function insert_ganti_menu($data)
    {
        $this->db->insert('ganti_menu', $data);
    }

    public function insert_menu_pengganti($data)
    {
        $this->db->insert('menu_pengganti', $data);
    }

    public function get_all_menu_pengganti()
    {
        return $this->db->get('menu_pengganti')->result_array();
    }

    public function get_spesific_join_ganti_menu($where)
    {
        $this->db->where($where);
        //     return $this->db->query("select 
        //     ganti_menu.*
        //   , a.nama_makanan AS menu_tidak_suka
        //   , b.nama_makanan AS menu_pengganti 
        //   FROM ganti_menu 
        //   INNER JOIN menu_makanan as a ON a.id_makanan = ganti_menu.id_makanan 
        //   INNER JOIN menu_makanan as b ON b.id_makanan = ganti_menu.id_makanan_pengganti")->result_array();

        $this->db->select('ganti_menu.*
    , a.nama_makanan AS menu_tidak_suka
    , b.nama_makanan AS menu_pengganti ,siswa.nama_siswa');
        $this->db->from('ganti_menu');
        $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
        $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');
        $this->db->join('siswa', 'siswa.nis = ganti_menu.nis', 'inner');
        return $this->db->get()->result_array();
    }

    public function delete_ganti_menu($where)
    {
        $this->db->delete('ganti_menu', $where);
    }

    public function cek_ganti_menu($where)
    {
        $this->db->where($where);
        $this->db->select('ganti_menu.*
    , a.nama_makanan AS menu_tidak_suka
    , b.nama_makanan AS menu_pengganti ,siswa.nama_siswa');
        $this->db->from('ganti_menu');
        $this->db->join('menu_makanan as a', 'a.id_makanan = ganti_menu.id_makanan', 'inner');
        $this->db->join('menu_makanan as b', 'b.id_makanan = ganti_menu.id_makanan_pengganti', 'inner');
        $this->db->join('siswa', 'siswa.nis = ganti_menu.nis', 'inner');
        return $this->db->get()->row_array();
    }
}
