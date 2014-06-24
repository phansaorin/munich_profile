<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mod_menu extends MU_Model{
    /*
    * getAllMenu is public method
    * @param $perPage as int
    * @param $offSet as int
    * RETURN as Object
    */
    public function getAllMenu($perPage, $offSet, $sortby, $sort){
        $sortby = "menu_".strtolower($sortby);
        $query = $this->db->select('*')
                 ->where('menu_delete', 0)
                 ->limit($perPage, $offSet)
                 ->order_by($sortby, $sort)
                 ->order_by('menu_id','DESC ')
                 ->get('menu');
        return $query;
    }

    /*
    * getSearchMenu is public method
    * @param $perPage as int
    * @param $offSet as int
    * @param $menu_title 
    * RETURN as Object
    */
    public function getSearchMenu($menu_title, $perPage, $offSet, $sortby, $sort){
        $sortby = "menu_".strtolower($sortby);
        $query = $this->db->select('*')
                 ->where('menu_delete', 0)
                 ->limit($perPage, $offSet)
                 ->like("menu_title", $menu_title)
                 ->order_by($sortby, $sort)
                 ->get('menu');
        return $query;
    }  

    /*
    * getAllParentMenu()
    * no @param
    * RETURN as object
    */
    public function getAllParentMenu(){
        $query = $this->db->select('*')
                 ->where('menu_status', 1)
                 ->where('menu_delete', 0)
                 ->get('menu');
        return $query;
    }
    
     public function getAllPositionMenu(){
         $query = $this->db->select('*')
                 ->where('menu_status', 1)
                 ->where('menu_delete', 0)
                 ->get('menu');
        return $query;
    }

    /*
    * public function insertmenu
    * @param $insert (array)
    * return last insert id
    */
    public function insertMenu($insert){
        $this->db->insert("menu",$insert);
        return $this->db->insert_id('menu');
    }

    /*
    * public function getMenuById
    * @param $menu_id (int)
    * return as object
    */
    public function getMenuById($menu_id){
        $this->db->select("*")->where('menu_delete', 0);
        $this->db->where("menu_id", $menu_id);
        return $this->db->get('menu');
    }
    /*
    * public function insertmenu
    * @param $update (array)
    * @param $menu_id (int)
    * return affected rows
    */
    public function updateMenu($update, $menu_id){
        $this->db->where("menu_id", $menu_id);
        $this->db->update('menu', $update);
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function deleteMultiple
    * @param $whereId (array) 
    * $param $update (array)
    * It has to update the column menu_delete from 0 to 1
    * return affected rows
    */
    public function deleteMultiple($update, $whereId){
        $this->db->where_in('menu_id', $whereId);
        $this->db->update('menu', $update);
        return $this->db->affected_rows() > 0;
    }

    /*
    * public function deleteMultiplePermanent
    * @param $whereId (array) 
    * It will delete the menu as permanent
    * return affected rows
    */
    public function deleteMultiplePermanent($whereId){
        $this->db->where_in('menu_id', $whereId);
        $this->db->delete('menu');
        return $this->db->affected_rows() > 0;
    }
}

/* End of file mod_admin.php */
/* Location: ./application/models/mod_admin.php */