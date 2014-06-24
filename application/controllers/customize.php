<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Customize extends MU_Controller {  

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_customize'));
    }

    /*
    * public function list_record
    * @noparam
    * sort, pagination, load view
    */
    public function list_record(){
    if ($this->check_user_session()) {
            $data['title'] = "Customize";
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
            $config['total_rows'] = MU_Model::count_all_data('customize_conjection', array('cuscon_deleted' => 0));
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
            $data['customize'] = $this->mod_customize->getAllCustomize($config['per_page'], $page, $sortby, $data['sort']);
            $data['pagination'] = $this->pagination->create_links();
            $this->load->view('munich_admin', $data);
        }
    }
    
    /*
    * public function search_customize
    * @noparam
    * sort, pagination, load view
    */
    public function search_customize(){
    if ($this->check_user_session()) {
        $data['title'] = "Search Customize";
        $data['dashboard'] = "management";
        if($this->input->post("search_customize_name")) $this->session->set_userdata('search_customize', $this->input->post("search_customize_name")); // else exit();
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
        $config['total_rows'] = MU_Model::count_all_data('customize_conjection', array('cuscon_deleted' => 0), array('cuscon_name'=> $this->session->userdata('search_customize')));
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
        $data['customize'] = $this->mod_customize->getAllSearchCustomize($this->session->userdata('search_customize'), $config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
        }
    }

    /*
    * public function add_customize
    * @noparam
    * load view and add new record
    * redirect
    */
    public function add_customize(){
    if ($this->check_user_session()) {
        $data['title'] = "Add Customize";
        $data['dashboard'] = "management";
        $data['txtLocation'] = $this->mod_customize->getLocation();
        $data['txtFastival'] = $this->mod_customize->getFastival();
        $data['txtPhotos'] = $this->mod_customize->getPhoto();
        $data['txtStatus'] = array('0' => 'Unpublish','1' => 'Publish');
        // variable catch
        $data['chosimg']  = ''; 
        $data['lc']      = '';
        $data['ftv']     = '';
        $data['cuscondc']    = '';
        $data['txtFrom'] = '';
        $data['txtTo']   = '';
        $data['status']   = '';

        if($this->input->post('addCustomize')){
            $insert_customize = $this->customize_variable();
            // variable catch
            $data['lc']      = $insert_customize['cuscon_lt_id'];
            $data['ftv']     = $insert_customize['cuscon_ftv_id'];
            $data['cuscondc']    = $insert_customize['cuscon_description'];
            $data['txtFrom'] = $insert_customize['cuscon_start_date'];
            $data['txtTo']   = $insert_customize['cuscon_end_date'];
            $data['status']  = $insert_customize['cuscon_status'];
            $data['chosimg'] = $insert_customize['cuscon_pho_id'];

            $encryp = $data['txtFrom'].','.$data['txtTo'];
            $encrypted_id = base64_encode($encryp);

            $config = $this->customize_config();
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('<p class="error">'.'Please complete the field required...'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
            }else{                
                if($this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice'))){
                    $result_customize = $this->mod_customize->createCustomize($insert_customize);
                    if($result_customize > 0) {
                        $this->session->set_userdata('create', show_message('<p>'.'Customize was submited successfully ...'.'</p>', 'success'));
                        //redirect('customize/add_customize');
                        // var_dump($result_customize); die();
                        redirect('customize/view_customize/'.$result_customize.'/'.$encrypted_id);
                    }else{
                        $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                        $this->load->view('munich_admin', $data);
                    }
                }else{
                   $this->session->set_userdata('create', show_message('<p class="error">'.'Please check the price field...'.'</p>', 'error'));
                   $this->load->view('munich_admin', $data); 
                }
            }
        }else{  
            $this->load->view('munich_admin', $data); 
        }
    }
}
    // view customize
    public function view_customize($cuscon_id, $date){
    if ($this->check_user_session()) {
        $decrypted = base64_decode($date);
        $encrypted_id = base64_encode($decrypted);
        $decrypted_date = explode(",", $decrypted);
        $data['title'] = "View Customize";
        $data['dashboard'] = "management";
        $data['customizeById'] = $this->mod_customize->getCustomizeById($cuscon_id);
        $data['cusconSelectedAct'] = $this->returnOptionAct($decrypted_date);
        $data['cusconSelectedAcc'] = $this->returnOptionAcc($decrypted_date);
        $data['cusconSelectedTps'] = $this->returnOptionTps($decrypted_date);
        $data['txtLocation'] = $this->mod_customize->getLocation();
        $data['txtFastival'] = $this->mod_customize->getFastival();
        $data['txtPhotos'] = $this->mod_customize->getPhoto();

        $data['txtStatus'] = array('0' => 'Unpublish','1' => 'Publish');
        // variable catch
        $data['chosimg']  = ''; 
        $data['lc']      = '';
        $data['ftv']     = '';
        $data['cuscondc']    = '';
        $data['txtFrom'] = '';
        $data['txtTo']   = '';
        $data['status']   = '';

        if($this->input->post('saveChangeCustomize')){
            $update_customize = $this->customize_variable();
            // variable catch
            $data['lc']      = $update_customize['cuscon_lt_id'];
            $data['ftv']     = $update_customize['cuscon_ftv_id'];
            $data['cuscondc']    = $update_customize['cuscon_description'];
            $data['txtFrom'] = $update_customize['cuscon_start_date'];
            $data['txtTo']   = $update_customize['cuscon_end_date'];
            $data['status']  = $update_customize['cuscon_status'];
            $cuscon_activities = $this->saveUpdateActivities($cuscon_id);
            $cuscon_accomodation = $this->saveUpdateAccommodation($cuscon_id);
            $cuscon_transportation = $this->saveUpdateTransport($cuscon_id);

            $config = $this->customize_config();
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('<p class="error">'.'Please complete the field required...'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
            }else{                
                if($this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice'))){
                    $update_customize["cuscon_activities"] = $cuscon_activities;
                    $update_customize["cuscon_accomodation"] = $cuscon_accomodation;
                    $update_customize["cuscon_transportation"] = $cuscon_transportation;
                    $result_customize = $this->mod_customize->updateCustomize($update_customize, $cuscon_id);
                    if($result_customize) {
                        $this->session->set_userdata('create', show_message('<p>'.'Customize was updated successfully ...'.'</p>', 'success'));
                        // redirect('customize/list_record');
                        redirect('customize/view_customize/'.$cuscon_id.'/'.$encrypted_id);
                    }else{
                        $this->session->set_userdata('create', show_message('<p class="error">'.'Sorry ! You had made any mistake, please try again...'.'</p>', 'error'));
                        $this->load->view('munich_admin', $data);
                    }
                }else{
                   $this->session->set_userdata('create', show_message('<p class="error">'.'Please check the price field...'.'</p>', 'error'));
                   $this->load->view('munich_admin', $data); 
                }
            }
        }else{  
            $this->load->view('munich_admin', $data); 
        }
    }
}
    // function to save change Activities
    public function saveUpdateActivities($cusconID){
    if ($this->check_user_session()) {
        $selectAct = $this->mod_customize->getActivitiesCustomize($cusconID);        
        $activities = array();
        $newActivites = array();
        if($selectAct->num_rows() > 0){
            foreach($selectAct->result() as $sltAct){                
                $activities = unserialize($sltAct->cuscon_activities);
            }
        }
        $actRecordID = $this->input->post('act_checkbox');
        $subactRecordID = $this->input->post('subact_checkbox');
        $epactRecordID = $this->input->post('epact_checkbox');
        //var_dump($epactRecordID);
        foreach($actRecordID as $acts){
            if(array_key_exists($acts, $activities['main-activities'])){
               $newActivites['main-activities'][$acts] = $activities['main-activities'][$acts];
            }
            if(isset($subactRecordID[$acts]))
            foreach($subactRecordID[$acts] as $subact){
              if(array_key_exists($subact, $activities['sub-activities'][$acts])){
                $newActivites['sub-activities'][$acts][$subact] = $activities['sub-activities'][$acts][$subact];
              }  
            }
            if(isset($epactRecordID[$acts]))
            foreach($epactRecordID[$acts] as $epact){
              if(array_key_exists($epact, $activities['extraproduct-cuscon'][$acts])){
                $newActivites['extraproduct-cuscon'][$acts][$epact] = $activities['extraproduct-cuscon'][$acts][$epact];
              }  
            }
        }

        // var_dump($newActivites); die();
        return serialize($newActivites);
    }
}
    // // function to save change Accommodation
    public function saveUpdateAccommodation($cusconID){  
    if ($this->check_user_session()) {
        $selectAcc = $this->mod_customize->getAccommodationCustomize($cusconID);        
        $accommodations = array();
        $newAccommodations = array();
        if($selectAcc->num_rows() > 0){
            foreach($selectAcc->result() as $sltAcc){                
                $accommodations = unserialize($sltAcc->cuscon_accomodation);
            }
        }

        $accRecordID = $this->input->post('acc_checkbox');
        $subaccRecordID = $this->input->post('subacc_checkbox');
        $epaccRecordID = $this->input->post('epacc_checkbox');

        foreach($accRecordID as $acc){
            if(array_key_exists($acc, $accommodations['main-accommodation'])){
               $newAccommodations['main-accommodation'][$acc] = $accommodations['main-accommodation'][$acc];
            }
            if(isset($subaccRecordID[$acc]))
            foreach($subaccRecordID[$acc] as $subacc){
              if(array_key_exists($subacc, $accommodations['sub-accommodation'][$acc])){
                $newAccommodations['sub-accommodation'][$acc][$subacc] = $accommodations['sub-accommodation'][$acc][$subacc];
              }  
            }
            if(isset($epaccRecordID[$acc]))
            foreach($epaccRecordID[$acc] as $epacc){
              if(array_key_exists($epacc, $accommodations['extraproduct-cuscon'][$acc])){
                $newAccommodations['extraproduct-cuscon'][$acc][$epacc] = $accommodations['extraproduct-cuscon'][$acc][$epacc];
              }  
            }
        }
        // var_dump($newAccommodations['extraproduct-cuscon']);
        return serialize($newAccommodations);
    }
}
    // // function to save change Transport
    public function saveUpdateTransport($cusconID){
    if ($this->check_user_session()) {
        $selectTps = $this->mod_customize->getTransportCustomize($cusconID); 
        $transportation = array();
        $newtransportation = array();
        if($selectTps->num_rows() > 0){
            foreach($selectTps->result() as $sltTps){                
                $transportation = unserialize($sltTps->cuscon_transportation);
            }
        }

        $tpsRecordID = $this->input->post('tp_checkbox');
        $subtpsRecordID = $this->input->post('subtps_checkbox');
        $eptpsRecordID = $this->input->post('eptps_checkbox');
        var_dump($eptpsRecordID);
        foreach($tpsRecordID as $tps){
            if(array_key_exists($tps, $transportation['main-transport'])){
               $newtransportation['main-transport'][$tps] = $transportation['main-transport'][$tps];
            }
            if(isset($subtpsRecordID[$tps]))
            foreach($subtpsRecordID[$tps] as $subtps){
              if(array_key_exists($subtps, $transportation['sub-transport'][$tps])){
                $newtransportation['sub-transport'][$tps][$subtps] = $transportation['sub-transport'][$tps][$subtps];
              }  
            }
            if(isset($eptpsRecordID[$tps]))
            foreach($eptpsRecordID[$tps] as $eptps){
              if(array_key_exists($eptps, $transportation['extraproduct-cuscon'][$tps])){
                $newtransportation['extraproduct-cuscon'][$tps][$eptps] = $transportation['extraproduct-cuscon'][$tps][$eptps];
              }  
            }
        }
        // var_dump($newtransportation['extraproduct-cuscon']);
        return serialize($newtransportation);
    }
}
    // returnOptionAct
    public function returnOptionAct($date){
    if ($this->check_user_session()) {
        $acts[''] = 'Please select';
        $activitiesObject = $this->mod_customize->getCustomizeActivities();
        foreach($activitiesObject->result() as $row){
            $dateAvaliable = $this->convertDateToRange($date, $row->start_date, $row->end_date);
            if($dateAvaliable){
                $acts[$row->act_id] = $row->act_name;
            }
        }
        return $acts;
    }
}
    // returnOptionAcc
    public function returnOptionAcc($date){
    if ($this->check_user_session()) {
        $accs[''] = 'Please select';
        $accommodationObject = $this->mod_customize->getCustomizeAccommodation();
        foreach($accommodationObject->result() as $row){
            $dateAvaliable = $this->convertDateToRange($date, $row->start_date, $row->end_date);
            if($dateAvaliable){
                $accs[$row->acc_id] = $row->acc_name;
            }
        }
        return $accs;
    }
}
    // returnOptionAcc
    public function returnOptionTps($date){
    if ($this->check_user_session()) {
        $tps[''] = 'Please select';
        $transportionObject = $this->mod_customize->getCustomizeTransportation();
        foreach($transportionObject->result() as $row){
            $dateAvaliable = $this->convertDateToRange($date, $row->start_date, $row->end_date);
            if($dateAvaliable){
                $tps[$row->tp_id] = $row->tp_name;
            }
        }
        return $tps;
    }
}
    // function convertDateToRange
    function convertDateToRange($findDate, $start, $end, $step = '+1 day', $format = 'Y-m-d' ) {
    if ($this->check_user_session()) {
        $dates = array();
        $current = strtotime($start);
        $last = strtotime($end);
        while( $current <= $last ) {    
            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }
        $std = in_array($findDate[0], $dates, true);
        $ed  = in_array($findDate[1], $dates, true);
        if($std OR $ed){
            return true;
        } 
        return false;
    }
}
    // view subactivities and extraproduct
    public function viewSubEp(){
    if ($this->check_user_session()) {
        $tableSubAct = "";
        $tableSubEp = "";
        $actID = $this->input->post('cuscon_act_id');
        $dateofcuscon = $this->input->post('dateofcuscon');
        if($actID == "") exit();
        $dateofcuscon = base64_decode($dateofcuscon);
        $dateofcuscon = explode(",", $dateofcuscon);
        $subactcuscon = $this->mod_customize->getSubActCuscon($actID);
        $subEpcuscon = $this->mod_customize->getSubEpCuscon($actID);
        // for subactivities and display in customize
        if($subactcuscon->num_rows() > 0){
            foreach($subactcuscon->result() as $row){
                $datesubcuscon = $this->convertDateToRange($dateofcuscon, $row->start_date, $row->end_date);
                if($datesubcuscon){
                    $tableSubAct .= '
                        <tr>
                            <td><input type="checkbox" name="cusconsubact[]" value="'.$row->act_id.'" class="checksuballtd" /></td>
                            <td>'.$row->act_name.'</td>
                            <td>'.$row->start_date.'</td>
                            <td>'.$row->end_date.'</td>
                            <td>'.$row->act_saleprice.'</td>
                            <td>'.$row->act_actualstock.'</td>
                        </tr>
                    ';
                }
            }
        }
        // for extraproduct and display in customize
        if($subEpcuscon->num_rows() > 0){
            foreach($subEpcuscon->result() as $row){
                $dateepcuscon = $this->convertDateToRange($dateofcuscon, $row->start_date, $row->end_date);
                if($dateepcuscon){
                    $tableSubEp .= '
                        <tr>
                            <td><input type="checkbox" name="cusconep[]" value="'.$row->ep_id.'" class="checkepalltd" /></td>
                            <td>'.$row->ep_name.'</td>
                            <td>'.$row->start_date.'</td>
                            <td>'.$row->end_date.'</td>
                            <td>'.$row->ep_saleprice.'</td>
                            <td>'.$row->ep_actualstock.'</td>
                        </tr>
                    ';
                }
            }
        }
        if($tableSubAct != ""){
            echo '<h5><b>Sub Activities</b></h5><table class="table table-striped table-hover table-bordered">
               <tr>
                <td><input type="checkbox" name="checkboxsub" class="checkallsub" /></td>
                <td>Name</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Sale ($)</td>
                <td>Actual Stock</td>
               </tr>
            '.$tableSubAct.'</table>';
        }

        if($tableSubEp != ""){
            echo '<h5><b>Extra Product</b></h5><table class="table table-striped table-hover table-bordered">
               <tr>
                <td><input type="checkbox" name="checkboxep" class="checkallep" /></td>
                <td>Name</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Sale ($)</td>
                <td>Actual Stock</td>
               </tr>
            '.$tableSubEp.'</table>';
        }
    }
}
// view subaccommodation and extraproduct
    public function viewSubEpAcc(){
    if ($this->check_user_session()) {
        $tableSubAcc = "";
        $tableSubEp = "";
        $accID = $this->input->post('cuscon_acc_id');
        $dateofcuscon = $this->input->post('dateofcuscon');
        if($accID == "") exit();
        $dateofcuscon = base64_decode($dateofcuscon);
        $dateofcuscon = explode(",", $dateofcuscon);
        $subacccuscon = $this->mod_customize->getSubAccCuscon($accID);
        $subEpcuscon = $this->mod_customize->getSubEpAccCuscon($accID); 
        // for subaccommodation and display in customize
        if($subacccuscon->num_rows() > 0){
            foreach($subacccuscon->result() as $row){
                $datesubcuscon = $this->convertDateToRange($dateofcuscon, $row->start_date, $row->end_date);
                if($datesubcuscon){
                    $tableSubAcc .= '
                        <tr>
                            <td><input type="checkbox" name="cusconsubacc[]" value="'.$row->acc_id.'" class="checksuballtd" /></td>
                            <td>'.$row->acc_name.'</td>
                            <td>'.$row->start_date.'</td>
                            <td>'.$row->end_date.'</td>
                            <td>'.$row->acc_saleprice.'</td>
                            <td>'.$row->acc_actualstock.'</td>
                        </tr>
                    ';
                }
            }
        }
        // for extraproduct and display in customize
        if($subEpcuscon->num_rows() > 0){
            foreach($subEpcuscon->result() as $row){
                $dateepcuscon = $this->convertDateToRange($dateofcuscon, $row->start_date, $row->end_date);
                if($dateepcuscon){
                    $tableSubEp .= '
                        <tr>
                            <td><input type="checkbox" name="cusconep[]" value="'.$row->ep_id.'" class="checkepalltd" /></td>
                            <td>'.$row->ep_name.'</td>
                            <td>'.$row->start_date.'</td>
                            <td>'.$row->end_date.'</td>
                            <td>'.$row->ep_saleprice.'</td>
                            <td>'.$row->ep_actualstock.'</td>
                        </tr>
                    ';
                }
            }
        }
        if($tableSubAcc != ""){
            echo '<h5><b>Sub Accommodation</b></h5><table class="table table-striped table-hover table-bordered">
               <tr>
                <td><input type="checkbox" name="checkboxsub" class="checkallsub" /></td>
                <td>Name</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Sale ($)</td>
                <td>Actual Stock</td>
               </tr>
            '.$tableSubAcc.'</table>';
        }

        if($tableSubEp != ""){
            echo '<h5><b>Extra Product</b></h5><table class="table table-striped table-hover table-bordered">
               <tr>
                <td><input type="checkbox" name="checkboxep" class="checkallep" /></td>
                <td>Name</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Sale ($)</td>
                <td>Actual Stock</td>
               </tr>
            '.$tableSubEp.'</table>';
        }
    }
}
// view subtransportation and extraproduct
    public function viewSubEpTps(){
    if ($this->check_user_session()) {
        $tableSubAcc = "";
        $tableSubEp = "";
        $tpsID = $this->input->post('cuscon_tps_id');
        $dateofcuscon = $this->input->post('dateofcuscon');
        if($tpsID == "") exit();
        $dateofcuscon = base64_decode($dateofcuscon);
        $dateofcuscon = explode(",", $dateofcuscon);
        $subtpscuscon = $this->mod_customize->getSubTpsCuscon($tpsID);
        $subEpcuscon = $this->mod_customize->getSubEpTpsCuscon($tpsID); 
        // for subtransportation and display in customize
        if($subtpscuscon->num_rows() > 0){
            foreach($subtpscuscon->result() as $row){
                $datesubcuscon = $this->convertDateToRange($dateofcuscon, $row->start_date, $row->end_date);
                if($datesubcuscon){
                    $tableSubAcc .= '
                        <tr>
                            <td><input type="checkbox" name="cusconsubtps[]" value="'.$row->tp_id.'" class="checksuballtd" /></td>
                            <td>'.$row->tp_name.'</td>
                            <td>'.$row->start_date.'</td>
                            <td>'.$row->end_date.'</td>
                            <td>'.$row->tp_saleprice.'</td>
                            <td>'.$row->tp_actualstock.'</td>
                        </tr>
                    ';
                }
            }
        }
        // for extraproduct and display in customize
        if($subEpcuscon->num_rows() > 0){
            foreach($subEpcuscon->result() as $row){
                $dateepcuscon = $this->convertDateToRange($dateofcuscon, $row->start_date, $row->end_date);
                if($dateepcuscon){
                    $tableSubEp .= '
                        <tr>
                            <td><input type="checkbox" name="cusconep[]" value="'.$row->ep_id.'" class="checkepalltd" /></td>
                            <td>'.$row->ep_name.'</td>
                            <td>'.$row->start_date.'</td>
                            <td>'.$row->end_date.'</td>
                            <td>'.$row->ep_saleprice.'</td>
                            <td>'.$row->ep_actualstock.'</td>
                        </tr>
                    ';
                }
            }
        }
        if($tableSubAcc != ""){
            echo '<h5><b>Sub Transportation</b></h5><table class="table table-striped table-hover table-bordered">
               <tr>
                <td><input type="checkbox" name="checkboxsub" class="checkallsub" /></td>
                <td>Name</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Sale ($)</td>
                <td>Actual Stock</td>
               </tr>
            '.$tableSubAcc.'</table>';
        }

        if($tableSubEp != ""){
            echo '<h5><b>Extra Product</b></h5><table class="table table-striped table-hover table-bordered">
               <tr>
                <td><input type="checkbox" name="checkboxep" class="checkallep" /></td>
                <td>Name</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Sale ($)</td>
                <td>Actual Stock</td>
               </tr>
            '.$tableSubEp.'</table>';
        }
    }
}
    //  function add activities 
    public function add_activities($cusconID, $date){
    if ($this->check_user_session()) {
        $actID = $this->input->post('cusconact');
        $epID  = $this->input->post('cusconep');        
        $subAct = $this->input->post('cusconsubact');
        $selectAct = $this->mod_customize->getActivitiesCustomize($cusconID);        
        $activities = array();
        if($selectAct->num_rows() > 0){
            foreach($selectAct->result() as $sltAct){                
                $activities = unserialize($sltAct->cuscon_activities);
            }
        }
        //var_dump($activities); die();

    //  main activities
        $activitiescustomize = $this->mod_customize->getActivitiesFromCuscon($actID);
        $activitiescustomize = $activitiescustomize->result();
        $activitiescustomize = json_decode(json_encode($activitiescustomize), true);
        $activities['main-activities'][$activitiescustomize[0]['act_id']] = $activitiescustomize[0];
    //  sub activitities
        $subactivitiescustomize = $this->mod_customize->getSubActivitiesFromCuscon($subAct);
        $subactivitiescustomize = $subactivitiescustomize->result();
        $subactivitiescustomize = json_decode(json_encode($subactivitiescustomize), true);
        for($i = 0; $i < count($subactivitiescustomize); $i++){
            $activities['sub-activities'][$actID][$subactivitiescustomize[$i]['act_id']] = $subactivitiescustomize[$i];
        }
        // var_dump($activities['sub-activities'][$actID][$subactivitiescustomize[$i]['act_id']]); die();
    // extraproduct
        $extraproductactcustomize = $this->mod_customize->getExtraproductFromCuscon($epID);
        $extraproductactcustomize = $extraproductactcustomize->result();
        $extraproductactcustomize = json_decode(json_encode($extraproductactcustomize), true);
        for($j = 0; $j < count($extraproductactcustomize); $j++){
            $activities['extraproduct-cuscon'][$actID][$extraproductactcustomize[$j]['ep_id']] = $extraproductactcustomize[$j];
        }
    // update table column in table customize_conjection
        $activities = serialize($activities);
        // var_dump($activities); die();
        $cuscon_result = $this->mod_customize->updateActivitiesCustomize($activities, $cusconID);
        redirect('customize/view_customize/'.$cusconID.'/'.$date);
    }
}
    // function add accommodation 
    public function add_accommodation($cusconID, $date){
    if ($this->check_user_session()) {
        $accID = $this->input->post('cusconacc');
        $epID  = $this->input->post('cusconep');        
        $subAcc = $this->input->post('cusconsubacc');
        $selectAcc = $this->mod_customize->getAccommodationCustomize($cusconID);        
        $accommodations = array();
        if($selectAcc->num_rows() > 0){
            foreach($selectAcc->result() as $sltAcc){                
                $accommodations = unserialize($sltAcc->cuscon_accomodation);
            }
        }

    // main accommodations
        $accommodationscustomize = $this->mod_customize->getAccommodationsFromCuscon($accID);
        $accommodationscustomize = $accommodationscustomize->result();
        $accommodationscustomize = json_decode(json_encode($accommodationscustomize), true);
        $accommodations['main-accommodation'][$accommodationscustomize[0]['acc_id']] = $accommodationscustomize[0];
    
    // sub accommodation
        $subaccommodationscustomize = $this->mod_customize->getSubaccommodationsFromCuscon($subAcc);
        $subaccommodationscustomize = $subaccommodationscustomize->result();
        $subaccommodationscustomize = json_decode(json_encode($subaccommodationscustomize), true);
        for($i = 0; $i < count($subaccommodationscustomize); $i++){
            $accommodations['sub-accommodation'][$accID][$subaccommodationscustomize[$i]['acc_id']] = $subaccommodationscustomize[$i];
        }
    // extraproduct
        $extraproductactcustomize = $this->mod_customize->getExtraproductFromCuscon($epID);
        $extraproductactcustomize = $extraproductactcustomize->result();
        $extraproductactcustomize = json_decode(json_encode($extraproductactcustomize), true);
        for($j = 0; $j < count($extraproductactcustomize); $j++){
            $accommodations['extraproduct-cuscon'][$accID][$extraproductactcustomize[$j]['ep_id']] = $extraproductactcustomize[$j];
        }
    // update table column in table customize_conjection
        $accommodations = serialize($accommodations);
        $cuscon_result = $this->mod_customize->updateAccommodationsCustomize($accommodations, $cusconID);
        redirect('customize/view_customize/'.$cusconID.'/'.$date);
    }
}
    // function add Transportation 
    public function add_transport($cusconID, $date){
    if ($this->check_user_session()) {
        $tpsID = $this->input->post('cuscontps');
        $epID  = $this->input->post('cusconep');        
        $subTps = $this->input->post('cusconsubtps');
        $selectTps = $this->mod_customize->getTransportCustomize($cusconID);        
        $transportation = array();
        if($selectTps->num_rows() > 0){
            foreach($selectTps->result() as $sltTps){                
                $transportation = unserialize($sltTps->cuscon_transportation);
            }
        }

    // main transportation
        $transportscustomize = $this->mod_customize->getTranpsportsFromCuscon($tpsID);
        $transportscustomize = $transportscustomize->result();
        $transportscustomize = json_decode(json_encode($transportscustomize), true);
        $transportation['main-transport'][$transportscustomize[0]['tp_id']] = $transportscustomize[0];
    
    // sub transportation
        $subtransportscustomize = $this->mod_customize->getSubTranpsportsFromCuscon($subTps);
        $subtransportscustomize = $subtransportscustomize->result();
        $subtransportscustomize = json_decode(json_encode($subtransportscustomize), true);
        for($i = 0; $i < count($subtransportscustomize); $i++){
            $transportation['sub-transport'][$tpsID][$subtransportscustomize[$i]['tp_id']] = $subtransportscustomize[$i];
        }
    // extraproduct
        $extraproductactcustomize = $this->mod_customize->getExtraproductFromCuscon($epID);
        $extraproductactcustomize = $extraproductactcustomize->result();
        $extraproductactcustomize = json_decode(json_encode($extraproductactcustomize), true);
        for($j = 0; $j < count($extraproductactcustomize); $j++){
            $transportation['extraproduct-cuscon'][$tpsID][$extraproductactcustomize[$j]['ep_id']] = $extraproductactcustomize[$j];
        }
    // var_dump($transportation);
    // update table column in table customize_conjection
        $transportation = serialize($transportation);
        $cuscon_result = $this->mod_customize->updateTransportationCustomize($transportation, $cusconID);
        redirect('customize/view_customize/'.$cusconID.'/'.$date);
    }
}
    /*
    * public function customize_config
    * @noparam
    * return config (array)
    */
    public function customize_config(){
    if ($this->check_user_session()) {
        $config = array(
            array('field' => 'cusconName','label' => 'customize name','rules' => 'trim|required'),
            array('field' => 'txtFrom','label' => 'from date', 'rules' => 'trim|required'),
            array('field' => 'txtTo','label' => 'end date','rules' => 'trim|required'),
            array('field' => 'txtLocation','label' => 'location', 'rules' => 'trim|required'),
            array('field' => 'txtFastival','label' => 'festival','rules' => 'trim|required'),
            array('field' => 'txtPhotos', 'label' => 'Photo','rules' => 'trim|required'),
            array('field' => 'purchasePrice','label' => 'purchase price','rules' => 'trim|required'),
            array('field' => 'salePrice','label' => 'sale price','rules' => 'trim|required'),
            array('field' => 'originalStock','label' => 'original stock','rules' => 'trim|required|numeric' ),
            array('field' => 'actualStock', 'label' => 'actual stock','rules' => 'trim|required|numeric'),
        );
        return $config;
    }
}
    /*
    * public function customize_variable
    * @noparent
    * return $customize (array)
    */
    public function customize_variable(){
    if ($this->check_user_session()) {
        $customize['cuscon_name']          = $this->input->post('cusconName');
        $customize['cuscon_start_date']    = $this->input->post('txtFrom');
        $customize['cuscon_end_date']      = $this->input->post('txtTo');
        $customize['cuscon_description']   = $this->input->post('txtDescribe');
        $customize['cuscon_ftv_id']        = $this->input->post('txtFastival');
        $customize['cuscon_lt_id']         = $this->input->post('txtLocation');
        $customize['cuscon_pho_id']        = $this->input->post('txtPhotos');
        $customize['cuscon_saleprice']     = $this->input->post('salePrice');
        $customize['cuscon_purchaseprice'] = $this->input->post('purchasePrice');
        $customize['cuscon_originalstock'] = $this->input->post('originalStock');
        $customize['cuscon_actualstock']   = $this->input->post('actualStock');
        $customize['cuscon_status']        = $this->input->post('txtStatus');
        return $customize;
    }
}
    //delete multiple customize
    public function deleteMulti(){
    if ($this->check_user_session()) {
      $multiCheck = $this->input->post("check_checkbox");
      $update['cuscon_deleted'] = 1;
      $result = $this->mod_customize->deleteMultiple($update, $multiCheck);
      if($result > 0){
            $this->session->set_userdata('msg_success', 'The customize have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name customize.');
            echo "f";
        }
    }
}
    /* delete permenent customize */
    public function deletePermanent() {
    if ($this->check_user_session()) {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_customize->deletePermenent($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The customize have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_error', 'The customize record can not delete from table');
            echo "f";
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
    * pulic function status_customize
    * @param $cuscon_status (int)
    * @param $cuscon_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function status_customize ($cuscon_status, $cuscon_id, $pagione = false, $pagitwo = false, $pagithree = false){
    if ($this->check_user_session()) {
        $cuscon_status = ($cuscon_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('customize_conjection', array("cuscon_status" => $cuscon_status), array('cuscon_id' => $cuscon_id));
        $pagi = "";
        if($this->session->userdata('search_customize')){ $function = "search_customize"; }else{ $function = "list_record"; } 
        if($pagione != false) $pagi = $pagione;
        if($pagitwo != false) $pagi .= "/".$pagitwo;
        if($pagithree != false) $pagi .= "/".$pagithree;
          $redirect = "customize/".$function."/".$pagi; 
          $cuscon_msg = ($cuscon_status == 1) ? "Unpublished" : "Published";
        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The customize have been '.$cuscon_msg.' successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$cuscon_msg.' record on table name customize.');
            redirect($redirect);
        }
    }
}
    /*
    * pulic function deleteCustomizeById
    * @param $cuscon_id (int) 
    * return boolean
    * redirect to the current page
    */
    public function deleteCustomizeById($cuscon_id, $pagione = false, $pagitwo = false,$pagithree = false){
    if ($this->check_user_session()) {
        $total_rows = MU_Model::count_all_data('customize_conjection', array('cuscon_deleted' => 0));
        $deleted = MU_Model::deleteRecordById('customize_conjection', array("cuscon_deleted" => 1), array('cuscon_id' => $cuscon_id));
        $pagi = "";
        if($this->session->userdata('search_customize')){ $function = "search_customize"; }else{ $function = "list_record"; }
        if($total_rows > 0){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

           $redirect = "customize/".$function."/".$pagi; 
        }else{ 
            $redirect = "customize/".$function; 
        }

        if($deleted){
            $this->session->set_userdata('msg_success', 'The customize have been deleted successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name customize.');
            redirect($redirect);
        }
    }
}
    // function to view detial of activities
    public function actdetail($act_id, $cuscon_id){
    if ($this->check_user_session()) {
        $selectAct = $this->mod_customize->getActivitiesCustomize($cuscon_id);        
        $activities = array();
        if($selectAct->num_rows() > 0){
            foreach($selectAct->result() as $sltAct){                
                $activities = unserialize($sltAct->cuscon_activities);
            }
        }
        $this->showDetailsAct($activities['main-activities'][$act_id]);
    }
}
    // function to view detial of accommodation
    public function accdetail($acc_id, $cuscon_id){
    if ($this->check_user_session()) {
        $selectAcc = $this->mod_customize->getAccommodationCustomize($cuscon_id);        
        $accommodations = array();
        if($selectAcc->num_rows() > 0){
            foreach($selectAcc->result() as $sltAcc){                
                $accommodations = unserialize($sltAcc->cuscon_accomodation);
            }
        }
        $this->showDetailsAcc($accommodations['main-accommodation'][$acc_id]);
    }
}
    // function to view detial of transportation
    public function tpdetail($tpsid, $cuscon_id){
    if ($this->check_user_session()) {
        $selectTps = $this->mod_customize->getTransportCustomize($cuscon_id);        
        $transportation = array();
        if($selectTps->num_rows() > 0){
            foreach($selectTps->result() as $sltTps){                
                $transportation = unserialize($sltTps->cuscon_transportation);
            }
        }
        $this->showDetailsTps($transportation['main-transport'][$tpsid]);
    }
}
    // function to view detial of subactivities
    public function subactdetail($act_id, $cuscon_id, $subAct){
    if ($this->check_user_session()) {
        $selectAct = $this->mod_customize->getActivitiesCustomize($cuscon_id);        
        $activities = array();
        if($selectAct->num_rows() > 0){
            foreach($selectAct->result() as $sltAct){                
                $activities = unserialize($sltAct->cuscon_activities);
            }
        }
        $this->showDetailsAct($activities['sub-activities'][$act_id][$subAct]);
    }
}
    // function to view detial of subaccommodation
    public function subaccdetail($acc_id, $cuscon_id, $subAcc){
    if ($this->check_user_session()) {
        $selectAcc = $this->mod_customize->getAccommodationCustomize($cuscon_id);        
        $accommodations = array();
        if($selectAcc->num_rows() > 0){
            foreach($selectAcc->result() as $sltAcc){                
                $accommodations = unserialize($sltAcc->cuscon_accomodation);
            }
        }
        $this->showDetailsAcc($accommodations['sub-accommodation'][$acc_id][$subAcc]);
    }
}
    // function to view detial of transportation
    public function subtpsdetail($tpsid, $cuscon_id, $subTps){
    if ($this->check_user_session()) {
        $selectTps = $this->mod_customize->getTransportCustomize($cuscon_id);        
        $transportation = array();
        if($selectTps->num_rows() > 0){
            foreach($selectTps->result() as $sltTps){                
                $transportation = unserialize($sltTps->cuscon_transportation);
            }
        }
        $this->showDetailsTps($transportation['sub-transport'][$tpsid][$subTps]);
    }
}
    // function to displaydetail
    public function showDetailsAct($details){
    if ($this->check_user_session()) {
        $date_available = "";
        $choiceItem = $details['act_choiceitem'] == 1 ? "Yes" : "No";
        $date_available = '<label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked" => $details['monday'])).' Mon</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" => $details['tuesday'])).' Tue</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" => $details['wednesday'])).' Wed</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" => $details['thursday'])).' Thu</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" => $details['friday'])).' Fri</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" => $details['saturday'])).' Sat</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" => $details['sunday'])).' Sunday</label>
        ';
        $lt_name  = $details['lt_name'];
        $ftv_name = $details['ftv_name'];
        $spl_name = $details['sup_company_name'];
        $pho_source = $details['pho_source'];
        $records = '<table class="table table-bordered"><tr><th>Activity Name</th> <td>'.$details['act_name'].'</td></tr>
            <tr><th>Choice Item</th><td>'.$choiceItem.'</td></tr>
            <tr><th>From Date</th><td>'.$details['start_date'].'</td></tr>
            <tr><th>To Date</th> <td>'.$details['end_date'].'</td></tr>
            <tr><th>Day available</th> <td>'.$date_available.'</td></tr>
            <tr><th>Time </th> <td>'.$details['start_time'].' to '.$details['end_time'].'</td></tr>
            <tr><th>Location </th> <td>'.$lt_name.'</td></tr>
            <tr><th>Festival </th> <td>'.$ftv_name.'</td></tr>
            <tr><th>Supplier </th> <td>'.$spl_name.'</td></tr>
            <tr><th>Photos </th> <td>'.img(array("src" => "user_uploads/thumbnail/original/".$pho_source,"alt"=>$pho_source,"class"=>"act_img")).'</td></tr>
            <tr><th>Purchase Price </th> <td>'.$details['act_purchaseprice'].' $</td></tr>
            <tr><th>Sale Price </th> <td>'.$details['act_saleprice'].' $</td></tr>
            <tr><th>Original Stock </th> <td>'.$details['act_originalstock'].'</td></tr>
            <tr><th>Actual Stock </th> <td>'.$details['act_actualstock'].'</td></tr>
            <tr><th>Date Contract </th> <td>'.$details['act_organiserdate'].'</td></tr>
            <tr><th>Paid Date </th> <td>'.$details['act_payeddate'].'</td></tr>
            <tr><th>Deadline </th> <td>'.$details['act_deadline'].'</td></tr>
            <tr><th>E-Ticket Text </th> <td>'.$details['act_texteticket'].'</td></tr>
            <tr><th>Booking Text </th> <td>'.$details['act_bookingtext'].'</td></tr>
            <tr><th>Admin Text </th> <td>'.$details['act_admintext'].'</td></tr>
            </table>';
          echo $records;
    }
}
    // function to displaydetail
    public function showDetailsAcc($details){
    if ($this->check_user_session()) {
        $date_available = "";
        $date_available = '<label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked" => $details['monday'])).' Mon</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" => $details['tuesday'])).' Tue</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" => $details['wednesday'])).' Wed</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" => $details['thursday'])).' Thu</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" => $details['friday'])).' Fri</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" => $details['saturday'])).' Sat</label>
                           <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" => $details['sunday'])).' Sunday</label>
        ';
        $rt_name  = $details['rt_name']; 
        $clf_name = $details['clf_name'];          
        $lt_name  = $details['lt_name'];
        $ftv_name = $details['ftv_name'];
        $spl_name = $details['sup_company_name'];
        $pho_source = $details['pho_source'];

        $records = '<table class="table table-bordered"><tr><th>Accommodation Name</th> <td>'.$details['acc_name'].'</td></tr>
        <tr><th>From Date</th><td>'.$details['start_date'].'</td></tr>
        <tr><th>To Date</th> <td>'.$details['end_date'].'</td></tr>
        <tr><th>Date available</th> <td>'.$date_available.'</td></tr>
        <tr><th>Time </th> <td>'.$details['start_time'].' to '.$details['end_time'].'</td></tr>
        <tr><th>Room Type </th> <td>'.$rt_name.'</td></tr>
        <tr><th>Classification </th> <td>'.$clf_name.'</td></tr>
        <tr><th>Location </th> <td>'.$lt_name.'</td></tr>
        <tr><th>Festival </th> <td>'.$ftv_name.'</td></tr>
        <tr><th>Supplier </th> <td>'.$spl_name.'</td></tr>
        <tr><th>Photos </th> <td>'.img(array("src" => "user_uploads/thumbnail/original/".$pho_source,"alt"=>$pho_source,"class"=>"acc_img")).'</td></tr>
        <tr><th>Purchase Price </th> <td>'.$details['acc_purchaseprice'].' $</td></tr>
        <tr><th>Sale Price </th> <td>'.$details['acc_saleprice'].' $</td></tr>
        <tr><th>Original Stock </th> <td>'.$details['acc_originalstock'].'</td></tr>
        <tr><th>Actual Stock </th> <td>'.$details['acc_actualstock'].'</td></tr>
        <tr><th>Date Contract </th> <td>'.$details['acc_hoteldate'].'</td></tr>
        <tr><th>Payed Date </th> <td>'.$details['acc_payeddate'].'</td></tr>
        <tr><th>Deadline </th> <td>'.$details['acc_deadline'].'</td></tr>
        <tr><th>E-Ticket Text </th> <td>'.$details['acc_texteticket'].'</td></tr>
        <tr><th>Booking Text </th> <td>'.$details['acc_bookingtext'].'</td></tr>
        <tr><th>Admin Text </th> <td>'.$details['acc_admintext'].'</td></tr>
        </table>';
        echo $records;
    }
}

    // function to displaydetail
    public function showDetailsTps($details){
    if ($this->check_user_session()) {
        $date_available = "";
        $date_available = '<label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked" => $details['monday'])).' Mon</label>
        <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" => $details['tuesday'])).' Tue</label>
        <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" => $details['wednesday'])).' Wed</label>
        <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" => $details['thursday'])).' Thu</label>
        <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" => $details['friday'])).' Fri</label>
        <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" => $details['saturday'])).' Sat</label>
        <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" => $details['sunday'])).' Sunday</label>';
        
        $lt_name  = $details['lt_name'];
        $ftv_name = $details['ftv_name'];
        $spl_name = $details['sup_company_name'];
        $pho_source = $details['pho_source'];

        $records = '<table class="table table-bordered"><tr><th>Transportation Name</th> <td>'.$details['tp_name'].'</td></tr>
        <tr><th>From Date</th><td>'.$details['start_date'].'</td></tr>
        <tr><th>To Date</th> <td>'.$details['end_date'].'</td></tr>
        <tr><th>Date available</th> <td>'.$date_available.'</td></tr>
        <tr><th>Time </th> <td>'.$details['start_time'].' to '.$details['end_time'].'</td></tr>
        <tr><th>Arrival Date </th> <td>'.$details['tp_arrival_date'].'</td></tr>
        <tr><th>Location </th> <td>'.$lt_name.'</td></tr>
        <tr><th>Festival </th> <td>'.$ftv_name.'</td></tr>
        <tr><th>Supplier </th> <td>'.$spl_name.'</td></tr>
        <tr><th>Photos </th> <td>'.img(array("src" => "user_uploads/thumbnail/original/".$pho_source,"alt"=>$pho_source,"class"=>"tp_img")).'</td></tr>
        <tr><th>Purchase Price </th> <td>'.$details['tp_purchaseprice'].' $</td></tr>
        <tr><th>Sale Price </th> <td>'.$details['tp_saleprice'].' $</td></tr>
        <tr><th>Original Stock </th> <td>'.$details['tp_originalstock'].'</td></tr>
        <tr><th>Actual Stock </th> <td>'.$details['tp_actualstock'].'</td></tr>
        <tr><th>Date Contract </th> <td>'.$details['tp_providerdate'].'</td></tr>
        <tr><th>Payed Date </th> <td>'.$details['tp_payeddate'].'</td></tr>
        <tr><th>Deadline </th> <td>'.$details['tp_deadline'].'</td></tr>
        <tr><th>E-Ticket Text </th> <td>'.$details['tp_texteticket'].'</td></tr>
        <tr><th>Booking Text </th> <td>'.$details['tp_textbooking'].'</td></tr>
        <tr><th>Admin Text </th> <td>'.$details['tp_admintext'].'</td></tr>
        </table>';
        echo $records;
    }
}

    // function detail of extraproduct
    public function epdetail($feild ,$actacctps_id, $cuscon_id, $ep_id){
    if ($this->check_user_session()) {
        if($feild == 'act'){
            $selectActAccTps = $this->mod_customize->getActivitiesCustomize($cuscon_id); 
            $dotVariable = 'cuscon_activities'; 
        }else if($feild == 'acc'){
            $selectActAccTps = $this->mod_customize->getAccommodationCustomize($cuscon_id); 
            $dotVariable = 'cuscon_accomodation'; 
        }else if($feild == 'tps'){
            $selectActAccTps = $this->mod_customize->getTransportCustomize($cuscon_id); 
            $dotVariable = 'cuscon_transportation'; 
        }      
        $actacctps = array();
        if($selectActAccTps->num_rows() > 0){
            foreach($selectActAccTps->result() as $sltActAccTps){                
                $sltActAccTps = unserialize($sltActAccTps->$dotVariable);
            }
        }
        $this->showDetailsep($sltActAccTps['extraproduct-cuscon'][$actacctps_id][$ep_id]);
    }
}
    // function display extraproduct details
    function showDetailsep($detials){
    if ($this->check_user_session()) {
        $date_available = "";
            $byperson = $detials['ep_perperson'] == 1 ? "Per Person" : "No";
            $bybooking = $detials['ep_perbooking'] == 1 ? "Per Booking" : "No";
            $date_available = '<label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked" =>  $detials['monday'])).' Mon</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" =>  $detials['tuesday'])).' Tue</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" =>  $detials['wednesday'])).' Wed</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" =>  $detials['thursday'])).' Thu</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" =>  $detials['friday'])).' Fri</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" =>  $detials['saturday'])).' Sat</label>
                               <label class="checkbox-inline">'.form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" =>  $detials['sunday'])).' Sunday</label>
            ';
            $pho_source = $detials['pho_source'];
            $records = '<table class="table table-bordered"><tr><th>Activity Name</th> <td>'. $detials['ep_name'].'</td></tr>
            <tr><th>Per Person</th><td>'.$byperson.'</td></tr>
            <tr><th>Per Booking</th><td>'.$bybooking.'</td></tr>
            <tr><th>From Date</th><td>'. $detials['start_date'].'</td></tr>
            <tr><th>To Date</th> <td>'. $detials['end_date'].'</td></tr>
            <tr><th>Date available</th> <td>'.$date_available.'</td></tr>
            <tr><th>Time </th> <td>'. $detials['start_time'].' to '. $detials['end_time'].'</td></tr>
            <tr><th>Photos </th> <td>'.img(array("src" => "user_uploads/thumbnail/original/".$pho_source,"alt"=>$pho_source,"class"=>"ep_img")).'</td></tr>
            <tr><th>Purchase Price </th> <td>'. $detials['ep_purchaseprice'].' $</td></tr>
            <tr><th>Sale Price </th> <td>'. $detials['ep_saleprice'].' $</td></tr>
            <tr><th>Original Stock </th> <td>'. $detials['ep_originalstock'].'</td></tr>
            <tr><th>Actual Stock </th> <td>'. $detials['ep_actualstock'].'</td></tr>
            <tr><th>Payed Date </th> <td>'. $detials['ep_payeddate'].'</td></tr>
            <tr><th>Deadline </th> <td>'. $detials['ep_deadline'].'</td></tr>
            <tr><th>Booking Text </th> <td>'. $detials['ep_bookingtext'].'</td></tr>
            <tr><th>Admin Text </th> <td>'. $detials['ep_admintext'].'</td></tr>
            </table>';
            echo $records;
        }
    }
}

/* End of file customize.php */
/* Location: ./application/controllers/customize.php */