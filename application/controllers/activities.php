<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activities extends MU_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_activities'));
    }

    /*
    * public fucntion list_record
    * @noparam
    * Display perpage 10
    * MU_Model.php {count_all_data()}
    * Conbine with sort column (id, activities name, start date, end date)
    * mod_actitivies.php {list_activity()}
    * show the list of the activities
    */

    public function list_record() {
    if ($this->check_user_session()) {
        $data['title'] = "Activities";
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
        $config['total_rows'] = MU_Model::count_all_data('activities', array('act_deleted' => 0, 'act_subof'=> 0));
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
        $data['acitivties'] = $this->mod_activities->list_activity($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
    }
}
    /*
    *   @: searching of from date, end date and name of activities
    */
    public function search_activities() {
    if ($this->check_user_session()) {
            $data['title'] = "Search Activities";
            $data['dashboard'] = "management";
            $controller = $this->uri->segment(1);
            $function = 'search_activities';
			if($this->input->post('search_from_date')){ $this->session->set_userdata('from_date', $this->input->post('search_from_date'));}else{$this->session->set_userdata('from_date', "");}
        	if($this->input->post('search_end_date')){ $this->session->set_userdata("end_date", $this->input->post('search_end_date')); }else{ $this->session->set_userdata("end_date", ""); }
        	if($this->input->post('search_activities_name')){$this->session->set_userdata("activities_name", $this->input->post('search_activities_name'));}else{ $this->session->set_userdata("activities_name", "");}
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
            $config['total_rows'] = MU_Model::count_all_activities($this->session->userdata("from_date"), $this->session->userdata("end_date"), $this->session->userdata("activities_name"));
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
            $data['search_activities'] = $this->mod_activities->getSearchActivities($config['per_page'],$page, $sortby, $data['sort'],$this->session->userdata("from_date"), $this->session->userdata("end_date"), $this->session->userdata("activities_name"));
	    $data['pagination'] = $this->pagination->create_links();
            $this->load->view('munich_admin', $data); 
    }
}
    /*
    * public function detail_activities
    * @noparam
    * @access from ajax
    * @echo record 
    * mod_activities.php {detail_activity(@param)}
    */

    public function detail_activities() {
    if ($this->check_user_session()) {
        $data['title'] = "View Activities";
        $data['dashboard'] = "management";
        if($this->uri->segment(3) == "temp"){
           $get_id = $this->uri->segment(4);
           $tempsub = $this->mod_activities->detail_temp_activity($get_id);
           $tempsub = $tempsub->result();
           foreach($tempsub as $val){
                $tempsub = unserialize($val->tmpt_value);
           }
           $data['detail_activities'] = array_merge($tempsub[0],$tempsub[1]);
        }else{
           $get_id = $this->uri->segment(3);
           $detail_activities = $this->mod_activities->detail_activity($get_id);
           // $detail_activities = $detail_activities->result();
           foreach($detail_activities->result() as $val){
                $data['detail_activities'] = json_decode(json_encode($val), true);
           }
        }
        if(count($data['detail_activities']) > 0){
            $date_available = "";
            $choiceItem = $data['detail_activities']['act_choiceitem'] == 1 ? "Yes" : "No";
            $date_available = '<label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_activities']['monday'])).' Mon</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_activities']['tuesday'])).' Tue</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_activities']['wednesday'])).' Wed</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_activities']['thursday'])).' Thu</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_activities']['friday'])).' Fri</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_activities']['saturday'])).' Sat</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_activities']['sunday'])).' Sunday</label>
            ';
            $lt_name  = isset($data['detail_activities']['lt_name'])? $data['detail_activities']['lt_name'] : MU_Model::getForiegnTableName("location", array("lt_deleted"=>0, "lt_id"=>$data['detail_activities']['location_id']), "lt_name");
            $ftv_name = isset($data['detail_activities']['ftv_name'])? $data['detail_activities']['ftv_name'] : MU_Model::getForiegnTableName("festival", array("ftv_deleted"=> 0, "ftv_id"=>$data['detail_activities']['act_ftv_id']), "ftv_name");
            $spl_name = isset($data['detail_activities']['sup_company_name'])? $data['detail_activities']['sup_company_name'] : MU_Model::getForiegnTableName("supplier", array("sup_deleted"=> 0, "sup_id"=>$data['detail_activities']['act_supplier_id']), "sup_company_name");
            $pho_source = isset($data['detail_activities']['pho_source'])? $data['detail_activities']['pho_source'] : MU_Model::getForiegnTableName("photo", array("pho_delete"=> 0, "photo_id"=>$data['detail_activities']['photo_id']), "pho_source");

            $records = '<table class="table table-bordered"><tr><th>Activity Name</th> <td>'.$data['detail_activities']['act_name'].'</td></tr>
            <tr><th>Choice Item</th><td>'.$choiceItem.'</td></tr>
            <tr><th>From Date</th><td>'.$data['detail_activities']['start_date'].'</td></tr>
            <tr><th>To Date</th> <td>'.$data['detail_activities']['end_date'].'</td></tr>
            <tr><th>Date available</th> <td>'.$date_available.'</td></tr>
            <tr><th>Time </th> <td>'.$data['detail_activities']['start_time'].' to '.$data['detail_activities']['end_time'].'</td></tr>
            <tr><th>Location </th> <td>'.$lt_name.'</td></tr>
            <tr><th>Festival </th> <td>'.$ftv_name.'</td></tr>
            <tr><th>Supplier </th> <td>'.$spl_name.'</td></tr>
            <tr><th>Photo </th> <td>'.img(array("src" => "user_uploads/thumbnail/original/".$pho_source,"alt"=>$pho_source,"class"=>"act_img")).'</td></tr>
            <tr><th>Purchase Price </th> <td>'.$data['detail_activities']['act_purchaseprice'].' $</td></tr>
            <tr><th>Sale Price </th> <td>'.$data['detail_activities']['act_saleprice'].' $</td></tr>
            <tr><th>Original Stock </th> <td>'.$data['detail_activities']['act_originalstock'].'</td></tr>
            <tr><th>Actual Stock </th> <td>'.$data['detail_activities']['act_actualstock'].'</td></tr>
            <tr><th>Date Contract </th> <td>'.$data['detail_activities']['act_organiserdate'].'</td></tr>
            <tr><th>Paid Date </th> <td>'.$data['detail_activities']['act_payeddate'].'</td></tr>
            <tr><th>Deadline </th> <td>'.$data['detail_activities']['act_deadline'].'</td></tr>
            <tr><th>E-Ticket Text </th> <td>'.$data['detail_activities']['act_texteticket'].'</td></tr>
            <tr><th>Booking Text </th> <td>'.$data['detail_activities']['act_bookingtext'].'</td></tr>
            <tr><th>Admin Text </th> <td>'.$data['detail_activities']['act_admintext'].'</td></tr>
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
    * mod_activities.php {detail_extraproduct(@param)}
    */

    public function detail_extraproduct() {
    if ($this->check_user_session()) {
        $data['title'] = "View Activities";
        $data['dashboard'] = "management";
        if($this->uri->segment(3) == "temp"){
    	   $get_id = $this->uri->segment(4);
        }else{
           $get_id = $this->uri->segment(3);
        }
        $ep_record  = $this->mod_activities->getExproductById($get_id);
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

            $records = '<table class="table table-bordered"><tr><th>Activity Name</th> <td>'. $detail_extraproduct['ep_name'].'</td></tr>
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
    * pulic function status_acitivties
    * @param $act_status (int)
    * @param $act_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function status_acitivties ($act_status, $act_id, $pagione = false, $pagitwo = false, $pagithree = false){
    if ($this->check_user_session()) {
        $total_rows = MU_Model::count_all_data('activities', array('act_deleted' => 0));
        $act_status = ($act_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('activities', array("act_status" => $act_status), array('act_id' => $act_id));
        $pagi = "";
        if($this->session->userdata('search')){ $function = "search_activities"; }else{ $function = "list_record"; } 
        if($pagione != false) $pagi = $pagione;
        if($pagitwo != false) $pagi .= "/".$pagitwo;
        if($pagithree != false) $pagi .= "/".$pagithree;
          $redirect = "activities/".$function."/".$pagi; 
          $act_msg = ($act_status == 1) ? "Published" : "Unpublished";
        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The activities have been '.$act_msg.' successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$act_msg.' record on table name activities.');
            redirect($redirect);
        }
    }
}
    /* 
    * public function is_money
    * @param $price
    * check money for add new activity 
    * return true or false
    */

    public function is_money($price) {
      return preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $price);
    }

    /* 
    * public function add_activities
    * @noparam
    * @validation
    * @loadview
    * @insert record.
    */

    public function add_activities() {
    if ($this->check_user_session()) {
        $data['title'] = "Add New Activities";
        $data['dashboard'] = "management";
        $data['txtchoiceItem'] = array(''=>"please select...",'1' => 'Yes', '0' => 'No');
        $data['txtLocation'] = $this->mod_activities->getLocation();
        $data['txtFastival'] = $this->mod_activities->getFastival();
        $data['txtSupplier'] = $this->mod_activities->getSupplier();
        $data['txtPhotos'] = $this->mod_activities->getPhotos();
        $data['txtStatus'] = array('' =>'--Select--','0' => 'Unpublished','1' => 'Published');
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

        if ($this->input->post('addActivity')) {

            $insert_activities = $this->activities_variable(); // function return the valude variable of activities.
            $checkavailableday = $this->input->post('check');
            $insert_calendar = $this->activities_cal($checkavailableday); // function return the calendar selected.

            // for catch value 
            $data['choice']     = $insert_activities['act_choiceitem'];
            $data['lc']         = $insert_activities['location_id']; 
            $data['ftv']        = $insert_activities['act_ftv_id'];
            $data['spl']        = $insert_activities['act_supplier_id'];
            $data['chosimg']    = $insert_activities['photo_id']; 
            $data['orContract'] =  $insert_activities['act_organiserdate'];
            $data['payed']      = $insert_activities['act_payeddate'];
            $data['deadline']   = $insert_activities['act_deadline'];
            $data['status']     = $insert_activities['act_status'];
            $data['txtadmin']   = $insert_activities['act_admintext'];
            if($checkavailableday[0] == "1_everyday"){$everyday = 1; }else{ $everyday = 0; }
            if($checkavailableday[0] != "" and count($checkavailableday) > 0) $data['dayavailable'] = array($everyday,$insert_calendar['monday'],$insert_calendar['tuesday'],$insert_calendar['wednesday'],$insert_calendar['thursday'],$insert_calendar['friday'],$insert_calendar['saturday'],$insert_calendar['sunday']);            
            $config = $this->activities_config(); // get the validation config  
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) { // form validation
                $this->session->set_userdata('create', show_message('<p class="error">'.'Error format! Please check your data again'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
            }else{ // else form validation
               if($this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice')) AND $checkavailableday[0] != ""){
                    $act_insert = $this->mod_activities->createActivities($insert_activities);
                    if($act_insert) $date_available =  $this->mod_activities->insertDateTime($insert_calendar);
                    if($date_available) $records_conjection =  $this->mod_activities->insertActDateTime($act_insert, $date_available);
                    if(isset($records_conjection)){ 
                        $this->session->set_userdata('create', show_message('<p>'.'Activity was submited successfully ...'.'</p>', 'success'));
                        //redirect('activities/add_activities');
                        redirect('activities/view_activities/'.$act_insert);
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
    } // function add_activities
}
    /* 
    * public function view_activities
    * @noparam
    * @validation
    * @loadview
    * @view record.
    * @saverecordback
    */
    public function view_activities($act_id) {
    if ($this->check_user_session()) {
        $data['title'] = "View Activities";
        $data['dashboard'] = "management";
        $data['txtchoiceItem'] = array(''=>"please select...",'1' => 'Yes', '0' => 'No');
        $data['txtLocation'] = $this->mod_activities->getLocation();
        $data['txtFastival'] = $this->mod_activities->getFastival();
        $data['txtSupplier'] = $this->mod_activities->getSupplier();
        $data['subactivities'] = $this->mod_activities->getSubactivities($act_id);        
        $data['ExtraRelatedact'] = $this->mod_activities->getExtraproductByActivities($act_id);
        $data['txtExtraProduct'] = $this->mod_activities->getAllExtraproduct();
        $data['txtPhotos'] = $this->mod_activities->getPhotos();
        $data['getUpdateActivities'] = $this->mod_activities->getUpdateActivities($act_id);
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

        if ($this->input->post('SaveChangeActivity')) {
            $update_activities = $this->activities_variable(); // function return the valude variable of activities.
            $checkavailableday = $this->input->post('check');
            $update_calendar = $this->activities_cal($checkavailableday); // function return the calendar selected.
            $cal_id = $this->input->post("cal_id");

            // for catch value 
            $data['choice']     = $update_activities['act_choiceitem'];
            $data['lc']         = $update_activities['location_id']; 
            $data['ftv']        = $update_activities['act_ftv_id'];
            $data['spl']        = $update_activities['act_supplier_id'];
            $data['chosimg']    = $update_activities['photo_id']; 
            $data['orContract'] = $update_activities['act_organiserdate'];
            $data['payed']      = $update_activities['act_payeddate'];
            $data['deadline']   = $update_activities['act_deadline'];
            $data['status']     = $update_activities['act_status'];
            $data['txtadmin']   = $update_activities['act_admintext'];

            if($checkavailableday[0] == "1_everyday"){$everyday = 1; }else{ $everyday = 0; }
            if($checkavailableday[0] != "" and count($checkavailableday) > 0) $data['dayavailable'] = array($everyday,$update_calendar['monday'],$update_calendar['tuesday'],$update_calendar['wednesday'],$update_calendar['thursday'],$update_calendar['friday'],$update_calendar['saturday'],$update_calendar['sunday']);
            $config = $this->activities_config(); // get the validation config  
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) { // form validation
                $this->session->set_userdata('create', show_message('<p class="error">'.'Error format! Please check your data again'.'</p>', 'error'));
                MU_Model::deleted_sub($act_id);
                $this->load->view('munich_admin', $data);
            }else{ // else form validation
               if( $this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice')) AND $checkavailableday[0] != ""){
                    $act_update = $this->mod_activities->updateActivities($update_activities, $act_id);
                    $date_available =  $this->mod_activities->updateDateTime($update_calendar, $cal_id);
                    if($date_available){ 
                        $this->add_sub_ep($act_id);
                        $this->session->set_userdata('create', show_message('<p>'.'Activity was submited successfully ...'.'</p>', 'success'));
                        // redirect('activities/list_record');
                        redirect('activities/view_activities/'.$act_id);
                    }else{
                        MU_Model::deleted_sub($act_id);
                        $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                        $this->load->view('munich_admin', $data);
                    }
               }else{
                    MU_Model::deleted_sub($act_id);
                    $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                    $this->load->view('munich_admin', $data);
               } // end check money and 
            } // form validation
        }else{ // else btn savechange
            $this->load->view('munich_admin', $data);
        } // btn savechange
    } // function view_activities
}
    /*
    * public function add_sub_ep
    * @param $act_id (int)
    * insert record into table (activities, available_calendar, acti_calendar, extra_acti)
    * return while success add
    */
    function add_sub_ep($act_id){
    if ($this->check_user_session()) {
        if($this->session->userdata('have_sub')){
            $tempsub = $this->mod_activities->get_temp_activity($act_id);
            $tempsub = $tempsub->result();
            foreach($tempsub as $val){
                $tempsub = unserialize($val->tmpt_value);
                if(count($tempsub) > 0){
                    $act_insert = $this->mod_activities->createActivities($tempsub[0]);
                    $date_available =  $this->mod_activities->insertDateTime($tempsub[1]);
                    $records_conjection =  $this->mod_activities->insertActDateTime($act_insert, $date_available);
                }
            }
        }

        if($this->session->userdata('have_extra')){
            $tempep = $this->mod_activities->get_temp_extrapro($act_id);
            $old_id = 0;
            foreach($tempep->result() as $val){
                if(is_numeric($val->tmpt_value) and $val->tmpt_value != $old_id){
                    $insert = $this->mod_activities->insertExtra_acti($val->tmpt_value, $act_id);
                    $old_id = $val->tmpt_value;
                }
            }
        }
        MU_Model::deleted_sub($act_id);
        $this->session->unset_userdata('have_sub');
        $this->session->unset_userdata('have_extra');    
    }
}
    /*
    * public function add_subactivities
    * @noparam 
    * @notable
    * @access from manage.js (ajax)
    * echo boolean
    */

    function add_subactivities(){
    if ($this->check_user_session()) {
        $sub_activities = $this->activities_variable(); // function return the valude variable of activities.
        $sub_activities['act_subof'] = $this->input->post('act_subof');
        $sub_activities['act_cherge_subact'] = $this->input->post('chergeby');
        $checkavailableday = $this->input->post('check_sub');
        $subact_calendar = $this->activities_cal($checkavailableday); // function return the calendar selected.
        $config = $this->activities_config();
        array_push($config, array('field' => 'chergeby','label' => 'cherge by','rules' => 'trim|required'));
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){
            echo "required";
        }else{
            $value_serialize = array($sub_activities, $subact_calendar);
            $insertTemp['tmpt_value'] = serialize($value_serialize);
            $insertTemp['tmpt_id'] = $sub_activities['act_subof'];
            $insertTemp['tmpt_name'] = "act";
            $result = MU_Model::insertToTempTable($insertTemp);
            if($result > 0){
                echo '<tr class="temp removet'.$result.'">
                    <td>'.$result.'</td>
                    <td>'.character_limiter($sub_activities['act_name'], 7).'</td>
                    <td>'.$subact_calendar['start_date'].'</td>
                    <td>'.$subact_calendar['end_date'].'</td>
                    <td>'.$sub_activities['act_purchaseprice'].'</td>
                    <td>'.$sub_activities['act_saleprice'].'</td>
                    <td>'.$sub_activities['act_originalstock'].'</td>
                    <td>'.$sub_activities['act_actualstock'].'</td>
                    <td>'
                        .anchor('activities/detail_activities/temp/'.$result, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#activitiesViewModal"></span>','class="eachActivitiesSubView"').
                        ' | '.
                        anchor('activities/delete_activities/temp/'.$result, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip" data-remove="removet'.$result.'" class="deleteEACHactivities"').
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
    *  public function delete_activities
    *  @noparam
    *  @access manage.js
    *  return true or false
    */
    public function delete_activities(){
    if ($this->check_user_session()) {
        if($this->uri->segment(3) == "temp"){
            $id = $this->uri->segment(4);
            $result = MU_Model::deletedRecordById("temp_table",array("ID"=>$id));
        }else{
            $id = $this->uri->segment(3);
            $result = MU_Model::deletedRecordById("activities",array("act_id"=>$id));
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
        $expro = $this->mod_activities->getExproductById($ep_id);
        if($expro->num_rows() > 0){
            $insertTemp['tmpt_value'] = $ep_id;
            $insertTemp['tmpt_id'] = $this->input->post('act_subof');
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
                        .anchor('activities/detail_extraproduct/temp/'.$value->ep_id, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#activitiesViewModal"></span>','class="extraModalview"').
                        ' | '.
                        anchor('activities/delete_extraproduct/temp/'.$result, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-remove=".removeept'.$value->ep_id.'" class="deleteEACHextraproduct" data-toggle="tooltip" id="tooltip"').
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
            $result = MU_Model::deletedRecordById("extra_acti",array("extraproduct_id" => $id));
        }
        if($result) echo 't';
    }
}
    /*
    * public funciton deleted_sub
    * @noparam
    * @table  temp_table
    * return boolean
    * deleted subactivities and extraproduct 
    */
    public function deleted_sub(){
    if ($this->check_user_session()) {
        $act_id = $this->input->post('act_id');
        if(! $this->session->userdata('have_sub') OR ! $this->session->userdata('have_extra')){
            $result = MU_Model::deleted_sub($act_id);
            if($result){
                echo 't';
            }
        }
        $this->session->unset_userdata('have_sub');
        $this->session->unset_userdata('have_extra');
    }
}
    /*
    * public function activities_config
    * @noparam
    * return config (array)
    */
    public function activities_config(){
    if ($this->check_user_session()) {
        $config = array(
            array('field' => 'activitiesName','label' => 'Activity Name','rules' => 'trim|required'),
            array('field' => 'txtchoiceItem','label' => 'Choice Item','rules' => 'trim|required'),
            array('field' => 'txtFrom','label' => 'From Date', 'rules' => 'trim|required'),
            array('field' => 'txtTo','label' => 'End Date','rules' => 'trim|required'),
            array('field' => 'txtStartTime','label' => 'start time','rules' => 'trim|required' ),
            array('field' => 'txtEndTime','label' => 'end time', 'rules' => 'trim|required' ),
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
            // array('field' => 'check', 'label' => 'available day','rules' => 'trim|required'),
        );
        return $config;
    }
}
    /*
    * public function activities_variable
    * @noparent
    * return $activities (array)
    */
    public function activities_variable(){
    if ($this->check_user_session()) {
        $activities['act_name']          = $this->input->post('activitiesName');
        $activities['act_choiceitem']    = $this->input->post('txtchoiceItem');
        $activities['location_id']       = $this->input->post('txtLocation');
        $activities['act_ftv_id']        = $this->input->post('txtFastival');
        $activities['act_supplier_id']   = $this->input->post('txtSupplier');
        $activities['act_admintext']     = $this->input->post('txtAdmin');
        $activities['photo_id']          = $this->input->post('txtPhotos');
        $activities['act_saleprice']     = $this->input->post('salePrice');
        $activities['act_purchaseprice'] = $this->input->post('purchasePrice');
        $activities['act_bookingtext']   = $this->input->post('txtBooking');
        $activities['act_texteticket']   = $this->input->post('txtEticket');
        $activities['act_originalstock'] = $this->input->post('originalStock');
        $activities['act_actualstock']   = $this->input->post('actualStock');
        $activities['act_organiserdate'] = $this->input->post('contract');
        $activities['act_payeddate']     = $this->input->post('txtPayed');
        $activities['act_deadline']      = $this->input->post('txtDeadline');
        $activities['act_status']        = $this->input->post('txtStatus');
        return $activities;
    }
}
    /*
    * public function activities_cal
    * @param $checkavailableday (array)
    * return calendar_selected (array)
    */
    public function activities_cal($checkavailableday){
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
    //delete activities by id
    public function deleteActivitiesById($activities_id,$pagination = false){
    if ($this->check_user_session()) {
  	  $total_count = MU_Model::count_all_data('activities',array('act_deleted' => 0));
  	  $delete_activities = MU_Model::deleteRecordById('activities',array("act_deleted" => 1) ,array('act_id' => $activities_id));
  	  if($delete_activities){
  		  redirect(strtolower(get_class()).'/list_record');
  	 }
  }	 
}
  //end delete activities by id
	
  //delete multiple activities
  public function deleteMultiActivities(){
  if ($this->check_user_session()) {
	  $multiCheck = $this->input->post("check_checkbox");
	  $update['act_deleted'] = 1;
	  $result = $this->mod_activities->deleteMultipleActivities($update,$multiCheck);
	  if($result > 0){
            $this->session->set_userdata('msg_success', 'The activities have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name activities.');
            echo "f";
        }
    }
}
    //end of delete multiple activities

    /* delete permenent activities */
    public function deletePermenentActivities() {
    if ($this->check_user_session()) {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_activities->deletePermenentActivities($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The activities have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The activities record can not delete from table');
            echo "f";
        }
    }
}
    /* end delete permenent activities */
    //For print pdf  and excel

    public function exportPDF() {
    if ($this->check_user_session()) {          
        $this->load->helper('pdf_helper');
        $data['activities'] = $this->mod_activities->exportAllDatas('activities');
        $this->load->view('include/BE/activities/pdfexport', $data);
    }
}
    public function exportExcel() { 
    if ($this->check_user_session()) {          
        $data['activities'] = $this->mod_activities->exportAllDatas('activities');
        $this->load->view('include/BE/activities/excelexport', $data);
    }
}
    public function exportByPagePDF(){
    if ($this->check_user_session()) {
        $this->load->helper('pdf_helper');
        $checkex = $this->input->post("check_checkbox");
        
        if($this->uri->segment(3) == "search_activities"){
            $exportpage['activities'] = $this->getRecordActivities();
        }else{
            $exportpage['activities'] = $this->mod_activities->exportDataPage($checkex);
        }
        $this->load->view('include/BE/activities/pdfexport', $exportpage);
        }
    }
    public function exportByPageExcel(){   
    if ($this->check_user_session()) {   
        $checkex = $this->input->post("check_checkbox");
        
        if($this->uri->segment(3) == "search_activities"){
            $exportpage['activities'] = $this->getRecordActivities();
        }else{
            $exportpage['activities'] = $this->mod_activities->exportDataPage($checkex);
        }
        $this->load->view('include/BE/activities/excelexport', $exportpage);
    }
}
    public function getRecordActivities(){
    if ($this->check_user_session()) {
        if($this->session->userdata("from_date")){ $fromdate = $this->session->userdata("from_date"); }else{ $fromdate = ""; }
        if($this->session->userdata("end_date")){ $enddate = $this->session->userdata("end_date"); }else{ $enddate = ""; }
        if($this->session->userdata("activities_name")){$name = $this->session->userdata("activities_name"); }else{ $name = ""; }
        $record = $this->mod_activities->getSearchActivitiesExport($fromdate, $enddate, $name);
        if ($record->num_rows() > 0) {
            foreach ($record->result() as $data) {
                $datas[] = $data;
            }           
            return $datas;
            }   
    }
}
        public function exportDataPage(){
        if ($this->check_user_session()) {
        $query = $this->db
                 ->select('*')
                ->from('activities')
                ->where('act_deleted',0)
                ->join('location', 'location.lt_id = activities.location_id', 'left')
                ->join('acti_calendar','activities.act_id = acti_calendar.activities_id')
                ->join('calendar_available','calendar_available.ca_id = acti_calendar.calendar_available_id')
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