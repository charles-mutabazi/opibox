<?php
/**
 * Created by PhpStorm.
 * User: Charl
 * Date: 4/10/15
 * Time: 4:27 PM
 */

class MY_Controller extends CI_Controller{

    public $layout;
    public function __construct(){
        parent::__construct();
        $this->layout = 'template/master';
    }

    public function loggedUserId(){
        return $this->session->userdata('userid');
    }
}