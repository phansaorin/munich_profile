<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	class Mod_classification extends MU_Model{
		/*
		** @: get all classification
		*/
		public function getAllClassification($perPage, $offSet, $sortby, $sort){
			$sortby = "clf_".strtolower($sortby);
			$getClassification = $this->db->select("*")
							->where("clf_deleted",0)
							->limit($perPage, $offSet)
                 					->order_by($sortby, $sort)
							->get("classification");
			return $getClassification;
		}
		/*
		 @: get all search classification 
		*/
		public function getSearchClassification($perPage, $offSet, $sortby, $sort, $classification_name) {
	        $sortby = "clf_id";
	        $this->db->select('*')
	        		->from("classification")
					->where("clf_deleted",0);
	        if ($classification_name != "") {
	            $this->db->like("classification.clf_name", $classification_name);			     
	        } 
			$this->db->where("classification.clf_deleted", 0);
	        $this->db->order_by($sortby, $sort);
	        $this->db->limit($perPage, $offSet);
	        $query = $this->db->get();
	        return $query;
	 	}
	 	/*
		@: delete multiple classification
	 	*/
	 	public function deleteMultipleClassification($update,$whereID){
			$this->db->where_in('clf_id',$whereID);
			$this->db->update('classification',$update);
			return $this->db->affected_rows() >0;
		}
		/*******
			@: delete and remove permanent of classification
		*********/
		public function deletePermenentClassification($whereID){
			$this->db->where_in('clf_id', $whereID);
			$this->db->delete('classification');
			return $this->db->affected_rows() > 0;
		}
		/*
		@: select classification by id to edit
		*/
		public function select_classificationId($getId){
			$select = $this->db->select()
						->from("classification")
						->where("clf_id", $getId)
						->get();
			return $select;
		}
		/*
		@: add classification 
		*/
		public function add_classification($classificationName, $classificationValue){
			$insert = array(
				'clf_name' => $classificationName, 
				'clf_value' => $classificationValue,
				'clf_deleted' => 0
			);
			$this->db->insert('classification',$insert);
			return $this->db->insert_id('classification');
		}
		/*
		@: edit classification by id
		*/
		public function edit_classification($get_id, $get_classificationName, $get_classificationValue){
			$update = array(
				'clf_name' => $get_classificationName, 
				'clf_value' => $get_classificationValue,
				'clf_deleted' => 0
			);
			$this->db->where('clf_id', $get_id);
	        return $this->db->update('classification', $update);
		}
	}

/* End of file mod_classificaion.php */
/* Classification: ./application/models/mod_classificaion.php */