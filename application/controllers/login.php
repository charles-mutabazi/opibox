<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{
    function __construct(){
        parent::__construct();

    }

    function index(){
        if ($this->session->userdata('user_id')) {
            redirect(base_url('home'));
        }

        $data['content'] = 'login_view';
        $data['page_title'] = 'Login';

        $this->load->view($this->layout, $data);
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

    function login_attempt(){

        $username = $this->input->post('username');
        $password = sha1($this->input->post('password'));

        $checked = user_model::login($username, $password);

        if ($checked === TRUE) {
            redirect('home/index');
        } else {
            $msg = 'Wrong Username/Password';
            $this->session->set_flashdata('error_login', $msg);
            redirect('login');
        }
    }


    // This function toggles between Facebook & Google+ login
    function ajax_login(){

        // I have problems accessing the email for the G+ auto login
        // so I will use the profile_url. This is unique
        if ($_POST["social"]=='google+') {

            //if profile_url exists login the person
            $if_exists=$this->user_model->if_exists('profile_url',$_POST["profileUrl"]);
            if ($if_exists == 1) {
                $this->user_model->ajax_login('profile_url',$_POST["profileUrl"]);
            }else{
                // register
                echo "registered";
                $familyName  = $_POST['familyName'];
                $givenName   = $_POST['givenName'];
                $displayName = $_POST['displayName'];
                $profileUrl  = $_POST['profileUrl'];
                $social      = $_POST['social'];

                // I chose to use profile_url for the set the password
                // because it is unique
                $password = $profileUrl;
                $id=rand();

                $data = array(
                    'id' => $id,
                    'first_name' => $givenName,
                    'last_name' => $familyName,
                    'username' => $displayName,
                    'password' => $password,
                    'email' => 'fakemail@yahoo.com',
                    'profile_url' => $profileUrl,
                    'academic_year' => 'M1',
                    'course_type' => 'Inovator Course',
                    'date_for_registration' => 'date_for_registration',
                    'status' => 1,
                    'user_role' => 'user_role',
                    'last_login' => 'last_login',
                );

                $this->user_model->register($data);
            }
        }else{
            //facebook login flow
            //check if email exists
            $email = $_POST["email"];

            $if_exists=$this->user_model->if_exists('email',$email);
            if ($if_exists == 1) {
                //login
                $this->user_model->ajax_login('email',$email);
            }else{
                // register
                echo "registered";
                $social      = $_POST['social'];
                $email = $_POST['email'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $username = $_POST['username'];
                $facebook_id = $_POST['facebook_id'];

                // I chose to use profile_url for the set the password
                // because it is unique
                $password = $facebook_id;
                $id=rand();

                $data = array(
                    'id' 					=> $id,
                    'first_name' 			=> $first_name,
                    'last_name' 			=> $last_name,
                    'username' 				=> $username,
                    'password' 				=> $password,
                    'email' 				=> $email,
                    'profile_url' 			=> $facebook_id,
                    'academic_year' 		=> 'M1',
                    'course_type' 			=> 'Inovator Course',
                    'date_for_registration' => 'date_for_registration',
                    'status' 				=> 1,
                    'user_role' 			=> 'user_role',
                    'last_login' 			=> 'last_login',
                );

                $this->user_model->register($data);

                //the login the person
                $this->user_model->ajax_login('email',$email);
            }
            // if not register
            // or login

        }


    }

}