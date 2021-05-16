<?php

class Kelas_model extends CI_Model
{

    public function get_all_kelas()
    {
        return $this->db->get('kelas')->result_array();
    }

    public function get_all_join_sekolah()
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->join('sekolah', 'sekolah.id_sekolah = kelas.id_sekolah');
        $this->db->order_by('sekolah.nama_sekolah ASC');
        $this->db->order_by('kelas.nama_kelas ASC');
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function insert_kelas($data)
    {
        $this->db->insert('kelas', $data);
    }

    public function get_spesific_kelas($where)
    {
        return $this->db->get_where('kelas', $where)->row_array();
    }

    public function get_spesific_kelas_result($where)
    {
        return $this->db->order_by('nama_kelas', 'ASC')->get_where('kelas', $where)->result_array();
    }



    public function update_kelas($set, $where)
    {
        $this->db->update('kelas', $set, $where);
    }

    public function delete_kelas($where)
    {
        $this->db->delete('kelas', $where);
    }

    public function get_combo_kelas()
    {
        $sekolah = $this->db->get('sekolah')->result_array();

        foreach ($sekolah as $index => $sekolah) {
            $data[]['nama_sekolah'] = $sekolah['nama_sekolah'];
            foreach ($this->db->order_by('nama_kelas', 'ASC')->get_where('kelas', ['id_sekolah' => $sekolah['id_sekolah']])->result_array() as $kelas) {
                // $data['combobox'][$index]['kelas']['id_kelas'][] = $kelas['id_kelas'];
                // $data['combobox'][$index]['kelas']['nama_kelas'][] = $kelas['nama_kelas'];
                $data[$index]['kelas'][] = ['id_kelas' => $kelas['id_kelas'], 'nama_kelas' => $kelas['nama_kelas']];
            }
        }
        return $data;
    }
}
