<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Mod_booking extends MU_Model {

	/*updateExtraservice
	* public function getFestival
	* @param $perPage, $offSet, $sortby, $sort
	* @table booking
	* return object
	*/
	public function getAllsalePackage($perPage, $offSet, $sortby, $sort){
		$sortby = "bk_".strtolower($sortby);
		$getbooking = $this->db->select("*")
			 ->where("bk_deleted",0)
			 ->limit($perPage, $offSet)
             		 ->order_by($sortby, $sort)
			 ->get("booking");
		return $getbooking;
	}
	/*
	* public function getAllSearchsalePackage
	* @param $perPage, $offSet, $sortby, $sort
	* @table booking
	* return object
	*/
	public function getAllSearchsalePackage($searchID, $perPage, $offSet, $sortby, $sort){
		$sortby = "bk_".strtolower($sortby);
		$getbooking = $this->db->select("*")
				->where("bk_deleted",0)
				->limit($perPage, $offSet)
             			->order_by($sortby, $sort)
             			->like('bk_id', $searchID)
						->get("booking");
		return $getbooking;
	}
	public function getAllCustomize(){
		$query = $this->db->select("*")
			->where("cuscon_deleted",0)
						->get("customize_conjection");
		return $query;
	}
	public function getAllPackage(){
		$query = $this->db->select("*")
						->where("pkcon_deleted",0)
						->get("package_conjection");
		return $query;
	}
	public function getAllExtraService(){
		$query = $this->db->select("ep_id, ep_name")
						->where("ep_deleted",0)
						->get("extraproduct");
		return $query;
	}
	// add extraproduct
	public function getPhotos(){
			$photos = $this->db->select("*")
						->where('pt_id', 1)
						->where('pho_status',1)
						->where('pho_delete',0)
						->get('photo');
			return $photos;
		}
	// the endof extraproduct
	/*
	* public function insertBooking
	* @param $insert_booking (array)
	* @table booking
	* return insert_id
	*/

	public function insertBooking($insert_booking){
		$this->db->insert('booking',$insert_booking);
        return $this->db->insert_id('booking');
	}
	
	/*******/
	public function updateBooking($update, $bk_id){
        $this->db->where('bk_id', $bk_id);
        if($this->db->update('booking',$update)){ return true; }else{ return false; }
    }

	/*
	* public function insertBooking
	* @param $bkID, $passID (int)
	* @table passenger_booking
	* return insert_id
	*/
	/*
	*function for update actutustock
	*
	*/
		public function updateActualstock($actuaProduct,$extraID){
		$updateactulstock['ep_actualstock'] = $actuaProduct;
		$this->db->where('ep_id',$extraID);
		if($this->db->update('extraproduct', $updateactulstock)){ return true; }else{ return false; }
	}


	public function insertpassbooking($passID, $bkID){
		$insertpassbooking['pbk_bk_id'] = $bkID;
		$insertpassbooking['pbk_pass_id'] = $passID;
		$this->db->insert('passenger_booking', $insertpassbooking);
        return $this->db->insert_id('passenger_booking');
	}

	/*
	* public function updateaccompany
	* @param $bkID, $passID (int), $accompany (array serialize)
	* @table passenger_booking
	* return affected_rows
	*/
	public function updateaccompany($accompany, $bkID, $passID){
		$this->db->where('pbk_bk_id', $bkID);
		$this->db->where('pbk_pass_id', $passID);
		$update = array('pbk_pass_come_with' => $accompany);
        if($this->db->update('passenger_booking',$update)){ return true; }else{ return false; }
	}
    public function updateAccompanyInBooking($newaccompany, $bkID){
    	$this->db->where('bk_id', $bkID);
		$update = array('bk_total_people' => $newaccompany);
        if($this->db->update('booking',$update)){ return true; }else{ return false; }
    }

	/*
	* public function updateBooking
	* @param $bkID, $passID (int)
	* @table passenger_booking
	* return affected_rows
	*/

	public function updatepassbooking($passID, $bkID){
		$updatepassbooking['pbk_bk_id'] = $bkID;
		$updatepassbooking['pbk_pass_id'] = $passID;
		$this->db->where('pbk_bk_id', $bkID);
		if($this->db->update('passenger_booking', $updatepassbooking)){ return true; }else{ return false; }
	}
	/*
	* public function insertsalepackage
	* @param $bkID, $bookingpackage (int)
	* @table passenger_booking
	* return insert_id
	*/
	public function insertsalepackage($bookingpackage, $bkID){
		$sale_packages['salepk_bk_id'] = $bkID;
		$sale_packages['salepk_pkcon_id'] = $bookingpackage;
		$this->db->insert('sale_packages', $sale_packages);
        return $this->db->insert_id('sale_packages');
	}

	/*
	* public function updatesalepackage
	* @param $bkID, $bookingpackage (int)
	* @table sale_packages
	* return affected_rows
	*/

	public function updatesalepackage($bookingpackage, $bkID){
		$updatesalebooking['salepk_pkcon_id'] = $bookingpackage;
		$this->db->where('salepk_bk_id', $bkID);
		if($this->db->update('sale_packages', $updatesalebooking)){ return true; }else{ return false; }
	}
	
	/*
	* public function getBookingEditPackage
	* @param $bkID (int)
	* table booking, passenger, passenger_booking, sale_customize, sale_packages, package_conjection, customize_conjection
	* return object
	*/
	public function getBookingEditPackage($bkID){
		$querybookingpk = $this->db->select('*')
					->join('passenger_booking', 'booking.bk_id = passenger_booking.pbk_bk_id','left')
					->join('passenger', 'passenger.pass_id = passenger_booking.pbk_pass_id','left')
					->join('sale_packages', 'booking.bk_id = sale_packages.salepk_bk_id','left')
					->join('package_conjection', 'sale_packages.salepk_pkcon_id = package_conjection.pkcon_id','left')
					->where('bk_deleted', 0)
					->where('bk_id', $bkID)
					->get('booking');
		return $querybookingpk;
	}


	/*
	* public function getPassenger
	* @noparam
	* table passenger
	*/
	public function getPassenger(){
		$passenger = $this->db->select('*')
					->where('pass_deleted', 0)
					->where('pass_status', 1)
					->get('passenger');
		return $passenger;
	}
	/*********/
	public function getpassengerin($passwith){
		$query = $this->db->select('*')
				->where('pass_deleted', 0)
				->where('pass_status', 1)
				->where_in('pass_id', $passwith)
				->get('passenger');
		return $query;
	}

	public function getExtraProductById($esID){
	$query = $this->db->select("*")                 
                ->join('supplier', 'supplier.sup_id = extraproduct.supplier_id', 'left')               
                ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
                ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")
                ->join('photo','photo.photo_id = extraproduct.photo_id')
                ->where_in("extraproduct.ep_id", $esID)
                ->get('extraproduct');
        return $query;
    }
    public function getExtraProductPrice(){
    	$query = $this->db->select('*')
    			//->where('ep_id')
    			->where('ep_status',1)
    			->where('ep_deleted',0)
    			->get('extraproduct');
    	return $query;
    }
    public function gettotalPeople(){
        $query = $this->db->select('*')
    			->where('bk_status',1)
    			->where('bk_deleted',0)
    			->get('booking');
    	return $query;
    }
    /*
	* public function updateExtraservice
	* @param $bkID (int), $extraservices (array serialize)
	* @table booking
	* return affected_rows
	*/

	public function updateExtraservice($extraservices, $bkID){
		$updateextraservices['bk_addmoreservice'] = $extraservices;
		$this->db->where('bk_id', $bkID);
		if($this->db->update('booking', $updateextraservices)){ return true; }else{ return false; }
	}
	////////////////
	public function deleteMultiplebk($update, $whereID){
		$this->db->where_in('bk_id',$whereID);
		return $this->db->update('booking',$update);
	}

	public function deletePermenentbk($whereID){
		$this->db->where_in('bk_id', $whereID);
		return $this->db->delete('booking');
	}

	/*
	* public function getFestival
	* @noparam
	* table (photo, location, festival)
	* return object
	*/
	public function getFestival(){
		$data = $this->db->select('*')
				->join('photo','photo.photo_id = festival.ftv_photo_id','left')
				->join('location','location.lt_id = festival.ftv_lt_id','left')
				->order_by('ftv_lt_id')
				->where('ftv_deleted',0)
				->where('ftv_status',1)
				->get('festival');
		return $data;
	}
	// public function getFestival(){
	// 	$data = $this->db->select('*')
	// 			->join('photo','photo.photo_id = festival.ftv_photo_id','left')
	// 			->join('location','location.lt_id = festival.ftv_lt_id','left')
	// 			->order_by('ftv_lt_id')
	// 			->where('ftv_deleted',0)
	// 			->where('ftv_status',1)
	// 			->get('festival');
	// 	return $data;
	// }
	

	/*
	* public function getLocation
	* @noparam
	* table (location)
	* return object
	*/

	public function getLocation(){
		$query_location = $this->db->select('*')->where('lt_status', 1)->where('lt_deleted', 0)->get('location');
		return $query_location;
	}

	/*
	* public function getFestival
	* @param $ftv_lc_id (int)
	* table (photo, location, festival)
	* return object
	*/
	public function getFtvByLcID($ftv_lc_id){
		$data = $this->db->select('*')
				->join('photo','photo.photo_id = festival.ftv_photo_id','left')
				->join('location','location.lt_id = festival.ftv_lt_id','left')
				->order_by('ftv_id')
				->where('ftv_deleted',0)
				->where('ftv_lt_id', $ftv_lc_id)
				->where('ftv_status',1)
				->get('festival');
		return $data;
	}
	public function getMorePassenger($insert){
		$this->db->insert('passenger',$insert);
		return $this->db->insert_id('passenger');
	}
	////// solak /////
	
	/*
	* public function insertsalecustomize
	* @param $bkID, $bookingcustomize (int)
	* @table sale_customize
	* return insert_id
	*/
	public function insertsalecustomize($bookingcustomize, $bkID){
		$sale_customize['salecus_bk_id'] = $bkID;
		$sale_customize['salecus_cuscon_id'] = $bookingcustomize;
		$this->db->insert('sale_customize', $sale_customize);
        return $this->db->insert_id('sale_customize');
	}
	/*
	* public function updatesalecustomize
	* @param $bkID, $bookingcustomize (int)
	* @table sale_customize
	* return affected_rows
	*/

	public function updatesalecustomize($bookingcustomize, $bkID){
		$updatesalebooking['salecus_cuscon_id'] = $bookingcustomize;
		$this->db->where('salecus_bk_id', $bkID);
		if($this->db->update('sale_customize', $updatesalebooking)){ return true; }else{ return false; }
	}
	/*
	* public function getBookingEditPackage
	* @param $bkID (int)
	* table booking, passenger, passenger_booking, sale_customize, sale_packages, package_conjection, customize_conjection
	* return object
	*/
	public function getBookingEditCustomize($bkID){
		$querybookingpk = $this->db->select('*')
					->join('passenger_booking', 'booking.bk_id = passenger_booking.pbk_bk_id','left')
					->join('passenger', 'passenger.pass_id = passenger_booking.pbk_pass_id','left')
					->join('sale_customize', 'booking.bk_id = sale_customize.salecus_bk_id','left')
					->join('customize_conjection', 'sale_customize.salecus_cuscon_id = customize_conjection.cuscon_id','left')
					->where('bk_deleted', 0)
					->where('bk_id', $bkID)
					->get('booking');
		return $querybookingpk;
	}

}