<?php
/**
 * Created by PhpStorm.
 * User: Charl
 * Date: 5/20/15
 * Time: 10:37 PM
 */
class Upload_verbose extends MY_Controller {
    public function verbose_upload()
    {
        $config['upload_path'] = "./images/profile_pic";
        $config['allowed_types'] = '*';
        //$this->load->library('upload', $config);
        $this->upload->do_upload();
        $data['errors'] = $this->upload->display_errors('<p>', '</p>');
        $data['result'] = print_r($this->upload->data(), true);
        $data['files']  = print_r($_FILES, true);
        $data['post']   = print_r($_POST, true);
        $this->load->view('result', $data);
    }
}