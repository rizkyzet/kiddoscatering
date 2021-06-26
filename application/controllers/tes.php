<?php
class Tes extends CI_Controller
{

    public function index()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required');

        $this->load->view('_tes/index-view');

        var_dump($this->session->flashdata());

        // if ($this->form_validation->run() == false) {
        //     var_dump(validation_errors());

        //     $this->load->view('_tes/index-view');
        // } else {
        //     echo "berhasil";
        // }
    }

    public function insert()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('tes');
        } else {
            echo "berhasil";
            var_dump($this->input->post());
        }
    }
}
