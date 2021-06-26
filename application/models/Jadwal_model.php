<?php

class Jadwal_model extends CI_Model
{


    public function get_all_jadwal()
    {

        $this->db->order_by('tahun DESC, bulan ASC');
        return $this->db->get('jadwal')->result_array();
    }
}
