<?php

class Menu_makanan_model extends CI_Model
{

    public function insert_makanan($data)
    {
        $this->db->insert('menu_makanan', $data);
    }

    public function get_all_makanan()
    {

        return $this->db->get('menu_makanan')->result_array();
    }

    public function get_specific_makanan($where)
    {

        return $this->db->get_where('menu_makanan', $where)->row_array();
    }

    public function update_menu_makanan($set, $where)
    {
        $this->db->update('menu_makanan', $set, $where);
    }
    public function delete_makanan($where)
    {
        $this->db->delete('menu_makanan', $where);
    }

    public function get_menu_pengganti($select)
    {
        $this->db->where_in('id_makanan', $select);
        return $this->db->get('menu_makanan')->result_array();
    }
}
