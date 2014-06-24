<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Mod_profile extends MU_Model{
		
		
		public function profile_adminloging($get_id){
				$query = $this
						->db
						->select('*')
						->from('user')
						->join('roles','roles.role_id = user.role_id')
						->where("user.user_deleted", 0)
						->where("user_id", $get_id)
						->get();
				return $query;
			}
	}

/* End of file mod_admin.php */
/* Location: ./application/models/mod_admin.php */

