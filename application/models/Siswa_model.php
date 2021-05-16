<?php

class Siswa_model extends CI_Model
{
    public function get_specific_siswa($where)
    {
        $query = $this->db->get_where('siswa', $where)->row_array();
        return $query;
    }

    public function get_all_siswa()
    {

        return $this->db->get('siswa');
    }

    public function get_all_join_kelas_sekolah()
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        $this->db->join('sekolah', 'sekolah.id_sekolah = kelas.id_sekolah', 'left');
        $this->db->order_by('sekolah.nama_sekolah ASC');
        $this->db->order_by('kelas.nama_kelas ASC');
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function get_siswa_join_kelas_sekolah($where)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        $this->db->join('sekolah', 'sekolah.id_sekolah = kelas.id_sekolah', 'left');
        $this->db->where($where);
        $query = $this->db->get()->row_array();

        return $query;
    }

    public function insert_siswa($data)
    {
        $this->db->insert('siswa', $data);
    }

    public function update_siswa($set, $where)
    {

        $this->db->update('siswa', $set, $where);
    }

    public function delete_siswa($where)
    {

        $this->db->delete('siswa', $where);
    }
}
