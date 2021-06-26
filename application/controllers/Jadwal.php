<?php
class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mycal_model');
    }
    public function index()
    {
        $data['user'] = $this->User_model->get_user_by_login();
        $year = date('Y');
        $month = date('m');
        $type = 'tampil';
        $jadwal = $this->db->get_where('jadwal', ['bulan' => $month, 'tahun' => $year])->row_array();
        if ($jadwal) {

            $id_jadwal = $jadwal['id_jadwal'];
            $data['calendar'] = "<tr>
            <th >Min</th>
            <th>Sen</th>
            <th>Sel</th>
            <th>Rab</th>
            <th>Kam</th>
            <th>Jum</th>
            <th>Sab</th>
        </tr>";
            $data['calendar'] .= $this->Mycal_model->getCalendarJadwal($year, $month, $type, $id_jadwal);
        } else {
            $data['calendar'] = "<tr>
            <th >Min</th>
            <th>Sen</th>
            <th>Sel</th>
            <th>Rab</th>
            <th>Kam</th>
            <th>Jum</th>
            <th>Sab</th>
        </tr>";
            $data['calendar'] .= $this->Mycal_model->getCalendarReg($year, $month);
        }

        $this->load->view('templates_homepage/header', $data);
        $this->load->view('templates_homepage/navbar');
        $this->load->view('homepage/jadwal/jadwal');
        $this->load->view('templates_homepage/footer');
    }
}
