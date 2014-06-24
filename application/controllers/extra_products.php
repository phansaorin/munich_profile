<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Extra_products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_extra_products'));
    }


    public function list_record() {
        $data['title'] = "Extra Products";
        $data['dashboard'] = "management";
        $controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
        if ($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))) {
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $config['base_url'] = site_url($controller . "/" . $function . "/" . $uri3 . "/" . $uri4);
            $config['uri_segment'] = 5;
            $sortby = $uri3;
           // echo $sortby; die();
            if ($uri4 == 'ASC') {
                $data['sort'] = "DESC";
            } elseif ($uri4 == "DESC") {
                $data['sort'] = "ASC";
            }
        } else {
            $sortby = "ID";
            $data['sort'] = "ASC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }
        $config['total_rows'] = MU_Model::count_all_data('extraproduct', array('ep_deleted' => 0));
        $config['per_page'] = 10;
	    	$config['next_tag_open'] = '<li>';
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;&gt;';
        $config['prev_link'] = '&lt;&lt;';
        $this->pagination->initialize($config); //function to show all pages
        $page = ($this->uri->segment($config['uri_segment']) && $this->uri->segment($config['uri_segment']) > 0) ? $this->uri->segment($config['uri_segment']) : 0;
        $data['extraproduct'] = $this->mod_extra_products->list_record($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
    }
	
    public function search_extra_products() {
            $data['title'] = "Search Extra Products";
            $data['dashboard'] = "management";
            $controller = $this->uri->segment(1);
            $function = 'search_extra_products';
			
			if($this->input->post('search_extra_products_name')){
			$this->session->set_userdata("extra_products_name", $this->input->post('search_extra_products_name'));
			}else{
				$this->session->set_userdata("extra_products_name", "");	
			}
            if ($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))) {
                $uri3 = $this->uri->segment(3);
                $uri4 = $this->uri->segment(4);
                $config['base_url'] = site_url($controller . "/" . $function . "/" . $uri3 . "/" . $uri4);
                $config['uri_segment'] = 5;
                $sortby = $uri3;
                if ($uri4 == 'ASC') {
                    $data['sort'] = "DESC";
                } elseif ($uri4 == "DESC") {
                    $data['sort'] = "ASC";
                }
            } else{
                $sortby = "ID";
                $data['sort'] = "ASC";
                $config['base_url'] = site_url($controller . "/" . $function);
                $config['uri_segment'] = 3;
            }
            $config['total_rows'] = MU_Model::count_all_data('extraproduct', array('ep_deleted' => 0));
            $config['per_page'] = 10;
			$config['next_tag_open'] = '<li>';
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);
			$config['next_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&gt;&gt;';
			$config['prev_link'] = '&lt;&lt;';
			$this->pagination->initialize($config); //function to show all pages
			$page = ($this->uri->segment($config['uri_segment']) && $this->uri->segment($config['uri_segment']) > 0) ? $this->uri->segment($config['uri_segment']) : 0;
			$data['search_extra_products'] = $this->mod_extra_products->getSearchExtraproducts($config['per_page'], $page, $sortby, $data['sort'], $this->input->post('search_extra_products_name'));
			$data['pagination'] = $this->pagination->create_links();
			$this->load->view('munich_admin', $data);
				// end of if condition
        //}
    }
    
    public function view_extra_products() {
        $data['title'] = "View Extra Products";
        $data['dashboard'] = "management";
    		$data['txtPerperson'] = array( '1' => 'Yes', '0' => 'No');
    		$data['txtPerbooking'] = array( '1' => 'Yes', '0' => 'No');
    		$get_id = $this->uri->segment(3);
    		$data['view_extra_products'] = $this->mod_extra_products->view_extra_products($get_id);
    		$data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $this->load->view('munich_admin', $data);
    }
    public function add_extra_products() {
              $data['title'] = "Add New Extra Products";
              $data['dashboard'] = "management";
              $data['txtPerperson'] = array( '1' => 'Yes', '0' => 'No');
			        $data['txtPerbooking'] = array( '1' => 'Yes', '0' => 'No');
			        $data['txtPhotos'] = $this->mod_extra_products->getPhotos();
              $data['txtSupplier'] = $this->mod_extra_products->getSupplier();
              $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
              $data['spl']      = '';
              $data['chosimg']  = ''; 
              $data['payed']    = '';
              $data['deadline'] = '';
              $data['txtadmin'] = '';
              $data['status'] = '';
              $data['dayavailable'] = array(0,0,0,0,0,0,0,0);
              $session = $this->session->set_userdata($data);
          if ($this->input->post('addExtraproducts')) {
              // all fields are require
             $insert_product = $this->activities_variable(); // function return the valude variable of activities.
           // var_dump($insert_product); die();
             $checkavailableday = $this->input->post('check');
             $insert_calendar = $this->activities_cal($checkavailableday); // function return the calendar selected.
             // for catch value 
            $data['spl']        = $insert_product['supplier_id'];
            $data['chosimg']    = $insert_product['photo_id']; 
            $data['payed']      = $insert_product['ep_payeddate'];
            $data['deadline']   = $insert_product['ep_deadline'];
            $data['status']     = $insert_product['ep_status'];
            $data['txtadmin']   = $insert_product['ep_admintext'];

            if($checkavailableday[0] == "1_everyday"){$everyday = 1; }else{ $everyday = 0; }
            if($checkavailableday[0] != "" and count($checkavailableday) > 0) $data['dayavailable'] = array($everyday,$insert_calendar['monday'],$insert_calendar['tuesday'],$insert_calendar['wednesday'],$insert_calendar['thursday'],$insert_calendar['friday'],$insert_calendar['saturday'],$insert_calendar['sunday']);  
            $config = $this->extract_products_config(); // get the validation config  
            $this->form_validation->set_rules($config);
              if ($this->form_validation->run() == FALSE) {
                //echo "error"; die();

                  $this->session->set_userdata('error', show_message('<p class="error">'.'Error format! Please check your data again'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
              }else{
                  if($this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice')) AND $checkavailableday[0] != ""){
                    $ep_insert = $this->mod_extra_products->createActivities($insert_product);
                    if($ep_insert) $date_available =  $this->mod_extra_products->insertDateTime($insert_calendar);
                    if($date_available) $records_conjection =  $this->mod_extra_products->insertActDateTime($ep_insert, $date_available);
                    if(isset($records_conjection)){ 
                        $this->session->set_userdata('create', show_message('<p>'.'Activity was submited successfully ...'.'</p>', 'success'));
                        // redirect('extra_products/list_record');
                        redirect('extra_products/view_extra_products/'.$ep_insert);
                    }else{
                        $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                        $this->load->view('munich_admin', $data);
                    }
               }else{
                    $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                    $this->load->view('munich_admin', $data);
               } // end check money and
                }// add condition
            }else{ // else btn add
            $this->load->view('munich_admin', $data);
        } // btn add
       
  }
  public function extract_products_config(){
       $config = array(
                          array('field' => 'txtFrom','label' => 'From Date', 'rules' => 'trim|required'),
                          array('field' => 'txtTo','label' => 'End Date','rules' => 'trim|required'),
                          array('field' => 'txtStartTime','label' => 'start time','rules' => 'trim|required' ),
                          array('field' => 'txtEndTime','label' => 'end time', 'rules' => 'trim|required' ),
                          array('field' => 'txtName','label' => 'Extra Products Name','rules' => 'trim|required'),
                          array('field' => 'txtPerperson','label' => 'Per Person','rules' => 'trim|required'),
                          array('field' => 'txtPerbooking','label' => 'Per Booking','rules' => 'trim|required'),
                          array('field' => 'txtAdmin','label' => 'Text for Admin','rules' => 'trim|required'),
                          array('field' => 'txtPhotos', 'label' => 'Photo','rules' => 'trim|required'),
                          array('field' => 'txtEticket','label' => 'Text for E-Ticket','rules' => 'trim|required'),
                          array('field' => 'purchasePrice','label' => 'Purchase Price','rules' => 'trim|required'),
                          array('field' => 'salePrice','label' => 'Sale Price','rules' => 'trim|required'),
                          array('field' => 'originalStock','label' => 'Original Stock','rules' => 'trim|required|numeric' ),
                          array('field' => 'actualStock', 'label' => 'Actual Stock','rules' => 'trim|required|numeric'),
                          array('field' => 'txtProvider','label' => 'Provider Date','rules' => 'trim|required'),
                          array('field' => 'txtPayed','label' => 'Payed Date','rules' => 'trim|required' ),
                          array('field' => 'txtDeadline','label' => 'Deadline','rules' => 'trim|required' ),
                          array('field' => 'txtBooking','label' => 'Text for booking form ','rules' => 'trim|required'),
                          array('field' => 'txtPhotos','label' => 'File input', 'rules' => 'trim|required'),
                          array('field' => 'txtSupplier','label' => 'Supplier', 'rules' => 'trim|required'),

                      );

      return $config;

  }
   public function activities_variable(){
        $activities['ep_name']          = $this->input->post('txtName');
        $activities['ep_perperson']    = $this->input->post('txtPerperson');
        $activities['ep_perbooking']       = $this->input->post('txtPerbooking');
        $activities['ep_bookingtext']        = $this->input->post('txtBooking');
        $activities['ep_etickettext']   = $this->input->post('txtEticket');
        $activities['photo_id']          = $this->input->post('txtPhotos');
        $activities['supplier_id']       = $this->input->post('txtSupplier');
        $activities['ep_purchaseprice'] = $this->input->post('purchasePrice');
        $activities['ep_saleprice']     = $this->input->post('salePrice');
        $activities['ep_originalstock'] = $this->input->post('originalStock');
        $activities['ep_actualstock']   = $this->input->post('actualStock');
        $activities['ep_providerdate']   = $this->input->post('txtProvider');
        $activities['ep_payeddate']     = $this->input->post('txtPayed');
        $activities['ep_deadline']      = $this->input->post('txtDeadline');
        $activities['ep_admintext'] = $this->input->post('txtAdmin'); 
        $activities['ep_status']        = $this->input->post('txtStatus');
        return $activities;
    }
     public function activities_cal($checkavailableday){
        $calendar_selected['start_date']    = $this->input->post('txtFrom');
        $calendar_selected['end_date']      = $this->input->post('txtTo');
        $calendar_selected['start_time']    = $this->input->post('txtStartTime');
        $calendar_selected['end_time']      = $this->input->post('txtEndTime');
        $day = array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");
        if($checkavailableday[0] == "1_everyday"){
            $calendar_selected['monday']    = 1;
            $calendar_selected['tuesday']   = 1;
            $calendar_selected['wednesday'] = 1;
            $calendar_selected['thursday']  = 1;
            $calendar_selected['friday']    = 1;
            $calendar_selected['saturday']  = 1;
            $calendar_selected['sunday']    = 1;
        }else{
            if($checkavailableday[0] != "" and count($checkavailableday) > 0){
                for($i = 0; $i < count($day); $i++){
                    for($j = 0; $j < count($checkavailableday); $j++){
                      $explode = explode("_", $checkavailableday[$j]);
                      if($explode[1] == $day[$i]){
                       $calendar_selected[$day[$i]] = $explode[0];
                      }
                    }
                    if(array_key_exists($day[$i], $calendar_selected) === FALSE){
                      $calendar_selected[$day[$i]] = 0;
                    }
                }
            }
        }
        return $calendar_selected;
    }

    public function is_money($price) {
      return preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $price);
    }

    public function edit_extra_products($ep_id) {
        $get_id = $this->uri->segment(3);
        $data['title'] = "Add New Extra Products";
        $data['dashboard'] = "management";
        $data['txtPerperson'] = array( '1' => 'Yes', '0' => 'No');
        $data['txtPerbooking'] = array( '1' => 'Yes', '0' => 'No');
        $data['txtPhotos'] = $this->mod_extra_products->getPhotos();
        $data['txtSupplier'] = $this->mod_extra_products->getSupplier();
        $data['getUpdateExstraProduct'] = $this->mod_extra_products->getUpdateExtraProduct($ep_id);
       //var_dump($data['getUpdateExstraProduct']->result());
        $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $data['spl']      = '';
        $data['chosimg']  = ''; 
        $data['payed']    = '';
        $data['deadline'] = '';
        $data['txtadmin'] = '';
        $data['status'] = '';
        $data['dayavailable'] = array(0,0,0,0,0,0,0,0);
        $session = $this->session->set_userdata($data);
        $data['get_extraproducts'] = $this->mod_extra_products->select_extraproductsId($get_id); 
        if($this->input->post('edit_extra_products')){
            $update_exstrproduct = $this->activities_variable(); // function return the valude variable of activities.
            $checkavailableday = $this->input->post('check');
            $update_calendar = $this->activities_cal($checkavailableday); // function return the calendar selected.
            $cal_id = $this->input->post("cal_id");
            $data['spl']  = $update_exstrproduct['supplier_id'];
            $data['chosimg']    = $update_exstrproduct['photo_id']; 
            $data['payed']      = $update_exstrproduct['ep_payeddate'];
            $data['deadline']   = $update_exstrproduct['ep_deadline'];
            $data['status']     = $update_exstrproduct['ep_status'];
            $data['txtadmin']   = $update_exstrproduct['ep_admintext'];
            if($checkavailableday[0] == "1_everyday"){$everyday = 1; }else{ $everyday = 0; }
            if($checkavailableday[0] != "" and count($checkavailableday) > 0) $data['dayavailable'] = array($everyday,$update_calendar['monday'],$update_calendar['tuesday'],$update_calendar['wednesday'],$update_calendar['thursday'],$update_calendar['friday'],$update_calendar['saturday'],$update_calendar['sunday']);  
            $config = $this->extract_products_config(); // get the validation config  
            $this->form_validation->set_rules($config);
              if ($this->form_validation->run() == FALSE) {
                //echo "error"; die();
                $this->session->set_userdata('error', show_message('<p class="error">'.'Error format! Please check your data again'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
              }else{
                   if($this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice')) AND $checkavailableday[0] != ""){
                      $act_update = $this->mod_extra_products->updateExtraProduct($update_exstrproduct, $ep_id);
                      $date_available =  $this->mod_extra_products->updateDateTime($update_calendar, $cal_id);
                      if($date_available){ 
                         // $this->add_sub_ep($act_id);
                          $this->session->set_userdata('create', show_message('<p>'.'Activity was submited successfully ...'.'</p>', 'success'));
                          // redirect('extra_products/list_record');
                          redirect('extra_products/view_extra_products/'.$ep_id);
                      }
                 }else{
                      $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                      $this->load->view('munich_admin', $data);
                 } // end check money and
                  }// add condition
            }else{ // else btn add
            $this->load->view('munich_admin', $data);
        } // btn add
       
  }
// end of exstrat product
    public function deleteExtraproductsById($extraproducts_id,$pagination = false){
  	  $total_count = MU_Model::count_all_data('extraproduct',array('ep_deleted' => 0));
  	  $delete_extraproducts = MU_Model::deleteRecordById('extraproduct',array("ep_deleted" => 1) ,array('ep_id' => $extraproducts_id));
  	  if($delete_extraproducts){
  		  redirect(strtolower(get_class()).'/list_record');
  	 }
   }	 

	

   public function deleteMultiExtraproducts(){
	  $multiCheck = $this->input->post("check_checkbox");
	  $update['ep_deleted'] = 1;
	  $result = $this->mod_extra_products->deleteMultipleExtraproducts($update,$multiCheck);
	  if($result > 0){
            $this->session->set_userdata('msg_success', 'The activities have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name extra prducts.');
            echo "f";
        }
    }
    
    public function deletePermenentExtraproducts() {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_extra_products->deletePermenentExtraproducts($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The extra products have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The extra products record can not delete from table');
            echo "f";
        }
    }

    

    //For print pdf  and excel

    public function exportPDF() {
        $this->load->helper('pdf_helper');
        $data['extraproduct'] = MU_Model::exportAllDatas('extraproduct');
        $this->load->view('include/BE/extra_products/pdfexport', $data);
    }
    public function exportExcel() {
        $data['extraproduct'] = MU_Model::exportAllDatas('extraproduct');
        $this->load->view('include/BE/extra_products/excelexport', $data);
    }
	public function exportByPagePDF(){
		$this->load->helper('pdf_helper');
		$checkex = $this->input->post("check_checkbox");
		
		if($this->uri->segment(3) == "search_extra_products"){
        	$exportpage['extraproduct'] = $this->getRecordExtraproducts();
		}else{
			$exportpage['extraproduct'] = $this->mod_extra_products->exportDataPage($checkex);
		}
		$this->load->view('include/BE/extra_products/pdfexport', $exportpage);
	}
	public function exportByPageExcel(){
		$checkex = $this->input->post("check_checkbox");
		
		if($this->uri->segment(3) == "search_extra_products"){
        	$exportpage['extraproduct'] = $this->getRecordExtraproducts();
		}else{
			$exportpage['extraproduct'] = $this->mod_extra_products->exportDataPage($checkex);
		}
		$this->load->view('include/BE/extra_products/excelexport', $exportpage);
	}
	public function getRecordExtraproducts(){
		if($this->session->userdata("extra_products_name")){$name = $this->session->userdata("extra_products_name"); }else{ $name = ""; }
		$record = $this->mod_extra_products->getSearchExtraproductsExport($name);
		if ($record->num_rows() > 0) {
            foreach ($record->result() as $data) {
                $datas[] = $data;
            }           
			return $datas;
        }	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */