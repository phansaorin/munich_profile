<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_extra_products extends CI_model {

    public function list_record($perPage, $offSet, $sortby, $sort) {
        $sortby = "ep_" . strtolower($sortby);
        $query = $this
                ->db
                ->select('*')
                ->from('extraproduct')
                ->join('photo','photo.photo_id = extraproduct.photo_id')
		->where("extraproduct.ep_deleted", 0)
                ->limit($perPage, $offSet)
                ->order_by($sortby, $sort)
                ->get();
        return $query;
    }	
	public function getSearchExtraproducts($perPage, $offSet, $sortby, $sort, $extraproduct_name) {
        	$sortby = "ep_id";
	        $this->db->select('*')
	        		->from("extraproduct")
					->where("ep_deleted",0);
	        if ($extraproduct_name != "") {
	            $this->db->like("extraproduct.ep_name", $extraproduct_name);			     
	        } 
			$this->db->where("extraproduct.ep_deleted", 0);
	        $this->db->limit($perPage, $offSet);
	        $this->db->order_by($sortby, $sort);
	        $query = $this->db->get();
	        return $query;
    }
	
	public function view_extra_products($get_id) {
	        $query = $this->db
	                ->select('*')
	                ->from('extraproduct')
					->join('photo','photo.photo_id = extraproduct.photo_id')
					->where("extraproduct.ep_deleted", 0)
					->where("ep_id", $get_id)
	                ->get();

	        return $query;
	    }
	

   
	
	public function getSearchExtraproductsExport($extraproduct_name) {
        $this->db->select('*')
                 ->from('extraproduct');
               	 
        if ($extraproduct_name != "") {
	        $this->db->like("extraproduct.ep_name", $extraproduct_name);			     
	    } 
		$this->db->where("extraproduct.ep_deleted", 0);
        $query = $this->db->get();
        return $query;
 	}
	
	public function createExtraproducts($extraproductsName,$perperson,$perbooking,$txtAdmin,$photo,$textEticket,$txtBooking,$purchasePrice,$salePrice, $originalStock, $actualStock,$txtProviderDate,$txtPayed,$txtDeadline,$txtStatus){
		//echo $txtAdmin; die();
			$insert =  array(
						'ep_name' => $extraproductsName,
						'ep_perperson' => $perperson,
						'ep_perbooking' => $perbooking,
						'ep_admintext' => $txtAdmin,
						'ep_bookingtext' => $txtBooking,
						'ep_etickettext' => $textEticket,
						'ep_purchaseprice' => $purchasePrice,
						'ep_saleprice' => $salePrice,
						'ep_originalstock' => $originalStock,
						'ep_actualstock' => $actualStock,
						'ep_providerdate' => $txtProviderDate,
						'ep_payeddate' => $txtPayed,
						'ep_deadline' => $txtDeadline,
						'photo_id' => $photo,
						'ep_status' => $txtStatus,
						'ep_deleted' => 0
			 );
			$this->db->insert('extraproduct',$insert);
			return $this->db->insert_id('extraproduct');
		}
		public function createActivities($insert){
		$this->db->insert('extraproduct',$insert);
		return $this->db->insert_id('extraproduct');
	}
		 public function insertDateTime($dateavalaible) {
        $this->db->insert('calendar_available', $dateavalaible);
        return $this->db->insert_id('calendar_available');
    }
    // go on to do it
    public function insertActDateTime($ep_id, $calendar_id) {
        $inserts = array('calendar_available_id' => $calendar_id,'extraproduct_id' => $ep_id);
        $this->db->insert('extraproduct_calendar', $inserts);
        return $this->db->insert_id('extraproduct_calendar');
    }
	public function checkExtraproductsName($checkEpNameExist){
			$checkEpName = $this->db->select("*")
							->where('ep_name',$checkEpNameExist)
							->where('ep_status',1)
							->where('ep_deleted',0)
							->get('extraproduct');
			return $checkEpName;
		}
	public function getSupplier() {
        $query = $this->db->select('*')
            ->where('sup_deleted', 0)
            ->get('supplier');
        return $query;
	}

	    public function select_extraproductsId($get_id) {
	        $query = $this->db
	                ->select('*')
					->join('photo','photo.photo_id = extraproduct.photo_id')
	                ->from('extraproduct')
					->where("ep_id", $get_id)
	                ->get();

	        return $query;
	    }
    
		public function edit_extra_product($get_id,$get_name,$get_person,$get_person_booking,$get_booking,$get_etichet,$get_photo,$get_supplier,$get_purchaseprice,$get_saleprice,$get_originalstock,$get_actualstock,$get_provider,$get_payed,$get_deadline,$get_admin,$get_status) {
	        $data = array(
	            		'ep_name' => $get_name,
						'ep_perperson' => $get_person,
						'ep_perbooking' => $get_person_booking,
						'ep_bookingtext' => $get_booking,
						'ep_etickettext' => $get_etichet,
						'photo_id' 			=> $get_photo,
						'ep_admintext' => $get_txtAdmin,
						'supplier_id' => $get_supplier,	
						'ep_purchaseprice' => $get_purchaseprice,
						'ep_saleprice' => $get_saleprice,
						'ep_originalstock' => $get_originalstock,
						'ep_actualstock' => $get_actualstock,
						'ep_providerdate' => $get_provider,
						'ep_payeddate' => $get_payed,
						'ep_deadline' => $get_deadline,
						'ep_admintext' >$get_admin,
						'ep_status' => $get_status,
						'ep_deleted' => 0
	        );
	        $this->db->where('ep_id', $get_id);
	        return $this->db->update('extraproduct', $data);
    	}
		
		public function getPhotos(){
			$photos = $this->db->select("*")
						->where('pt_id', 1)
						->where('pho_status',1)
						->where('pho_delete',0)
						->get('photo');
			return $photos;
		}
	public function getUpdateExtraProduct($ep_id){
    	$query = $this->db->select("*")
    			 ->join('extraproduct_calendar','extraproduct_calendar.extraproduct_id = extraproduct.ep_id', 'left')
				 ->join('calendar_available','extraproduct_calendar.calendar_available_id = calendar_available.ca_id', 'left')
				 ->join('photo','photo.photo_id = extraproduct.photo_id')
				 ->where("extraproduct.ep_deleted", 0)
			 	 ->where("extraproduct.ep_id", $ep_id)
				 ->get("extraproduct");
				 // ->get("extraproduct_calendar");
		return $query;
    }			
	public function updateExtraProduct($update_activities, $ep_id){
        $this->db->where('ep_id', $ep_id);
        if($this->db->update('extraproduct', $update_activities)){
         return true;
          }else{ 
            return false;
           }
	}
		var $not_in = array();

	public function updateDateTime($update_calendar, $cal_id){
			$this->db->where('ca_id', $cal_id);
			if($this->db->update('calendar_available', $update_calendar)){ return true; }else{ return false; }
	}

		
		public function deleteMultipleExtraproducts($update,$whereID){
			$this->db->where_in('ep_id',$whereID);
			$this->db->update('extraproduct',$update);
			return $this->db->affected_rows() >0;
		}
		
		
		public function deletePermenentExtraproducts($whereID){
			$this->db->where_in('ep_id', $whereID);
			$this->db->delete('extraproduct');
			return $this->db->affected_rows() > 0;
		}
			
			
		public function exportDataPage(){
         $query = $this->db
		        ->select('*')
				->from('extraproduct')
		 	    ->where('ep_deleted',0)
				->get();
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