		<?php
		
		if (!defined('BASEPATH'))
			exit('No direct script access allowed');
		
		class Mod_passenger extends CI_model {
		 
		 public function ListPassenger($perPage, $offSet, $sortby, $sort){
			 $sortby = "pass_" . strtolower($sortby);  
			  $query = $this
						->db
						->select('*')
						->from('passenger')
						->where("passenger.pass_deleted", 0)
						->limit($perPage, $offSet)
						->order_by($sortby, $sort)
						->get();
				return $query;
			 }
		 public function view_passenger($get_id){
			  $query = $this->db
							->select('*')
							->from('passenger')
							->where("passenger.pass_deleted", 0)
							->where("pass_id", $get_id)
							->get();
		
			  return $query;
			 }
		 public function createPassenger($firstName,$lastName,$Email,$Phone,$Address,$Company,$Password,$Gender,$Status){
			 $insert = array (
							'pass_fname' => $firstName,
							'pass_lname' => $lastName,
							'pass_email' => $Email,
							'pass_phone' => $Phone,
							'pass_address' => $Address,
							'pass_company' => $Company,
							'pass_password' => $Password,
							'pass_gender' => $Gender,
							'pass_status' => $Status,
							'pass_deleted' => 0,
							);
			 $this->db->insert('passenger',$insert);
			 // return $this->db->affected_rows() > 0;
			 return $this->db->insert_id('passenger');
			 
			 }
		 public function deleteMultiplePassenger($update,$whereID){
					$this->db->where_in('pass_id',$whereID);
					$this->db->update('passenger',$update);
					return $this->db->affected_rows() >0;
					
				}
		 public function deletePermenentPassenger($whereID){
					$this->db->where_in('pass_id', $whereID);
					$this->db->delete('passenger');
					return $this->db->affected_rows() > 0;
				}		 
		 public function selectPassengerByID($get_id){
					$query = $this->db
							->select('*')
							->from('passenger')
							->where("pass_id", $get_id)
							->get();
		
					return $query;
			 }
		 public function edit_passenger($get_id,$get_firstname,$get_lastname,$get_email,$get_phone,$get_address,$get_company,$get_password,$get_gender,$get_txtStatus) {
					$data = array(
							'pass_fname' => $get_firstname,
							'pass_lname' => $get_lastname,
							'pass_email' => $get_email,
							'pass_phone' => $get_phone,
							'pass_address' => $get_address,
							'pass_company' => $get_company,
							'pass_password' => $get_password,
							'pass_gender' => $get_gender,
							'pass_status' => $get_txtStatus,
							'pass_deleted' => 0,
					);
					$this->db->where('pass_id', $get_id);
					return $this->db->update('passenger', $data);
				}
		
		   public function search_passenger($perPage, $offSet, $sortby, $sort,$passenger_fname) {
				$sortby = "pass_id";
				$this->db->select('*')
						->from("passenger")
						->where("pass_deleted",0);
				if ($passenger_fname != "") {
					$this->db->like("passenger.pass_fname", $passenger_fname);			     
				} 
				$this->db->where("passenger.pass_deleted", 0);
				$this->db->order_by($sortby, $sort);
				$this->db->limit($perPage, $offSet);
				$query = $this->db->get();
				return $query;
				}
		}
		
		/* End of file mod_activities.php */
		/* Location: ./application/model/mod_activities.php */