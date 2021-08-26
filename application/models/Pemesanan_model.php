<?php

class Pemesanan_model extends CI_Model
{

    public function tampung_pesanan($tanggal_mulai, $post)
    {
        // var_dump($post['tanggal_mulai']);
        // var_dump(date('Y-m-t', strtotime($post['tanggal_mulai'])));
        // die;

        $tanggal_pesanan = date_range($tanggal_mulai, date('Y-m-t', strtotime($post['tanggal_mulai'])));

        foreach ($tanggal_pesanan as $tgl) {
            $this->db->select('*');
            $this->db->from('pemesanan');
            $this->db->join('detail_pemesanan', 'pemesanan.no_pemesanan=detail_pemesanan.no_pemesanan');
            $this->db->where(['nis' => $this->session->userdata('nis'), 'tgl_detail' => $tgl, 'status_pemesanan' => 'settlement']);
            $cekHarian = $this->db->get()->row_array();

            if (date('l', strtotime($tgl)) == "Sunday" || date('l', strtotime($tgl)) == "Saturday") {
                $pesanan[] = ['tanggal' => $tgl, 'pesan' => 'libur'];
            } else {
                if ($cekHarian) {
                    $pesanan[] = ['tanggal' => $tgl, 'pesan' => 'harian'];
                } else {

                    if (date('l', strtotime($tgl)) == "Monday") {
                        $pesanan[] = ['tanggal' => $tgl, 'pesan' => $post['senin']];
                    } elseif (date('l', strtotime($tgl)) == "Tuesday") {
                        $pesanan[] = ['tanggal' => $tgl, 'pesan' => $post['selasa']];
                    } elseif (date('l', strtotime($tgl)) == "Wednesday") {
                        $pesanan[] = ['tanggal' => $tgl, 'pesan' => $post['rabu']];
                    } elseif (date('l', strtotime($tgl)) == "Thursday") {
                        $pesanan[] = ['tanggal' => $tgl, 'pesan' => $post['kamis']];
                    } elseif (date('l', strtotime($tgl)) == "Friday") {
                        $pesanan[] = ['tanggal' => $tgl, 'pesan' => $post['jumat']];
                    }
                }
            }
        }

        return $pesanan;
    }

    public function template_tanggal($month = null)
    {
        if ($month == null) {
            $month = date('m');
        };
        $tanggal_akhir = days_in_month($month, date('Y'));
        $tanggal = date_range(date("Y-$month-01"), date("Y-$month-$tanggal_akhir"));
        return $tanggal;
    }

    public function template_tanggal_v2($month = null, $year = null)
    {
        if ($month == null) {
            $month = date('m');
        }
        if ($year == null) {
            $year = date('Y');
        }

        $tanggal_akhir = days_in_month($month, $year);

        $tanggal = date_range(date('Y-m-d', strtotime("$year-$month-01")), date('Y-m-d', strtotime("$year-$month-$tanggal_akhir")));
        return $tanggal;
    }
    public function template_hari($month = null)
    {
        if ($month == null) {
            $month = date('m');
        }
        $tanggal_akhir = days_in_month($month, date('Y'));
        $range = date_range(date("Y-$month-01"), date("Y-$month-$tanggal_akhir"));

        foreach ($range as $tanggal) {

            $hari[] = getDayIndo(date('D', strtotime($tanggal)));
        }

        return $hari;
    }

    public function tampung_detail_pembayaran($pesanan)
    {
        $siang = 0;
        $pagi = 0;
        $dobel = 0;
        foreach ($pesanan as $psn) {

            if ($psn['pesan'] == 'p') {
                $pagi += 1;
            } elseif ($psn['pesan'] == 's') {
                $siang += 1;
            } elseif ($psn['pesan'] == 'ps') {
                $dobel += 1;
            }
        };

        $bsiang = 12000 * $siang;
        $bpagi = 12000 * $pagi;
        $bdobel = 24000 * $dobel;
        $total = $bpagi + $bsiang + $bdobel;

        $detail_pembayaran = [
            'pagi' => $pagi,
            'siang' => $siang,
            'dobel' => $dobel,
            'byr_pagi' => $bpagi,
            'byr_siang' => $bsiang,
            'byr_dobel' => $bdobel,
            'total_byr' => $total
        ];
        return $detail_pembayaran;
    }

    public function insert_pemesanan($data)
    {
        $this->db->insert('pemesanan', $data);
    }

    public function insert_detail_pemesanan($no_pesanan, $pesanan)
    {
        foreach ($pesanan as $psn) {
            if ($psn['pesan'] == "libur") {
            } elseif ($psn['pesan'] == "harian") {
            } else {
                $data = [
                    'no_pemesanan' => $no_pesanan,
                    'tgl_detail' => $psn['tanggal'],
                    'pesan' => $psn['pesan']
                ];
                $this->db->insert('detail_pemesanan', $data);
            }
        }
    }


