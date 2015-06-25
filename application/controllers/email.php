
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class email extends CI_Controller {
	function __construct() {
		parent::__construct();
        
    }
	
	function index() {
		if($this->session->userdata('student_id')){
			redirect('home');
		}


		$key = rand();

		// $this->load->library('email',array('mailtype'=>'html'));

		// $this->email->from('opibox@gmail.com','Opibox');
		// $this->email->to('victorstinefuture@gmail.com');
		// $this->email->subject('COnfirm your account');

		// $message = "Thank you";

		// $this->email->message($message);

		// if ($this->email->send()) {
		// echo "email sent";
		// }else{
		// echo "failed";
		// }

		$this->load->library('email');

		$this->email->from('your@example.com', 'Your Name');
		$this->email->to('victorstinefuture@gmail.com'); 

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	

		$this->email->send();

		echo $this->email->print_debugger();

		
		//$this->load->view('email_view');
	}
	
	
	
}


 ?>














