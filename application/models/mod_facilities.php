<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	class Mod_facilities extends MU_Model{
		/*
		** @: get all facilities
		*/
		public function getAllfacilities($perPage, $offSet, $sortby, $sort){
			$sortby = "facilities_".strtolower($sortby);
			$getFacilities = $this->db->select("*")
							->where("facilities_deleted",0)
							->limit($perPage, $offSet)
                 			->order_by($sortby, $sort)
							->get("facilities");
			return $getFacilities;
		}
		/*
		 @: get all search facilities 
		*/
		public function getSearchFacilities($perPage, $offSet, $sortby, $sort, $facilities_name) {
	        $sortby = "facilities_id";
	        $this->db->select('*')
	        		->from("facilities")
					->where("facilities_deleted",0);
	        if ($facilities_name != "") {
	            $this->db->like("facilities.facilities_title", $facilities_name);			     
	        } 
			$this->db->where("facilities.facilities_deleted", 0);
	        $this->db->order_by($sortby, $sort);
	        $this->db->limit($perPage, $offSet);
	        $query = $this->db->get();
	        return $query;
	 	}
	 	/*
		@: delete multiple facilities
	 	*/
	 	public function deleteMultipleFacilities($update,$whereID){
			$this->db->where_in('facilities_id',$whereID);
			$this->db->update('facilities',$update);
			return $this->db->affected_rows() >0;
		}
		/*******
			@: delete and remove permanent of facilities
		*********/
		public function deletePermenentFacilities($whereID){
			$this->db->where_in('facilities_id', $whereID);
			$this->db->delete('facilities');
			return $this->db->affected_rows() > 0;
		}
		/*
		@: select facilities by id to edit
		*/
		public function select_facilitiesId($getId){
			$select = $this->db->select()
						->from("facilities")
						->where("facilities_id", $getId)
						->get();
			return $select;
		}
		/*
		@: add facilities 
		*/
		public function add_facilities($facilitiesName, $facilitiesValue){
			$insert = array(
				'facilities_title' => $facilitiesName,
				'facilities_value' => $facilitiesValue, 
				'facilities_deleted' => 0
			);
			$this->db->insert('facilities',$insert);
			return $this->db->insert_id('facilities');
		}
		/*
		@: edit facilities by id
		*/
		public function edit_facilities($get_id, $get_facilitiesName, $get_facilitiesValue){
			$update = array(
				'facilities_title' => $get_facilitiesName, 
				'facilities_value' => $get_facilitiesValue,
				'facilities_deleted' => 0
			);
			$this->db->where('facilities_id', $get_id);
	        return $this->db->update('facilities', $update);
		}
	}

/* End of file mod_facilities.php */
/* Location: ./application/models/mod_facilities.php */