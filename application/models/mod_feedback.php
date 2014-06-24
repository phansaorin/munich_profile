<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_feedback extends MU_model {

	public function getDataFeedback($username,$email,$txtStatus,$date,$subject,$text){
		$insert = array(
			'fb_name' => $username,
			'fb_email' => $email,
			'fb_status' => $txtStatus,
			'fb_date' => $date,
			'fb_subject' => $subject,
			'fb_text' => $text,
			'fb_deleted' => 0,
		);
		$this->db->insert('feedback',$insert);
		// return $this->db->affected_rows() > 0;
		return $this->db->insert_id('feedback');
	}
	public function showDateFeedback($perPage, $offSet,$sortby,$sort){
		$sortby = "fb_".strtolower($sortby);
		$query = $this
    		   ->db
    		   ->select('*')
    		   ->from('feedback')
		   ->where("fb_deleted", 0)
                  ->limit($perPage, $offSet)
    		   ->order_by($sortby, $sort)
    		   ->get();
        return $query;
	}
	public function getSearchFeedback($menu_title, $perPage, $offSet, $sortby, $sort){
        $sortby = "fb_".strtolower($sortby);
        $query = $this->db->select('*')
                 ->where('fb_deleted', 0)
                 ->limit($perPage, $offSet)
                 ->like("fb_name", $menu_title)
                 ->order_by($sortby, $sort)
                 ->get('feedback');
        return $query;
    } 
    public function view_feedback($get_id) {
	        $query = $this->db
	                ->select('*')
	                ->from('feedback')
			   		->where("fb_deleted", 0)
					->where("fb_id", $get_id)
	                ->get();

	        return $query;
	    }
    public function deleteFeedbackMultiple($update,$whereID){
    $this->db->where_in('fb_id',$whereID);
    $this->db->update('feedback',$update);
    return $this->db->affected_rows() >0;
  }
  public function deletePermenentFeedback($whereID){
      $this->db->where_in('fb_id', $whereID);
      $this->db->delete('feedback');
      return $this->db->affected_rows() > 0;
    } 
  public function select_feedback($get_id){
    		$query = $this->db
	                ->select('*')
	                ->from('feedback')
					->where("fb_id", $get_id)
	                ->get();

	        return $query;
    }
  public function editDataFeedback($get_id,$get_username,$get_email,$get_txtStatus,$get_date,$get_subject,$get_text){
  		$data = array(
				'fb_name' => $get_username,
				'fb_email' => $get_email,
				'fb_status' => $get_txtStatus,
				'fb_date' => $get_date,
				'fb_subject' => $get_subject,
				'fb_text' => $get_text,
				'fb_deleted' => 0,
	        );
	        $this->db->where('fb_id', $get_id);
	        return $this->db->update('feedback', $data);

  }
}