<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	Class Post extends CI_Controller {
		
		function new_post(){
			
			$data = array(
            'post_text' => $this->input->post('post_text'),
            'date_added' => date("Y-m-d H:i:s"),
            'status' => 0,
            'user_id' => $this->input->post('user_id')
        );
        	$this->post_model->insert_post($data);
		}
		
		function voted_up(){
			
			$user_id = $this->input->post('user_id');
			$post_id = $this->input->post('post_id');
			$vote_value = "Up";
			$this->post_model->i_voted($post_id, $user_id, $vote_value);
			
			$this->db->where('id', $post_id);
			$this->db->set('votes', 'votes + 1', FALSE);
			$this->db->update('posts');
		}
		
		function voted_down(){
			$user_id = $this->input->post('user_id');
			$post_id = $this->input->post('post_id');
			$vote_value = "Down";
			$this->post_model->i_voted($post_id, $user_id, $vote_value);
			
			$this->db->where('id', $post_id);
			$this->db->set('votes', 'votes - 1', FALSE);
			$this->db->update('posts');
		}

        function add_comment(){
            $data = array(
                'comment' => $this->input->post('comment_text'),
                'comment_date' => date("Y-m-d H:i:s"),
                'user_id' => $this->input->post('user_id'),
                'post_id' => $this->input->post('post_id'),
            );
            $this->post_model->add_comment($data);
        }

        function edit_post(){
            $data = array(
                'post_text' => $this->input->post('post_edit')
            );
            $post_id = $this->input->post('post_edit_id');

            $this->post_model->edit_post($data, $post_id);
        }

        function delete_post(){
            $post_id = $this->uri->segment(3);
            if($this->session->userdata('user_id')){
                $user_id = $this->session->userdata('user_id');
            }

            $this->post_model->delete_post($post_id, $user_id);
        }
	}
?>