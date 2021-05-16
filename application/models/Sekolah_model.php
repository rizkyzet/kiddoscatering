<?php

class Sekolah_model extends CI_Model
{

    public function get_all_sekolah()
    {
        return $this->db->get('sekolah')->result_array();
    }

    public function insert_sekolah($data)
    {
        return $this->db->insert('sekolah', $data);
    }

    public function get_specific_sekolah($id)
    {
        return $this->db->get_where('sekolah', ['id_sekolah' => $id])->row_array();
    }

    public function get_specific_sekolahV2($where)
    {

        return $this->db->get_where('sekolah', $where)->row_array();
    }
    public function update_sekolah($set, $where)
    {
        return $this->db->update('sekolah', $set, $where);
    }

    public function delete_sekolah($id)
    {
        return $this->db->delete('sekolah', ['id_sekolah' => $id]);
    }
}
