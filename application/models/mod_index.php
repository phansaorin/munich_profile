<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mod_index extends MU_Model{
    
    /*
    * getAllMenu is public method
    * RETURN as Object
    */
    public function getAllMenu(){
        $query = $this->db->select('*')
                 ->where("menu_menu_id", NULL)
                 ->where('menu_delete', 0)
                 ->where('menu_status', 1)
                ->order_by("menu_id", "DESC")
                 ->get('menu');
        return $query;
    }

    /*
    * public function getContentById
    * @param $menu_id (int)
    * join with table menu, content_photo    
    * return object 
    */
    public function getContentById($menu_id){
        $query = $this->db->select("*")
                  ->where("con_delete", 0)
                  ->where("con_status", 1)
                  ->join('menu','menu.menu_id = content.con_menu_id')
                  ->join('content_photo','content.con_id = content_photo.con_id','left')
                  ->join('photo','photo.photo_id = content_photo.photo_id','left')
                  ->where("content.con_menu_id", $menu_id)
                  ->get("content");
        return $query;
    }
    /*
    * public function getContentTemplate
    * @param $menu_id (int)
    * get from table content   
    * return object of con_template
    */
    public function getContentTemplate($menu_id){
        $query = $this->db->select("con_template")
                  ->where("con_delete", 0)
                  ->where("con_status", 1)
                  ->where("content.con_menu_id", $menu_id)
                  ->get("content");
        return $query;
    }

    /*
    * public function getFeedback
    * get from table feedback   
    * return object of feedback publish
    */
    public function getFeedback(){
        $query = $this->db->select("*")
                  ->where("fb_deleted", 0)
                  ->where("fb_status", 1)
                  ->order_by("fb_id", "DESC")
                  ->get("feedback");
        return $query;
    }

    /*
    * public function getAdminProfile
    * @noparam
    * using table user and role admin
    * return Admin profile
    */

    public function getAdminProfile(){
      $query = $this->db->select("*")
                    ->where("role_id", 1)
                    ->where("user_deleted", 0)
                    ->where("user_status", 1)
                    ->limit(1)
                    ->get("user");
      return $query;
    }

    /*
    * public function getFeedbackById
    * @param $fb_id (int)
    * get from table feedback  by specific by id  
    * return object of feedback publish
    */
    public function getFeedbackById($fb_id){
        $query = $this->db->select("*")
                  ->where("fb_deleted", 0)
                  ->where("fb_status", 1)
                  ->where("fb_id", $fb_id)
                  ->get("feedback");
        return $query;
    }

    /*
    * public function insertFeedback
    * $param $insert (array)
    * return insert_id();
    */
    public function insertFeedback($insert){
      $this->db->insert("feedback",$insert);
      return $this->db->insert_id('feedback');
    }

    /*
    * public function insertSubscriber
    * $param $insert (array)
    * return insert_id();
    */
    public function insertSubscriber($insert){
      $this->db->insert("subscriber",$insert);
      return $this->db->insert_id('subscriber');
    }
    public function exportAllEtichet($bkID){
        $query = $this->db->select('*')
                ->join('passenger_booking', 'booking.bk_id = passenger_booking.pbk_bk_id','left')
                ->join('passenger','passenger.pass_id = passenger_booking.pbk_pass_id','left')
                ->join('sale_packages','booking.bk_id = sale_packages.salepk_bk_id','left')
                ->join('package_conjection','package_conjection.pkcon_id = sale_packages.salepk_pkcon_id','left')
               ->where('bk_deleted', 0)
               ->where_in('bk_id', $bkID)
               ->get('booking');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $record) {
                $data[] = $record;
            }
            return $data;
        }
        return FALSE;
    }
  public function exportCustomizet($cusID){
      $query = $this->db->select('*')
                ->join('passenger_booking', 'booking.bk_id = passenger_booking.pbk_bk_id','left')
                ->join('passenger','passenger.pass_id = passenger_booking.pbk_pass_id','left')
                ->join('sale_customize','booking.bk_id = sale_customize.salecus_bk_id','left')
                ->join('customize_conjection','customize_conjection.cuscon_id = sale_customize.salecus_cuscon_id','left')
               ->where('bk_deleted', 0)
               ->where_in('bk_id', $cusID)
               ->get('booking');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $record) {
                $data[] = $record;
            }
            return $data;
        }
        return FALSE;

  }
    public function getAccompany($passIDs){
      $query = $this->db->select('*')
              ->where_in('pass_id', $passIDs)
              ->get('passenger');
      return $query;
   }
}

/* End of file mod_admin.php */
/* Location: ./application/models/mod_admin.php */