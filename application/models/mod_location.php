<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	class Mod_location extends MU_Model{
		/*
		** @: get all locations
		*/
		public function getAllLocations($perPage, $offSet, $sortby, $sort){
			$sortby = "lt_".strtolower($sortby);
			$getLocation = $this->db->select("*")
							->where("lt_deleted",0)
							->limit($perPage, $offSet)
                 			->order_by($sortby, $sort)
							->get("location");
			return $getLocation;
		}
		/*
		 @: get all search locations 
		*/
		public function getSearchLocation($perPage, $offSet, $sortby, $sort, $location_name) {
	        $sortby = "lt_id";
	        $this->db->select('*')
	        		->from("location")
					->where("lt_deleted",0);
	        if ($location_name != "") {
	            $this->db->like("location.lt_name", $location_name);			     
	        } 
			$this->db->where("location.lt_deleted", 0);
	        $this->db->order_by($sortby, $sort);
	        $this->db->limit($perPage, $offSet);
	        $query = $this->db->get();
	        return $query;
	 	}
	 	/*
		@: delete multiple locations
	 	*/
	 	public function deleteMultipleLocation($update,$whereID){
			$this->db->where_in('lt_id',$whereID);
			$this->db->update('location',$update);
			return $this->db->affected_rows() >0;
		}
		/*******
			@: delete and remove permanent of location
		*********/
		public function deletePermenentLocation($whereID){
			$this->db->where_in('lt_id', $whereID);
			$this->db->delete('location');
			return $this->db->affected_rows() > 0;
		}
		/*
		@: select location by id to edit
		*/
		public function select_locationId($getId){
			$select = $this->db->select()
						->from("location")
						->where("lt_id", $getId)
						->get();
			return $select;
		}
		/*
		@: add location 
		*/
		public function add_location($locationName){
			$insert = array(
				'lt_name' => $locationName, 
				'lt_deleted' => 0
			);
			$this->db->insert('location',$insert);
			return $this->db->insert_id('location');
		}
		/*
		@: edit location by id
		*/
		public function edit_location($get_id, $get_locationName){
			$update = array(
				'lt_name' => $get_locationName, 
				'lt_deleted' => 0
			);
			$this->db->where('lt_id', $get_id);
	        return $this->db->update('location', $update);
		}
	}

/* End of file mod_location.php */
/* Location: ./application/models/mod_location.php */