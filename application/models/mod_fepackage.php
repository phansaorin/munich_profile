<?php
	if (!defined('BASEPATH'))
    	exit('No direct script access allowed');
class mod_fepackage extends MU_Model{
	/*
    * getAllpackage is public method
    * @param $ftv as int
    * @param $lc as int
    * RETURN as Object
    */
    public function getallpackages($ftv, $lc){
    	$today = date("Y-m-d");
        $query = $this->db->select('*')         
            ->where('package_conjection.pkcon_lt_id', $lc)
            ->where('package_conjection.pkconl_ftv_id', $ftv)
            ->where('package_conjection.pkcon_actualstock >', 0)
            ->where('package_conjection.pkcon_start_date >=', date("Y-m-d", strtotime($today)))
            ->or_where('package_conjection.pkcon_end_date >', date("Y-m-d", strtotime($today)))
            ->where('pkcon_deleted', 0)
            ->where('pkcon_status', 1)
            ->get('package_conjection');
        return $query;
    }
    /*
    * getdetailpackages is public method
    * @param $pkID as int
    * RETURN as Object
    */

    public function getdetailpackages($pkID){
        $query = $this->db->select('*')
            ->join('location', 'location.lt_id = package_conjection.pkcon_lt_id')
            ->join('festival', 'festival.ftv_id = package_conjection.pkconl_ftv_id')            
            ->join('photo', 'photo.photo_id = package_conjection.phoid') 
            ->where('pkcon_deleted', 0)
            ->where('pkcon_status', 1)
            ->where('pkcon_id', $pkID)
            ->get('package_conjection');
        return $query;
    }


    public function getExtraService(){
        $today = date("Y-m-d");
        $query = $this->db->select('*')               
            ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
            ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")                
            ->join('photo', 'photo.photo_id = extraproduct.photo_id') 
            ->where('calendar_available.start_date >=', date("Y-m-d", strtotime($today)))
            ->or_where('calendar_available.end_date >', date("Y-m-d", strtotime($today)))
            ->where('ep_deleted', 0)
            ->where('ep_actualstock >', 0)
            ->where('ep_status', 1)
            ->get('extraproduct');
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

    public function insertDataBooking($insertBooking){
        $this->db->insert('booking', $insertBooking);
        return $this->db->insert_id('booking');
    }

    public function insertDataPassenger($insertPassenger){
        $this->db->insert('passenger', $insertPassenger);
        return $this->db->insert_id('passenger');
    }

    public function insertPassengerBooking($passId, $bookingId){
        $passbk = array(
           'pbk_pass_id' => $passId, 
           'pbk_bk_id' => $bookingId, 
        );
        $this->db->insert('passenger_booking', $passbk);
        return $this->db->insert_id('passenger_booking');
    }

}

/* End of file mod_fepackage.php */
/* Location: ./application/models/mod_fepackage.php */