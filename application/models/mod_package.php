<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mod_package extends MU_Model{
    /*
    * getAllpackage is public method
    * @param $perPage as int
    * @param $offSet as int
    * RETURN as Object
    */
    public function getAllPackage($perPage, $offSet, $sortby, $sort){
        $sortby = "pkcon_".strtolower($sortby);
        $query = $this->db->select('*')
            ->join('location', 'location.lt_id = package_conjection.pkcon_lt_id')
            ->join('festival', 'festival.ftv_id = package_conjection.pkconl_ftv_id')
            ->limit($perPage, $offSet)
            ->order_by($sortby, $sort)
            ->where('pkcon_deleted', 0)
            ->get('package_conjection');
        return $query;
    }

    /*
    * getAllSearchPackage is public method
    * @param $perPage as int
    * @param $offSet as int
    * RETURN as Object
    */
    public function getAllSearchPackage($pk_name ,$perPage, $offSet, $sortby, $sort){
        $sortby = "pkcon_".strtolower($sortby);
        $query = $this->db->select('*')
            ->join('location', 'location.lt_id = package_conjection.pkcon_lt_id')
            ->join('festival', 'festival.ftv_id = package_conjection.pkconl_ftv_id')
            ->like("pkcon_name", $pk_name)
            ->limit($perPage, $offSet)
            ->order_by($sortby, $sort)
            ->where('pkcon_deleted', 0)
            ->get('package_conjection');
        return $query;
    }
    
    /*
    * getPackageById is public method
    * @param $pk_id (int)
    * RETURN as Object
    */
    public function getPackageById($pk_id){
        $queryById = $this->db->select('*')
            ->join('location', 'location.lt_id = package_conjection.pkcon_lt_id')
            ->join('festival', 'festival.ftv_id = package_conjection.pkconl_ftv_id')
            ->join('photo', 'photo.photo_id = package_conjection.phoid')
            ->where('pkcon_deleted', 0)
            ->where('pkcon_id', $pk_id)
            ->get('package_conjection');
        return $queryById;
    }

    /*
    * public function getPackageActivities
    * @noparam
    * @table activities, acti_calendar calendar_available
    * return object DB
    */
    public function getPackageActivities(){
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
    * public function getPackageAccommodation()
    * @noparam
    * @table accommodation, acc_calendar calendar_available
    * return object DB
    */
    public function getPackageAccommodation(){
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
    * public function getPackageTransportation
    * @noparam
    * @table transportation, acc_calendar calendar_available
    * return object DB
    */
    public function getPackageTransportation(){
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
    * public function getSubActPk
    * @param $actID
    * @table transportation, acc_calendar calendar_available
    * return object DB
    */
    public function getSubActPk($actID){
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
    * public function getSubAccPk
    * @param $accID
    * @table accommodation, acc_calendar and calendar_available
    * return object DB
    */
    public function getSubAccPk($accID){
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
    * public function getSubTpsPk
    * @param $tpsID
    * @table accommodation, acc_calendar and calendar_available
    * return object DB
    */
    public function getSubTpsPk($tpsID){
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
    * public function getSubEpPk
    * @param $actID
    * @table extra_acti, extraproduct, extraproduct_calendar
    * return object DB
    */
    public function getSubEpPk($actID){
        $query_ep = $this->db->select("*")
                ->join("extraproduct","extraproduct.ep_id = extra_acti.extraproduct_id","left")
                ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
                ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")                
                ->where("activities_id", $actID)
                ->get("extra_acti");
        return $query_ep;
    }

    /*
    * public function getSubEpAccPk
    * @param $accID
    * @table extra_acc, extraproduct, extraproduct_calendar
    * return object DB
    */
    public function getSubEpAccPk($accID){
        $query_ep = $this->db->select("*")
                ->join("extraproduct","extraproduct.ep_id = extra_acc.extraproduct_ep_id","left")
                ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
                ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")                
                ->where("accomodations_ad_id", $accID)
                ->get("extra_acc");
        return $query_ep;
    }

    /*
    * public function getSubEpTpsPk
    * @param $tpsID
    * @table extra_transport, extraproduct, extraproduct_calendar
    * return object DB
    */
    public function getSubEpTpsPk($tpsID){
        $query_ep = $this->db->select("*")
                ->join("extraproduct","extraproduct.ep_id = extra_transport.extraproduct_id","left")
                ->join("extraproduct_calendar","extraproduct_calendar.extraproduct_id = extraproduct.ep_id","left")
                ->join("calendar_available","extraproduct_calendar.calendar_available_id = calendar_available.ca_id","left")                
                ->where("transport_id", $tpsID)
                ->get("extra_transport");
        return $query_ep;
    }

    /*
    * public function createPackage
    * @param $insert (array)
    * @table package_conjection
    * add records
    * return last insert id
    */
    public function createPackage($insert){
        $this->db->insert('package_conjection',$insert);
        return $this->db->insert_id('package_conjection');
    }
    /*
    * public function updatePackage
    * @param $update (array)
    * @param $pk_id (int)
    * @table package_conjection
    * add records
    * return 
    */
    public function updatePackage($update, $pk_id){
        $this->db->where('pkcon_id', $pk_id);
        if($this->db->update('package_conjection',$update)){ return true; }else{ return false; }
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

    //delete multiple packages
    public function deleteMultiple($update, $whereID){
        $this->db->where_in('pkcon_id',$whereID);
        $this->db->update('package_conjection',$update);
        return $this->db->affected_rows() >0;
    }
    
    public function deletePermenent($whereID){
        $this->db->where_in('pkcon_id', $whereID);
        $this->db->delete('package_conjection');
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function getActivitiesFromPk
    * @param $act_id (int)
    * @table acti_calendar, activities, calendar_available, location, supplier, festival
    * return object record
    */
    public function getActivitiesFromPk($act_id){
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
    * public function getAccommodationsFromPk
    * @param $accID (int)
    * @table accommodation,room_types, classification, location, festival, acc_calendar, calendar_available, photo
    * return object record
    */
    public function getAccommodationsFromPk($accID){
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
    * public function getTranpsportsFromPk
    * @param $tpsID (int)
    * @table location, supplier, festival, tp_calendar, calendar_available, photo, transportation
    * return object record
    */
    public function getTranpsportsFromPk($tpsID){
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
    * public function getSubActivitiesFromPk
    * @param $act_id (array)
    * @table acti_calendar, activities, calendar_available
    * @where_in
    * return object record
    */
    public function getSubActivitiesFromPk($act_id){
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
    * public function getSubTranpsportsFromPk
    * @param $tpsID (int)
    * @table location, supplier, festival, tp_calendar, calendar_available, photo, transportation
    * return object record
    */
    public function getSubTranpsportsFromPk($tpsID){
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
    * public function getSubaccommodationsFromPk
    * @param $subAcc (array)
    * @table accommodation,room_types, classification, location, festival, acc_calendar, calendar_available, photo
    * @where_in
    * return object record
    */
    public function getSubaccommodationsFromPk($subAcc){
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
    * public function getExtraproductFromPk
    * @param $ep_id (array)
    * @table , calendar_available
    * @where_in
    * return object record
    */
    public function getExtraproductFromPk($ep_id){
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
    * public function updateActivitiesPackage
    * @param $activites (array serialzie)
    * @param $pk_id (int)
    * @table package conjection 
    * @colum pk_activities
    * return affected row.
    */
    public function updateActivitiesPackage($activities, $pk_id){
        $update['pk_activities'] = $activities;
        $this->db->where('pkcon_id', $pk_id);
        return $this->db->update('package_conjection',$update);
    }
    /*
    * public function updateAccommodationsPackage
    * @param $accommodations (array serialzie)
    * @param $pkID (int)
    * @table package conjection 
    * @colum pk_accomodation
    * return affected row.
    */
    public function updateAccommodationsPackage($accommodations, $pkID){
        $update['pk_accomodation'] = $accommodations;
        $this->db->where('pkcon_id', $pkID);
        return $this->db->update('package_conjection',$update);
    }
    /*
    * public function updateTransportationPackage
    * @param $transportation (array serialzie)
    * @param $pkID (int)
    * @table package_conjection 
    * @colum pk_transportation
    * return affected row.
    */
    public function updateTransportationPackage($transportation, $pkID){
        $update['pk_transportation'] = $transportation;
        $this->db->where('pkcon_id', $pkID);
        return $this->db->update('package_conjection', $update);
    }
    
    /*
    * public function getActivitiesPackage
    * @param $pk_id (int)
    * @table package_conjection 
    * @colum pk_activities
    * return object.
    */
    public function getActivitiesPackage($pk_id){
        $querypkact = $this->db->select('pk_activities')
            ->where('pkcon_id', $pk_id)
            ->get('package_conjection');
        return $querypkact;
    }
    /*
    * public function getAccommodationPackage
    * @param $pk_id (int)
    * @table package_conjection 
    * @colum pk_accomodation
    * return object.
    */
    public function getAccommodationPackage($pk_id){
        $querypkacc = $this->db->select('pk_accomodation')
            ->where('pkcon_id', $pk_id)
            ->get('package_conjection');
        return $querypkacc;
    }
    /*
    * public function getTransportPackage
    * @param $pk_id (int)
    * @table package_conjection 
    * @colum pk_transportation
    * return object.
    */
    public function getTransportPackage($pk_id){
        $querypkacc = $this->db->select('pk_transportation')
            ->where('pkcon_id', $pk_id)
            ->get('package_conjection');
        return $querypkacc;
    }
}

/* End of file mod_package.php */
/* Location: ./application/models/mod_package.php */