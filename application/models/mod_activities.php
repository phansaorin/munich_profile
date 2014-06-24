<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_activities extends CI_model {
    /*
    * public function list_activity
    * @param $perPage, $offSet, $sortby, $sort
    * Table related (location, festival, acti_calendar, calendar_available) 
    * Table activities
    * return Object after query
    */
    public function list_activity($perPage, $offSet, $sortby, $sort) {
    	if(($sortby == 'start_date') OR ($sortby == 'end_date')){
    		$sortby = strtolower($sortby);
    	}else{
    		$sortby = "act_". strtolower($sortby);
    	}
        $query = $this
                ->db
                ->select('*')
                ->from('activities')
               	->join('location', 'location.lt_id = activities.location_id', 'left')
               	->join('festival', 'festival.ftv_id = activities.act_ftv_id', 'left')
		->join('acti_calendar','activities.act_id = acti_calendar.activities_id', 'left')
		->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id','left')
		->where('act_subof', 0)
		->where("activities.act_deleted", 0)
                ->limit($perPage, $offSet)
                ->order_by($sortby, $sort)
                ->get();
        return $query;
    }
    /*
    * public function getUpdateActivities
    * @param $act_id (int)
    * @table acti_calendar, activities, calendar_available
    * return object record
    */
    public function getUpdateActivities($act_id){
    	$query = $this->db->select("*")
    			 ->join('acti_calendar','activities.act_id = acti_calendar.activities_id', 'left')
    			 ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id','left')
                 ->join('photo','photo.photo_id = activities.photo_id')
    			 ->where("activities.act_deleted", 0)
    			 ->where("activities.act_id", $act_id)
    			 ->get("activities");
		return $query;
    }
	/*
	* public function detail_activity
	* @param $get_id (int)
	* Table related (location, festival, acti_calendar, calendar_available, photo)
	* Table activities
	* Conditioin act_id
	*/
	public function detail_activity($get_id) {
	        $query = $this->db
	                ->select('*')
	                ->from('activities')
	                ->join('location', 'location.lt_id = activities.location_id', 'left')
	                ->join('supplier', 'supplier.sup_id = activities.act_supplier_id', 'left')
	               	->join('festival', 'festival.ftv_id = activities.act_ftv_id', 'left')
				    ->join('acti_calendar','activities.act_id = acti_calendar.activities_id', 'left')
					->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id','left')
					->join('photo','photo.photo_id = activities.photo_id')
					->where("activities.act_deleted", 0)
					->where("act_id", $get_id)
	                ->get();

	        return $query;
	    }
	/*
	* public function detail_extraproduct
	* @param $get_id (int)
	* Table related (location, festival, acti_calendar, calendar_available, photo)
	* Table activities
	* Conditioin act_id
	*/
	public function detail_extraproduct($get_id) {
	        $query = $this->db
	                ->select('*')
	                ->from('activities')
	                ->join('location', 'location.lt_id = activities.location_id', 'left')
	                ->join('supplier', 'supplier.sup_id = activities.act_supplier_id', 'left')
	               	->join('festival', 'festival.ftv_id = activities.act_ftv_id', 'left')
			->join('acti_calendar','activities.act_id = acti_calendar.activities_id', 'left')
			->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id','left')
			->join('photo','photo.photo_id = activities.photo_id')
			->where("activities.act_deleted", 0)
			->where("act_id", $get_id)
	                ->get();

	        return $query;
	    }
	/*
	* public function detail_temp_activity
	* @param $get_id (int)
	* Table temp_table
	* return object
	*/
	public function detail_temp_activity($get_id) {
        $query = $this->db->select('*')->where('ID',$get_id)->where('tmpt_name','act')->get('temp_table');
		return $query;
	}
	/*
	* public function get_temp_activity
	* @param $get_id (int)
	* Table temp_table
	* return object
	*/
	public function get_temp_activity($get_id) {
        $query = $this->db->select('*')->where('tmpt_id',$get_id)->where('tmpt_name','act')->get('temp_table');
		return $query;
	}
	/*
	* public function get_temp_extrapro
	* @param $get_id (int)
	* Table temp_table
	* return object
	*/
	public function get_temp_extrapro($get_id) {
        $query = $this->db->select('*')->where('tmpt_id',$get_id)->where('tmpt_name','extraproduct')->get('temp_table');
		return $query;
	}
	/*
	* public function insert_extrapro_acti
	* @param $ep_id (int)
	* @param $act_id (int)
	* Table extra_acti
	* return object
	*/
	public function insertExtra_acti($ep_id, $act_id){
        $insert['extraproduct_id'] = $ep_id;
        $insert['activities_id'] = $act_id;
		$this->db->insert('extra_acti',$insert);
		return $this->db->insert_id('extra_acti');
	}
	
    /*
     * @: search on activities name
     *
     */

   	public function getSearchActivities($perPage, $offSet, $sortby, $sort,$from_date, $end_date, $activities_name) {
        $sortby = "act_id";
        $this->db->select('*')
                 ->from('activities')
                 ->join('festival', 'festival.ftv_id = activities.act_ftv_id', 'left')
               	 ->join('location', 'location.lt_id = activities.location_id', 'left')
		 ->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
		 ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id');
        if ($from_date != "" AND $end_date != "" AND $activities_name != "") {
            $this->db->like("activities.act_name", $activities_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)))
                     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else if ($from_date != "" AND $end_date != "") {
            $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)))
                     ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($from_date != "" AND $activities_name != "") {
            $this->db->like("activities.act_name", $activities_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($end_date != "" AND $activities_name != "") {
            $this->db->like("activities.act_name", $activities_name)
				     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else {
            if ($from_date != "") {
                $this->db->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
            }elseif ($end_date != "") {
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
            }elseif ($activities_name != "") {
                $this->db->like("activities.act_name", $activities_name);
            }
        }
        $this->db->where('act_subof', 0);
	$this->db->where("activities.act_deleted", 0);
	$this->db->order_by($sortby, $sort);
	$this->db->limit($perPage, $offSet);
        $query = $this->db->get();
        return $query;
    }
	/*
	* @: search export record
	*/
	public function getSearchActivitiesExport($from_date, $end_date, $activities_name) {
        $this->db->select('*')
                 ->from('activities')
                 ->join('festival', 'festival.ftv_id = activities.act_ftv_id', 'left')
               	 ->join('location', 'location.lt_id = activities.location_id', 'left')
				 ->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
				 ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id');
        if ($from_date != "" AND $end_date != "" AND $activities_name != "") {
            $this->db->like("activities.act_name", $activities_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)))
                     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else if ($from_date != "" AND $end_date != "") {
            $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)))
                     ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($from_date != "" AND $activities_name != "") {
            $this->db->like("activities.act_name", $activities_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($end_date != "" AND $activities_name != "") {
            $this->db->like("activities.act_name", $activities_name)
				     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else {
            if ($from_date != "") {
                $this->db->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
            }elseif ($end_date != "") {
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
            }elseif ($activities_name != "") {
                $this->db->like("activities.act_name", $activities_name);
            }
        }
        $this->db->where('act_subof', 0);
	$this->db->where("activities.act_deleted", 0);
        $query = $this->db->get();
        return $query;
 	}

	/*
	* public function createActivities
	* @param $insert (array)
	* @table activities
	* add records
	* return last insert id
	*/
	public function createActivities($insert){
		$this->db->insert('activities',$insert);
		return $this->db->insert_id('activities');
	}

	/*
	* public function updateActivities
	* @param $update_activities (array)
	* @param $act_id (int)
	* @table activities
	* update records
	* return affected rows
	*/
	public function updateActivities($update_activities, $act_id){
        $this->db->where('act_id', $act_id);
        if($this->db->update('activities', $update_activities)){
         return true;
          }else{ 
            return false;
           }
	}
		var $not_in = array();
    /*
    * public function getAllExtraproduct
    * @noparam
    * @table extraproduct
    * return object record of extraproduct
    */
    public function getAllExtraproduct(){
    	$exceptID = $this->not_in;
    	$this->db->select("*")->where('ep_deleted', 0)->where('ep_status', 1);
    			if(!empty($exceptID)){
    				$this->db->where_not_in("ep_id", $exceptID);
    			}
    	$query_extrapro = $this->db->get('extraproduct');
    	return $query_extrapro; 
	}
	/*
    * public function getSubactivities
    * @param $act_id (int)
    * @table activities
    * return object record of extraproduct
    */
    public function getSubactivities($act_id){
    	$query = $this->db->select("*")
    			 ->join('acti_calendar','activities.act_id = acti_calendar.activities_id', 'left')
				 ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id','left')
    			 ->where('act_deleted', 0)
    			 ->where('act_subof', $act_id)
    			 ->get('activities'); 
    	return $query; 
	}
    /*
    * puetblic function getExtraproductByActivities
    * @param $actId (int)
    * @table extra_acti, extraproduct, extraproduct_calendar, calendar_available
    * return object of record
    */

	public function getExtraproductByActivities($actId){
		$query = $this->db->select("*")
				->join("extraproduct","extraproduct.ep_id = extra_acti.extraproduct_id","left")
				->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
				->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")				
				->where("activities_id",$actId)
				->get("extra_acti");
		foreach($query->result() as $record){
    		$this->not_in[$record->ep_id] = $record->ep_id;
    	} 
		return $query;
	}

    /*
    * public function getExproductById
    * @param $ep_id (int)
    * @table extraproduct, extraproduct_calendar, calendar_available
    * return object of record
    */
    public function getExproductById($ep_id){
    	$query = $this->db->select('*')
    			->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
				->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")				
				->where("ep_id",$ep_id)
				->get("extraproduct");
		return $query;
    }
    /*
    * public function insertDateTime
    * @param $dateavalaible (array)
    * @table calendar_available
    * add records
    * return last insert id
    */
    public function insertDateTime($dateavalaible) {
        $this->db->insert('calendar_available', $dateavalaible);
        return $this->db->insert_id('calendar_available');
    }

    /*
    * public function updateDateTime
    * @param $update_calendar (array)
    * @param $cal_id (int)
    * @table calendar_available
    * update records
    * return affected rows
    */
	public function updateDateTime($update_calendar, $cal_id){
			$this->db->where('ca_id', $cal_id);
			if($this->db->update('calendar_available', $update_calendar)){ return true; }else{ return false; }
	}

    /*
    * public function insertActDateTime
    * @param $act_id (int)
    * @param $calendar_id (int)
    * 
    */
    public function insertActDateTime($act_id, $calendar_id) {
        $inserts = array('calendar_available_id' => $calendar_id,'activities_id' => $act_id);
        $this->db->insert('acti_calendar', $inserts);
        return $this->db->insert_id('acti_calendar');
    }

    // end insert id

    /*
    * public function getLocation
    * @noparam
    * @table location
    * Return Object record
    */

    public function getLocation() {
        $query = $this->db->select('*')
            ->where('lt_deleted', 0)
            ->get('location');
        return $query;
	}
	/*
    * public function getSupplier
    * @noparam
    * @table supplier
    * Return Object record
    */

    public function getSupplier() {
        $query = $this->db->select('*')
            ->where('sup_deleted', 0)
            ->get('supplier');
        return $query;
	} 
	/*
    * public function getFastival
    * @noparam
    * @table festival
    * Return Object record
    */

    public function getFastival() {
        $query = $this->db->select('*')
            ->where('ftv_deleted', 0)
            ->get('festival');
        return $query;
	}

    /*
    * public function getPhotos
    * @noparam
    * @table photo
    * Return Object record
    */

	public function getPhotos(){
		$photos = $this->db->select("*")
					->where('pt_id', 3)
					->where('pho_status',1)
					->where('pho_delete',0)
					->get('photo');
		return $photos;
	}
	// end select photos			
		
	//delete multiple activities
	public function deleteMultipleActivities($update,$whereID){
		$this->db->where_in('act_id',$whereID);
		$this->db->update('activities',$update);
		return $this->db->affected_rows() >0;
	}
	//end delete multiple activities
	
	public function deletePermenentActivities($whereID){
		$this->db->where_in('act_id', $whereID);
		$this->db->delete('activities');
		return $this->db->affected_rows() > 0;
	}   
	
	public function exportDataPage(){
	    $query = $this->db
		        ->select('*')
				->from('activities')
		 	    ->where('act_deleted',0)
				->join('location', 'location.lt_id = activities.location_id', 'left')
				->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
				->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id')
				->get();
	    if ($query->num_rows() > 0) {
	        foreach ($query->result() as $record) {
	            $data[] = $record;
	        }
	        return $data;
	    }
	    return FALSE;
	}

    public function exportAllDatas($table){
            $query = $this->db->select('*')
                ->join('location', 'location.lt_id = activities.location_id', 'left')
                ->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
                ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id')
                ->get($table);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $record) {
                    $data[] = $record;
                }
                return $data;
            }
            return FALSE;
        }
}

/* End of file mod_activities.php */
/* Location: ./application/model/mod_activities.php */