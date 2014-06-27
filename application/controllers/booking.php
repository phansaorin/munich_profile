<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MU_Controller {
	
	public function __construct() {
        parent::__construct();
         $this->load->model(array('mod_booking','mod_index'));
    }
    	
	// // show of fettival
	//  public function booking(){
	//  	$fe_data['title'] = "festival";
	// 	$fe_data['booking'] = "Default Font End";
	// 	$fe_data['show_festival'] = $this->mod_booking->getFestival();
	// 	$this->load->view('index', $fe_data);
	// }
	
	// // edit booking
	// public function detail(){
	// 	$fe_data['menu_fe'] = $this->mod_index->getAllMenu();
	// 	$fe_data['title'] = "detail";
	// 	$fe_data['booking'] = "Default Font End";
	// 	$fe_data['detail'] = $this->
	// 	$this->load->view('index', $fe_data);
	// }	

	public function list_record(){
		$data['title'] = "Booking Management";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
        $data['option_ftvstatus'] = array('0' => 'Unpublished','1' => 'Published');
        if($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))){
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $config['base_url'] = site_url($controller . "/" . $function."/".$uri3."/".$uri4);
            $config['uri_segment'] = 5;
            $sortby = $uri3;
            if($uri4 == 'ASC'){
                $data['sort'] = "DESC";
            }elseif($uri4 == "DESC"){
                $data['sort'] = "ASC";
            }

        }else{
            $sortby = "ID";
            $data['sort'] = "DESC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }

        $config['total_rows'] = MU_Model::count_all_data('booking', array('bk_deleted' => 0));
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

		$data['getbooking'] = $this->mod_booking->getAllsalePackage($config['per_page'], $page, $sortby, $data['sort']);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin', $data);
	}
    
    // search booking ID
    public function search_booking(){
        $data['title'] = "Booking Management";
        $data['dashboard'] = "management";
        $controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
        if($this->input->post('search_bookingID')) $this->session->set_userdata('searchBooking', $this->input->post('search_bookingID'));
        $data['option_ftvstatus'] = array('0' => 'Unpublished','1' => 'Published');
        if($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))){
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $config['base_url'] = site_url($controller . "/" . $function."/".$uri3."/".$uri4);
            $config['uri_segment'] = 5;
            $sortby = $uri3;
            if($uri4 == 'ASC'){
                $data['sort'] = "DESC";
            }elseif($uri4 == "DESC"){
                $data['sort'] = "ASC";
            }

        }else{
            $sortby = "ID";
            $data['sort'] = "DESC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }

        $config['total_rows'] = MU_Model::count_all_data('booking', array('bk_deleted' => 0), array('bk_id'=> $this->session->userdata('searchBooking')));
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

        $data['getbooking'] = $this->mod_booking->getAllSearchsalePackage($this->session->userdata('searchBooking'),$config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
    }


    /*
    * pulic function add_booking
    * @noparam  
    * return boolean
    * redirect to the view page
    */
    public function add_booking(){
        $data['title'] = "Booking Management";
        $data['dashboard'] = "management";
        $data['passenger'] = $this->mod_booking->getPassenger();        
        $data['getpk'] = $this->mod_booking->getAllPackage();
        $data['getcus'] = $this->mod_booking->getAllCustomize();
        if($this->input->post('btnbookingsubmit')){
            $insertbooking['bk_type'] = $this->input->post('bkType');
            $insertbooking['bk_date'] = $this->input->post('bkDate');
            $insertbooking['bk_arrival_date'] = $this->input->post('bkArrivalDate');
            $insertbooking['bk_total_people'] = $this->input->post('bkTotalPeople');
            $insertbooking['bk_pay_date'] = $this->input->post('bkPayDate');
            $insertbooking['bk_pay_price'] = $this->input->post('bkPrice');
            $insertbooking['bk_pay_status'] = $this->input->post('bkPaystatus');
            $insertbooking['bk_status'] = $this->input->post('bkstatus');            
            $insertpassenger['passID'] = $this->input->post('bkpass');
            $bookingpackage = $this->input->post('pkORcus');

            $config = $this->booking_config();
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('<p class="error">'.'Please complete the field required...'.'</p>', 'error'));
            }else{
                if($this->is_money($insertbooking['bk_pay_price'])){
                    $result_booking = $this->mod_booking->insertBooking($insertbooking);
                    if($result_booking){
                        $this->mod_booking->insertpassbooking($insertpassenger['passID'], $result_booking);
                        if($insertbooking['bk_type'] == 'package'){
                            $this->mod_booking->insertsalepackage($bookingpackage, $result_booking);
                        }else{
                            $this->mod_booking->insertsalecustomize($bookingpackage, $result_booking);
                        }
                        $this->session->set_userdata('create', show_message('<p>'.'Booking was added successfully ...'.'</p>', 'success'));
                        redirect('booking/view_booking_'.$insertbooking['bk_type'].'/'.$result_booking.'/'.$insertbooking['bk_type']);
                        break;
                    }                    
                }
            }
        }
        $this->load->view('munich_admin', $data);
    }
    /*
    * pulic function view_booking
    * @param   
    * noreturn
    * redirect to the view page
    */
    // private $priceBooking = 0;
    public function view_booking_package($bkID, $bkType){
        $data['title'] = "Booking Management";
        $data['dashboard'] = "management";
        $data['passenger'] = $this->mod_booking->getPassenger();
        $data['bookingedit'] = $this->mod_booking->getBookingEditPackage($bkID);
        $data['getpkORcus'] = $this->mod_booking->getAllPackage();
        $data['extraService'] = $this->mod_booking->getAllExtraService();
        if($this->input->post('btnviewsubmit')){
            $updatebooking['bk_type'] = $this->input->post('bkType');
            $updatebooking['bk_date'] = $this->input->post('bkDate');
            $updatebooking['bk_arrival_date'] = $this->input->post('bkArrivalDate');
            $updatebooking['bk_pay_date'] = $this->input->post('bkPayDate');
            $updatebooking['bk_pay_status'] = $this->input->post('bkPaystatus');
            $updatebooking['bk_status'] = $this->input->post('bkstatus');
            $bookingpassid['passID'] = $this->input->post('bkpass');
            $bookingpackage = $this->input->post('pkORcus');

            $extraservicecheckbox = $this->input->post('epacc_checkbox');
            $passengercheckbox = $this->input->post('pass_checkbox');

            $config = $this->booking_config();
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('<p class="error">'.'Please complete the field required...'.'</p>', 'error'));
            }else{

                $this->saveChangePassengers($passengercheckbox, $bkID, $bookingpassid['passID']);
                $servicePrice = $this->saveChangeExtraservices($bkID, $extraservicecheckbox);
                $cuspkPrice = $this->input->post('pkconprice');
                $aop = count($passengercheckbox)+1;
                $updatebooking['bk_pay_price'] = ($servicePrice + $cuspkPrice) * $aop;
                $updatebooking['bk_total_people'] = $aop;

                if(isset($updatebooking['bk_pay_price']) && $this->is_money($updatebooking['bk_pay_price'])){
                    $result_booking = $this->mod_booking->updateBooking($updatebooking, $bkID);
                    if($result_booking){
                        $this->session->set_userdata('create', show_message('<p>'.'Booking was updated successfully ...'.'</p>', 'success'));
                        $this->mod_booking->updatepassbooking($bookingpassid['passID'], $bkID);
                        $this->mod_booking->updatesalepackage($bookingpackage, $bkID);
                        // redirect('booking/list_record');
                        redirect('booking/view_booking_'.$updatebooking['bk_type'].'/'.$bkID.'/'.$updatebooking['bk_type']);
                        break;
                    }
                }
            }
        }
        $this->load->view('munich_admin', $data);
    }

    /*
    * public function booking_config
    * @noparam
    * return config (array)
    */
    public function booking_config(){
        $config = array(
            array('field' => 'bkDate','label' => 'booking date','rules' => 'trim|required'),
            array('field' => 'bkArrivalDate','label' => 'arrival date', 'rules' => 'trim|required'),
            array('field' => 'bkTotalPeople','label' => 'total people','rules' => 'trim|required|numeric'),
            array('field' => 'bkPrice','label' => 'price', 'rules' => 'trim|required'),
            array('field' => 'bkPayDate','label' => 'pay date','rules' => 'trim|required'),
            array('field' => 'bkType','label' => 'booking type','rules' => 'trim|required'),
            array('field' => 'bkPaystatus','label' => 'pay status','rules' => 'trim|required'),
            array('field' => 'bkpass','label' => 'passenger','rules' => 'trim|required'),
            array('field' => 'pkORcus','label' => 'Package','rules' => 'trim|required'),
        );
        return $config;
    }

	/*
    * pulic function deleteById
    * @param $bk_id (int) 
    * return boolean
    * redirect to the current page
    */
    public function deleteBookingById($bk_id, $pagione = false, $pagitwo = false,$pagithree = false){
        $deleted = MU_Model::deleteRecordById('booking', array("bk_deleted" => 1), array('bk_id' => $bk_id));
        $total_rows = MU_Model::count_all_data('booking', array('bk_deleted' => 0));
        $pagi = "";
        if($this->session->userdata('searchBooking')){ $function = "search_booking"; }else{ $function = "list_record"; }
        if($total_rows > 10){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

           $redirect = "booking/".$function."/".$pagi; 
        }else{ 
            $redirect = "booking/".$function; 
        }

        if($deleted){
            $this->session->set_userdata('create', show_message('The booking have been deleted successfully.', 'success'));
            redirect($redirect);
        }else{
            $this->session->set_userdata('create', show_message('Cannot delete record on table name booking.', 'error'));
            redirect($redirect);
        }
    }
	/*
    * pulic function status_booking
    * @param $bk_status (int)
    * @param $bk_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function status_booking($bk_status, $bk_id, $pagione = false, $pagitwo = false, $pagithree = false){
        $total_rows = MU_Model::count_all_data('booking', array('bk_deleted' => 0));
        $bk_status = ($bk_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('booking', array("bk_status" => $bk_status), array('bk_id' => $bk_id));
        $pagi = "";
        if($this->session->userdata('searchBooking')){ $function = "search_booking"; }else{ $function = "list_record"; }
        if($total_rows > 3){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

           $redirect = "booking/".$function."/".$pagi; 
        }else{ 
            $redirect = "booking/".$function; 
        }

        $bk_msg = ($bk_statuss == 1) ? "Published" : "Unpublished";

        if($statuschaged){
            $this->session->set_userdata('create', show_message('The booking have been '.$bk_msg.' successfully.', 'success'));
            redirect($redirect);
        }else{
            $this->session->set_userdata('create', show_message('Cannot '.$bk_msg.' record on table name booking.', 'error'));
            redirect($redirect);
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

    /************/
    public function add_morepassenger($bkID, $passID, $bkType){
        $accompany = MU_Model::getForiegnTableName("passenger_booking", array('pbk_bk_id' => $bkID, 'pbk_pass_id' => $passID), 'pbk_pass_come_with');
        $accompany = unserialize($accompany);
        $pID = $this->input->post('bkmodalpass');
        $accompany[$pID] = $pID;
        $accompany = serialize($accompany);
        $result = $this->mod_booking->updateaccompany($accompany, $bkID, $passID);
        if($result){
            $this->session->set_userdata('create', show_message('The passenger added successfully.', 'success'));
            redirect('booking/view_booking_'.$bkType.'/'.$bkID.'/'.$bkType);
        }
    }

