<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MU_Model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

    public function count_all_data($table, $where = false, $like = false) {
        if($where != false) $this->db->where($where);
        if($like != false) $this->db->like($like);
        return $this->db->count_all_results($table);
    }
    /*
    *  public function insertToTempTable
    *  @param $insertTemp (array)
    *  return insert ID
    */
    public function insertToTempTable($insertTemp){
       $this->db->insert('temp_table',$insertTemp);
       return $this->db->insert_id('temp_table');
    }
	/*
    *  public function deleted_sub
    *  @param $act_id (int)
    *  return boolean
    */
    public function deleted_sub($act_id){
       $this->db->where('tmpt_id', $act_id);
       return $this->db->delete('temp_table');
    }
    
    /*
    *  public function getForiegnTableName
    *  @param $table (string)
    *  @param $where (array) (false)
    *  @param $return (String)
    *  return value (string)
    */
    public function getForiegnTableName($table, $where = false, $return){
        $this->db->select("*");
        if($where != false) $this->db->where($where);
        $query = $this->db->get($table);
        foreach($query->result() as $value){
            return $value->$return;
        }
    }
	
    /*
    * public function count_all_activities
    * @param $activities_name
    * @param $from_date
    * @param $end_date
    * Return Amount of record
    */ 
    public function count_all_activities($from_date, $end_date, $activities_name){
        $this->db->join('location', 'location.lt_id = activities.location_id', 'left')
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
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)))
                     ->like("activities.act_name", $activities_name);
        } else {
            if ($from_date != "") {
                $this->db->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
            }
            if ($end_date != "") {
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
            }
            if ($activities_name != "") {
                $this->db->like("activities.act_name", $activities_name);
            }
        }
        $this->db->where("act_subof",0);
        $this->db->where("activities.act_deleted", 0);
        return $this->db->count_all_results("activities");
    }

    /*
    * public function count_all_transportation
    * @param $transportation_name
    * @param $from_date
    * @param $end_date
    * Return Amount of record
    */ 
    public function count_all_transportation($from_date, $end_date, $transportation_name){
        $this->db->join('festival', 'festival.ftv_id = transportation.tp_ftv_id', 'left')
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
        $this->db->where("tp_subof",0);
        $this->db->where("transportation.tp_deleted", 0);
        return $this->db->count_all_results("transportation");
    }

    /*
    * public function count_all_accommodation
    * @param $accommodation_name
    * @param $from_date
    * @param $end_date
    * Return Amount of record
    */ 
    public function count_all_accommodation($from_date, $end_date, $accommodation_name){
        $this->db->join('location', 'location.lt_id = accommodation.location_id', 'left')
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
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)))
                     ->like("accommodation.acc_name", $accommodation_name);
        } else {
            if ($from_date != "") {
                $this->db->where("calendar_available.start_date >=", date("Y-m-d", strtotime($from_date)));
            }
            if ($end_date != "") {
                $this->db->where("calendar_available.end_date <=", date("Y-m-d", strtotime($end_date)));
            }
            if ($accommodation_name != "") {
                $this->db->like("accommodation.acc_name", $accommodation_name);
            }
        }
        $this->db->where("acc_subof",0);
        $this->db->where("accommodation.acc_deleted", 0);
        return $this->db->count_all_results("accommodation");
    }

	//For print as PDF and excel    
    public function exportAllDatas($table){
        $query = $this->db->select('*')
               			  ->where('ep_deleted', 0)	
               			  ->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $record) {
                $data[] = $record;
            }
            return $data;
        }
        return FALSE;
    }

    
    //Get status
    public function update_status($id, $cur_status, $condition, $where_insert, $table) {
        $data = '';
        if ($cur_status == 1) {
            $data = array($condition => '0');
        } else {
            $data = array($condition => '1');
        }
        $this->db->where($where_insert, $id);
        return $this->db->update($table, $data);
    } 

    /*
    * public function getRecordById
    * @param $table (string)
    * @param $where (array) default false
    * RETURN OBJECT
    */

    public function getRecordById($table, $where = false){
        $this->db->select("*");
        if($where != false) $this->db->where($where);
        return $this->db->get($table);
    }

    /*
    * public function deleteRecordById
    * @param $table (string)
    * @param $update (array)
    * @param $where (array) default false
    * RETURN affected rows
    */

    public function deleteRecordById($table, $update, $where = false){
        if($where != false) $this->db->where($where);
        $this->db->update($table, $update);
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function updateStatusById
    * @param $table (string)
    * @param $update (array)
    * @param $where (array) default false
    * RETURN affected rows
    */

    public function updateStatusById($table, $update, $where = false){
        if($where != false) $this->db->where($where);
        $this->db->update($table, $update);
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function getConjunctionRecordById
    * @param $table (string)
    * $param $column_fetch (int) ID
    * @param $where (array) default false
    * RETURN ARRAY
    */

    public function getConjunctionRecordById($table, $column_fetch, $where = false){
        $this->db->select("*");
        if($where != false) $this->db->where($where);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            foreach ($query->result() as $key => $value) {
                $array[] = $value->$column_fetch;
            }
        }else{
            $array = "";
        }
        return $array;
    }

    /*
    * public function deletedRecordById
    * @param $table (string)
    * @param $where (array) default false
    * RETURN affected rows
    */
    public function deletedRecordById($table, $where = false){
        if($where != false) $this->db->where($where);
        return $this->db->delete($table);
    //    return $this->db->affected_rows() > 0;
    }

    /*
    * public function getAdminEmail
    * @noparam
    * RETURN admin email
    */
    public function getAdminEmail(){
        $email = "";
        $query = $this->db->select("*")
                ->where('user_status', 1)
                ->where('user_deleted', 0)
                ->where('role_id', 1)
                ->get('user');
        if($query->num_rows() > 0){
            foreach($query->result() as $val){
               $email = $val->user_mail; 
            }
        }
        return $email;
    }

    /*
    * public checkExistEmail
    * check Existing Email.
    * Return true or false
    * @param $table 
    * @param $where default false
    * @param $column default "*"
    */
    public function checkExistEmail($table, $column = "*",$where = false){
        $this->db->select($column);
        if($where != false) $this->db->where($where);
        $result = $this->db->get($table);
        if($result->num_rows > 0){
            return "exist";
        }else{
            return "unexist";
        }

    }
}

/* End of file MU_Model.php */
/* Location: ./application/core/MU_Model.php */