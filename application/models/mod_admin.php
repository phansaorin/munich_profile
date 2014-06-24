<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Mod_admin extends MU_Model{
		
    	 public function signin_admin($username, $password) {
				$user_login = $this
					->db
					->select('*')
					->from('user')
					->join('roles','roles.role_id = user.role_id')
					->where('user_password',$password)
        			->where('user_mail', $username)
                    ->where('user_status', 1)
					->get();
				return $user_login;
    	}
    	 //Get email admin for sending email
   public function getEmailAdmin($arr) {
        $data = $this->db->select('*')
            ->join('roles', 'roles.role_id  = user.role_id')
            ->where('user.user_id ',$arr['user_id'])
            ->where('user_status', 1)
            ->where('user.user_deleted', 0)
            ->where('user.role_id ', 1)
            ->get('user');
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $items) {
                $email[] = $items;
            }
            return $email;
        }
        return FALSE;

    }
	}

/* End of file mod_admin.php */
/* Location: ./application/models/mod_admin.php */