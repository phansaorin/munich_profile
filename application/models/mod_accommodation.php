<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_accommodation extends CI_model {

    /*
    * public function list_accommodation
    * @param $perPage, $offSet, $sortby, $sort
    * Table related (room_types, location, festival, acc_calendar, calendar_available) 
    * Table accommodation
    * return Object after query
    */
    public function list_accommodation($perPage, $offSet, $sortby, $sort) {
    	if(($sortby == 'start_date') OR ($sortby == 'end_date')){
    		$sortby = strtolower($sortby);
    	}else{
    		$sortby = "acc_". strtolower($sortby);
    	}
        $query = $this->db
            ->select('*')
            ->from('accommodation')
            ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
            ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
            ->join('location', 'location.lt_id = accommodation.location_id', 'left')
            ->join('festival', 'festival.ftv_id = accommodation.acc_ftv_id', 'left')
			->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id', 'left')
			->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id','left')
			->where('acc_subof', 0)
			->where("accommodation.acc_deleted", 0)
            ->limit($perPage, $offSet)
            ->order_by($sortby, $sort)
            ->get();
        return $query;
    }

    /*
    *public function getFacility
    *noparam
    *return object record
    */
    public function getFacility(){
        $query = $this->db->select("*")
        ->where('facilities_deleted',0)
        ->get('facilities');
        return $query;
    }
    
    /*
    * public function getUpdateAccommodation
    * @param $acc_id (int)
    * @table acc_calendar, accommodation, calendar_available
    * return object record
    */
    public function getUpdateAccommodation($acc_id){
    	$query = $this->db->select("*")
            ->from('accommodation')
            ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
            ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
            ->join('location', 'location.lt_id = accommodation.location_id', 'left')
            ->join('photo','photo.photo_id = accommodation.photo_id')
            ->join('festival', 'festival.ftv_id = accommodation.acc_ftv_id', 'left')
            ->join('acc_fac','acc_fac.accomodations_id = accommodation.acc_id','left')
            ->join('facilities','acc_fac.facilities_id = facilities.facilities_id','left')
            ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id', 'left')
            ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id','left')
            ->where('acc_deleted',0)
            ->where('accommodation.acc_id', $acc_id)
			->get();
		return $query;
    }

	/*
	* public function detail_accommodation
	* @param $get_id (int)
	* Table related (room_types, location, festival, acc_calendar, calendar_available, photo)
	* Table accommodation
	* Conditioin acc_id
	*/
	public function detail_accommodation($get_id) {
	    $query = $this->db
	        ->select('*')
	        ->from('accommodation')
            ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
            ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
	        ->join('location', 'location.lt_id = accommodation.location_id', 'left')
	        ->join('supplier', 'supplier.sup_id = accommodation.acc_supplier_id', 'left')
	        ->join('festival', 'festival.ftv_id = accommodation.acc_ftv_id', 'left')
			->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id', 'left')
			->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id','left')
			->join('photo','photo.photo_id = accommodation.photo_id')
            ->join('acc_fac','acc_fac.accomodations_id = accommodation.acc_id','left')
            ->join('facilities','acc_fac.facilities_id = facilities.facilities_id','left')
			->where("accommodation.acc_deleted", 0)
			->where("acc_id", $get_id)
	        ->get();
	    return $query;
	}

	/*
	* public function detail_extraproduct
	* @param $get_id (int)
	* Table related (room_types, location, festival, acc_calendar, calendar_available, photo)
	* Table accommodation
	* Conditioin acc_id
	*/
	public function detail_extraproduct($get_id) {
	   $query = $this->db
	        ->select('*')
	        ->from('accommodation')
            ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
            ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
	        ->join('location', 'location.lt_id = accommodation.location_id', 'left')
	        ->join('supplier', 'supplier.sup_id = accommodation.acc_supplier_id', 'left')
	        ->join('festival', 'festival.ftv_id = accommodation.acc_ftv_id', 'left')
			->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id', 'left')
			->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id','left')
			->join('photo','photo.photo_id = accommodation.photo_id')
            ->join('acc_fac','acc_fac.accomodations_id = accommodation.acc_id','left')
            ->join('facilities','acc_fac.facilities_id = facilities.facilities_id','left')
			->where("accommodation.acc_deleted", 0)
			->where("acc_id", $get_id)
	       ->get();
	   return $query;
	}

	/*
	* public function detail_temp_accommodation
	* @param $get_id (int)
	* Table temp_table
	* return object
	*/
	public function detail_temp_accommodation($get_id) {
        $query = $this->db
            ->select('*')
            ->where('ID',$get_id)
            ->where('tmpt_name','acc')
            ->get('temp_table');
		return $query;
	}

	/*
	* public function get_temp_accommodation
	* @param $get_id (int)
	* Table temp_table
	* return object
	*/
	public function get_temp_accommodation($get_id) {
        $query = $this->db->select('*')->where('tmpt_id',$get_id)->where('tmpt_name','acc')->get('temp_table');
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
	* public function insert_extrapro_acc
	* @param $ep_id (int)
	* @param $acc_id (int)
	* Table extra_acc
	* return object
	*/
	public function insertExtra_acc($ep_id, $acc_id){
        $insert['extraproduct_id'] = $ep_id;
        $insert['accomodations_id'] = $acc_id;
		$this->db->insert('extra_acc',$insert);
		return $this->db->insert_id('extra_acc');
	}
	
    /*
    *public function getSearchAccommodation
    *@param $perPage
    *@param $offSet
    *@param $sortby
    *@param $sort
    *@param $from_date
    *@param $end_date
    *@param $accommodation_name
    *@: search on accommodation name
    *return object record
    */

   public function getSearchAccommodation($perPage, $offSet, $sortby, $sort,$from_date, $end_date, $accommodation_name) {
        $sortby = "acc_id";
        $this->db->select('*')
                 ->from('accommodation')
                 ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
                 ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
                 ->join('location', 'location.lt_id = accommodation.location_id', 'left')
                 ->join('festival', 'festival.ftv_id = accommodation.acc_ftv_id', 'left')
                 ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id', 'left')
                 ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id','left');
        if ($from_date != "" AND $end_date != "" AND $accommodation_name != "") {
            $this->db->like("accommodation.acc_name", $accommodation_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)))
                     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else if ($from_date != "" AND $end_date != "") {
            $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)))
                     ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($from_date != "" AND $accommodation_name != "") {
            $this->db->like("accommodation.acc_name", $accommodation_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($end_date != "" AND $accommodation_name != "") {
            $this->db->like("accommodation.acc_name", $accommodation_name)
				     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else {
            if ($from_date != "") {
                $this->db->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
            }elseif ($end_date != "") {
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
            }elseif ($accommodation_name != "") {
                $this->db->like("accommodation.acc_name", $accommodation_name);
            }
        }
        $this->db->where('acc_subof', 0);
	$this->db->where("accommodation.acc_deleted", 0);
	$this->db->order_by($sortby, $sort);
	$this->db->limit($perPage, $offSet);
        $query = $this->db->get();
        return $query;
    }

	/*
    *public function getSearchAccommodationExport
	*@: search export record
    *@param $from_date (date)
    *@param $end_date (date)
    *@param $accommodation_name (varchar)
    *condition search from date, end date, accommodation name
    *return object record
	*/
	public function getSearchAccommodationExport($from_date, $end_date, $accommodation_name) {
        $this->db->select('*')
                 ->from('accommodation')
                 ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
                 ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
               	 ->join('location', 'location.lt_id = accommodation.location_id', 'left')
				 ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
				 ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id');
        if ($from_date != "" AND $end_date != "" AND $accommodation_name != "") {
            $this->db->like("accommodation.acc_name", $accommodation_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)))
                     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else if ($from_date != "" AND $end_date != "") {
            $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)))
                     ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($from_date != "" AND $accommodation_name != "") {
            $this->db->like("accommodation.acc_name", $accommodation_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($end_date != "" AND $accommodation_name != "") {
            $this->db->like("accommodation.acc_name", $accommodation_name)
				     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else {
            if ($from_date != "") {
                $this->db->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
            }elseif ($end_date != "") {
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
            }elseif ($accommodation_name != "") {
                $this->db->like("accommodation.acc_name", $accommodation_name);
            }
        }
        $this->db->where('acc_subof', 0);        
	$this->db->where("accommodation.acc_deleted", 0);
        $query = $this->db->get();
        return $query;
 	}

	/*
	* public function createAccommodation
	* @param $insert (array)
	* @table accommodation
	* add records
	* return last insert id
	*/
	public function createAccommodation($insert){
		$this->db->insert('accommodation',$insert);
		return $this->db->insert_id('accommodation');
	}

	/*
	* public function updateAccommodation
	* @param $update_accommodation (array)
	* @param $acc_id (int)
	* @table accommodation
	* update records
	* return affected rows
	*/
	public function updateAccommodation($update_accommodation, $acc_id){
        $this->db->where('acc_id', $acc_id);
        if($this->db->update('accommodation', $update_accommodation)){ 
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
    	$this->db->select("*") 
                 ->where('ep_deleted', 0)
                 ->where('ep_status', 1);
    			if(!empty($exceptID)){
    				$this->db->where_not_in("ep_id", $exceptID);
    			}
    	$query_extrapro = $this->db->get('extraproduct');
    	return $query_extrapro; 
	}

	/*
    * public function getSubaccommodation
    * @param $acc_id (int)
    * @table accommodation
    * return object record of extraproduct
    */
    public function getSubaccommodation($acc_id){
    	$query = $this->db->select("*")
    			 ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id', 'left')
				 ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id','left')
    			 ->where('acc_deleted', 0)
    			 ->where('acc_subof', $acc_id)
    			 ->get('accommodation'); 
    	return $query; 
	}

    /*
    * puetblic function getExtraproductByAccommodation
    * @param $accId (int)
    * @table extra_acc, extraproduct, extraproduct_calendar, calendar_available
    * return object of record
    */
	public function getExtraproductByAccommodation($accId){
		$query = $this->db->select("*")
				->join("extraproduct","extraproduct.ep_id = extra_acc.extraproduct_ep_id","left")
				->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
				->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")				
				->where("accomodations_ad_id",$accId)
				->get("extra_acc");
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
    * public function updateFacilities
    *@param $update_ficility
    *@param $acc_id(int)
    *return 
    */
    public function updateFacilities($update_ficility, $acc_id){
            $this->db->where('accomodations_id', $acc_id);
            if($this->db->update('facilities', $update_ficility)){ 
                return true; 
            }else{ 
                return false; 
            }
    }

    /*
    *public function insertFacilities
    *@param $fici_id (int)
    *@param $acc_id (int)
    */
    public function insertFacilities($fici_id, $acc_id){
        for($i = 0; $i<count($fici_id); $i++){ 
            if($fici_id[$i] != "" or $fici_id[$i] != 0){
                $insert = array('facilities_id'=> $fici_id[$i], 'accomodations_id'=> $acc_id);
                $this->db->insert('acc_fac', $insert);
            }
        }
        return $this->db->affected_rows() > 0;
    }
// 
    public function insertFacilitiesForUpdate($ficilities_id,$accomodation_id){
        for($i = 0; $i<count($ficilities_id); $i++){ 
            if($ficilities_id[$i] != "" or $ficilities_id[$i] != 0){
                $insert = array('facilities_id'=> $ficilities_id[$i], 'accomodations_id'=> $accomodation_id);
                $this->db->insert('acc_fac', $insert);
            }
        }
        return $this->db->affected_rows() > 0;
    }
    public function DeleteFacility($accomodation_id){
            $this->db->where('accomodations_id', $accomodation_id);
            return $this->db->delete('acc_fac');

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
            if($this->db->update('calendar_available', $update_calendar)){ 
                return true; 
            }else{ 
                return false; 
            }
    }
    /*
    *public function updateFicility
     
    }

    */
    public function updateFicility($update_ficilities, $ficility_id){
            $this->db->where('accfac_id',$ficility_id);
            if($this->db->update('acc_fac', $update_ficilities)){ 
                    return true; 
                }else{ 
                    return false; 
                }
       
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
    * public function insertAccDateTime
    * @param $acc_id (int)
    * @param $calendar_id (int)
    * return object record
    */
    public function insertAccDateTime($acc_id, $calendar_id) {
        $inserts = array('calendar_available_id' => $calendar_id,'accomodations_id' => $acc_id);
        $this->db->insert('acc_calendar', $inserts);
        return $this->db->insert_id('acc_calendar');
    }

    // end insert id


    /*
    * public function getRoom
    * @noparam
    * @table room_types
    * Return Object record
    */
    public function getRoom() {
        $query = $this->db->select('*')
            ->where('rt_deleted', 0)
            ->get('room_types');
        return $query;
    }

    /*
    * public function getClassification
    * @noparam
    * @table classification
    * Return Object record
    */
    public function getClassification() {
        $query = $this->db->select('*')
            ->where('clf_deleted', 0)
            ->get('classification');
        return $query;
    }

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
			->where('pt_id',2)
			->where('pho_status',1)
			->where('pho_delete',0)
			->get('photo');
		return $photos;
	}
	// end select photos			
		
	/*
    *public function deleteMultipleAccommodation
    *@param $update
    *@param $whereID
    *return object record
    */
    //delete multiple accommodation
	public function deleteMultipleAccommodation($update,$whereID){
		$this->db->where_in('acc_id',$whereID);
		$this->db->update('accommodation',$update);
		return $this->db->affected_rows() >0;
	}
	//end delete multiple accommodation
	
    /*
    *public function deletePermenentAcc
    *@param $whereID(int)
    *return object record
    */
	public function deletePermenentAcc($whereID){
		$this->db->where_in('acc_id', $whereID);
		$this->db->delete('accommodation');
		return $this->db->affected_rows() > 0;
	}
	
    /*
    *public function exportDataPage
    *noparam
    */
	public function exportDataPage(){
	    $query = $this->db
		    ->select('*')
			->from('accommodation')
		 	->where('acc_deleted',0)
            ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
            ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
			->join('location', 'location.lt_id = accommodation.location_id', 'left')
			->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
			->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id')
			->get();
	    if ($query->num_rows() > 0) {
	        foreach ($query->result() as $record) {
	            $data[] = $record;
	        }
	        return $data;
	    }
	    return FALSE;
	}

    /*
    *public function exportAllDatas
    *@param $table
    */
    public function exportAllDatas($table){
        $query = $this->db
            ->select('*')
            ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
            ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
            ->join('location', 'location.lt_id = accommodation.location_id', 'left')
            ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
            ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id')
            ->where('acc_deleted',0)
            ->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $record) {
                $data[] = $record;
            }
            return $data;
        }
        return FALSE;
    }


    /*
    * public function getAccWithFAC
    * @param $facORacc_id (array or int)
    * @param $string (string)
    * condition (where or where_in)
    * @table acc_fac, facilities
    */
    public function getAccWithFAC($facORacc_id, $string){
        $this->db->select("*");
        if($string == "normal"){
            $this->db->join('facilities', 'facilities.facilities_id = acc_fac.facilities_id', 'left');
            $this->db->where('accomodations_id', $facORacc_id);
            $query = $this->db->get('acc_fac');
        }else{
            $this->db->where_in('facilities_id', $facORacc_id);
            $query = $this->db->get('facilities');
        }
        return $query;
    }
}

/* End of file mod_accommodation.php */
/* Location: ./application/model/mod_accommodation.php */