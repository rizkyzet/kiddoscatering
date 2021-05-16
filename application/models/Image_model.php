<?php

class Image_model extends CI_Model
{

    public $upload_path = null,
        $unlink_path = null,
        $new_name = null;

    protected function set_config_upload()
    {
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']     = '20048';
        $config['upload_path'] = $this->upload_path;
        $config['file_name'] = $this->new_name;
        $this->load->library('upload', $config);
    }

    public function do_upload_update_image_user($old_image)
    {
        $this->set_config_upload();
        if ($this->upload->do_upload('image')) {
            if ($old_image != 'default.png') {
                unlink(FCPATH . $this->unlink_path . $old_image);
            }
            return true;
        } else {
            return false;
        }
    }

    public function do_upload_image_user()
    {
    }
}