    public function get_pesanan($where)
    {

        $this->db->select('*,monthname(tgl_pesan) as bulan,year(tgl_pesan) as tahun');
        $this->db->from('pemesanan');
        $this->db->join('pembayaran', 'pemesanan.no_pemesanan=pembayaran.no_pemesanan');
        $this->db->where($where);
        $this->db->order_by('tgl_pesan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_detail_pemesanan($where)
    {
        return $this->db->get_where('detail_pemesanan', $where)->result_array();
    }

    public function get_pemesanan($where)
    {
        return $this->db->get_where('pemesanan', $where)->row_array();
    }

    public function tampung_detail_pemesanan($no_pemesanan)
    {
        $pemesanan = $this->db->get_where('pemesanan', ['no_pemesanan' => $no_pemesanan])->row_array();
        $explode = explode('-', $pemesanan['tgl_pesan']);
        $month = $explode[1];
        $tahun = $explode[0];
        $tanggal_akhir = days_in_month($month, $tahun);

        $range = date_range("$tahun-$month-01", "$tahun-$month-$tanggal_akhir");

        foreach ($range as $range) {
            $detail_pemesanan = $this->db->get_where('detail_pemesanan', ['no_pemesanan' => $no_pemesanan, 'tgl_detail' => $range])->row_array();

            if ($no_pemesanan) {
                $tampung[] = ['tanggal' => $detail_pemesanan['tgl_detail'], 'pesan' => $detail_pemesanan['pesan']];
            } else {
                $tampung[] = ['tanggal' => $detail_pemesanan['tgl_detail'], 'pesan' => 'kosong'];
            }
        }

        return $tampung;
    }

    public function get_join_pemesanan_by_kelas($id_kelas)
    {
        $this->db->select('sekolah.nama_sekolah,kelas.nama_kelas,kelas.id_kelas,siswa.nama_siswa,pemesanan.no_pemesanan,detail_pemesanan.pesan,detail_pemesanan.tgl_detail');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where('kelas.id_kelas', $id_kelas);

        $this->db->order_by('detail_pemesanan.tgl_detail', 'ASC');
        return $query = $this->db->get()->result_array();
    }

    public function get_join_pemesanan_by_nis_tanggal($nis, $tanggal)
    {
        $this->db->select('detail_pemesanan.pesan');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where('siswa.nis', $nis);
        $this->db->where('detail_pemesanan.tgl_detail', $tanggal);
        $this->db->order_by('detail_pemesanan.tgl_detail', 'ASC');
        return $query = $this->db->get()->row_array();
    }

    public function get_join_pemesanan_by($where)
    {
        $this->db->select('detail_pemesanan.pesan');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where($where);
        $this->db->order_by('detail_pemesanan.tgl_detail', 'ASC');
        return  $this->db->get()->row_array();
    }
    public function get_join_pemesanan_by_result($where)
    {
        $this->db->select('detail_pemesanan.pesan');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where($where);
        $this->db->order_by('detail_pemesanan.tgl_detail', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_join_pemesananV2_by_result($where)
    {
        $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where($where);
        $this->db->order_by('detail_pemesanan.tgl_detail', 'ASC');
        return $this->db->get()->result_array();
    }
    public function get_join_pemesananV2_by_num($where)
    {
        $this->db->select('siswa.nis,siswa.nama_siswa,detail_pemesanan.pesan,detail_pemesanan.tgl_detail');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where($where);
        $this->db->order_by('detail_pemesanan.tgl_detail', 'ASC');
        return $this->db->get()->num_rows();
    }

    public function get_jumlah_pesanan($where)
    {
        $this->db->select('detail_pemesanan.pesan');
        $this->db->from('sekolah');
        $this->db->join('kelas', 'kelas.id_sekolah = sekolah.id_sekolah');
        $this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pemesanan', 'pemesanan.nis = siswa.nis');
        $this->db->join('detail_pemesanan', 'detail_pemesanan.no_pemesanan = pemesanan.no_pemesanan');
        $this->db->where($where);

        return $query = $this->db->get()->num_rows();
    }


    public function get_all_pemesanan()
    {
        return $this->db->get('pemesanan')->result_array();
    }

    public function get_detail_pemesanan_siswa()
    {
        $this->db->select('*');
        $this->db->from('detail_pemesanan');
        $this->db->join('pemesanan', 'detail_pemesanan.no_pemesanan=pemesanan.no_pemesanan');
        $this->db->join('siswa', 'pemesanan.nis=siswa.nis');
        $cek = $this->db->get()->result_array();

        return $cek;
    }
}
