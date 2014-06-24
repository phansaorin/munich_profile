<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Mod_felogin extends MU_Model{
		
    	 public function login_fe($username, $password) {
                        $user_loginfe = $this->db->select('*')
                                ->where('pass_email', $username)
                                ->where('pass_password',$password)
                                ->where('pass_status', 1)
                                ->get('passenger');
                        return $user_loginfe;
    	}
     
}