/*Start Chhingchhing*/
    /**
     * @insert a new array member at a given index
     * @param array $array
     * @param mixed $new_element
     * @param int $index
     * @return array
     */
     function insertArrayIndex($array, $new_element, $index) {
        $array[$index] = $new_element;
        return $array;
     }

    /***********/
    public function add_extraservice($bkID, $bkType){
        $extraservices = array();
        $extraservices = MU_Model::getForiegnTableName("booking", array('bk_id' => $bkID), 'bk_addmoreservice');
        $extraservices = unserialize($extraservices);
        $esID = $this->input->post('bkmodalextraservice');

       // echo $esID; die();
        // Information of new product just add
        $objRecord = $this->mod_booking->getExtraProductById($esID);
        $extraproductactbooking = $objRecord->result();
        $extraproductactbooking = json_decode(json_encode($extraproductactbooking), true);
        $extraservices[$esID] = $extraproductactbooking[0];

        // Customize booking
        if ($bkType == 'customize') {
            $temp_old = array();
            $temp_new = array();
            $bookingInfos = $this->mod_booking->getBookingEditCustomize($bkID)->result();
            foreach ($bookingInfos as $bookingInfo) {
                $temp_old = unserialize($bookingInfo->bk_addmoreservice);
            }
            $temp_new = $this->insertArrayIndex($temp_new, $extraservices[$esID], $esID);
            array_push($temp_old, $temp_new);
            $extraservices = $temp_old;
        }

        $extraservices = serialize($extraservices);
        $result = $this->mod_booking->updateExtraservice($extraservices, $bkID);
        if($result){
            $this->session->set_userdata('create', show_message('The extra service added successfully.', 'success'));
            redirect('booking/view_booking_'.$bkType.'/'.$bkID.'/'.$bkType);
        }
    }

    /*
    * public function customize_more_passenger
    * load template fe_more_passenger
    */
    public function customize_more_passenger() {
        $bkID = $this->input->post('bk_id');
        $passID = $this->input->post('pass_id');
        $accompany = MU_Model::getForiegnTableName("passenger_booking", array('pbk_bk_id' => $bkID, 'pbk_pass_id' => $passID), 'pbk_pass_come_with');
        $accompany = unserialize($accompany);
        $temp_old = array();
        $temp_new = array();
        if ($accompany) {
            $temp_old = $accompany;
        }

        $passengerInfo = array(
            'pass_addby' => $passID,
            'pass_fname'        => $this->input->post('pfname'),
            'pass_lname'        => $this->input->post('plname'),
            'pass_email'        => $this->input->post('pemail'),
            'pass_phone'        => $this->input->post('phphone'),
            'pass_mobile'       => $this->input->post('pmobile'),
            'pass_country'      => $this->input->post('pcountry'),
            'pass_address'      => $this->input->post('paddress'),
            'pass_company'      => $this->input->post('pcompany'),
            'pass_gender'       => $this->input->post('pgender'),
            'pass_status'       => 1,
            'pass_deleted'      => 0,
        );
        $success  = $this->mod_booking->personal_information($passengerInfo);
        $result = false;
        if ($success) {
            $temp_old = $this->insertArrayIndex($temp_old, $passengerInfo['pass_id'], $passengerInfo['pass_id']);
            // array_push($temp_old, $temp_new);
            $accompany = serialize($temp_old);
            $result = $this->mod_booking->updateaccompany($accompany, $bkID, $passID);
        }

        if (!$result) {
            $arr_errors = array(
                "success" => false,
                "sms_type" => "danger",
                "sms_title" => "Error!",
                "sms_value" => "Sorry! That email is already registered. Please login before you booking."
            );
            echo json_encode($arr_errors);
        } else {
            $arr_errors = array(
                "success" => true,
                "sms_type" => "success",
                "sms_title" => "Congradulation!",
                "sms_value" => "You have been added a passenger with successfully."
            );
            echo json_encode($arr_errors);
        }
    }

    // Check existing passenger by email
    function checkExistPassengerByEmail() {
        $email = $this->input->post('email');
        $result = $this->mod_booking->exist_passenger_by_email($email);
        if ($result) {
            $arr_errors = array(
                "success" => false,
                "sms_type" => "danger",
                "sms_title" => "Error!",
                "sms_value" => "Sorry! That email is already registered."
            );
            echo json_encode($arr_errors);
        }
    }

    /*public function add_morepassenger($bkID, $passID, $bkType){
        $accompany = MU_Model::getForiegnTableName("passenger_booking", array('pbk_bk_id' => $bkID, 'pbk_pass_id' => $passID), 'pbk_pass_come_with');
        $accompany = unserialize($accompany);
        $pID = $this->input->post('bkmodalpass');
        $accompany[$pID] = $pID;
        $accompany = serialize($accompany);
        $result = $this->mod_booking->updateaccompany($accompany, $bkID, $passID);
        if($result){
            $this->session->set_userdata('create', show_message('The passenger added successfully.', 'success'));
            redirect('booking/view_booking_'.$bkType.'/'.$bkID.'/'.$bkType);
        }
    }*/

