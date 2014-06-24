<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_gallery extends CI_model {
    /*     * *
      @ all record in activity record
     */
    public function show_galleries($perPage, $offSet,$sortby,$sort){
      if(strtolower($sortby) == "id"){
        $sortby = "photo_id";
      }else{
        $sortby = "pho_".strtolower($sortby);        
      } 
        $query = $this
               ->db
               ->select('*')
               ->from('photo')
               ->join('photo_type','photo_type.pt_id = photo.pt_id')
               ->where("photo.pho_delete", 0)
               ->limit($perPage, $offSet)
               ->order_by($sortby, $sort)
               ->get();
        return $query;
    }
    public function getGallery(){
      $query = $this
              ->db
              ->select('*')
              ->from('photo_type')
              ->where('pt_delete',0)
              ->get();
      return $query;
    }

    public function add_galleries($get_name,$image,$get_status,$get_detail,$get_phototype){
    for($i = 0; $i<count($image); $i++){ 
     $insert = array (
            'pho_name' =>$get_name,
            'pho_source' => $image[$i],
            'pho_status' => $get_status,
            'pho_detail' => $get_detail,
            'pt_id'=>$get_phototype,
            'pho_delete' => 0,
    );
    $this->db->insert('photo',$insert);
  }
    // return $this->db->affected_rows() > 0;
    return $this->db->insert_id('photo');

    }
   //  public function edit_galleries($get_id,$get_name,$image,$get_status,$get_detail,$get_phototype){
   //  for($i = 0; $i<count($image); $i++){ 
   //   $data = array (
   //  'pho_name' =>$get_name,
   //  'pho_source' => $image[$i],
   //  'pho_status' => $get_status,
   //  'pho_detail' => $get_detail,
   //  'pt_id'=>$get_phototype,
   //  'pho_delete' => 0,
   //  );
   //   $this->db->where('photo_id', $get_id);
   // }
     //return $this->db->update('photo', $data);
    // }
    public function select_gallery($get_id){
        $query = $this->db
                  ->select('*')
                  ->from('photo')
                  ->join('photo_type','photo_type.pt_id = photo.pt_id')
                 ->where("photo_id", $get_id)
                  ->get();

          return $query;

    }
  public function getSearchName($menu_title, $perPage, $offSet, $sortby, $sort){
        $sortby = "photo_".strtolower($sortby);
        $query = $this->db->select('*')
                 ->where('pho_delete', 0)
                 ->limit($perPage, $offSet)
                 ->like("pho_name", $menu_title)
                 ->order_by($sortby, $sort)
                 ->get('photo');
        return $query;
    } 
  public function view_galleriess($get_id) {
          $query = $this->db
                  ->from('photo')
                 ->join('photo_type','photo_type.pt_id = photo.pt_id')
                 ->where("photo.pho_delete", 0)
                 ->where("photo_id", $get_id)
                  ->get();

          return $query;
      }
    public function deleteMultiplePhoto($update,$whereID){
    $this->db->where_in('photo_id',$whereID);
    $this->db->update('photo',$update);
    return $this->db->affected_rows() >0;
  }
   public function deletePermenentPhoto($whereID){
      $this->db->where_in('photo_id', $whereID);
      $this->db->delete('photo');
      return $this->db->affected_rows() > 0;
    } 

 }
 ?>