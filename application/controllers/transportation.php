<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transportation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_transportation'));
    }

    /*
    * public fucntion list_record
    * @noparam
    * Display perpage 10
    * MU_Model.php {count_all_data()}
    * Conbine with sort column (id, transportation name, start date, end date)
    * mod_transportation.php {list_transportation()}
    * show the list of the transportation
    */

    public function list_record() {
        $data['title'] = "Transportation";
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
        $config['total_rows'] = MU_Model::count_all_data('transportation', array('tp_deleted' => 0,'tp_subof'=> 0));
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
        $data['transportation'] = $this->mod_transportation->list_transportation($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
    }
    /*
    *   @: searching of from date, end date and name of transportation
    */

    public function search_transportation() {
            $data['title'] = "Search Transportation";
            $data['dashboard'] = "management";
            $controller = $this->uri->segment(1);
            $function = 'search_transportation';
			if($this->input->post('search_from_date')){ $this->session->set_userdata('from_date', $this->input->post('search_from_date'));}else{$this->session->set_userdata('from_date', "");}
        	if($this->input->post('search_end_date')){ $this->session->set_userdata("end_date", $this->input->post('search_end_date')); }else{ $this->session->set_userdata("end_date", ""); }
        	if($this->input->post('search_transportation_name')){$this->session->set_userdata("transportation_name", $this->input->post('search_transportation_name'));}else{ $this->session->set_userdata("transportation_name", "");}
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
            $config['total_rows'] = MU_Model::count_all_transportation($this->session->userdata("from_date"), $this->session->userdata("end_date"), $this->session->userdata("transportation_name"));
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
            $data['search_transportation'] = $this->mod_transportation->getSearchTransportation($config['per_page'],$page, $sortby, $data['sort'],$this->session->userdata("from_date"), $this->session->userdata("end_date"), $this->session->userdata("transportation_name"));
			$data['pagination'] = $this->pagination->create_links();
            $this->load->view('munich_admin', $data); 
    }

    /*
    * public function detail_transportation
    * @noparam
    * @access from ajax
    * @echo record 
    * mod_transportation.php {detail_transportation(@param)}
    */

    public function detail_transportation() {
        $data['title'] = "View Transportation";
        $data['dashboard'] = "management";
        if($this->uri->segment(3) == "temp"){
           $get_id = $this->uri->segment(4);
           $tempsub = $this->mod_transportation->detail_temp_transportation($get_id);
           $tempsub = $tempsub->result();
           foreach($tempsub as $val){
                $tempsub = unserialize($val->tmpt_value);
           }
           $data['detail_transportation'] = array_merge($tempsub[0],$tempsub[1]);
        }else{
           $get_id = $this->uri->segment(3);
           $detail_transportation = $this->mod_transportation->detail_transportation($get_id);
           // $detail_transportation = $detail_transportation->result();
           foreach($detail_transportation->result() as $val){
                $data['detail_transportation'] = json_decode(json_encode($val), true);
           }
        }
        if(count($data['detail_transportation']) > 0){
            $date_available = "";
            $date_available = '<label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_transportation']['monday'])).' Mon</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_transportation']['tuesday'])).' Tue</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_transportation']['wednesday'])).' Wed</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_transportation']['thursday'])).' Thu</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_transportation']['friday'])).' Fri</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_transportation']['saturday'])).' Sat</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" => $data['detail_transportation']['sunday'])).' Sunday</label>
            ';
            $lt_name  = isset($data['detail_transportation']['lt_name'])? $data['detail_transportation']['lt_name'] : MU_Model::getForiegnTableName("location", array("lt_deleted"=>0, "lt_id"=>$data['detail_transportation']['tp_pickuplocation']), "lt_name");
            $ftv_name = isset($data['detail_transportation']['ftv_name'])? $data['detail_transportation']['ftv_name'] : MU_Model::getForiegnTableName("festival", array("ftv_deleted"=> 0, "ftv_id"=>$data['detail_transportation']['tp_ftv_id']), "ftv_name");
            $spl_name = isset($data['detail_transportation']['sup_company_name'])? $data['detail_transportation']['sup_company_name'] : MU_Model::getForiegnTableName("supplier", array("sup_deleted"=> 0, "sup_id"=>$data['detail_transportation']['tp_supplier_id']), "sup_company_name");
            $pho_source = isset($data['detail_transportation']['pho_source'])? $data['detail_transportation']['pho_source'] : MU_Model::getForiegnTableName("photo", array("pho_delete"=> 0, "photo_id"=>$data['detail_transportation']['photo_id']), "pho_source");

            $records = '<table class="table table-bordered"><tr><th>Transportation Name</th> <td>'.$data['detail_transportation']['tp_name'].'</td></tr>
            <tr><th>From Date</th><td>'.$data['detail_transportation']['start_date'].'</td></tr>
            <tr><th>To Date</th> <td>'.$data['detail_transportation']['end_date'].'</td></tr>
            <tr><th>Date available</th> <td>'.$date_available.'</td></tr>
            <tr><th>Time </th> <td>'.$data['detail_transportation']['start_time'].' to '.$data['detail_transportation']['end_time'].'</td></tr>            
            <tr><th>Arrival Date </th> <td>'.$data['detail_transportation']['tp_arrival_date'].'</td></tr>
            <tr><th>Location </th> <td>'.$lt_name.'</td></tr>
            <tr><th>Festival </th> <td>'.$ftv_name.'</td></tr>
            <tr><th>Supplier </th> <td>'.$spl_name.'</td></tr>
            <tr><th>Photo </th> <td>'.img(array("src" => "user_uploads/thumbnail/original/".$pho_source,"alt"=>$pho_source,"class"=>"tp_img")).'</td></tr>
            <tr><th>Purchase Price </th> <td>'.$data['detail_transportation']['tp_purchaseprice'].' $</td></tr>
            <tr><th>Sale Price </th> <td>'.$data['detail_transportation']['tp_saleprice'].' $</td></tr>
            <tr><th>Original Stock </th> <td>'.$data['detail_transportation']['tp_originalstock'].'</td></tr>
            <tr><th>Actual Stock </th> <td>'.$data['detail_transportation']['tp_actualstock'].'</td></tr>
            <tr><th>Date Contract </th> <td>'.$data['detail_transportation']['tp_providerdate'].'</td></tr>
            <tr><th>Paid Date </th> <td>'.$data['detail_transportation']['tp_payeddate'].'</td></tr>
            <tr><th>Deadline </th> <td>'.$data['detail_transportation']['tp_deadline'].'</td></tr>
            <tr><th>E-Ticket Text </th> <td>'.$data['detail_transportation']['tp_texteticket'].'</td></tr>
            <tr><th>Booking Text </th> <td>'.$data['detail_transportation']['tp_textbooking'].'</td></tr>
            <tr><th>Admin Text </th> <td>'.$data['detail_transportation']['tp_admintext'].'</td></tr>
            </table>';
          echo $records;
        }
    }
   /*
    * public function detail_extraproduct
    * @noparam
    * @access from ajax (manage.js)
    * @echo record 
    * mod_transportation.php {detail_extraproduct(@param)}
    */

    public function detail_extraproduct() {
        $data['title'] = "View Transportation";
        $data['dashboard'] = "management";
        if($this->uri->segment(3) == "temp"){
    	   $get_id = $this->uri->segment(4);
        }else{
           $get_id = $this->uri->segment(3);
        }
        $ep_record  = $this->mod_transportation->getExproductById($get_id);
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

            $records = '<table class="table table-bordered"><tr><th>Extra Product Name</th> <td>'. $detail_extraproduct['ep_name'].'</td></tr>
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

    /*
    * pulic function status_transportation
    * @param $tp_status (int)
    * @param $tp_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function status_transportation ($tp_status, $tp_id, $pagione = false, $pagitwo = false, $pagithree = false){
        $total_rows = MU_Model::count_all_data('transportation', array('tp_deleted' => 0));
        $tp_status = ($tp_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('transportation', array("tp_status" => $tp_status), array('tp_id' => $tp_id));
        $pagi = "";
        if($this->session->userdata('search')){ $function = "search_transportation"; }else{ $function = "list_record"; } 
        if($pagione != false) $pagi = $pagione;
        if($pagitwo != false) $pagi .= "/".$pagitwo;
        if($pagithree != false) $pagi .= "/".$pagithree;
          $redirect = "transportation/".$function."/".$pagi; 
          $tp_msg = ($tp_status == 1) ? "Published" : "Unpublished";
        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The transportation have been '.$tp_msg.' successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$tp_msg.' record on table name transportation.');
            redirect($redirect);
        }
    }

    /* 
    * public function is_money
    * @param $price
    * check money for add new transportation 
    * return true or false
    */

    public function is_money($price) {
      return preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $price);
    }

    /* 
    * public function add_transportation
    * @noparam
    * @validation
    * @loadview
    * @insert record.
    */

    public function add_transportation() {
        $data['title'] = "Add New Transportation";
        $data['dashboard'] = "management";
        // $data['txtchoiceItem'] = array(''=>"please select...",'1' => 'Yes', '0' => 'No');
        $data['txtLocation'] = $this->mod_transportation->getLocation();
        $data['txtFastival'] = $this->mod_transportation->getFastival();
        $data['txtSupplier'] = $this->mod_transportation->getSupplier();
        $data['txtPhotos'] = $this->mod_transportation->getPhotos();
        $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        // for catch value 
        // $data['choice']   = '';
        $data['lc']       = ''; 
        $data['ftv']      = '';
        $data['spl']      = '';
        $data['chosimg']  = ''; 
        $data['orContract'] =  '';
        $data['payed']    = '';
        $data['deadline'] = '';
        $data['txtArrivalDate'] = '';
        $data['txtadmin'] = '';
        $data['status'] = '';
        $data['dayavailable'] = array(0,0,0,0,0,0,0,0);
              // $session = $this->session->set_userdata($data);

        if ($this->input->post('addTransportation')) {

            $insert_transportation = $this->transportation_variable(); // function return the valude variable of transportation.
            $checkavailableday = $this->input->post('check');
            $insert_calendar = $this->transportation_cal($checkavailableday); // function return the calendar selected.

            // for catch value 
            $data['lc']         = $insert_transportation['tp_pickuplocation']; 
            $data['ftv']        = $insert_transportation['tp_ftv_id'];
            $data['spl']        = $insert_transportation['tp_supplier_id'];
            $data['chosimg']    = $insert_transportation['photo_id']; 
            $data['orContract'] = $insert_transportation['tp_providerdate'];
            $data['payed']      = $insert_transportation['tp_payeddate'];
            $data['deadline']   = $insert_transportation['tp_deadline'];
            $data['txtArrivalDate'] = $insert_transportation['tp_arrival_date'];
            $data['status']     = $insert_transportation['tp_status'];
            $data['txtadmin']   = $insert_transportation['tp_admintext'];

            if($checkavailableday[0] == "1_everyday"){$everyday = 1; }else{ $everyday = 0; }
            if($checkavailableday[0] != "" and count($checkavailableday) > 0) $data['dayavailable'] = array($everyday,$insert_calendar['monday'],$insert_calendar['tuesday'],$insert_calendar['wednesday'],$insert_calendar['thursday'],$insert_calendar['friday'],$insert_calendar['saturday'],$insert_calendar['sunday']);
            
            $config = $this->transportation_config(); // get the validation config  
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) { // form validation
                $this->session->set_userdata('create', show_message('<p class="error">'.'Error format! Please check your data again'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
            }else{ // else form validation
                if( $this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice')) AND $checkavailableday[0] != ""){
                    $tp_insert = $this->mod_transportation->createTransportation($insert_transportation);
                    if($tp_insert) $date_available =  $this->mod_transportation->insertDateTime($insert_calendar);
                    if($date_available) $records_conjection =  $this->mod_transportation->insertTpDateTime($tp_insert, $date_available);
                    if(isset($records_conjection)){ 
                        $this->session->set_userdata('create', show_message('<p>'.'Transportation was submited successfully ...'.'</p>', 'success'));
                        //redirect('transportation/add_transportation');
                        redirect('transportation/view_transportation/'.$tp_insert);
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
    } // function add_transportation

    /* 
    * public function view_transportation
    * @noparam
    * @validation
    * @loadview
    * @view record.
    * @saverecordback
    */
    public function view_transportation($tp_id) {
        $data['title'] = "View Transportation";
        $data['dashboard'] = "management";
        // $data['txtchoiceItem'] = array(''=>"please select...",'1' => 'Yes', '0' => 'No');
        $data['txtLocation'] = $this->mod_transportation->getLocation();
        $data['txtFastival'] = $this->mod_transportation->getFastival();
        $data['txtSupplier'] = $this->mod_transportation->getSupplier();
        $data['subtransportation'] = $this->mod_transportation->getSubtransportation($tp_id);        
        $data['ExtraRelatedtp'] = $this->mod_transportation->getExtraproductByTransportation($tp_id);
        $data['txtExtraProduct'] = $this->mod_transportation->getAllExtraproduct();
        $data['txtPhotos'] = $this->mod_transportation->getPhotos();
        $data['getUpdateTransportation'] = $this->mod_transportation->getUpdateTransportation($tp_id);
        $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        // for catch value 
        // $data['choice']   = '';
        $data['lc']       = ''; 
        $data['ftv']      = '';
        $data['spl']      = '';
        $data['chosimg']  = ''; 
        $data['orContract'] =  '';
        $data['payed']    = '';
        $data['deadline'] = '';
        $data['txtArrivalDate'] = '';
        $data['txtadmin'] = '';
        $data['status'] = '';
        $data['dayavailable'] = array(0,0,0,0,0,0,0,0);
        // $session = $this->session->set_userdata($data);

        if ($this->input->post('SaveChangeTransportation')) {
            $update_transportation = $this->transportation_variable(); // function return the valude variable of transportation.
            $checkavailableday = $this->input->post('check');
            $update_calendar = $this->transportation_cal($checkavailableday); // function return the calendar selected.
            $cal_id = $this->input->post("cal_id");

            // for catch value 
            // $data['choice']     = $update_transportation['tp_choiceitem'];
            $data['lc']         = $update_transportation['tp_pickuplocation']; 
            $data['ftv']        = $update_transportation['tp_ftv_id'];
            $data['spl']        = $update_transportation['tp_supplier_id'];
            $data['chosimg']    = $update_transportation['photo_id']; 
            $data['orContract'] = $update_transportation['tp_providerdate'];
            $data['payed']      = $update_transportation['tp_payeddate'];
            $data['deadline']   = $update_transportation['tp_deadline'];
            $data['txtArrivalDate'] = $update_transportation['tp_arrival_date'];
            $data['status']     = $update_transportation['tp_status'];
            $data['txtadmin']   = $update_transportation['tp_admintext'];

            if($checkavailableday[0] == "1_everyday"){$everyday = 1; }else{ $everyday = 0; }
            if($checkavailableday[0] != "" and count($checkavailableday) > 0) $data['dayavailable'] = array($everyday,$update_calendar['monday'],$update_calendar['tuesday'],$update_calendar['wednesday'],$update_calendar['thursday'],$update_calendar['friday'],$update_calendar['saturday'],$update_calendar['sunday']);
            $config = $this->transportation_config(); // get the validation config  
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) { // form validation
                $this->session->set_userdata('create', show_message('<p class="error">'.'Error format! Please check your data again'.'</p>', 'error'));
                MU_Model::deleted_sub($tp_id);
                $this->load->view('munich_admin', $data);
            }else{ // else form validation
               if( $this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice')) AND $checkavailableday[0] != ""){
                    $tp_update = $this->mod_transportation->updateTransportation($update_transportation, $tp_id);
                    $date_available =  $this->mod_transportation->updateDateTime($update_calendar, $cal_id);
                    if($date_available){ 
                        $this->add_sub_ep($tp_id);
                        $this->session->set_userdata('create', show_message('<p>'.'Transportation was submited successfully ...'.'</p>', 'success'));
                        // redirect('transportation/list_record');
                        redirect('transportation/view_transportation/'.$tp_id);
                    }else{
                        MU_Model::deleted_sub($tp_id);
                        $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                        $this->load->view('munich_admin', $data);
                    }
               }else{
                    MU_Model::deleted_sub($tp_id);
                    $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                    $this->load->view('munich_admin', $data);
               } // end check money and 
            } // form validation
        }else{ // else btn savechange
            $this->load->view('munich_admin', $data);
        } // btn savechange
    } // function view_transportation

    /*
    * public function add_sub_ep
    * @param $tp_id (int)
    * insert record into table (transportation, available_calendar, tp_calendar, extra_transport)
    * return while success add
    */
    function add_sub_ep($tp_id){
        if($this->session->userdata('have_sub')){
            $tempsub = $this->mod_transportation->get_temp_transportation($tp_id);
            $tempsub = $tempsub->result();
            foreach($tempsub as $val){
                $tempsub = unserialize($val->tmpt_value);
                if(count($tempsub) > 0){
                    $tp_insert = $this->mod_transportation->createTransportation($tempsub[0]);
                    $date_available =  $this->mod_transportation->insertDateTime($tempsub[1]);
                    $records_conjection =  $this->mod_transportation->insertTpDateTime($tp_insert, $date_available);
                }
            }
        }

        if($this->session->userdata('have_extra')){
            $tempep = $this->mod_transportation->get_temp_extrapro($tp_id);
            $old_id = 0;
            foreach($tempep->result() as $val){
                if(is_numeric($val->tmpt_value) and $val->tmpt_value != $old_id){
                    $insert = $this->mod_transportation->insertExtra_tp($val->tmpt_value, $tp_id);
                    $old_id = $val->tmpt_value;
                }
            }
        }
        MU_Model::deleted_sub($tp_id);
        $this->session->unset_userdata('have_sub');
        $this->session->unset_userdata('have_extra');    
    }

    /*
    * public function add_subtransportation
    * @noparam 
    * @notable
    * @access from manage.js (ajax)
    * echo boolean
    */

    function add_subtransportation(){
        $sub_transportation = $this->transportation_variable(); // function return the valude variable of transportation.
        $sub_transportation['tp_subof'] = $this->input->post('tp_subof');
        $sub_transportation['tp_cherge_subtp'] = $this->input->post('chergeby');
        $checkavailableday = $this->input->post('check_sub');
        $subtp_calendar = $this->transportation_cal($checkavailableday); // function return the calendar selected.
        $config = $this->transportation_config();
        array_push($config, array('field' => 'chergeby','label' => 'cherge by','rules' => 'trim|required'));
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){
            echo "required";
        }else{
            $value_serialize = array($sub_transportation, $subtp_calendar);
            $insertTemp['tmpt_value'] = serialize($value_serialize);
            $insertTemp['tmpt_id'] = $sub_transportation['tp_subof'];
            $insertTemp['tmpt_name'] = "tp";
            $result = MU_Model::insertToTempTable($insertTemp);
            if($result > 0){
                echo '<tr class="temp removet'.$result.'">
                    <td>'.$result.'</td>
                    <td>'.character_limiter($sub_transportation['tp_name'], 7).'</td>
                    <td>'.$subtp_calendar['start_date'].'</td>
                    <td>'.$subtp_calendar['end_date'].'</td>
                    <td>'.$sub_transportation['tp_purchaseprice'].'</td>
                    <td>'.$sub_transportation['tp_saleprice'].'</td>
                    <td>'.$sub_transportation['tp_originalstock'].'</td>
                    <td>'.$sub_transportation['tp_actualstock'].'</td>
                    <td>'
                        .anchor('transportation/detail_transportation/temp/'.$result, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#transportationViewModal"></span>','class="eachTransportationSubView"').
                        ' | '.
                        anchor('transportation/delete_transportation/temp/'.$result, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip" data-remove="removet'.$result.'" class="deleteEACHtransportation"').
                    '</td>
                    </tr>';
                $this->session->set_userdata('have_sub', true);
            }else{
                echo 'required';
            }
        }
    }

    /*
    *  public function delete_transportation
    *  @noparam
    *  @access manage.js
    *  return true or false
    */
    public function delete_transportation(){
        if($this->uri->segment(3) == "temp"){
            $id = $this->uri->segment(4);
            $result = MU_Model::deletedRecordById("temp_table",array("ID"=>$id));
        }else{
            $id = $this->uri->segment(3);
            $result = MU_Model::deletedRecordById("transportation",array("tp_id"=>$id));
        }
        if($result) echo 't';
    }

    /*
    * public function add_extraproduct
    * @noparam
    * @table extraproduct
    * @access from manage.js
    * echo table row of table to append in front page
    */
    public function add_extraproduct(){
        $ep_id = $this->input->post('txtExtra');
        $expro = $this->mod_transportation->getExproductById($ep_id);
        if($expro->num_rows() > 0){
            $insertTemp['tmpt_value'] = $ep_id;
            $insertTemp['tmpt_id'] = $this->input->post('tp_subof');
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
                        .anchor('transportation/detail_extraproduct/temp/'.$value->ep_id, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#transportationViewModal"></span>','class="extraTpsModalview"').
                        ' | '.
                        anchor('transportation/delete_extraproduct/temp/'.$result, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-remove=".removeept'.$value->ep_id.'" class="deleteEACHextraproduct" data-toggle="tooltip" id="tooltip"').
                    '</td>
                    </tr>';
                $this->session->set_userdata('have_extra', true);
            }
        }else{
            echo "no record was found.";
        }
    }

    /*
    *  public function delete_extraproduct
    *  @noparam
    *  @access manage.js
    *  return true or false
    */
    public function delete_extraproduct(){
        if($this->uri->segment(3) == "temp"){
            $id = $this->uri->segment(4);
            $result = MU_Model::deletedRecordById("temp_table",array("ID" => $id));
        }else{
            $id = $this->uri->segment(3);
            $result = MU_Model::deletedRecordById("extra_transport",array("extraproduct_id" => $id));
        }
        if($result) echo 't';
    }

    /*
    * public funciton deleted_sub
    * @noparam
    * @table  temp_table
    * return boolean
    * deleted subtransportation and extraproduct 
    */
    public function deleted_sub(){
        $tp_id = $this->input->post('tp_id');
        if(! $this->session->userdata('have_sub') OR ! $this->session->userdata('have_extra')){
            $result = MU_Model::deleted_sub($tp_id);
            if($result){
                echo 't';
            }
        }
        $this->session->unset_userdata('have_sub');
        $this->session->unset_userdata('have_extra');
    }

    /*
    * public function transportation_config
    * @noparam
    * return config (array)
    */
    public function transportation_config(){
        $config = array(
            array('field' => 'transportationName','label' => 'Transportation Name','rules' => 'trim|required'),
            // array('field' => 'txtchoiceItem','label' => 'Choice Item','rules' => 'trim|required'),
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
            array('field' => 'txtArrivalDate', 'label' => 'Arrival Date', 'rules' => 'trim|required'),
            // array('field' => 'check', 'label' => 'available day','rules' => 'trim|required'),
        );
        return $config;
    }

    /*
    * public function transportation_variable
    * @noparent
    * return $transportation (array)
    */
    public function transportation_variable(){
        $transportation['tp_name']          = $this->input->post('transportationName');
        // $transportation['tp_choiceitem']    = $this->input->post('txtchoiceItem');
        $transportation['tp_pickuplocation']       = $this->input->post('txtLocation');
        $transportation['tp_ftv_id']        = $this->input->post('txtFastival');
        $transportation['tp_supplier_id']   = $this->input->post('txtSupplier');
        $transportation['tp_admintext']     = $this->input->post('txtAdmin');
        $transportation['photo_id']          = $this->input->post('txtPhotos');
        $transportation['tp_saleprice']     = $this->input->post('salePrice');
        $transportation['tp_purchaseprice'] = $this->input->post('purchasePrice');
        $transportation['tp_textbooking']   = $this->input->post('txtBooking');
        $transportation['tp_texteticket']   = $this->input->post('txtEticket');
        $transportation['tp_originalstock'] = $this->input->post('originalStock');
        $transportation['tp_actualstock']   = $this->input->post('actualStock');
        $transportation['tp_providerdate'] = $this->input->post('contract');
        $transportation['tp_payeddate']     = $this->input->post('txtPayed');
        $transportation['tp_deadline']      = $this->input->post('txtDeadline');
        //var_dump($transportation['tp_deadline']); die();
        $transportation['tp_arrival_date']  = $this->input->post('txtArrivalDate');
        $transportation['tp_status']        = $this->input->post('txtStatus');
        return $transportation;
    }
    /*
    * public function transportation_cal
    * @param $checkavailableday (array)
    * return calendar_selected (array)
    */
    public function transportation_cal($checkavailableday){
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

    //delete transportation by id
    public function deleteTransportationById($transportation_id,$pagination = false){
  	  $total_count = MU_Model::count_all_data('transportation',array('tp_deleted' => 0));
  	  $delete_transportation = MU_Model::deleteRecordById('transportation',array("tp_deleted" => 1) ,array('tp_id' => $transportation_id));
  	  if($delete_transportation){
  		  redirect(strtolower(get_class()).'/list_record');
  	 }
  }	 
  //end delete transportation by id
	
  //delete multiple transportation
    public function deleteMultiTransportation(){
	    $multiCheck = $this->input->post("check_checkbox");
	    $update['tp_deleted'] = 1;
	    $result = $this->mod_transportation->deleteMultipleTransportation($update,$multiCheck);
	    if($result > 0){
            $this->session->set_userdata('msg_success', 'The transportation have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name transportation.');
            echo "f";
        }
    }
    //end of delete multiple transportation

    /* delete permenent transportation */
    public function deletePermenentTransportation() {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_transportation->deletePermenentTp($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The transportation have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The transportation record can not delete from table');
            echo "f";
        }
    }

    /* end delete permenent transportation */

    //For print pdf  and excel

    public function exportPDF() {          
        $this->load->helper('pdf_helper');
        $data['transportation'] = $this->mod_transportation->exportAllDatas(' transportation');
        $this->load->view('include/BE/transportation/pdfexport', $data);
    }
    public function exportExcel() {           
        $data['transportation'] = $this->mod_transportation->exportAllDatas('transportation');
        $this->load->view('include/BE/transportation/excelexport', $data);
    }
    public function exportByPagePDF(){
        $this->load->helper('pdf_helper');
        $checkex = $this->input->post("check_checkbox");
        
        if($this->uri->segment(3) == "search_transportation"){
            $exportpage['transportation'] = $this->getRecordTransportation();
        }else{
            $exportpage['transportation'] = $this->mod_transportation->exportDataPage($checkex);
        }
        $this->load->view('include/BE/transportation/pdfexport', $exportpage);
        }
    public function exportByPageExcel(){      
        $checkex = $this->input->post("check_checkbox");
        
        if($this->uri->segment(3) == "search_transportation"){
            $exportpage['transportation'] = $this->getRecordTransportation();
        }else{
            $exportpage['transportation'] = $this->mod_transportation->exportDataPage($checkex);
        }
        $this->load->view('include/BE/transportation/excelexport', $exportpage);
    }
    public function getRecordTransportation(){
        if($this->session->userdata("from_date")){ $fromdate = $this->session->userdata("from_date"); }else{ $fromdate = ""; }
        if($this->session->userdata("end_date")){ $enddate = $this->session->userdata("end_date"); }else{ $enddate = ""; }
        if($this->session->userdata("transportation_name")){$name = $this->session->userdata("transportation_name"); }else{ $name = ""; }
        $record = $this->mod_transportation->getSearchTransportationExport($fromdate, $enddate, $name);
        if ($record->num_rows() > 0) {
            foreach ($record->result() as $data) {
                $datas[] = $data;
            }           
            return $datas;
            }   
    }
        public function exportDataPage(){
        $query = $this->db
                 ->select('*')
                 ->from('transportation')
                 ->where('tp_deleted',0)
                 ->join('supplier', 'supplier.sup_id = transportation.tp_supplier_id', 'left')
                 ->join('location', 'location.lt_id = transportation.tp_pickuplocation', 'left')
                 ->join('festival', 'festival.ftv_id = transportation.tp_ftv_id', 'left')
                 ->join('tp_calendar','transportation.tp_id = tp_calendar.transport_id','left')
                 ->join('calendar_available','calendar_available.ca_id = tp_calendar.calendar_available_id','left')
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */