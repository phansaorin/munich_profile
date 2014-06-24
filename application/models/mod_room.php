		<?php
		
		if (!defined('BASEPATH'))
			exit('No direct script access allowed');
		
		class Mod_room extends CI_model {
		 
		 public function ShowRoom($perPage, $offSet, $sortby, $sort){
			  $sortby = "rt_" . strtolower($sortby);  
			  $query = $this
						->db
						->select('*')
						->from('room_types')
						->where("room_types.rt_deleted",0)
						->limit($perPage, $offSet)
						->order_by($sortby, $sort)
						->get();
				return $query;
			 }
		 public function view_room($get_id){
			  $query = $this->db
							->select('*')
							->from('room_types')
							->where("room_types.rt_deleted", 0)
							->where("rt_id", $get_id)
							->get();
		
			  return $query;
			 }
		 public function createRoom($roomName,$Status){
			 $insert = array (
							'rt_name' => $roomName,
							'rt_status' => $Status,
							'rt_deleted' => 0,
							);
			 $this->db->insert('room_types',$insert);
			 // return $this->db->affected_rows() > 0;
			 return $this->db->insert_id('room_types');
			 
			 }
		 public function deleteMultipleRooms($update,$whereID){
					$this->db->where_in('rt_id',$whereID);
					$this->db->update('room_types',$update);
					return $this->db->affected_rows() >0;
					
				}
		 public function deletePermenentRooms($whereID){
					$this->db->where_in('rt_id', $whereID);
					$this->db->delete('room_types');
					return $this->db->affected_rows() > 0; 
				}		 
		 public function selectRoomByID($get_id){
					$query = $this->db
							->select('*')
							->from('room_types')
							->where("rt_id", $get_id)
							->get();
		
					return $query;
			 }
		 public function edit_room($get_id,$get_roomname,$get_txtStatus) {
					$data = array(
							'rt_name' => $get_roomname,
							'rt_status' => $get_txtStatus,
							'rt_deleted' => 0,
					);
					$this->db->where('rt_id', $get_id);
					return $this->db->update('room_types', $data);
				}
		
		   public function search_room($perPage, $offSet, $sortby, $sort,$room_name) {
				$sortby = "rt_".strtolower($sortby);
				$this->db->select('*')
						->from("room_types")
						->where("rt_deleted",0);
				if ($room_name != "") {
					$this->db->like("room_types.rt_name", $room_name);			     
				} 
				$this->db->where("room_types.rt_deleted", 0);
				$this->db->order_by($sortby, $sort);
				$this->db->limit($perPage, $offSet);
				$query = $this->db->get();
				return $query;
				}
		}
		
		/* End of file mod_activities.php */
		/* Location: ./application/model/mod_activities.php */