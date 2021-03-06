<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_FeCustomize extends MU_model {
 	
    // select join with table photo, location, festival, by session and where lcID and ftvID
 	public function trip_information($ftvID, $lcId){    
 		$query = $this->db->select('*')
		 ->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
		 ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id')
		 ->join('photo','photo.photo_id = activities.photo_id')			
         ->where("activities.act_deleted", 0)
         ->where('activities.act_ftv_id', $ftvID)
         ->where('activities.location_id', $lcId)
         ->where('activities.act_subof',0)
         ->get('activities');
    	return $query;
 	}
    /*
    * public function select sub activity
    * @param parameter $ftvID, $lcId, $subAct
    */
    public function selectSubActivity($ftvID, $lcId, $subAct){
        $sub_activity = $this->db->select('*')
             ->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
             ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id') 
             ->join('photo','photo.photo_id = activities.photo_id')      
             ->where("activities.act_deleted", 0)
             ->where('activities.act_ftv_id', $ftvID)
             ->where('activities.location_id', $lcId)
             ->where('activities.act_subof', $subAct)
             ->get('activities');
            return $sub_activity;
    }

    /*
    * public function select accommodation
    * @param parameter $ftvID, $lcId
    */
    public function accommodation($ftvID, $lcId){
        $accommodation = $this->db->select('*')
            ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
            ->join('calendar_available', 'calendar_available.ca_id = acc_calendar.calendar_available_id')
            ->join('photo','photo.photo_id = accommodation.photo_id')
            ->where('accommodation.acc_deleted',0)
            ->where('accommodation.acc_ftv_id', $ftvID)
            ->where('accommodation.location_id', $lcId)
            ->get('accommodation');
            return $accommodation;
    }
    /*
    * public function select transportation
    * @param parameter $ftvID, $lcId, $subAct
    */
    public function transportation($ftvID, $lcId){
        $transportation = $this->db->select('*')
            ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id')
            ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id')
            ->join('photo','photo.photo_id = transportation.photo_id')
            ->join('supplier','supplier.sup_id = transportation.tp_supplier_id')
            ->where('transportation.tp_deleted',0)
            ->where('transportation.tp_ftv_id', $ftvID)
            //->where('transportation.location_id', $lcId)
            ->where('transportation.tp_subof',0)
            ->get('transportation');
            return $transportation;
    }
    /*
    * public function select sub transportation
    * @param parameter $ftvID, $lcId, $subAct
    */
    public function selectSubTransportation($ftvID, $lcId, $subAct){
            $subtransportation = $this->db->select('*')
            ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id')
            ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id')
            ->join('photo','photo.photo_id = transportation.photo_id')
            ->join('supplier','supplier.sup_id = transportation.tp_supplier_id')
            ->where('transportation.tp_deleted',0)
            ->where('transportation.tp_ftv_id', $ftvID)
            //->where('transportation.location_id', $lcId)
            ->where('transportation.tp_subof', $subAct)
            ->get('transportation');
            return $subtransportation;
    }
    /*
    * public function select extra products
    * @param parameter  
    */
    public function select_extraProducts(){
        $extra_product = $this->db->select('*')
            ->join('extra_acti','extraproduct.ep_id = activities.act_id')
            ->join('extra_acc','')
            ->where('extraproduct.ep_deleted',0)
            ->get('extraproduct');
            return $extra_product;
    }
    /*
    * public function add information of passenger to table passenger
    * @param parameter $pfname, $plname, $pgender, $pdob, $pmobile, $phphone, $paddress, $pcode, $pcity, $pcountry, $pnumber
    */
    public function personal_information($pnumber, $pfname, $plname, $pemail, $phphone, $paddress, $pcompany, $pgender){
        $passenger = array(
            'pass_addby' => $pnumber,
            'pass_fname' => $pfname,
            'pass_lname' => $plname,
            'pass_email' => $pemail,
            'pass_phone' => $phphone,
            'pass_address' => $paddress,
            'pass_company' => $pcompany,
            'pass_gender' => $pgender,
            'pass_status' => 1,
            'pass_deleted' => 0,
        );
        $this->db->insert('passenger', $passenger);
    }

    /*Start Chhingchhing*/

    /*
    * View detail of each booking information of booking id and passenger id
    */
    public function bookingInfoByPassengerIDAndBookingID($bk_id, $passegnger_id)
    {
        $select = $this->db->select('*')
                 ->join('passenger_booking','booking.bk_id  =  passenger_booking.pbk_bk_id', 'left')
                 ->join('passenger','passenger.pass_id  =  passenger_booking.pbk_pass_id ', 'left')
                 ->join('sale_customize','sale_customize.salecus_bk_id = booking.bk_id', 'left')                          
                 ->join('sale_packages','sale_packages.salepk_bk_id = booking.bk_id', 'left')
                 ->join('customize_conjection','customize_conjection.cuscon_id = sale_customize.salecus_cuscon_id', 'left')
                 ->join('package_conjection','package_conjection.pkcon_id = sale_packages.salepk_pkcon_id', 'left')
                 ->where('passenger.pass_deleted', 0)
                 ->where('passenger_booking.pbk_pass_id',$passegnger_id)
                 ->where('passenger_booking.pbk_bk_id',$bk_id)
                 ->get('booking');
        return $select;
    }
    
    /*
    * Get passenger information when passenger has been loged in
    */
    public function customizePersonal_info($passenger_id) {
        $query = $this->db
            ->where("pass_id", $passenger_id)
            ->get("passenger");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            //Get empty base parent object, as $item_id is NOT an item
            $pass_obj=new stdClass();

            //Get all the fields from items table
            $fields = $this->db->list_fields('passenger');

            foreach ($fields as $field)
            {
                $pass_obj->$field='';
            }

            return $pass_obj;
        }
    }

    // Get information of item
    function get_info_of_main_obj($table, $col, $id, $field_select) {
        $query = $this->db
            ->select($field_select)
            ->where($col, $id)
            ->get($table);
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            //Get empty base parent object, as $item_id is NOT an item
            $object = new stdClass();

            //Get all the fields from items table
            $fields = $this->db->list_fields($table);

            foreach ($fields as $field)
            {
                $object->$field='';
            }
            return $object;
        }
    }
    /*End Chhingchhing*/

}