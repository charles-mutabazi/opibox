<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class g_login extends CI_Controller {
	function __construct() {
		parent::__construct();
        
    }
	
	function index() {
		if($this->session->userdata('student_id')){
			redirect('home');
		}
		
		$this->load->view('glogin_view');
	}
	
	
	
}


 ?>