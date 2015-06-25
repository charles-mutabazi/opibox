<?php
/**
 * Created by PhpStorm.
 * User: Charl
 * Date: 5/8/15
 * Time: 2:09 PM
 */

class User extends MY_Controller {
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('user_id')){
            redirect('login');
            //$this->output->nocache();
        }

        $config['upload_path'] = './images/profile_pic';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = 'TRUE';
        $this->upload->initialize($config);

    }

    function profile(){

        $data['userid'] = $this->uri->segment(2);
        $data['avatar_path'] = base_url() . "images/profile_pic/avatar.png";
        $data['logged_userid'] = $this->session->userdata('user_id');
        $data['user_page'] = $this->user_model->get_user_by_id($data['userid']);

        #$data['logged_user'] = $this->user_model->get_user_by_id($data['logged_userid']);

        if ($data['user_page']->profile_pic != ""){
            $data['pic_path'] = base_url() . "images/profile_pic/".$data['user_page']->profile_pic;
        }else{
            $data['pic_path'] = $data['avatar_path'];
        }
        $data['content'] = 'profile_page';
        $data['page_title'] = $data['user_page']->last_name;


        //$data['user_posts'] = $this->post_model->get_post_by_userid($data['userid']);

        $this->load->view($this->layout, $data);
    }

    function edit_user(){

        //$filename = null;
        if($this->upload->do_upload()){
            $image_data = $this->upload->data();
            $filename = $image_data['file_name'];

            //this loads the image model
            $this->load->model('image_model');
            $this->image_model->image_manuplation();
        }

        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'course_type' => $this->input->post('course_type'),
            'academic_year' => $this->input->post('academic_year'),
            'profile_pic' => $filename
        );
        //echo $filename;
        $user_id = $this->input->post('user_id');
        $this->user_model->edit_user($data, $user_id);

        redirect('user/'. $this->session->userdata('user_id'));
    }
}