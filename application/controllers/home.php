<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('user_id')){
			redirect('login');
			//$this->output->nocache();
		}
		
	}

	function index(){

//		$data['first_name'] = $this->session->userdata('username');
//		$data['last_name'] = $this->session->userdata('last_name');
//		$data['student_id'] = $this->session->userdata('student_id');
//		$data['username'] = $this->session->userdata('username');
//		$data['user_role'] = $this->session->userdata('user_role');

        $data['avatar_path'] = base_url() . "images/profile_pic/avatar.png";

        $data['logged_userid'] = $this->session->userdata('user_id');
        $data['logged_user'] = $this->user_model->get_user_by_id($data['logged_userid']);

        if ($data['logged_user']->profile_pic != ""){
            $data['pic_path'] = base_url() . "images/profile_pic/".$data['logged_user']->profile_pic;
        }else{
            $data['pic_path'] = $data['avatar_path'];
        }
		
		$data['all_posts'] = $this->post_model->get_posts();

        #$data['content'] = 'home_view';
        $data['page_title'] = 'Home';
        $data['content'] = 'home_view_new';

		$this->load->view($this->layout, $data);
	}

//    public function image_path($image_name){
//        if ($image_name == ""){
//            return base_url() . "images/profile_pic/avatar.png";
//        }else {
//            return base_url() . "images/profile_pic/".$image_name;
//        }
//    }
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
