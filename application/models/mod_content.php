<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mod_content extends MU_Model{
    /*
    * getAllMenu is public method
    * @param $perPage as int
    * @param $offSet as int
    * RETURN as Object
    */
    public function getAllContent($perPage, $offSet, $sortby, $sort){
        $sortby = "con_".strtolower($sortby);
        $query = $this->db->select('*')
                 ->where('con_delete', 0)
                 ->limit($perPage, $offSet)
                 ->order_by($sortby, $sort)
                 ->get('content');
        return $query;
    }
public function getUpdateExtraProduct($act_id){
        $query = $this->db->select("*")
                 ->join('acti_calendar','activities.act_id = acti_calendar.activities_id', 'left')
                 ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id','left')
                 ->where("activities.act_deleted", 0)
                 ->where("activities.act_id", $act_id)
                 ->get("activities");
        return $query;
    }
    /*
    * getSearchContent is public method
    * @param $perPage as int
    * @param $offSet as int
    * @param $content_title 
    * RETURN as Object
    */
    public function getSearchContent($content_title, $perPage, $offSet, $sortby, $sort){
        $sortby = "con_".strtolower($sortby);
        $query = $this->db->select('*')
                 ->where('con_delete', 0)
                 ->limit($perPage, $offSet)
                 ->like("con_title", $content_title)
                 ->order_by($sortby, $sort)
                 ->get('content');
        return $query;
    }  

    /*
    * public function insertContent
    * @param $insert (array)
    * return last insert id
    */
    public function insertContent($insert){
        $this->db->insert("content",$insert);
        return $this->db->insert_id('content');
    }

    /*
    * public function insertIntoContentPhoto
    * @param $insertContentPhoto (array)
    * return last insert id
    */
    public function insertIntoContentPhoto($insertContentPhoto){
        $this->db->insert("content_photo",$insertContentPhoto);
        return $this->db->insert_id('content_photo');
    }

    /*
    * public function getContentById
    * @param $con_id (int)
    * return as object
    */
    public function getContentById($con_id){
        $this->db->select("*")->where('con_delete', 0);
        $this->db->where("con_id", $con_id);
        return $this->db->get('content');
    }
    /*
    * public function updateContent
    * @param $update (array)
    * @param $con_id (int)
    * return affected rows
    */
    public function updateContent($update, $con_id){
        $this->db->where("con_id", $con_id);
        $this->db->update('content', $update);
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function deleteMultiple
    * @param $whereId (array) 
    * $param $update (array)
    * It has to update the column con_delete from 0 to 1
    * return affected rows
    */
    public function deleteMultiple($update, $whereId){
        $this->db->where_in('con_id', $whereId);
        $this->db->update('content', $update);
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function deleteMultiplePermanent
    * @param $whereId (array) 
    * It will delete the content as permanent
    * return affected rows
    */
    public function deleteMultiplePermanent($whereId){
        $this->db->where_in('con_id', $whereId);
        $this->db->delete('content');
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function getAllPhotos
    * @noparam 
    * return object
    */
    public function getAllPhotos(){
        $query = $this->db->select("*")
                 ->where("pho_status", 1)
                 ->where("pho_delete", 0)
                 ->get('photo');
        return $query;
    }

    /*
    * public function getContentView
    * @param $con_id (int)
    * table related menu, photo, photo type
    * return as object
    */
    public function getContentView($con_id){
        $query = $this->db->select("*")
                          ->join("menu", "menu.menu_id = content.con_menu_id")
                          ->join("content_photo", "content.con_id = content_photo.con_id", "left")
                          ->join("photo", "photo.photo_id = content_photo.photo_id", "left")
                          ->where("content.con_id", $con_id)
                          ->get("content");
        return $query;
    }
}

/* End of file mod_admin.php */
/* Location: ./application/models/mod_admin.php */