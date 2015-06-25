<?php 
	class User_model extends CI_Model {
	
		function login($username, $password) {
			// Prep the query
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$query = $this->db->get('users');
			
			// Let's check if there are any results
			if ($query->num_rows == 1) {
				$row = $query->row();
				// If there is a user, then create session data
				if ($row->status != 0) {
					$session_data = array(
						'user_id' => $row->id,
						'first_name' => $row->first_name,
						'last_name' => $row->last_name,
						'username' => $row->username,
						'role' => $row->user_role,
						'validated' => true
					);
					$this->session->set_userdata($session_data);
					
					//update the table and add the last login
					$sql = "UPDATE users SET last_login='" . date('Y-m-d H:i:s') . "' WHERE id='" . $row->id . "'";
					$this->db->query($sql);
					
					return true;
				
				} else {
					return FALSE;
				}
			
			}
			// If the previous process did not validate
			// then return false.
			return false;  
		}

        function ajax_login($field,$value) {

            $this->db->where($field,$value);
            $query = $this->db->get('users');

            // echo "<pre>";var_dump($query);echo "</pre>";
            // echo "<pre>";var_dump($query->num_rows);echo "</pre>";
            // Let's check if there are any results
            if ($query->num_rows == 1) {

                $row = $query->row();

                // If there is a user, then create session data
                if ($row->status != 0) {
                    $session_data = array(
                        'user_id' => $row->id,
                        'first_name' => $row->first_name,
                        'last_name' => $row->last_name,
                        'username' => $row->username,
                        'role' => $row->user_role,
                        'validated' => true
                    );

                    $this->session->set_userdata($session_data);

                    //update the table and add the last login
                    $sql = "UPDATE users SET last_login='" . date('Y-m-d H:i:s') . "' WHERE id='" . $row->id . "'";
                    $this->db->query($sql);

                    // echo "<pre>";var_dump($session_data);echo "</pre>";
                    // return true;

                } else {
                    return FALSE;
                }

            }
            // If the previous process did not validate
            // then return false.
            return false;
        }


        function get_users(){
			$query = $this->db->select('*')->from('users')->order_by('id', 'asc');
			return $query->get()->result();
		}
		
		function get_user_by_id($userid){
			return $this->db->where('id', $userid)->limit(1)->get('users')->row();
		}

        public function image_path($image_name){
            if ($image_name == ""){
                return base_url() . "images/profile_pic/avatar.png";
            }else {
                return base_url() . "images/profile_pic/".$image_name;
            }
        }
        //edit user information
        function edit_user($data, $user_id){
            $this->db->update('users', $data, array('id' => $user_id));
        }

        //edit user user image
        function uplaod_image($data, $user_id){
            $this->db->update('users', $data, array('id' => $user_id));
        }

        //Register a new user
        function register($data){
            return $this->db->insert('users', $data);
        }

        //if exists
        function if_exists($field,$value){
            $this->db->where($field,$value);
            $query = $this->db->get('users');
            return $query->num_rows ;
        }
	}

?>