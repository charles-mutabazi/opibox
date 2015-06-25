<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller {
    function __construct() {
        parent::__construct();

    }

    function index() {
        $data['content'] = 'register_view';
        $data['page_title'] = 'Register';
        $this->load->view($this->layout, $data);
    }

    function register_user(){
        
        $this->form_validation->set_rules('fname','FirstName','required|trim');
        $this->form_validation->set_rules('sname','SecondName','required|trim');
        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_rules('cpassword','COnfirm Password','required|trim|matches[password]');
        $id=rand();

        // echo "validation start";
        // $dd=$this->form_validation->run();
        // echo "<pre>";var_dump($dd);echo "</pre>";
        // exit();
        if ($this->form_validation->run()) {

            $username = $this->input->post('username');
            $password=sha1($this->input->post('password'));

            $data = array(
                'id' => $id,
                'first_name' => $this->input->post('fname'),
                'last_name' => $this->input->post('sname'),
                'username' => $username,
                'password' => $password,
                'email' => $this->input->post('email'),
                'status' => 1,
                'user_role' => 1
            );

            $this->user_model->register($data);

            $checked = $this->user_model->login($username, $password);

            // exit();
            if ($checked === TRUE){

                $message = "Welcome Again Dear ".$this->session->userdata('firstname')."! Hope you get what you want.";

                $this->session->set_flashdata('success_message', $message);
                redirect('home/index');
            }else{
                echo "cars";
            }

            echo "pass";
        }else{
            // echo "You shall not pass";
            $this->load->view('register_view');
        }
        // save
    }

}