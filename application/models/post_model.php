<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* This will be the model for the posts - opinions from student/administration
*/
class Post_model extends CI_Model{

	function get_posts(){
		$query = $this->db->select('*')->from('posts')->order_by('id', 'desc');
        return $query->get()->result();
	}
	
	//get single post by its id
	function get_post_by_id($id){
		return $this->db->where('id', $id)->limit(1)->get('posts')->row();
	}
	
	function get_post_by_userid($userid){
		$query = $this->db->select('*')->from('posts')->where('user_id', $userid)->order_by('id', 'desc');
		return $query->get()->result();
	}

    //Insert new Post
    function insert_post($data){
        return $this->db->insert('posts', $data);
    }

    //delete the post
    function delete_post($post_id, $user_id){
        $this->db->delete('posts', array('id' => $post_id));

        if ($this->get_post_comments($post_id)) {
            $this->db->delete('post_comments', array('post_id' => $post_id));
        }

        if ($this->did_vote($post_id, $user_id)){
            $this->db->delete('i_voted', array('post_id' => $post_id, 'user_id' => $user_id));
        }
    }

    //edit Post

    function edit_post($data, $id){
        $this->db->update('posts', $data, array('id' => $id));
    }

	//record who voted
	function i_voted($post_id,$user_id,$vote_value){
		
		$this->db->where('post_id', $post_id);
		$this->db->where('user_id', $user_id);
		 
		$query = $this->db->get('i_voted');
		
		if ($query->num_rows() == 0){
			$data = array(
				'post_id' => $post_id,
				'user_id' => $user_id,
				'vote_value' => $vote_value
			);
			return $this->db->insert('i_voted', $data);
		}
		return false;
		
	}
	
	//voting functions
	function did_vote($post_id,$user_id){
		
		$this->db->where('post_id', $post_id);
		$this->db->where('user_id', $user_id);
		 
		$query = $this->db->get('i_voted');
		
		if ($query->num_rows() == 0){
			return false;
		}
		return true;
		
	}

    //    COMMENTS FUNCTIONS

    public function add_comment($data){
        return $this->db->insert('post_comments', $data);
    }

    public function get_comments(){
        return $this->db->get('post_comments')->result_array();
    }

    public function get_post_comments($post_id){
        $query = $this->db->get_where('post_comments', array('post_id'=>$post_id));

        if($query->num_rows() != 0)
            return $query->result_array();
        else
            return null;
    }

    //Date format function
    function getDate($dateObj){
        $datestring = "%M %j, %Y";
        $date_added_mysql = $dateObj;
        $date_added = strtotime($date_added_mysql);
        return mdate($datestring, $date_added);
    }

}
