<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mod_customize extends MU_Model{
    /*
    * getAllcustomize is public method
    * @param $perPage as int
    * @param $offSet as int
    * RETURN as Object
    */
    public function getAllCustomize($perPage, $offSet, $sortby, $sort){
        $sortby = "cuscon_".strtolower($sortby);
        $query = $this->db->select('*')
            ->join('location', 'location.lt_id = customize_conjection.cuscon_lt_id')
            ->join('festival', 'festival.ftv_id = customize_conjection.cuscon_ftv_id')
            ->limit($perPage, $offSet)
            ->order_by($sortby, $sort)
            ->where('cuscon_deleted', 0)
            ->get('customize_conjection');
        return $query;
    }

    /*
    * getAllSearchCustomize is public method
    * @param $perPage as int
    * @param $offSet as int
    * RETURN as Object
    */
    public function getAllSearchCustomize($cus_name ,$perPage, $offSet, $sortby, $sort){
        $sortby = "cuscon_".strtolower($sortby);
        $query = $this->db->select('*')
            ->join('location', 'location.lt_id = customize_conjection.cuscon_lt_id')
            ->join('festival', 'festival.ftv_id = customize_conjection.cuscon_ftv_id')
            ->like("cuscon_name", $cus_name)
            ->limit($perPage, $offSet)
            ->order_by($sortby, $sort)
            ->where('cuscon_deleted', 0)
            ->get('customize_conjection');
        return $query;
    }
    
    /*
    * getCustomizeById is public method
    * @param $cus_id (int)
    * RETURN as Object
    */
    public function getCustomizeById($cus_id){
        $queryById = $this->db->select('*')
            ->join('location', 'location.lt_id = customize_conjection.cuscon_lt_id')
            ->join('festival', 'festival.ftv_id = customize_conjection.cuscon_ftv_id')
            ->join('photo', 'photo.photo_id = customize_conjection.cuscon_pho_id')
            ->where('cuscon_deleted', 0)
            ->where('cuscon_id', $cus_id)
            ->get('customize_conjection');
        return $queryById;
    }

    /*
    * public function getCustomizeActivities
    * @noparam
    * @table activities, acti_calendar calendar_available
    * return object DB
    */
    public function getCustomizeActivities(){
        $query_activities = $this->db->select('*')
                ->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
                ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id')
                ->where("activities.act_deleted", 0)
                ->where("activities.act_status", 1)                
                ->where("activities.act_subof", 0)
                ->get('activities');
        return $query_activities;
    }

    /*
    * public function getCustomizeAccommodation()
    * @noparam
    * @table accommodation, acc_calendar calendar_available
    * return object DB
    */
    public function getCustomizeAccommodation(){
        $query_accommodaations = $this->db->select('*')
                ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
                ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id')
                ->where("accommodation.acc_deleted", 0)
                ->where("accommodation.acc_status", 1)                
                ->where("accommodation.acc_subof", 0)
                ->get('accommodation');
        return $query_accommodaations;
    }

    /*
    * public function getCustomizeTransportation
    * @noparam
    * @table transportation, acc_calendar calendar_available
    * return object DB
    */
    public function getCustomizeTransportation(){
        $query_trasport = $this->db->select('*')
                ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id')
                ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id')
                ->where("transportation.tp_deleted", 0)
                ->where("transportation.tp_status", 1)                
                ->where("transportation.tp_subof", 0)
                ->get('transportation');
        return $query_trasport;
    }

    /*
    * public function getSubActCuscon
    * @param $actID
    * @table transportation, acc_calendar calendar_available
    * return object DB
    */
    public function getSubActCuscon($actID){
        $query_sub_activities = $this->db->select('*')
                ->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
                ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id')
                ->where("activities.act_deleted", 0)
                ->where("activities.act_status", 1)
                ->where("activities.act_subof", $actID)
                ->get('activities');
        return $query_sub_activities;
    }

    /*
    * public function getSubAccCuscon
    * @param $accID
    * @table accommodation, acc_calendar and calendar_available
    * return object DB
    */
    public function getSubAccCuscon($accID){
        $query_sub_accommodation = $this->db->select('*')
                ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
                ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id')
                ->where("accommodation.acc_deleted", 0)
                ->where("accommodation.acc_status", 1)
                ->where("accommodation.acc_subof", $accID)
                ->get('accommodation');
        return $query_sub_accommodation;
    }

    /*
    * public function getSubTpsCuscon
    * @param $tpsID
    * @table accommodation, acc_calendar and calendar_available
    * return object DB
    */
    public function getSubTpsCuscon($tpsID){
        $query_sub_trasportation = $this->db->select('*')
                ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id')
                ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id')
                ->where("transportation.tp_deleted", 0)
                ->where("transportation.tp_status", 1) 
                ->where("transportation.tp_subof", $tpsID)
                ->get('transportation');
        return $query_sub_trasportation;
    }

    /*
    * public function getSubEpCuscon
    * @param $actID
    * @table extra_acti, extraproduct, extraproduct_calendar
    * return object DB
    */
    public function getSubEpCuscon($actID){
        $query_ep = $this->db->select("*")
                ->join("extraproduct","extraproduct.ep_id = extra_acti.extraproduct_id","left")
                ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
                ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")                
                ->where("activities_id", $actID)
                ->get("extra_acti");
        return $query_ep;
    }

    /*
    * public function getSubEpAccCuscon
    * @param $accID
    * @table extra_acc, extraproduct, extraproduct_calendar
    * return object DB
    */
    public function getSubEpAccCuscon($accID){
        $query_ep = $this->db->select("*")
                ->join("extraproduct","extraproduct.ep_id = extra_acc.extraproduct_ep_id","left")
                ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
                ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")                
                ->where("accomodations_ad_id", $accID)
                ->get("extra_acc");
        return $query_ep;
    }

    /*
    * public function getSubEpTpsCuscon
    * @param $tpsID
    * @table extra_transport, extraproduct, extraproduct_calendar
    * return object DB
    */
    public function getSubEpTpsCuscon($tpsID){
        $query_ep = $this->db->select("*")
                ->join("extraproduct","extraproduct.ep_id = extra_transport.extraproduct_id","left")
                ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
                ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")                
                ->where("transport_id", $tpsID)
                ->get("extra_transport");
        return $query_ep;
    }

    /*
    * public function createCustomize
    * @param $insert (array)
    * @table customize_conjection
    * add records
    * return last insert id
    */
    public function createCustomize($insert){
        $this->db->insert('customize_conjection',$insert);
        return $this->db->insert_id('customize_conjection');
    }
    /*
    * public function updateCustomize
    * @param $update (array)
    * @param $cuscon_id (int)
    * @table customize_conjection
    * add records
    * return 
    */
    public function updateCustomize($update, $cuscon_id){
        $this->db->where('cuscon_id', $cuscon_id);
        if($this->db->update('customize_conjection',$update)){ 
            return true; 
        }else{ 
            return false; 
        }
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
    * public function getPhoto
    * @noparam
    * @table photo
    * Return Object record
    */
    public function getPhoto(){
        $query = $this->db->select('*')
            ->where('pho_delete', 0)
            ->get('photo');
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

    //delete multiple customize
    public function deleteMultiple($update, $whereID){
        $this->db->where_in('cuscon_id',$whereID);
        $this->db->update('customize_conjection',$update);
        return $this->db->affected_rows() >0;
    }
    
    public function deletePermenent($whereID){
        $this->db->where_in('cuscon_id', $whereID);
        $this->db->delete('customize_conjection');
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function getActivitiesFromCuscon
    * @param $act_id (int)
    * @table acti_calendar, activities, calendar_available, location, supplier, festival
    * return object record
    */
    public function getActivitiesFromCuscon($act_id){
        $query = $this->db->select("*")                
                ->join('location', 'location.lt_id = activities.location_id', 'left')
                ->join('supplier', 'supplier.sup_id = activities.act_supplier_id', 'left')
                ->join('festival', 'festival.ftv_id = activities.act_ftv_id', 'left')
                ->join('acti_calendar','activities.act_id = acti_calendar.activities_id', 'left')
                ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id','left')
                ->join('photo','photo.photo_id = activities.photo_id')
                ->where("activities.act_deleted", 0)
                ->where("activities.act_id", $act_id)
                ->order_by("acti_calendar.actcca_id", "DESC")
                ->limit(1)
                ->get("activities");
        return $query;
    }
    /*
    * public function getAccommodationsFromCuscon
    * @param $accID (int)
    * @table accommodation,room_types, classification, location, festival, acc_calendar, calendar_available, photo
    * return object record
    */
    public function getAccommodationsFromCuscon($accID){
        $query = $this->db->select("*")                
                ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
                ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
                ->join('location', 'location.lt_id = accommodation.location_id', 'left')
                ->join('festival', 'festival.ftv_id = accommodation.acc_ftv_id', 'left')
                ->join('supplier', 'supplier.sup_id = accommodation.acc_supplier_id', 'left')
                // ->join('acc_fac','accommodation.acc_id = acc_fac.accomodations_id', 'left')
                // ->join('facilities','facilities.facilities_id = acc_fac.facilities_id','left')
                ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
                ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id')
                ->join('photo','photo.photo_id = accommodation.photo_id')
                ->where("accommodation.acc_deleted", 0)
                ->where('acc_subof', 0)
                ->where("accommodation.acc_id", $accID)
                ->order_by("acc_calendar.accca_id", "DESC")
                ->limit(1)
                ->get("accommodation");
        return $query;
    }
    /*
    * public function getTranpsportsFromCuscon
    * @param $tpsID (int)
    * @table location, supplier, festival, tp_calendar, calendar_available, photo, transportation
    * return object record
    */
    public function getTranpsportsFromCuscon($tpsID){
        $query = $this->db->select("*")
            ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
            ->join('supplier', 'supplier.sup_id = transportation.tp_supplier_id', 'left')
            ->join('festival', 'festival.ftv_id = transportation.tp_ftv_id', 'left')
            ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id', 'left')
            ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
            ->join('photo','photo.photo_id = transportation.photo_id')
            ->where("transportation.tp_deleted", 0)
            ->where("transportation.tp_id", $tpsID)
            ->order_by("tp_calendar.tp_cal_id", "DESC")
            ->limit(1)
            ->get("transportation");
        return $query;
    }
    /*
    * public function getSubActivitiesFromCuscon
    * @param $act_id (array)
    * @table acti_calendar, activities, calendar_available
    * @where_in
    * return object record
    */
    public function getSubActivitiesFromCuscon($act_id){
        $query = $this->db->select("*")                
                ->join('location', 'location.lt_id = activities.location_id', 'left')
                ->join('supplier', 'supplier.sup_id = activities.act_supplier_id', 'left')
                ->join('festival', 'festival.ftv_id = activities.act_ftv_id', 'left')
                ->join('acti_calendar','activities.act_id = acti_calendar.activities_id', 'left')
                ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id','left')
                ->join('photo','photo.photo_id = activities.photo_id')
                ->where("activities.act_deleted", 0)
                ->where_in("activities.act_id", $act_id)
                ->get("activities");
        return $query;
    }

    /*
    * public function getSubTranpsportsFromCuscon
    * @param $tpsID (int)
    * @table location, supplier, festival, tp_calendar, calendar_available, photo, transportation
    * return object record
    */
    public function getSubTranpsportsFromCuscon($tpsID){
        $query = $this->db->select("*")
            ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
            ->join('supplier', 'supplier.sup_id = transportation.tp_supplier_id', 'left')
            ->join('festival', 'festival.ftv_id = transportation.tp_ftv_id', 'left')
            ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id', 'left')
            ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
            ->join('photo','photo.photo_id = transportation.photo_id')
            ->where("transportation.tp_deleted", 0)
            ->where_in("transportation.tp_id", $tpsID)
            ->get("transportation");
        return $query;
    }
    /*
    * public function getSubaccommodationsFromCuscon
    * @param $subAcc (array)
    * @table accommodation,room_types, classification, location, festival, acc_calendar, calendar_available, photo
    * @where_in
    * return object record
    */
    public function getSubaccommodationsFromCuscon($subAcc){
        $query = $this->db->select("*")                
                ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
                ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
                ->join('location', 'location.lt_id = accommodation.location_id', 'left')
                ->join('festival', 'festival.ftv_id = accommodation.acc_ftv_id', 'left')
                ->join('supplier', 'supplier.sup_id = accommodation.acc_supplier_id', 'left')
                // ->join('acc_fac','accommodation.acc_id = acc_fac.accomodations_id', 'left')
                // ->join('facilities','facilities.facilities_id = acc_fac.facilities_id','left')
                ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
                ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id')
                ->join('photo','photo.photo_id = accommodation.photo_id')
                ->where("accommodation.acc_deleted", 0)
                ->where_in("accommodation.acc_id", $subAcc)
                ->get("accommodation");
        return $query;
    }

    /*
    * public function getExtraproductFromCuscon
    * @param $ep_id (array)
    * @table , calendar_available
    * @where_in
    * return object record
    */
    public function getExtraproductFromCuscon($ep_id){
        $query = $this->db->select("*")                 
                ->join('supplier', 'supplier.sup_id = extraproduct.supplier_id', 'left')               
                ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
                ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")
                ->join('photo','photo.photo_id = extraproduct.photo_id')
                ->where_in("extraproduct.ep_id",$ep_id)
                ->get('extraproduct');
        return $query;
    }

    /*
    * public function updateActivitiesCustomize
    * @param $activites (array serialzie)
    * @param $cuscon_id (int)
    * @table customize conjection 
    * @colum cuscon_activities
    * return affected row.
    */
    public function updateActivitiesCustomize($activities, $cuscon_id){
        $update['cuscon_activities'] = $activities;
        $this->db->where('cuscon_id', $cuscon_id);
        return $this->db->update('customize_conjection',$update);
    }
    /*
    * public function updateAccommodationsCustomize
    * @param $accommodations (array serialzie)
    * @param $cusconID (int)
    * @table customize conjection 
    * @colum cuscon_accomodation
    * return affected row.
    */
    public function updateAccommodationsCustomize($accommodations, $cusconID){
        $update['cuscon_accomodation'] = $accommodations;
        $this->db->where('cuscon_id', $cusconID);
        return $this->db->update('customize_conjection',$update);
    }
    /*
    * public function updateTransportationCustomize
    * @param $transportation (array serialzie)
    * @param $cusconID (int)
    * @table customize_conjection 
    * @colum cuscon_transportation
    * return affected row.
    */
    public function updateTransportationCustomize($transportation, $cusconID){
        $update['cuscon_transportation'] = $transportation;
        $this->db->where('cuscon_id', $cusconID);
        return $this->db->update('customize_conjection', $update);
    }
    
    /*
    * public function getActivitiesCustomize
    * @param $cuscon_id (int)
    * @table customize_conjection 
    * @colum cuscon_activities
    * return object.
    */
    public function getActivitiesCustomize($cuscon_id){
        $querycusconact = $this->db->select('cuscon_activities')
            ->where('cuscon_id', $cuscon_id)
            ->get('customize_conjection');
        return $querycusconact;
    }
    /*
    * public function getAccommodationCustomize
    * @param $cuscon_id (int)
    * @table customize_conjection 
    * @colum cuscon_accomodation
    * return object.
    */
    public function getAccommodationCustomize($cuscon_id){
        $querycusconacc = $this->db->select('cuscon_accomodation')
            ->where('cuscon_id', $cuscon_id)
            ->get('customize_conjection');
        return $querycusconacc;
    }
    /*
    * public function getTransportCustomize
    * @param $cuscon_id (int)
    * @table customize_conjection 
    * @colum cuscon_transportation
    * return object.
    */
    public function getTransportCustomize($cuscon_id){
        $querycusconacc = $this->db->select('cuscon_transportation')
            ->where('cuscon_id', $cuscon_id)
            ->get('customize_conjection');
        return $querycusconacc;
    }
}

/* End of file mod_customize.php */
/* Location: ./application/models/mod_customize.php */