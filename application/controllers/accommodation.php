<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accommodation extends MU_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_accommodation'));
    }

    /*
    * public fucntion list_record
    * @noparam
    * Display perpage 10
    * MU_Model.php {count_all_data()}
    * Conbine with sort column (id, accommodation name, start date, end date)
    * mod_accommodation.php {list_accommodation()}
    * show the list of the accommodation
    */
    public function list_record() {
    if ($this->check_user_session()) {
        $data['title'] = "Accommodation";
        $data['dashboard'] = "management";
        $controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
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
        } else {
            $sortby = "ID";
            $data['sort'] = "DESC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }
        $config['total_rows'] = MU_Model::count_all_data('accommodation', array('acc_deleted' => 0,'acc_subof'=> 0));
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
        $data['accommodation'] = $this->mod_accommodation->list_accommodation($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
    }
}

    /*
    *public function search_accommodation
    *@: searching of from date, end date and name of accommodation
    *display perpage 10
    *MU_Model.php {count_all_data()}
    *Conbine with sort column (id, accommodation name, start date, end date)
    *mod_accommodation.php {getSearchAccommodation()}
    *show the list of search the accommodation 
    */
    public function search_accommodation() {
    if ($this->check_user_session()) {
        $data['title'] = "Search Accommodation";
        $data['dashboard'] = "management";
        $controller = $this->uri->segment(1);
        $function = 'search_accommodation';
		if($this->input->post('search_from_date')){ $this->session->set_userdata('from_date', $this->input->post('search_from_date'));}else{$this->session->set_userdata('from_date', "");}
        if($this->input->post('search_end_date')){ $this->session->set_userdata("end_date", $this->input->post('search_end_date')); }else{ $this->session->set_userdata("end_date", ""); }
        if($this->input->post('search_accommodation_name')){$this->session->set_userdata("accommodation_name", $this->input->post('search_accommodation_name'));}else{ $this->session->set_userdata("accommodation_name", "");}
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
        } else {
            $sortby = "ID";
            $data['sort'] = "DESC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }
        $config['total_rows'] = MU_Model::count_all_accommodation($this->session->userdata("from_date"), $this->session->userdata("end_date"), $this->session->userdata("accommodation_name"));
        $config['per_page'] = 10;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $config['next_tag_open'] = '<li>';
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
        $data['search_accommodation'] = $this->mod_accommodation->getSearchAccommodation($config['per_page'],$page, $sortby, $data['sort'],$this->session->userdata("from_date"), $this->session->userdata("end_date"), $this->session->userdata("accommodation_name"));
		$data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data); 
    }
}
    /*
    * public function detail_accommodation
    * @noparam
    * @access from ajax
    * @echo record 
    * mod_accommodation.php {detail_accommodation(@param)}
    */
    public function detail_accommodation() {
    if ($this->check_user_session()) {
        $data['title'] = "View Accommodation";
        $data['dashboard'] = "management";
        $data['get_facility'] = $this->mod_accommodation->getFacility();
        if($this->uri->segment(3) == "temp"){
            $get_id = $this->uri->segment(4);
            $tempsub = $this->mod_accommodation->detail_temp_accommodation($get_id);
            $tempsub = $tempsub->result();
            foreach($tempsub as $val){
                $tempsub = unserialize($val->tmpt_value);
            }
        $data['detail_accommodation'] = array_merge($tempsub[0],$tempsub[1]);
        $facilities = $this->mod_accommodation->getAccWithFAC($tempsub['facilities_id'], "array");
        }else{
           $get_id = $this->uri->segment(3);
           $detail_accommodation = $this->mod_accommodation->detail_accommodation($get_id);
           // $detail_accommodation = $detail_accommodation->result();
           foreach($detail_accommodation->result() as $val){
                $data['detail_accommodation'] = json_decode(json_encode($val), true);
           }
           $facilities = $this->mod_accommodation->getAccWithFAC($get_id, "normal");
        }
        if(count($data['detail_accommodation']) > 0){
            $date_available = "";
            $date_available = '<label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_accommodation']['monday'])).' Mon</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_accommodation']['tuesday'])).' Tue</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_accommodation']['wednesday'])).' Wed</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_accommodation']['thursday'])).' Thu</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_accommodation']['friday'])).' Fri</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_accommodation']['saturday'])).' Sat</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_accommodation']['sunday'])).' Sunday</label>
            ';
            $rt_name  = isset($data['detail_accommodation']['rt_name'])? $data['detail_accommodation']['rt_name'] : MU_Model::getForiegnTableName("room_types", array("rt_deleted"=>0, "rt_id"=>$data['detail_accommodation']['acc_rt_id']), "rt_name"); 
            $clf_name  = isset($data['detail_accommodation']['clf_name'])? $data['detail_accommodation']['clf_name'] : MU_Model::getForiegnTableName("classification", array("clf_deleted"=>0, "clf_id"=>$data['detail_accommodation']['classification_id']), "clf_name");           
            $lt_name  = isset($data['detail_accommodation']['lt_name'])? $data['detail_accommodation']['lt_name'] : MU_Model::getForiegnTableName("location", array("lt_deleted"=>0, "lt_id"=>$data['detail_accommodation']['location_id']), "lt_name");
            $ftv_name = isset($data['detail_accommodation']['ftv_name'])? $data['detail_accommodation']['ftv_name'] : MU_Model::getForiegnTableName("festival", array("ftv_deleted"=> 0, "ftv_id"=>$data['detail_accommodation']['acc_ftv_id']), "ftv_name");
            $spl_name = isset($data['detail_accommodation']['sup_company_name'])? $data['detail_accommodation']['sup_company_name'] : MU_Model::getForiegnTableName("supplier", array("sup_deleted"=> 0, "sup_id"=>$data['detail_accommodation']['acc_supplier_id']), "sup_company_name");
            $pho_source = isset($data['detail_accommodation']['pho_source'])? $data['detail_accommodation']['pho_source'] : MU_Model::getForiegnTableName("photo", array("pho_delete"=> 0, "photo_id"=>$data['detail_accommodation']['photo_id']), "pho_source");
            // $facilities = isset($data['detail_accommodation']['facilities_title'])? $data['detail_accommodation']['facilities_title'] : MU_Model::getForiegnTableName("facilities", array("facilities_deleted"=> 0, "facilities_id" => $data['detail_accommodation']['facilities_id']), "facilities_title");
            $showfac = "";
                foreach($facilities->result() as $facilitytitle){
                    if($showfac == ""){
                        $showfac .= $facilitytitle->facilities_title;
                    }else{
                        $showfac .= " | ".$facilitytitle->facilities_title;
                    }
                }
            $records = '<table class="table table-bordered"><tr><th>Accommodation Name</th> <td>'.$data['detail_accommodation']['acc_name'].'</td></tr>
            <tr><th>From Date</th><td>'.$data['detail_accommodation']['start_date'].'</td></tr>
            <tr><th>To Date</th> <td>'.$data['detail_accommodation']['end_date'].'</td></tr>
            <tr><th>Facility</th> <td>'.$showfac.'</td></tr>
            <tr><th>Date available</th> <td>'.$date_available.'</td></tr>
            <tr><th>Time </th> <td>'.$data['detail_accommodation']['start_time'].' to '.$data['detail_accommodation']['end_time'].'</td></tr>
            <tr><th>Room Type </th> <td>'.$rt_name.'</td></tr>
            <tr><th>Classification </th> <td>'.$clf_name.'</td></tr>
            <tr><th>Location </th> <td>'.$lt_name.'</td></tr>
            <tr><th>Festival </th> <td>'.$ftv_name.'</td></tr>
            <tr><th>Supplier </th> <td>'.$spl_name.'</td></tr>
            <tr><th>Photo </th> <td>'.img(array("src" => "user_uploads/thumbnail/original/".$pho_source,"alt"=>$pho_source,"class"=>"acc_img")).'</td></tr>
            <tr><th>Purchase Price </th> <td>'.$data['detail_accommodation']['acc_purchaseprice'].' $</td></tr>
            <tr><th>Sale Price </th> <td>'.$data['detail_accommodation']['acc_saleprice'].' $</td></tr>
            <tr><th>Original Stock </th> <td>'.$data['detail_accommodation']['acc_originalstock'].'</td></tr>
            <tr><th>Actual Stock </th> <td>'.$data['detail_accommodation']['acc_actualstock'].'</td></tr>
            <tr><th>Date Contract </th> <td>'.$data['detail_accommodation']['acc_hoteldate'].'</td></tr>
            <tr><th>Paid Date </th> <td>'.$data['detail_accommodation']['acc_payeddate'].'</td></tr>
            <tr><th>Deadline </th> <td>'.$data['detail_accommodation']['acc_deadline'].'</td></tr>
            <tr><th>E-Ticket Text </th> <td>'.$data['detail_accommodation']['acc_texteticket'].'</td></tr>
            <tr><th>Booking Text </th> <td>'.$data['detail_accommodation']['acc_bookingtext'].'</td></tr>
            <tr><th>Admin Text </th> <td>'.$data['detail_accommodation']['acc_admintext'].'</td></tr>
            </table>';
          echo $records;
        }
    }
}
    /*
    * public function detail_extraproduct
    * @noparam
    * @access from ajax (manage.js)
    * @echo record 
    * mod_accommodation.php {detail_extraproduct(@param)}
    */
    public function detail_extraproduct() {
    if ($this->check_user_session()) {
        $data['title'] = "View Accommodation";
        $data['dashboard'] = "management";
        if($this->uri->segment(3) == "temp"){
    	   $get_id = $this->uri->segment(4);
        }else{
           $get_id = $this->uri->segment(3);
        }
        $ep_record  = $this->mod_accommodation->getExproductById($get_id);
        foreach($ep_record->result() as $val){
            $detail_extraproduct = json_decode(json_encode($val), true);
        }
        if($detail_extraproduct){        
            $date_available = "";
            $byperson = $detail_extraproduct['ep_perperson'] == 1 ? "Per Person" : "No";
            $bybooking = $detail_extraproduct['ep_perbooking'] == 1 ? "Per Booking" : "No";
            $date_available = '<label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked" =>  $detail_extraproduct['monday'])).' Mon</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" =>  $detail_extraproduct['tuesday'])).' Tue</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" =>  $detail_extraproduct['wednesday'])).' Wed</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" =>  $detail_extraproduct['thursday'])).' Thu</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" =>  $detail_extraproduct['friday'])).' Fri</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" =>  $detail_extraproduct['saturday'])).' Sat</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" =>  $detail_extraproduct['sunday'])).' Sunday</label>
            ';

            $records = '<table class="table table-bordered"><tr><th>Accommodation Name</th> <td>'. $detail_extraproduct['ep_name'].'</td></tr>
            <tr><th>Per Person</th><td>'.$byperson.'</td></tr>
            <tr><th>Per Booking</th><td>'.$bybooking.'</td></tr>
            <tr><th>From Date</th><td>'. $detail_extraproduct['start_date'].'</td></tr>
            <tr><th>To Date</th> <td>'. $detail_extraproduct['end_date'].'</td></tr>
            <tr><th>Date available</th> <td>'.$date_available.'</td></tr>
            <tr><th>Time </th> <td>'. $detail_extraproduct['start_time'].' to '. $detail_extraproduct['end_time'].'</td></tr>
            <tr><th>Purchase Price </th> <td>'. $detail_extraproduct['ep_purchaseprice'].' $</td></tr>
            <tr><th>Sale Price </th> <td>'. $detail_extraproduct['ep_saleprice'].' $</td></tr>
            <tr><th>Original Stock </th> <td>'. $detail_extraproduct['ep_originalstock'].'</td></tr>
            <tr><th>Actual Stock </th> <td>'. $detail_extraproduct['ep_actualstock'].'</td></tr>
            <tr><th>Paid Date </th> <td>'. $detail_extraproduct['ep_payeddate'].'</td></tr>
            <tr><th>Deadline </th> <td>'. $detail_extraproduct['ep_deadline'].'</td></tr>
            <tr><th>Booking Text </th> <td>'. $detail_extraproduct['ep_bookingtext'].'</td></tr>
            <tr><th>Admin Text </th> <td>'. $detail_extraproduct['ep_admintext'].'</td></tr>
            </table>';
            echo $records;
        }
    }
}
    /*
    * pulic function status_accommodation
    * @param $acc_status (int)
    * @param $acc_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function status_accommodation ($acc_status, $acc_id, $pagione = false, $pagitwo = false, $pagithree = false){
    if ($this->check_user_session()) {
        $total_rows = MU_Model::count_all_data('accommodation', array('acc_deleted' => 0));
        $acc_status = ($acc_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('accommodation', array("acc_status" => $acc_status), array('acc_id' => $acc_id));
        $pagi = "";
        if($this->session->userdata('search')){ $function = "search_accommodation"; }else{ $function = "list_record"; } 
        if($pagione != false) $pagi = $pagione;
        if($pagitwo != false) $pagi .= "/".$pagitwo;
        if($pagithree != false) $pagi .= "/".$pagithree;
            $redirect = "accommodation/".$function."/".$pagi; 
            $acc_msg = ($acc_status == 1) ? "Published" : "Unpublished";
        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The accommodation have been '.$acc_msg.' successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$acc_msg.' record on table name accommodation.');
            redirect($redirect);
        }
    }
}
    /* 
    * public function is_money
    * @param $price
    * check money for add new accommodation 
    * return true or false
    */
    public function is_money($price) {
      return preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $price);
    }

    /* 
    * public function add_accommodation
    * @noparam
    * @validation
    * @loadview
    * @insert record.
    */
    public function add_accommodation() {
    if ($this->check_user_session()) {
        $data['title'] = "Add New Accommodation";
        $data['dashboard'] = "management";
        // $data['txtchoiceItem'] = array(''=>"please select...",'1' => 'Yes', '0' => 'No');
        $data['txtRoom'] = $this->mod_accommodation->getRoom();
        $data['txtClassification'] = $this->mod_accommodation->getClassification();
        $data['txtLocation'] = $this->mod_accommodation->getLocation();
        $data['txtFastival'] = $this->mod_accommodation->getFastival();
        $data['txtSupplier'] = $this->mod_accommodation->getSupplier();
        $data['txtPhotos'] = $this->mod_accommodation->getPhotos();
        $data['get_facility'] = $this->mod_accommodation->getFacility();
        $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        // for catch value 
        $data['choice']   = '';
        $data['lc']       = ''; 
        $data['ftv']      = '';
        $data['spl']      = '';
        $data['chosimg']  = ''; 
        $data['orContract'] = '';
        $data['payed']    = '';
        $data['deadline'] = '';
        $data['txtadmin'] = '';
        $data['status'] = '';
        $data['dayavailable'] = array(0,0,0,0,0,0,0,0);
        // $session = $this->session->set_userdata($data);

        if ($this->input->post('addAccommodation')) {
            $insert_accommodation = $this->accommodation_variable(); // function return the valude variable of accommodation.
            $checkavailableday = $this->input->post('check');
            $insert_calendar = $this->accommodation_cal($checkavailableday); // function return the calendar selected.
            $insert_ficility = $this->input->post('txtFaciliti');
                    
            // var_dump($insert_ficility); die();
            // for catch value 
            $data['rt']         = $insert_accommodation['acc_rt_id']; 
            $data['clf']        = $insert_accommodation['classification_id']; 
            $data['lc']         = $insert_accommodation['location_id']; 
            $data['ftv']        = $insert_accommodation['acc_ftv_id'];
            $data['spl']        = $insert_accommodation['acc_supplier_id'];
            $data['chosimg']    = $insert_accommodation['photo_id']; 
            $data['orContract'] =  $insert_accommodation['acc_hoteldate'];
            $data['payed']      = $insert_accommodation['acc_payeddate'];
            $data['deadline']   = $insert_accommodation['acc_deadline'];
            $data['status']     = $insert_accommodation['acc_status'];
            $data['txtadmin']   = $insert_accommodation['acc_admintext'];

            if($checkavailableday[0] == "1_everyday"){$everyday = 1; }else{ $everyday = 0; }
            if($checkavailableday[0] != "" and count($checkavailableday) > 0) $data['dayavailable'] = array($everyday,$insert_calendar['monday'],$insert_calendar['tuesday'],$insert_calendar['wednesday'],$insert_calendar['thursday'],$insert_calendar['friday'],$insert_calendar['saturday'],$insert_calendar['sunday']);
            
            $config = $this->accommodation_config(); // get the validation config  
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) { // form validation
                $this->session->set_userdata('create', show_message('<p class="error">'.'Error format! Please check your data again'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
            }else{ // else form validation
               if( $this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice')) AND $checkavailableday[0] != ""){
                    $acc_insert = $this->mod_accommodation->createAccommodation($insert_accommodation);
                    // /if($acc_insert) $facilities =  $this->mod_accommodation->insertToFacility($insert_calendar);
                    if($acc_insert) $date_available =  $this->mod_accommodation->insertDateTime($insert_calendar);
                    if($date_available)$conjection = $this->mod_accommodation->insertFacilities($insert_ficility, $acc_insert);
                    if($date_available){
                         $records_conjection =  $this->mod_accommodation->insertAccDateTime($acc_insert, $date_available);
                      }
                    
                    if(isset($records_conjection)){ 
                        $this->session->set_userdata('create', show_message('<p>'.'Accommodation was submited successfully ...'.'</p>', 'success'));
                        //redirect('accommodation/list_record');
                        redirect('accommodation/view_accommodation/'.$acc_insert);
                    }else{
                        $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                        $this->load->view('munich_admin', $data);
                    }
               }else{
                    $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                    $this->load->view('munich_admin', $data);
               } // end check money and 
            } // form validation
        }else{ // else btn add
            $this->load->view('munich_admin', $data);
        } // btn add
    } // function add_accommodation
}
    /* 
    * public function view_accommodation
    * @noparam
    * @validation
    * @loadview
    * @view record.
    * @saverecordback
    */
    public function view_accommodation($acc_id) {
    if ($this->check_user_session()) {
        $data['title'] = "View Accommodation";
        $data['dashboard'] = "management";
        // $data['txtchoiceItem'] = array(''=>"please select...",'1' => 'Yes', '0' => 'No');
        $data['txtRoom'] = $this->mod_accommodation->getRoom();
        $data['txtClassification'] = $this->mod_accommodation->getClassification();
        $data['txtLocation'] = $this->mod_accommodation->getLocation();
        $data['txtFastival'] = $this->mod_accommodation->getFastival();
        $data['txtSupplier'] = $this->mod_accommodation->getSupplier();
        $data['subaccommodation'] = $this->mod_accommodation->getSubaccommodation($acc_id); 
        $data['ExtraRelatedacc'] = $this->mod_accommodation->getExtraproductByAccommodation($acc_id);
        //var_dump($data['ExtraRelatedacc']);
        $data['txtExtraProduct'] = $this->mod_accommodation->getAllExtraproduct();
        $data['txtPhotos'] = $this->mod_accommodation->getPhotos();
        $data['getUpdateAccommodation'] = $this->mod_accommodation->getUpdateAccommodation($acc_id);
        $data['get_facility'] = $this->mod_accommodation->getFacility();

        $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        // for catch value 
        $data['choice']   = '';
        $data['lc']       = ''; 
        $data['ftv']      = '';
        $data['spl']      = '';
        $data['chosimg']  = ''; 
        $data['orContract'] =  '';
        $data['payed']    = '';
        $data['deadline'] = '';
        $data['txtadmin'] = '';
        $data['status'] = '';
        $data['dayavailable'] = array(0,0,0,0,0,0,0,0);
        // $session = $this->session->set_userdata($data);
        if ($this->input->post('SaveChangeAccommodation')) {
            //$ficility_id = $this->input->post('ficility_id');// name of hidden form
            $ficilities_id = $this->input->post('fici_id');// name of hidden form
            $accomodation_id = $this->input->post('acc_id');// name of hidden form
            $update_ficilities = $this->mod_accommodation->DeleteFacility($accomodation_id);
           // var_dump($update_ficility); die();
            $update_accommodation = $this->accommodation_variable(); // function return the valude variable of accommodation.
            $checkavailableday = $this->input->post('check');
            $update_calendar = $this->accommodation_cal($checkavailableday); // function return the calendar selected.
            $cal_id = $this->input->post("cal_id");
            $update_ficility = $this->input->post('txtFaciliti');
            
            $data['rt']         = $update_accommodation['acc_rt_id']; 
            $data['clf']        = $update_accommodation['classification_id'];
            $data['lc']         = $update_accommodation['location_id']; 
            $data['ftv']        = $update_accommodation['acc_ftv_id'];
            $data['spl']        = $update_accommodation['acc_supplier_id'];
            $data['chosimg']    = $update_accommodation['photo_id']; 
            $data['orContract'] = $update_accommodation['acc_hoteldate'];
            $data['payed']      = $update_accommodation['acc_payeddate'];
            $data['deadline']   = $update_accommodation['acc_deadline'];
            $data['status']     = $update_accommodation['acc_status'];
            $data['txtadmin']   = $update_accommodation['acc_admintext'];

            if($checkavailableday[0] == "1_everyday"){$everyday = 1; }else{ $everyday = 0; }
            if($checkavailableday[0] != "" and count($checkavailableday) > 0) $data['dayavailable'] = array($everyday,$update_calendar['monday'],$update_calendar['tuesday'],$update_calendar['wednesday'],$update_calendar['thursday'],$update_calendar['friday'],$update_calendar['saturday'],$update_calendar['sunday']);
            
            $config = $this->accommodation_config(); // get the validation config  
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) { // form validation
              //  echo validation_errors();
                $this->session->set_userdata('create', show_message('<p class="error">'.'Error format! Please check your data again'.'</p>', 'error'));
                MU_Model::deleted_sub($acc_id);
                $this->load->view('munich_admin', $data);
            }else{ // else form validation
                if( $this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice')) AND $checkavailableday[0] != ""){
                    $acc_update = $this->mod_accommodation->updateAccommodation($update_accommodation, $acc_id);
                    $ficility_update = $this->mod_accommodation->insertFacilitiesForUpdate($update_ficility, $accomodation_id);
                    $date_available =  $this->mod_accommodation->updateDateTime($update_calendar, $cal_id);
                    // if($date_available)$conjection = $this->mod_accommodation->updateFacilities($update_ficility, $acc_update);
                    if($date_available){ 
                        $this->add_sub_ep($acc_id);
                        $this->session->set_userdata('create', show_message('<p>'.'Accommodation was submited successfully ...'.'</p>', 'success'));
                        // redirect('accommodation/list_record');
                        redirect('accommodation/view_accommodation/'.$acc_id);
                    }else{
                        MU_Model::deleted_sub($acc_id);
                        $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                        $this->load->view('munich_admin', $data);
                    }
               }else{
                    MU_Model::deleted_sub($acc_id);
                    $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                    $this->load->view('munich_admin', $data);
               } // end check money and 
            } // form validation
        }else{ // else btn savechange
            $this->load->view('munich_admin', $data);
        } // btn savechange
    } // function view_accommodation
}
    /*
    * public function add_sub_ep
    * @param $acc_id (int)
    * insert record into table (accommodation, available_calendar, acc_calendar, extra_acc)
    * return while success add
    */
    function add_sub_ep($acc_id){
    if ($this->check_user_session()) {
        if($this->session->userdata('have_sub')){
            $tempsub = $this->mod_accommodation->get_temp_accommodation($acc_id);
            $tempsub = $tempsub->result();
            foreach($tempsub as $val){
                $tempsub = unserialize($val->tmpt_value);
                if(count($tempsub) > 0){
                    $acc_insert = $this->mod_accommodation->createAccommodation($tempsub[0]);
                    $date_available =  $this->mod_accommodation->insertDateTime($tempsub[1]);
                    $records_conjection =  $this->mod_accommodation->insertAccDateTime($acc_insert, $date_available);
                }
            }
        }

        if($this->session->userdata('have_extra')){
            $tempep = $this->mod_accommodation->get_temp_extrapro($acc_id);
            $old_id = 0;
            foreach($tempep->result() as $val){
                if(is_numeric($val->tmpt_value) and $val->tmpt_value != $old_id){
                    $insert = $this->mod_accommodation->insertExtra_acc($val->tmpt_value, $acc_id);
                    $old_id = $val->tmpt_value;
                }
            }
        }
        MU_Model::deleted_sub($acc_id);
        $this->session->unset_userdata('have_sub');
        $this->session->unset_userdata('have_extra');    
    }
}
    /*
    * public function add_subaccommodation
    * @noparam 
    * @notable
    * @access from manage.js (ajax)
    * echo boolean
    */
    function add_subaccommodation(){
    if ($this->check_user_session()) {
        $sub_accommodation = $this->accommodation_variable(); // function return the valude variable of accommodation.
        $sub_accommodation['acc_subof'] = $this->input->post('acc_subof');
        $sub_accommodation['acc_cherge_subacc'] = $this->input->post('chergeby');
        $checkavailableday = $this->input->post('check_sub');
        $subacc_calendar = $this->accommodation_cal($checkavailableday); // function return the calendar selected.
        $config = $this->accommodation_config();
        array_push($config, array('field' => 'chergeby','label' => 'cherge by','rules' => 'trim|required'));
        $data['get_facility'] = $this->mod_accommodation->getFacility();
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){
            echo "required";
        }else{
            $value_serialize = array($sub_accommodation, $subacc_calendar,"facilities_id" => $this->input->post('txtFaciliti'));
            $insertTemp['tmpt_value'] = serialize($value_serialize);
            $insertTemp['tmpt_id'] = $sub_accommodation['acc_subof'];
            $insertTemp['tmpt_name'] = "acc";
            $result = MU_Model::insertToTempTable($insertTemp);
            if($result > 0){
                echo '<tr class="temp removet'.$result.'">
                    <td>'.$result.'</td>
                    <td>'.character_limiter($sub_accommodation['acc_name'], 7).'</td>
                    <td>'.$subacc_calendar['start_date'].'</td>
                    <td>'.$subacc_calendar['end_date'].'</td>
                    <td>'.$sub_accommodation['acc_purchaseprice'].'</td>
                    <td>'.$sub_accommodation['acc_saleprice'].'</td>
                    <td>'.$sub_accommodation['acc_originalstock'].'</td>
                    <td>'.$sub_accommodation['acc_actualstock'].'</td>
                    <td>'
                        .anchor('accommodation/detail_accommodation/temp/'.$result, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#accommodationViewModal"></span>','class="eachAccommodationSubView"').
                        ' | '.
                        anchor('accommodation/delete_accommodation/temp/'.$result, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip" data-remove="removet'.$result.'" class="deleteEACHaccommodation"').
                    '</td>
                    </tr>';
                $this->session->set_userdata('have_sub', true);
            }else{
                echo 'required';
            }
        }
    }
}
    /*
    *  public function delete_accommodation
    *  @noparam
    *  @access manage.js
    *  return true or false
    */
    public function delete_accommodation(){
    if ($this->check_user_session()) {
        if($this->uri->segment(3) == "temp"){
            $id = $this->uri->segment(4);
            $result = MU_Model::deletedRecordById("temp_table",array("ID"=>$id));
        }else{
            $id = $this->uri->segment(3);
            $result = MU_Model::deletedRecordById("accommodation",array("acc_id"=>$id));
        }
        if($result) echo 't';
    }
}
    /*
    * public function add_extraproduct
    * @noparam
    * @table extraproduct
    * @access from manage.js
    * echo table row of table to append in front page
    */
    public function add_extraproduct(){
    if ($this->check_user_session()) {
        $ep_id = $this->input->post('txtExtra');
        $expro = $this->mod_accommodation->getExproductById($ep_id);
        if($expro->num_rows() > 0){
            $insertTemp['tmpt_value'] = $ep_id;
            $insertTemp['tmpt_id'] = $this->input->post('acc_subof');
            $insertTemp['tmpt_name'] = "extraproduct";
            $result = MU_Model::insertToTempTable($insertTemp);

            foreach($expro->result() as $value){
                echo '<tr class="temp removeept'.$value->ep_id.'">
                    <td>'.$value->ep_id.'</td>
                    <td>'.character_limiter($value->ep_name, 7).'</td>
                    <td>'.$value->start_date.'</td>
                    <td>'.$value->end_date.'</td>
                    <td>'.$value->ep_purchaseprice.'</td>
                    <td>'.$value->ep_saleprice.'</td>
                    <td>'.$value->ep_originalstock.'</td>
                    <td>'.$value->ep_actualstock.'</td>
                    <td>'
                        .anchor('accommodation/detail_extraproduct/temp/'.$value->ep_id, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#accommodationViewModal"></span>','class="extraModalview"').
                        ' | '.
                        anchor('accommodation/delete_extraproduct/temp/'.$result, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-remove=".removeept'.$value->ep_id.'" class="deleteEACHextraproduct" data-toggle="tooltip" id="tooltip"').
                    '</td>
                    </tr>';
                $this->session->set_userdata('have_extra', true);
            }
        }else{
            echo "no record was found.";
        }
    }
}
    /*
    *  public function delete_extraproduct
    *  @noparam
    *  @access manage.js
    *  return true or false
    */
    public function delete_extraproduct(){
    if ($this->check_user_session()) {
        if($this->uri->segment(3) == "temp"){
            $id = $this->uri->segment(4);
            $result = MU_Model::deletedRecordById("temp_table",array("ID" => $id));
        }else{
            $id = $this->uri->segment(3);
            $result = MU_Model::deletedRecordById("extra_acc",array("extraproduct_id" => $id));
        }
        if($result) echo 't';
    }
}
    /*
    * public funciton deleted_sub
    * @noparam
    * @table  temp_table
    * return boolean
    * deleted subaccommodation and extraproduct 
    */
    public function deleted_sub(){
    if ($this->check_user_session()) {
        $acc_id = $this->input->post('acc_id');
        if(! $this->session->userdata('have_sub') OR ! $this->session->userdata('have_extra')){
            $result = MU_Model::deleted_sub($acc_id);
            if($result){
                echo 't';
            }
        }
        $this->session->unset_userdata('have_sub');
        $this->session->unset_userdata('have_extra');
    }
}
    /*
    * public function accommodation_config
    * @noparam
    * return config (array)
    */
    public function accommodation_config(){
    if ($this->check_user_session()) {
        $config = array(
            array('field' => 'accommodationName','label' => 'Accommodation Name','rules' => 'trim|required'),
            // array('field' => 'txtchoiceItem','label' => 'Choice Item','rules' => 'trim|required'),
            array('field' => 'txtFrom','label' => 'From Date', 'rules' => 'trim|required'),
            array('field' => 'txtTo','label' => 'End Date','rules' => 'trim|required'),
            array('field' => 'txtStartTime','label' => 'start time','rules' => 'trim|required' ),
            array('field' => 'txtEndTime','label' => 'end time', 'rules' => 'trim|required' ),
            array('field' => 'txtRoom','label' => 'Room Type','rules' => 'trim|required'),
            array('field' => 'txtClassification','label' => 'Classification','rules' => 'trim|required'),
            array('field' => 'txtLocation','label' => 'Location','rules' => 'trim|required'),
            array('field' => 'txtFastival','label' => 'fastival','rules' => 'trim|required'),
            array('field' => 'txtSupplier','label' => 'supplier','rules' => 'trim|required'),
            array('field' => 'txtPhotos', 'label' => 'Photo','rules' => 'trim|required'),
            array('field' => 'txtEticket','label' => 'Text for E-Ticket','rules' => 'trim|required'),
            array('field' => 'txtBooking','label' => 'booking text','rules' => 'trim|required'),
            array('field' => 'purchasePrice','label' => 'Purchase Price','rules' => 'trim|required'),
            array('field' => 'salePrice','label' => 'Sale Price','rules' => 'trim|required'),
            array('field' => 'originalStock','label' => 'Original Stock','rules' => 'trim|required|numeric' ),
            array('field' => 'actualStock', 'label' => 'Actual Stock','rules' => 'trim|required|numeric'),
            // array('field' => 'txtFaciliti', 'label' => 'Facility','rules' => 'trim|required'),
        );
        return $config;
    }
}
    /*
    * public function accommodation_variable
    * @noparent
    * return $accommodation (array)
    */
    public function accommodation_variable(){
    if ($this->check_user_session()) {
        $accommodation['acc_name']          = $this->input->post('accommodationName');
        // $accommodation['acc_choiceitem']    = $this->input->post('txtchoiceItem');
        $accommodation['acc_rt_id']       = $this->input->post('txtRoom');
        $accommodation['classification_id']       = $this->input->post('txtClassification');
        $accommodation['location_id']       = $this->input->post('txtLocation');
        $accommodation['acc_ftv_id']        = $this->input->post('txtFastival');
        $accommodation['acc_supplier_id']   = $this->input->post('txtSupplier');
        $accommodation['acc_admintext']     = $this->input->post('txtAdmin');
        $accommodation['photo_id']          = $this->input->post('txtPhotos');
        $accommodation['acc_saleprice']     = $this->input->post('salePrice');
        $accommodation['acc_purchaseprice'] = $this->input->post('purchasePrice');
        $accommodation['acc_bookingtext']   = $this->input->post('txtBooking');
        $accommodation['acc_texteticket']   = $this->input->post('txtEticket');
        $accommodation['acc_originalstock'] = $this->input->post('originalStock');
        $accommodation['acc_actualstock']   = $this->input->post('actualStock');
        $accommodation['acc_hoteldate'] = $this->input->post('contract');
        $accommodation['acc_payeddate']     = $this->input->post('txtPayed');
        $accommodation['acc_deadline']      = $this->input->post('txtDeadline');
        $accommodation['acc_status']        = $this->input->post('txtStatus');
        return $accommodation;
    }
}
    /*
    * public function accommodation_cal
    * @param $checkavailableday (array)
    * return calendar_selected (array)
    */
    public function accommodation_cal($checkavailableday){
    if ($this->check_user_session()) {
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
}
    /*
    *public function deleteAccommodationById
    *@param $accommodation (int)
    *@param $pagination
    */
    //delete accommodation by id
    public function deleteAccommodationById($accommodation_id,$pagination = false){
    if ($this->check_user_session()) {
  	    $total_count = MU_Model::count_all_data('accommodation',array('acc_deleted' => 0));
  	    $delete_accommodation = MU_Model::deleteRecordById('accommodation',array("acc_deleted" => 1) ,array('acc_id' => $accommodation_id));
  	    if($delete_accommodation){
  		    redirect(strtolower(get_class()).'/list_record');
  	    }
    }	 
}
    //end delete accommodation by id
    
    /*
    *public function deleteMultiAccommodation
    *noparam
    */
    //delete multiple accommodation
    public function deleteMultiAccommodation(){
    if ($this->check_user_session()) {
	    $multiCheck = $this->input->post("check_checkbox");
	    $update['acc_deleted'] = 1;
	    $result = $this->mod_accommodation->deleteMultipleAccommodation($update,$multiCheck);
	    if($result > 0){
            $this->session->set_userdata('msg_success', 'The accommodation have been deleted successfully.');
                echo "t";
        }else{
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name accommodation.');
            echo "f";
        }
    }
}
    //end of delete multiple accommodation

    /*
    *public function deletePermenentAccommodation
    *noparam
    */
    /* delete permenent accommodation */
    public function deletePermenentAccommodation() {
    if ($this->check_user_session()) {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_accommodation->deletePermenentAcc($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The accommodation have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The accommodation record can not delete from table');
            echo "f";
        }
    }
}
    /* end delete permenent accommodation */

    //For print pdf  and excel
    /*
    *public function exportPDF
    *noparam
    */
    public function exportPDF() {
    if ($this->check_user_session()) {          
        $this->load->helper('pdf_helper');
        $data['accommodation'] = $this->mod_accommodation->exportAllDatas('accommodation');
        $this->load->view('include/BE/accommodation/pdfexport', $data);
    }
}
    /*
    *public function exportExcel
    *noparamm
    */
    public function exportExcel() {   
    if ($this->check_user_session()) {        
        $data['accommodation'] = $this->mod_accommodation->exportAllDatas('accommodation');
        $this->load->view('include/BE/accommodation/excelexport', $data);
    }
}
    /*
    *public function exportByPagePDF
    *noparam
    */
    public function exportByPagePDF(){
    if ($this->check_user_session()) {
        $this->load->helper('pdf_helper');
        $checkex = $this->input->post("check_checkbox");
        
        if($this->uri->segment(3) == "search_accommodation"){
            $exportpage['accommodation'] = $this->getRecordAccommodation();
        }else{
            $exportpage['accommodation'] = $this->mod_accommodation->exportDataPage($checkex);
        }
        $this->load->view('include/BE/accommodation/pdfexport', $exportpage);
        }
    }
    /*
    *public function exportByPageExcel
    *noparam
    */
    public function exportByPageExcel(){ 
    if ($this->check_user_session()) {     
        $checkex = $this->input->post("check_checkbox");
        
        if($this->uri->segment(3) == "search_accommodation"){
            $exportpage['accommodation'] = $this->getRecordAccommodation();
        }else{
            $exportpage['accommodation'] = $this->mod_accommodation->exportDataPage($checkex);
        }
        $this->load->view('include/BE/accommodation/excelexport', $exportpage);
    }
}
    /*
    *public function getRecordAccommodation
    *noparam
    */
    public function getRecordAccommodation(){
    if ($this->check_user_session()) {
        if($this->session->userdata("from_date")){ $fromdate = $this->session->userdata("from_date"); }else{ $fromdate = ""; }
        if($this->session->userdata("end_date")){ $enddate = $this->session->userdata("end_date"); }else{ $enddate = ""; }
        if($this->session->userdata("accommodation_name")){$name = $this->session->userdata("accommodation_name"); }else{ $name = ""; }
        $record = $this->mod_accommodation->getSearchAccommodationExport($fromdate, $enddate, $name);
        if ($record->num_rows() > 0) {
            foreach ($record->result() as $data) {
                $datas[] = $data;
            }           
            return $datas;
        }   
    }
}
    /*
    *public function exportDataPage
    *noparam
    */
    public function exportDataPage(){
    if ($this->check_user_session()) {
    $query = $this->db
        ->select('*')
        ->from('accommodation')
        ->where('acc_deleted',0)
        ->join('room_types', 'room_types.rt_id = accommodation.acc_rt_id', 'left')
        ->join('classification', 'classification.clf_id = accommodation.classification_id', 'left')
        ->join('location', 'location.lt_id = accommodation.location_id', 'left')
        ->join('acc_calendar','accommodation.acc_id = acc_calendar.accomodations_id')
        ->join('calendar_available','calendar_available.ca_id = acc_calendar.calendar_available_id')
        ->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $record) {
                $data[] = $record;
            }
            return $data;
        }
        return FALSE;
    }
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */