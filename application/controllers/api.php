<?php
require(APPPATH . "libraries/REST_Controller.php");

class Api extends REST_Controller{

    function posts_get(){
        $posts = $this->db->get('posts')->result();

        if($posts){
            $this->response($posts, 200);
        }else{
            $this->response(NULL, 404);
        }

    }

    function post_get(){
        if(!$this->get('id')){
            $this->response(NULL, 400);
        }

        $post = $this->post_model->get_post_by_id($this->get('id'));

        if($post){
            $this->response($post, 200);
        }else{
            $this->response(NULL, 404);
        }

    }

}