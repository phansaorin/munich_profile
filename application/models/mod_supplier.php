<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_supplier extends CI_model {
	
    /*
    *@: List All record in supplier record
    */
	
	public function list_record($perPage, $offSet, $sortby, $sort){
			$sortby = "sup_".strtolower($sortby);
			$query = $this->db->select('*')
							->where("sup_deleted",0)
							->limit($perPage, $offSet)
                 			->order_by($sortby, $sort)
							->get("supplier");
	return $query;
	}
	
	/*
	*@: get all search Suppliers 
	*/
	 
	public function search_supplier($perPage, $offSet, $sortby, $sort, $supplier_fname) {
		$sortby = "sup_id";
	    $this->db->select('*')
	        	 ->from("supplier")
				 ->where("sup_deleted",0);
	        if ($supplier_fname != "") {
	            $this->db->like("supplier.sup_fname", $supplier_fname);			     
	        } 
			$this->db->where("supplier.sup_deleted", 0);
	        $this->db->order_by($sortby, $sort);
	        $this->db->limit($perPage, $offSet);
	        $query = $this->db->get();
	return $query;
	}
		
	/*
	*@: View supplier by each record that selected
	*/
	
	public function view_supplier($get_id) {
	        $query = $this->db
	                ->select('*')
	                ->from('supplier')
					->where("supplier.sup_deleted", 0)
					->where("sup_id", $get_id)
	                ->get();
	return $query;
	}
		
	/*
	*@: select supplier by id to edit
	*/
	
	public function selectSupplierByID($get_id){
		$query = $this->db
					  ->select('*')
					  ->from('supplier')
					  ->where("sup_id", $get_id)
					  ->get();
		
	return $query;
	}
	
    /* 
	*@: edit supplier 
	*/
	
	public function edit_supplier($get_id, $get_txtCompanyName,$get_txtFirstName,$get_txtLastName,$get_txtOccupation,$get_txtSector,$get_txtService,$get_txtCountry,$get_txtCity,$get_txtMobile, $get_txtHomePhone, $get_txtEmail,$get_txtWebsite,$get_txtAddress,$get_txtCode) {
		$data = array(
	            'sup_company_name' 		=> $get_txtCompanyName,
	            'sup_fname' 	=> $get_txtFirstName,
	            'sup_lname' 		=> $get_txtLastName,
	            'sup_occupation' 	=> $get_txtOccupation,
	            'sup_sector' 			=> $get_txtSector,
	            'sup_service_provision' 	=> $get_txtService,
	            'sup_country' 	=> $get_txtCountry,
	            'sup_city' => $get_txtCity,
	            'sup_phone' 	=> $get_txtMobile,
	            'sup_home_phone' => $get_txtHomePhone,
	            'sup_email' 	=> $get_txtEmail,
	            'sup_website' => $get_txtWebsite,
	            'sup_address' 	=> $get_txtAddress,
	            'sup_postcode' 		=> $get_txtCode,
	            'sup_deleted'		=> 0
	        );
		
	$this->db->where('sup_id', $get_id);
	return $this->db->update('supplier', $data);
    }
		
	/*
	*@: Add supplier more
	*/	
		
	public function add_supplier($txtCompanyName,$txtFirstName,$txtLastName,$txtOccupation,$txtSector,$txtService,$txtCountry,$txtCity,$txtMobile, $txtHomePhone, $txtEmail,$txtWebsite,$txtAddress,$txtCode){
		$insert =  array(
						'sup_company_name' 		=> $txtCompanyName,
						'sup_fname' 	=> $txtFirstName,
						'sup_lname' 		=> $txtLastName,
						'sup_occupation' 	=> $txtOccupation,
						'sup_sector' 			=> $txtSector,
						'sup_service_provision' 	=> $txtService,
						'sup_country' 	=> $txtCountry,
						'sup_city' => $txtCity,
						'sup_phone' 	=> $txtMobile,
						'sup_home_phone' => $txtHomePhone,
						'sup_email' 	=> $txtEmail,
						'sup_website' => $txtWebsite,
						'sup_address' 	=> $txtAddress,
						'sup_postcode' 		=> $txtCode,
						'sup_deleted'		=> 0
		);
	$this->db->insert('supplier',$insert);
	// return $this->db->affected_rows() > 0;
	return $this->db->insert_id('supplier');
	}

	/*
	*@: Delete multiple supplier
	*/
		
	public function deleteMultipleSupplier($update,$whereID){
		$this->db->where_in('sup_id',$whereID);
		$this->db->update('supplier',$update);
		return $this->db->affected_rows() >0;
	}
		
	/*
	*@: Delete Permenent Supplier
	*/
		
	public function deletePermenentSupplier($whereID){
		$this->db->where_in('sup_id', $whereID);
		$this->db->delete('supplier');
		return $this->db->affected_rows() > 0;
	}
		
}

/* End of file mod_supplier.php */
/* Location: ./application/model/mod_supplier.php */