<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_user extends MU_Model {
public function profile($userID) {
		$query = $this->db->select("*")
			->join("roles", "roles.role_id = user.role_id")
			->where("user_id", $userID)
			->where("user.user_deleted ", 0)
			->get("user");
		return $query;
	}
 public function edit_profile_admin($uid, $fname, $lname, $email, $tel1, $tel2, $phone, $fax, $webpage, $gender, $address){
		$data = array(
			'user_fname' => $fname,
			'user_lname' => $lname,
			'user_email' => $email,
			'tel_one' => $tel1,
			'tel_two' => $tel2,
			'user_phone' => $phone,
			'fax' => $fax,
			'webpage' => $webpage,
			'user_gender' => $gender,
			'user_address' => $address
		);
		$this->db->where("user_uid", $uid);
		return $this->db->update("ct_users", $data);
	}
	public function show_user($perPage, $offSet,$sortby,$sort){
		$sortby = "user_".strtolower($sortby);
		$query = $this
    		   ->db
    		   ->select('*')
    		   ->from('user')
               ->join('roles','roles.role_id = user.role_id')
			   ->where("user.user_deleted", 0)
               ->limit($perPage, $offSet)
    		   ->order_by($sortby, $sort)
    		   ->get();
        return $query;

	}
	public function get_role() {
		$query = $this->db
				->select('*')
				->from('roles')
				->order_by('role_title')
				// ->where('sub_role', 0)
				->get();
		$role[0] = '-- Select --';
		foreach ($query->result_array() as $row) {
			$role[$row['role_id']] = $row['role_title']; //get id show name
		}
		return $role;
	}
	public function add_user($fname,$lname,$username,$password,$gender,$usertype,$email,$phone,$phone_two,$address,$company,$txtStatus,$fix,$mobile,$website){
		
		$insert = array (
		'user_fname' => $fname,
		'user_lname' => $lname,
		'user_name' => $username,
		'user_password' => $password,
		'role_id' => $usertype,
		'user_gender' => $gender,
		'user_mail' => $email,
		'user_telone' => $phone,
		'user_teltwo' => $phone_two,
		'user_address' => $address,
		'user_company' => $company,		
		'user_status' => $txtStatus,
		'user_deleted' => 0,
		);
		$this->db->insert('user',$insert);
		// return $this->db->affected_rows() > 0;
		return $this->db->insert_id('user');
	}	
	public function getSearchName($menu_title, $perPage, $offSet, $sortby, $sort){
        $sortby = "user_".strtolower($sortby);
        $query = $this->db->select('*')
                 ->where('user_deleted', 0)
                 ->limit($perPage, $offSet)
                 ->like("user_name", $menu_title)
                 ->order_by($sortby, $sort)
                 ->get('user');
        return $query;
    } 
    public function view_users($get_id) {
	        $query = $this->db
	                ->select('*')
	                ->from('user')
	                ->join('roles','roles.role_id = user.role_id')
					->where("user.user_deleted", 0)
					->where("user_id", $get_id)
	                ->get();

	        return $query;
	    }
    public function edit_user($get_id,$get_fname,$get_lname,$get_email,$get_phone,$get_address,$get_company,$get_password,$get_gender,$get_txtStatus,$get_usertype,$get_username){
    	$data = array(
	            'user_fname' => $get_fname,
				'user_lname' => $get_lname,
				'user_mail' => $get_email,
				'user_telone' => $get_phone,
				'user_address' => $get_address,
				'user_company' => $get_company,
				'user_password' => $get_password,
				'user_gender' => $get_gender,
				'user_status' => $get_txtStatus,
				'role_id' => $get_usertype,
				'user_name' => $get_username,
				'user_deleted' => 0,
	        );
	        $this->db->where('user_id', $get_id);
	        return $this->db->update('user', $data);
    }
    public function select_user($get_id){
    		$query = $this->db
	                ->select('*')
	                ->from('user')
	                ->join('roles','roles.role_id = user.role_id')
					// ->where("user.user_deleted", 0)
					->where("user_id", $get_id)
	                ->get();

	        return $query;

    }
   public function deletePermenentAct($whereID){
			$this->db->where_in('user_id', $whereID);
			$this->db->delete('user');
			return $this->db->affected_rows() > 0;
		} 
	public function deleteMultipleUser($update,$whereID){
		$this->db->where_in('user_id',$whereID);
		$this->db->update('user',$update);
		return $this->db->affected_rows() >0;
	}

}
