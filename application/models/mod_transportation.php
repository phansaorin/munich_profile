<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_transportation extends CI_model {
    /*
    * public function list_transportation
    * @param $perPage, $offSet, $sortby, $sort
    * Table related (location, festival, tp_calendar, calendar_available) 
    * Table transportation
    * return Object after query
    */
    public function list_transportation($perPage, $offSet, $sortby, $sort) {
    	if(($sortby == 'start_date') OR ($sortby == 'end_date')){
    		$sortby = strtolower($sortby);
    	}else{
    		$sortby = "tp_". strtolower($sortby);
    	}
        $query = $this
                ->db
                ->select('*')
                ->from('transportation')
               	->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
               	->join('festival', 'festival.ftv_id = transportation.tp_ftv_id', 'left')
                ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id', 'left')
                ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
                ->where('tp_subof', 0)
                ->where("transportation.tp_deleted", 0)
                ->limit($perPage, $offSet)
                ->order_by($sortby, $sort)
                ->get();
        return $query;
    }
    /*
    * public function getUpdateTransportation
    * @param $tp_id (int)
    * @table tp_calendar, transportation, calendar_available
    * return object record
    */
    public function getUpdateTransportation($tp_id){
    	$query = $this->db->select("*")
    			 ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id', 'left')
                 ->join('photo','photo.photo_id = transportation.photo_id')
				 ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
				 ->where("transportation.tp_deleted", 0)
				 ->where("transportation.tp_id", $tp_id)
				 ->get("transportation");
		return $query;
    }
	/*
	* public function detail_transportation
	* @param $get_id (int)
	* Table related (location, festival, tp_calendar, calendar_available, photo)
	* Table transportation
	* Conditioin tp_id
	*/
	public function detail_transportation($get_id) {
	        $query = $this->db
	                ->select('*')
	                ->from('transportation')
	                ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
	                ->join('supplier', 'supplier.sup_id = transportation.tp_supplier_id', 'left')
	               	->join('festival', 'festival.ftv_id = transportation.tp_ftv_id', 'left')
				    ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id', 'left')
					->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
					->join('photo','photo.photo_id = transportation.photo_id')
					->where("transportation.tp_deleted", 0)
					->where("tp_id", $get_id)
	                ->get();

	        return $query;
	    }
	/*
	* public function detail_extraproduct
	* @param $get_id (int)
	* Table related (location, festival, tp_calendar, calendar_available, photo)
	* Table transportation
	* Conditioin tp_id
	*/
	public function detail_extraproduct($get_id) {
	        $query = $this->db
	                ->select('*')
	                ->from('transportation')
	                ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
	                ->join('supplier', 'supplier.sup_id = transportation.tp_supplier_id', 'left')
	               	->join('festival', 'festival.ftv_id = transportation.tp_ftv_id', 'left')
				    ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id', 'left')
					->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
					->join('photo','photo.photo_id = transportation.photo_id')
					->where("transportation.tp_deleted", 0)
					->where("tp_id", $get_id)
	                ->get();

	        return $query;
	    }
	/*
	* public function detail_temp_transportation
	* @param $get_id (int)
	* Table temp_table
	* return object
	*/
	public function detail_temp_transportation($get_id) {
        $query = $this->db->select('*')->where('ID',$get_id)->where('tmpt_name','tp')->get('temp_table');
		return $query;
	}
	/*
	* public function get_temp_transportation
	* @param $get_id (int)
	* Table temp_table
	* return object
	*/
	public function get_temp_transportation($get_id) {
        $query = $this->db->select('*')->where('tmpt_id',$get_id)->where('tmpt_name','tp')->get('temp_table');
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
	* public function insert_extrapro_tp
	* @param $ep_id (int)
	* @param $tp_id (int)
	* Table extra_transport
	* return object
	*/
	public function insertExtra_tp($ep_id, $tp_id){
        $insert['extraproduct_id'] = $ep_id;
        $insert['transport_id'] = $tp_id;
		$this->db->insert('extra_transport',$insert);
		return $this->db->insert_id('extra_transport');
	}
	
    /*
     * @: search on transportation name
     *
     */

   public function getSearchTransportation($perPage, $offSet, $sortby, $sort,$from_date, $end_date, $transportation_name) {
        $sortby = "tp_id";
        $this->db->select('*')
                 ->from('transportation')
                 ->join('festival', 'festival.ftv_id = transportation.tp_ftv_id', 'left')
               	 ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
		 ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id')
		 ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id');
        if ($from_date != "" AND $end_date != "" AND $transportation_name != "") {
            $this->db->like("transportation.tp_name", $transportation_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)))
                     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else if ($from_date != "" AND $end_date != "") {
            $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)))
                     ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($from_date != "" AND $transportation_name != "") {
            $this->db->like("transportation.tp_name", $transportation_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($end_date != "" AND $transportation_name != "") {
            $this->db->like("transportation.tp_name", $transportation_name)
				     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else {
            if ($from_date != "") {
                $this->db->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
            }elseif ($end_date != "") {
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
            }elseif ($transportation_name != "") {
                $this->db->like("transportation.tp_name", $transportation_name);
            }
        }
        $this->db->where('tp_subof', 0);
	$this->db->where("transportation.tp_deleted", 0);
	$this->db->order_by($sortby, $sort);
	$this->db->limit($perPage, $offSet);
        $query = $this->db->get();
        return $query;
    }
	/*
	* @: search export record
	*/
	public function getSearchTransportationExport($from_date, $end_date, $transportation_name) {
        $this->db->select('*')
                 ->from('transportation')
               	 ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
				 ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id')
				 ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id');
        if ($from_date != "" AND $end_date != "" AND $transportation_name != "") {
            $this->db->like("transportation.tp_name", $transportation_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)))
                     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else if ($from_date != "" AND $end_date != "") {
            $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)))
                     ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($from_date != "" AND $transportation_name != "") {
            $this->db->like("transportation.tp_name", $transportation_name)
					 ->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
        } else if ($end_date != "" AND $transportation_name != "") {
            $this->db->like("transportation.tp_name", $transportation_name)
				     ->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
        } else {
            if ($from_date != "") {
                $this->db->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
            }elseif ($end_date != "") {
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
            }elseif ($transportation_name != "") {
                $this->db->like("transportation.tp_name", $transportation_name);
            }
        }
        $this->db->where('tp_subof', 0);
	$this->db->where("transportation.tp_deleted", 0);
        $query = $this->db->get();
        return $query;
 	}

	/*
	* public function createTransportation
	* @param $insert (array)
	* @table transportation
	* add records
	* return last insert id
	*/
	public function createTransportation($insert){
		$this->db->insert('transportation',$insert);
		return $this->db->insert_id('transportation');
	}

	/*
	* public function updateTransportation
	* @param $update_transportation (array)
	* @param $tp_id (int)
	* @table transportation
	* update records
	* return affected rows
	*/
	public function updateTransportation($update_transportation, $tp_id){
        $this->db->where('tp_id', $tp_id);
        if($this->db->update('transportation', $update_transportation)){ return true; }else{ return false; }
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
    * public function getSubtransportation
    * @param $tp_id (int)
    * @table transportation
    * return object record of extraproduct
    */
    public function getSubtransportation($tp_id){
    	$query = $this->db->select("*")
    			 ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id', 'left')
				 ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
    			 ->where('tp_deleted', 0)
    			 ->where('tp_subof', $tp_id)
    			 ->get('transportation'); 
    	return $query; 
	}
    /*
    * puetblic function getExtraproductByTransportation
    * @param $tpId (int)
    * @table extra_transport, extraproduct, extraproduct_calendar, calendar_available
    * return object of record
    */

	public function getExtraproductByTransportation($tpId){
		$query = $this->db->select("*")
				->join("extraproduct","extraproduct.ep_id = extra_transport.extraproduct_id","left")
				->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
				->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")				
				->where("transport_id",$tpId)
				->get("extra_transport");
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
    * public function insertTpDateTime
    * @param $tp_id (int)
    * @param $calendar_id (int)
    * 
    */
    public function insertTpDateTime($tp_id, $calendar_id) {
        $inserts = array('calendar_available_id' => $calendar_id,'transport_id' => $tp_id);
        $this->db->insert('tp_calendar', $inserts);
        return $this->db->insert_id('tp_calendar');
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
					->where('pt_id', 4)
					->where('pho_status',1)
					->where('pho_delete',0)
					->get('photo');
		return $photos;
	}
	// end select photos			
		
	//delete multiple transportation
	public function deleteMultipleTransportation($update,$whereID){
		$this->db->where_in('tp_id',$whereID);
		$this->db->update('transportation',$update);
		return $this->db->affected_rows() >0;
	}
	//end delete multiple transportation
	
	public function deletePermenenttp($whereID){
		$this->db->where_in('tp_id', $whereID);
		$this->db->delete('transportation');
		return $this->db->affected_rows() > 0;
	}
	
	public function exportDataPage(){
        $query = $this->db
                ->select('*')
                ->from('transportation')
                ->where('tp_deleted',0)
                 ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
                ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id')
                ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id')
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
                ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id', 'left')
                ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
                ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
                ->where('tp_deleted', 0)    
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

/* End of file mod_transportation.php */
/* Location: ./application/model/mod_transportation.php */