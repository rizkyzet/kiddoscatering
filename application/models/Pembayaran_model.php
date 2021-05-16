<?php

class Pembayaran_model extends CI_Model
{
    public function insert_pembayaran($data)
    {
        return $this->db->insert('pembayaran', $data);
    }

    public function update_pembayaran_cancel($no_pembayaran)
    {
        return $this->db->update('pembayaran', ['status_pembayaran' => 'cancel'], ['no_pembayaran' => $no_pembayaran]);
    }

    public function get_pembayaran_join_pemesanan($where = null)
    {
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('pemesanan', 'pembayaran.no_pemesanan=pemesanan.no_pemesanan');
        $this->db->where($where);
        return $this->db->get()->row_array();
    }
}
