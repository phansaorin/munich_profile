<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	class Mod_festival extends MU_Model{
		/*
		** @: get all festivals
		*/
		public function getAllFestivals($perPage, $offSet, $sortby, $sort){
			$sortby = "ftv_".strtolower($sortby);
			$getFestival = $this->db->select("*")
							->where("ftv_deleted",0)
							->limit($perPage, $offSet)
                 			->order_by($sortby, $sort)
							->get("festival");
			return $getFestival;
		}
		/*
		 @: get all search festivals 
		*/
		public function getSearchFestival($perPage, $offSet, $sortby, $sort, $festival_name) {
	        $sortby = "ftv_id";
	        $this->db->select('*')
	        ->from("festival")
			->where("ftv_deleted",0);
	        if ($festival_name != "") {
	            $this->db->like("festival.ftv_name", $festival_name);			     
	        } 
			$this->db->where("festival.ftv_deleted", 0);
	        $this->db->order_by($sortby, $sort);
	        $this->db->limit($perPage, $offSet);
	        $query = $this->db->get();
	        return $query;
	 	}
	 	/*
		@: delete multiple festivals
	 	*/
	 	public function deleteMultipleFestival($update,$whereID){
			$this->db->where_in('ftv_id',$whereID);
			$this->db->update('festival',$update);
			return $this->db->affected_rows() >0;
		}
		/*******
			@: delete and remove permanent of festival
		*********/
		public function deletePermenentFestival($whereID){
			$this->db->where_in('ftv_id', $whereID);
			$this->db->delete('festival');
			return $this->db->affected_rows() > 0;
		}
		/*
		@: select festival by id to edit
		*/
		public function select_festivalId($getId){
			$select = $this->db->select()
						->from("festival")
						->join("photo","photo.photo_id = festival.ftv_photo_id")
						->join("location","location.lt_id = festival.ftv_lt_id")
						->where("ftv_id", $getId)
						->get();
			return $select;
		}
		/*
		@: add festival 
		*/
		public function add_festival($festivalName,$festivalPhotos,$festivalDetail,$festivalLocation){
			$insert = array(
				'ftv_name' => $festivalName,
				'ftv_photo_id' => $festivalPhotos, 
				'ftv_detail' => $festivalDetail,
				'ftv_lt_id' => $festivalLocation,
				'ftv_deleted' => 0
			);
			$this->db->insert('festival',$insert);
			return $this->db->insert_id('festival');
		}
		/*
		@: edit festival by id
		*/
		public function edit_festival($get_id, $get_festivalName, $get_festivalDetail, $get_festivalPhotos,$get_festivalLocation){
			$update = array(
				'ftv_name' => $get_festivalName, 
				'ftv_detail' => $get_festivalDetail,
				'ftv_photo_id' => $get_festivalPhotos,
				'ftv_lt_id' => $get_festivalLocation,
				'ftv_deleted' => 0
			);
			$this->db->where('ftv_id', $get_id);
	        return $this->db->update('festival', $update);
		}

		public function getPhotos(){
			$photos = $this->db->select("*")
						->where('pt_id',6)
						->where('pho_status',1)
						->where('pho_delete',0)
						->get('photo');
			return $photos;
		}

		public function getLocation(){
			$location = $this->db->select("*")
						->where('lt_status',1)
						->where('lt_deleted',0)
						->get('location');
			return $location;
		}
	}

/* End of file mod_festival.php */
/* Location: ./application/models/mod_festival.php */