/*End Chhingchhing*/

    // delete multiple booking
    public function deleteMultipleBooking(){
      $multiCheck = $this->input->post("check_checkbox");
      $update['bk_deleted'] = 1;
      $result = $this->mod_booking->deleteMultiplebk($update, $multiCheck);
      if($result > 0){
            $this->session->set_userdata('create', show_message('The booking was deleted successfully.', 'success'));
            echo "t";
        } else {
            $this->session->set_userdata('create', show_message('Cannot delete record from table booking.', 'error'));
            echo "f";
        }
    }
    // end of delete multiple booking

    /* delete permenent booking */
    public function deletePermenentBooking() {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_booking->deletePermenentbk($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('create', show_message('The booking was deleted permenent successfully.', 'success'));
            echo "t";
        } else {
            $this->session->set_userdata('create', show_message('Cannot delete record from table booking.', 'error'));
            echo "f";
        }
    }

   ////////////// customize ////////////////

    /*
    * pulic function view_booking
    * @param   
    * noreturn
    * redirect to the view page
    */

    // private $priceBooking = 0;
    public function view_booking_customize($bkID, $bkType){
        $data['title'] = "Booking Management";
        $data['dashboard'] = "management";
        $data['passenger'] = $this->mod_booking->getPassenger();
        $data['bookingedit'] = $this->mod_booking->getBookingEditCustomize($bkID);
        // $data['getpkORcus'] = $this->mod_booking->getAllCustomize();
        $data['extraService'] = $this->mod_booking->getAllExtraService();
        if($this->input->post('btnviewsubmit')){
            $updatebooking['bk_type'] = $this->input->post('bkType');
            $updatebooking['bk_date'] = $this->input->post('bkDate');
            $updatebooking['bk_arrival_date'] = $this->input->post('bkArrivalDate');
            $updatebooking['bk_pay_date'] = $this->input->post('bkPayDate');
            $updatebooking['bk_pay_status'] = $this->input->post('bkPaystatus');
            $updatebooking['bk_status'] = $this->input->post('bkstatus');
            $bookingpassid['passID'] = $this->input->post('bkpass');
            $bookingpackage = $this->input->post('pkORcus');

            $extraservicecheckbox = $this->input->post('epacc_checkbox');
            $passengercheckbox = $this->input->post('pass_checkbox');

            $config = $this->booking_config();
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('<p class="error">'.'Please complete the field required...'.'</p>', 'error'));
            }else{
                $this->saveChangePassengers($passengercheckbox, $bkID, $bookingpassid['passID']);
                $servicePrice = $this->saveChangeExtraservices($bkID, $extraservicecheckbox);
                $cuspkPrice = $this->input->post('pkconprice');
                if($passengercheckbox == NULL){ $aop = 1; }else{ $aop = count($passengercheckbox)+1; }
                $updatebooking['bk_pay_price'] = ($servicePrice + $cuspkPrice) * $aop;
                $updatebooking['bk_total_people'] = $aop;
                if(isset($updatebooking['bk_pay_price']) && $this->is_money($updatebooking['bk_pay_price'])){
                    $result_booking = $this->mod_booking->updateBooking($updatebooking, $bkID);
                    if($result_booking){
                        $this->session->set_userdata('create', show_message('<p>'.'Booking was updated successfully ...'.'</p>', 'success'));
                        $this->mod_booking->updatepassbooking($bookingpassid['passID'], $bkID);
                        $this->mod_booking->updatesalecustomize($bookingpackage, $bkID);
                        // redirect('booking/list_record');
                        redirect('booking/view_booking_'.$updatebooking['bk_type'].'/'.$bkID.'/'.$updatebooking['bk_type']);
                        break;
                    }
                }
            }
        }
        $this->load->view('munich_admin', $data);
    }

    /************/
    public function saveChangePassengers($passengercheckbox, $bkID, $passID){
        $accompany = MU_Model::getForiegnTableName("passenger_booking", array('pbk_bk_id' => $bkID, 'pbk_pass_id' => $passID), 'pbk_pass_come_with');
        $accompany = unserialize($accompany);
        $newaccompany = array();
        if($passengercheckbox != NULL){
            foreach($passengercheckbox as $pssID){
                $newaccompany[$pssID] = $pssID;
            }
        }
        if($newaccompany != NULL){
            $newaccompany = serialize($newaccompany);
            $result = $this->mod_booking->updateaccompany($newaccompany, $bkID, $passID); 
            return $result;
        } else {
            $result = $this->mod_booking->updateaccompany(NULL, $bkID, $passID);
            return 0;
        }      
    }

    /****************/
    public function saveChangeExtraservices($bkID,$extraservicecheckbox){
        $extraservices = array();
        $extraservices = MU_Model::getForiegnTableName("booking", array('bk_id' => $bkID), 'bk_addmoreservice');
        $extraservices = unserialize($extraservices);
        $newextrservices = array();
        $prices = 0;
        if($extraservicecheckbox != NULL){
            foreach($extraservicecheckbox as $eservice){
                $newextrservices[$eservice] = $extraservices[$eservice];
                $prices += $extraservices[$eservice]['ep_saleprice'];
            }
        }
        if($newextrservices == NULL){ $newextrservices = NULL; }else{ $newextrservices = serialize($newextrservices); }        
        $result = $this->mod_booking->updateExtraservice($newextrservices, $bkID);
        if($result != NULL){
            return $prices;
        }else{
            return 0;
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */