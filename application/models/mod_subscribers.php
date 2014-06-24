<?php
	if (!defined('BASEPATH'))
		exit('No direct script access allowed');
		
		class Mod_subscribers extends MU_model {
		 
		 public function ShowSubscriber($perPage, $offSet, $sortby, $sort){
			 $sortby = "sub_" . strtolower($sortby);  
			  $query = $this
						->db
						->select('*')
						->from('subscriber')	
						->join('roles', 'roles.role_id = subscriber.roles_role_id ','left')
						->where("subscriber.sub_deleted", 0)
						->limit($perPage, $offSet)
						->order_by($sortby, $sort)
						->get();
				return $query;
			 }
		 public function view_subscribers($get_id){
			  $query = $this->db
							->select('*')
							->from('subscriber')
							->where("subscriber.sub_deleted", 0)
							->where("sub_id", $get_id)
							->get();
		
			  return $query;
		 }
		 public function deleteMultipleSubscrib($update,$whereID){
					$this->db->where_in('sub_id',$whereID);
					$this->db->update('subscriber',$update);
					return $this->db->affected_rows() >0;
				}
		 public function deletePermenentSubscrib($whereID){
					$this->db->where_in('sub_id', $whereID);
					$this->db->delete('subscriber');
					return $this->db->affected_rows() > 0;
				}		 
		public function selectSubscriberByID($get_id){
					$query = $this->db
							->select('*')
							->from('subscriber')
							->where("sub_id", $get_id)
							->get();
		
					return $query;
			 }
		 public function edit_subscrib($get_id,$get_subfirstname,$get_sublastname,$get_subemail,$get_subtxtStatus) {
					$data = array(
							'sub_fname' => $get_subfirstname,
							'sub_lname' => $get_sublastname,
							'sub_email' => $get_subemail,
							'sub_status' => $get_subtxtStatus,
							'sub_deleted' => 0,
					);
					$this->db->where('sub_id', $get_id);
					return $this->db->update('subscriber', $data);
				}
		
		    public function search_subscribers($perPage, $offSet, $sortby, $sort,$subscribers_fname) {
				$sortby = "sub_id";
				$this->db->select('*')
						->from("subscriber")
						->where("sub_deleted",0);
				if ($subscribers_fname != "") {
					$this->db->like("subscriber.sub_fname", $subscribers_fname);			     
				} 
				$this->db->where("subscriber.sub_deleted", 0);
				$this->db->order_by($sortby, $sort);
				$this->db->limit($perPage, $offSet);
				$query = $this->db->get();
				return $query;
		  }
		   public function getSubscriber() {
				$query = $this->db->select('*')
						->where('sub_status', 1)
						->where('sub_deleted', 0)
						->limit(2)
						->get('subscriber');
				if ($query->num_rows() > 0) {
					foreach ($query->result() as $items) {
						$data[] = $items;
					}
					return $data;
				}
				return FALSE;
   		 }
		 
			public function SubscribersName($address) {
			$query = $this->db->select('*')
					->where('sub_email', $address)
					->where('sub_status', 1)
					->where('sub_deleted', 0)
					->get('subscriber');
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $items) {
					$data[] = $items;
				}
				return $data;
			}
			return FALSE;
		}
		
}
		
		/* End of file mod_activities.php */
		/* Location: ./application/model/mod_activities.php */