<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_package'));
    }
    /*
    * public function list_record
    * @noparam
    * sort, pagination, load view
    */
    public function list_record(){
        $data['title'] = "Packages";
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
        $config['total_rows'] = MU_Model::count_all_data('package_conjection', array('pkcon_deleted' => 0));
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
        $data['packages'] = $this->mod_package->getAllPackage($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
    }
    
    /*
    * public function search_package
    * @noparam
    * sort, pagination, load view
    */
	public function search_package(){
		$data['title'] = "Search packages";
		$data['dashboard'] = "management";
        if($this->input->post("search_package_name")) $this->session->set_userdata('search_package', $this->input->post("search_package_name")); // else exit();
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
        $config['total_rows'] = MU_Model::count_all_data('package_conjection', array('pkcon_deleted' => 0), array('pkcon_name'=> $this->session->userdata('search_package')));
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
        $data['packages'] = $this->mod_package->getAllSearchPackage($this->session->userdata('search_package'), $config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin', $data);
	}

    /*
    * public function add_package
    * @noparam
    * load view and add new record
    * redirect
    */
    public function add_package(){
        $data['title'] = "Add Packages";
        $data['dashboard'] = "management";
        $data['txtLocation'] = $this->mod_package->getLocation();
        $data['txtFastival'] = $this->mod_package->getFastival();
        $data['txtPhotos'] = $this->mod_package->getPhoto();
        $data['txtStatus'] = array('0' => 'Unpublish','1' => 'Publish');
        // variable catch
        $data['chosimg']  = ''; 
        $data['lc']      = '';
        $data['ftv']     = '';
        $data['pkdc']    = '';
        $data['txtFrom'] = '';
        $data['txtTo']   = '';
        $data['status']   = '';

        if($this->input->post('addPackage')){
            $insert_package = $this->package_variable();
            // variable catch
            $data['lc']      = $insert_package['pkcon_lt_id'];
            $data['ftv']     = $insert_package['pkconl_ftv_id'];
            $data['pkdc']    = $insert_package['pkcon_description'];
            $data['txtFrom'] = $insert_package['pkcon_start_date'];
            $data['txtTo']   = $insert_package['pkcon_end_date'];
            $data['status']  = $insert_package['pkcon_status'];
            $data['chosimg'] = $insert_package['phoid'];

            $encryp = $data['txtFrom'].','.$data['txtTo'];
            $encrypted_id = base64_encode($encryp);
            // echo $encrypted_id; die();

            $config = $this->package_config();
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('<p class="error">'.'Please complete the field required...'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
            }else{                
                if($this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice'))){
                    $result_package = $this->mod_package->createPackage($insert_package);
                    if($result_package > 0) {
                        $this->session->set_userdata('create', show_message('<p>'.'Package was submited successfully ...'.'</p>', 'success'));
                        //redirect('package/add_package');
                        redirect('package/view_package/'.$result_package.'/'.$encrypted_id);
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

	// view package
	 public function view_package($pk_id, $date){
        $decrypted = base64_decode($date);
        $encrypted_id = base64_encode($decrypted);
        //echo $encrypted_id; die();
        $decrypted_date = explode(",", $decrypted);
        
		$data['title'] = "View Packages";
        $data['dashboard'] = "management";
        $data['packageById'] = $this->mod_package->getPackageById($pk_id);
        $data['pkSelectedAct'] = $this->returnOptionAct($decrypted_date);
        $data['pkSelectedAcc'] = $this->returnOptionAcc($decrypted_date);
        $data['pkSelectedTps'] = $this->returnOptionTps($decrypted_date);
        $data['txtLocation'] = $this->mod_package->getLocation();
        $data['txtFastival'] = $this->mod_package->getFastival();
        $data['txtPhotos'] = $this->mod_package->getPhoto();
        $data['txtStatus'] = array('0' => 'Unpublish','1' => 'Publish');
        // variable catch
        $data['chosimg']  = ''; 
        $data['lc']      = '';
        $data['ftv']     = '';
        $data['pkdc']    = '';
        $data['txtFrom'] = '';
        $data['txtTo']   = '';
        $data['status']   = '';

        if($this->input->post('saveChangePackage')){
            $update_package = $this->package_variable();
            // variable catch
            $data['lc']      = $update_package['pkcon_lt_id'];
            $data['ftv']     = $update_package['pkconl_ftv_id'];
            $data['pkdc']    = $update_package['pkcon_description'];
            $data['txtFrom'] = $update_package['pkcon_start_date'];
            $data['txtTo']   = $update_package['pkcon_end_date'];
            $data['status']  = $update_package['pkcon_status'];
            $pk_activities = $this->saveUpdateActivities($pk_id);
            $pk_accomodation = $this->saveUpdateAccommodation($pk_id);
            $pk_transportation = $this->saveUpdateTransport($pk_id);

            $config = $this->package_config();
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('<p class="error">'.'Please complete the field required...'.'</p>', 'error'));
                $this->load->view('munich_admin', $data);
            }else{                
                if($this->is_money($this->input->post('salePrice')) AND $this->is_money($this->input->post('purchasePrice'))){
                    $update_package["pk_activities"] = $pk_activities;
                    $update_package["pk_accomodation"] = $pk_accomodation;
                    $update_package["pk_transportation"] = $pk_transportation;
                    $result_package = $this->mod_package->updatePackage($update_package, $pk_id);
                    if($result_package) {
                        $this->session->set_userdata('create', show_message('<p>'.'Package was updated successfully ...'.'</p>', 'success'));
                        // redirect('package/list_record');
                        redirect('package/view_package/'.$pk_id.'/'.$encrypted_id);
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
    // function to save change Activities
    public function saveUpdateActivities($pkID){
        $selectAct = $this->mod_package->getActivitiesPackage($pkID);        
        $activities = array();
        $newActivites = array();
        if($selectAct->num_rows() > 0){
            foreach($selectAct->result() as $sltAct){                
                $activities = unserialize($sltAct->pk_activities);
            }
        }
        $actRecordID = $this->input->post('act_checkbox');
        $subactRecordID = $this->input->post('subact_checkbox');
        $epactRecordID = $this->input->post('epact_checkbox');
        var_dump($epactRecordID);
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
              if(array_key_exists($epact, $activities['extraproduct-pk'][$acts])){
                $newActivites['extraproduct-pk'][$acts][$epact] = $activities['extraproduct-pk'][$acts][$epact];
              }  
            }
        }

        // var_dump($newActivites['extraproduct-pk']);
        return serialize($newActivites);
    }

    // // function to save change Accommodation
    public function saveUpdateAccommodation($pkID){  
        $selectAcc = $this->mod_package->getAccommodationPackage($pkID);        
        $accommodations = array();
        $newAccommodations = array();
        if($selectAcc->num_rows() > 0){
            foreach($selectAcc->result() as $sltAcc){                
                $accommodations = unserialize($sltAcc->pk_accomodation);
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
              if(array_key_exists($epacc, $accommodations['extraproduct-pk'][$acc])){
                $newAccommodations['extraproduct-pk'][$acc][$epacc] = $accommodations['extraproduct-pk'][$acc][$epacc];
              }  
            }
        }
        // var_dump($newAccommodations['extraproduct-pk']);
        return serialize($newAccommodations);
    }

    // // function to save change Transport
    public function saveUpdateTransport($pkID){
        $selectTps = $this->mod_package->getTransportPackage($pkID); 
        $transportation = array();
        $newtransportation = array();
        if($selectTps->num_rows() > 0){
            foreach($selectTps->result() as $sltTps){                
                $transportation = unserialize($sltTps->pk_transportation);
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
              if(array_key_exists($eptps, $transportation['extraproduct-pk'][$tps])){
                $newtransportation['extraproduct-pk'][$tps][$eptps] = $transportation['extraproduct-pk'][$tps][$eptps];
              }  
            }
        }
        // var_dump($newtransportation['extraproduct-pk']);
        return serialize($newtransportation);
    }

    // returnOptionAct
    public function returnOptionAct($date){
        $acts[''] = 'Please select';
        $activitiesObject = $this->mod_package->getPackageActivities();
        foreach($activitiesObject->result() as $row){
            $dateAvaliable = $this->convertDateToRange($date, $row->start_date, $row->end_date);
            if($dateAvaliable){
                $acts[$row->act_id] = $row->act_name;
            }
        }
        return $acts;
    }

    // returnOptionAcc
    public function returnOptionAcc($date){
        $accs[''] = 'Please select';
        $accommodationObject = $this->mod_package->getPackageAccommodation();
        foreach($accommodationObject->result() as $row){
            $dateAvaliable = $this->convertDateToRange($date, $row->start_date, $row->end_date);
            if($dateAvaliable){
                $accs[$row->acc_id] = $row->acc_name;
            }
        }
        return $accs;
    }

    // returnOptionAcc
    public function returnOptionTps($date){
        $tps[''] = 'Please select';
        $transportionObject = $this->mod_package->getPackageTransportation();
        foreach($transportionObject->result() as $row){
            $dateAvaliable = $this->convertDateToRange($date, $row->start_date, $row->end_date);
            if($dateAvaliable){
                $tps[$row->tp_id] = $row->tp_name;
            }
        }
        return $tps;
    }

    // function convertDateToRange
    function convertDateToRange($findDate, $start, $end, $step = '+1 day', $format = 'Y-m-d' ) {
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
    // view subactivities and extraproduct
    public function viewSubEp(){
        $tableSubAct = "";
        $tableSubEp = "";
        $actID = $this->input->post('pk_act_id');
        $dateofpk = $this->input->post('dateofpk');
        if($actID == "") exit();
        $dateofpk = base64_decode($dateofpk);
        $dateofpk = explode(",", $dateofpk);
        $subactpk = $this->mod_package->getSubActPk($actID);
        $subEppk = $this->mod_package->getSubEpPk($actID);
        // for subactivities and display in package
        if($subactpk->num_rows() > 0){
            foreach($subactpk->result() as $row){
                $datesubpk = $this->convertDateToRange($dateofpk, $row->start_date, $row->end_date);
                if($datesubpk){
                    $tableSubAct .= '
                        <tr>
                            <td><input type="checkbox" name="pksubact[]" value="'.$row->act_id.'" class="checksuballtd" /></td>
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
        // for extraproduct and display in package
        if($subEppk->num_rows() > 0){
            foreach($subEppk->result() as $row){
                $dateeppk = $this->convertDateToRange($dateofpk, $row->start_date, $row->end_date);
                if($dateeppk){
                    $tableSubEp .= '
                        <tr>
                            <td><input type="checkbox" name="pkep[]" value="'.$row->ep_id.'" class="checkepalltd" /></td>
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

// view subaccommodation and extraproduct
    public function viewSubEpAcc(){
        $tableSubAcc = "";
        $tableSubEp = "";
        $accID = $this->input->post('pk_acc_id');
        $dateofpk = $this->input->post('dateofpk');
        if($accID == "") exit();
        $dateofpk = base64_decode($dateofpk);
        $dateofpk = explode(",", $dateofpk);
        $subaccpk = $this->mod_package->getSubAccPk($accID);
        $subEppk = $this->mod_package->getSubEpAccPk($accID); 
        // for subaccommodation and display in package
        if($subaccpk->num_rows() > 0){
            foreach($subaccpk->result() as $row){
                $datesubpk = $this->convertDateToRange($dateofpk, $row->start_date, $row->end_date);
                if($datesubpk){
                    $tableSubAcc .= '
                        <tr>
                            <td><input type="checkbox" name="pksubacc[]" value="'.$row->acc_id.'" class="checksuballtd" /></td>
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
        // for extraproduct and display in package
        if($subEppk->num_rows() > 0){
            foreach($subEppk->result() as $row){
                $dateeppk = $this->convertDateToRange($dateofpk, $row->start_date, $row->end_date);
                if($dateeppk){
                    $tableSubEp .= '
                        <tr>
                            <td><input type="checkbox" name="pkep[]" value="'.$row->ep_id.'" class="checkepalltd" /></td>
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

// view subtransportation and extraproduct
    public function viewSubEpTps(){
        $tableSubAcc = "";
        $tableSubEp = "";
        $tpsID = $this->input->post('pk_tps_id');
        $dateofpk = $this->input->post('dateofpk');
        if($tpsID == "") exit();
        $dateofpk = base64_decode($dateofpk);
        $dateofpk = explode(",", $dateofpk);
        $subtpspk = $this->mod_package->getSubTpsPk($tpsID);
        $subEppk = $this->mod_package->getSubEpTpsPk($tpsID); 
        // for subtransportation and display in package
        if($subtpspk->num_rows() > 0){
            foreach($subtpspk->result() as $row){
                $datesubpk = $this->convertDateToRange($dateofpk, $row->start_date, $row->end_date);
                if($datesubpk){
                    $tableSubAcc .= '
                        <tr>
                            <td><input type="checkbox" name="pksubtps[]" value="'.$row->tp_id.'" class="checksuballtd" /></td>
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
        // for extraproduct and display in package
        if($subEppk->num_rows() > 0){
            foreach($subEppk->result() as $row){
                $dateeppk = $this->convertDateToRange($dateofpk, $row->start_date, $row->end_date);
                if($dateeppk){
                    $tableSubEp .= '
                        <tr>
                            <td><input type="checkbox" name="pkep[]" value="'.$row->ep_id.'" class="checkepalltd" /></td>
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

    // function add activities 
    public function add_activities($pkID, $date){
        $actID = $this->input->post('pkact');
        $epID  = $this->input->post('pkep');        
        $subAct = $this->input->post('pksubact');
        $selectAct = $this->mod_package->getActivitiesPackage($pkID);        
        $activities = array();
        if($selectAct->num_rows() > 0){
            foreach($selectAct->result() as $sltAct){                
                $activities = unserialize($sltAct->pk_activities);
            }
        }

    // main activities
        $activitiespackage = $this->mod_package->getActivitiesFromPk($actID);
        $activitiespackage = $activitiespackage->result();
        $activitiespackage = json_decode(json_encode($activitiespackage), true);
        $activities['main-activities'][$activitiespackage[0]['act_id']] = $activitiespackage[0];
    // sub activitities
        $subactivitiespackage = $this->mod_package->getSubActivitiesFromPk($subAct);
        $subactivitiespackage = $subactivitiespackage->result();
        $subactivitiespackage = json_decode(json_encode($subactivitiespackage), true);
        for($i = 0; $i < count($subactivitiespackage); $i++){
            $activities['sub-activities'][$actID][$subactivitiespackage[$i]['act_id']] = $subactivitiespackage[$i];
        }
    // extraproduct
        $extraproductactpackage = $this->mod_package->getExtraproductFromPk($epID);
        $extraproductactpackage = $extraproductactpackage->result();
        $extraproductactpackage = json_decode(json_encode($extraproductactpackage), true);
        for($j = 0; $j < count($extraproductactpackage); $j++){
            $activities['extraproduct-pk'][$actID][$extraproductactpackage[$j]['ep_id']] = $extraproductactpackage[$j];
        }
    // update table column in table package_conjection
        $activities = serialize($activities);
        $pk_result = $this->mod_package->updateActivitiesPackage($activities, $pkID);
        redirect('package/view_package/'.$pkID.'/'.$date);
    }

    // function add accommodation 
    public function add_accommodation($pkID, $date){
        $accID = $this->input->post('pkacc');
        $epID  = $this->input->post('pkep');        
        $subAcc = $this->input->post('pksubacc');
        $selectAcc = $this->mod_package->getAccommodationPackage($pkID);        
        $accommodations = array();
        if($selectAcc->num_rows() > 0){
            foreach($selectAcc->result() as $sltAcc){                
                $accommodations = unserialize($sltAcc->pk_accomodation);
            }
        }

    // main accommodations
        $accommodationspackage = $this->mod_package->getAccommodationsFromPk($accID);
        $accommodationspackage = $accommodationspackage->result();
        $accommodationspackage = json_decode(json_encode($accommodationspackage), true);
        $accommodations['main-accommodation'][$accommodationspackage[0]['acc_id']] = $accommodationspackage[0];
    
    // sub accommodation
        $subaccommodationspackage = $this->mod_package->getSubaccommodationsFromPk($subAcc);
        $subaccommodationspackage = $subaccommodationspackage->result();
        $subaccommodationspackage = json_decode(json_encode($subaccommodationspackage), true);
        for($i = 0; $i < count($subaccommodationspackage); $i++){
            $accommodations['sub-accommodation'][$accID][$subaccommodationspackage[$i]['acc_id']] = $subaccommodationspackage[$i];
        }
    // extraproduct
        $extraproductactpackage = $this->mod_package->getExtraproductFromPk($epID);
        $extraproductactpackage = $extraproductactpackage->result();
        $extraproductactpackage = json_decode(json_encode($extraproductactpackage), true);
        for($j = 0; $j < count($extraproductactpackage); $j++){
            $accommodations['extraproduct-pk'][$accID][$extraproductactpackage[$j]['ep_id']] = $extraproductactpackage[$j];
        }
    // update table column in table package_conjection
        $accommodations = serialize($accommodations);
        $pk_result = $this->mod_package->updateAccommodationsPackage($accommodations, $pkID);
        redirect('package/view_package/'.$pkID.'/'.$date);
    }

    // function add Transportation 
    public function add_transport($pkID, $date){
        $tpsID = $this->input->post('pktps');
        $epID  = $this->input->post('pkep');        
        $subTps = $this->input->post('pksubtps');
        $selectTps = $this->mod_package->getTransportPackage($pkID);        
        $transportation = array();
        if($selectTps->num_rows() > 0){
            foreach($selectTps->result() as $sltTps){                
                $transportation = unserialize($sltTps->pk_transportation);
            }
        }

    // main transportation
        $transportspackage = $this->mod_package->getTranpsportsFromPk($tpsID);
        $transportspackage = $transportspackage->result();
        $transportspackage = json_decode(json_encode($transportspackage), true);
        $transportation['main-transport'][$transportspackage[0]['tp_id']] = $transportspackage[0];
    
    // sub transportation
        $subtransportspackage = $this->mod_package->getSubTranpsportsFromPk($subTps);
        $subtransportspackage = $subtransportspackage->result();
        $subtransportspackage = json_decode(json_encode($subtransportspackage), true);
        for($i = 0; $i < count($subtransportspackage); $i++){
            $transportation['sub-transport'][$tpsID][$subtransportspackage[$i]['tp_id']] = $subtransportspackage[$i];
        }
    // extraproduct
        $extraproductactpackage = $this->mod_package->getExtraproductFromPk($epID);
        $extraproductactpackage = $extraproductactpackage->result();
        $extraproductactpackage = json_decode(json_encode($extraproductactpackage), true);
        for($j = 0; $j < count($extraproductactpackage); $j++){
            $transportation['extraproduct-pk'][$tpsID][$extraproductactpackage[$j]['ep_id']] = $extraproductactpackage[$j];
        }
    // var_dump($transportation);
    // update table column in table package_conjection
        $transportation = serialize($transportation);
        $pk_result = $this->mod_package->updateTransportationPackage($transportation, $pkID);
        redirect('package/view_package/'.$pkID.'/'.$date);
    }

    /*
    * public function package_config
    * @noparam
    * return config (array)
    */
    public function package_config(){
        $config = array(
            array('field' => 'pkName','label' => 'package name','rules' => 'trim|required'),
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

    /*
    * public function package_variable
    * @noparent
    * return $packages (array)
    */
    public function package_variable(){
        $packages['pkcon_name']          = $this->input->post('pkName');
        $packages['pkcon_start_date']    = $this->input->post('txtFrom');
        $packages['pkcon_end_date']      = $this->input->post('txtTo');
        $packages['pkcon_description']   = $this->input->post('txtDescribe');
        $packages['pkconl_ftv_id']       = $this->input->post('txtFastival');
        $packages['pkcon_lt_id']         = $this->input->post('txtLocation');
        $packages['phoid']               = $this->input->post('txtPhotos');
        $packages['pkcon_saleprice']     = $this->input->post('salePrice');
        $packages['pkcon_purchaseprice'] = $this->input->post('purchasePrice');
        $packages['pkcon_originalstock'] = $this->input->post('originalStock');
        $packages['pkcon_actualstock']   = $this->input->post('actualStock');
        $packages['pkcon_status']        = $this->input->post('txtStatus');
        return $packages;
    }

    //delete multiple packages
    public function deleteMulti(){
      $multiCheck = $this->input->post("check_checkbox");
      $update['pkcon_deleted'] = 1;
      $result = $this->mod_package->deleteMultiple($update, $multiCheck);
      if($result > 0){
            $this->session->set_userdata('msg_success', 'The packages have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name packages.');
            echo "f";
        }
    }

    /* delete permenent packages */
    public function deletePermanent() {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_package->deletePermenent($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The packages have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_error', 'The packages record can not delete from table');
            echo "f";
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
    * pulic function status_package
    * @param $pk_status (int)
    * @param $pk_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function status_package ($pk_status, $pk_id, $pagione = false, $pagitwo = false, $pagithree = false){
        $pk_status = ($pk_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('package_conjection', array("pkcon_status" => $pk_status), array('pkcon_id' => $pk_id));
        $pagi = "";
        if($this->session->userdata('search_package')){ $function = "search_package"; }else{ $function = "list_record"; } 
        if($pagione != false) $pagi = $pagione;
        if($pagitwo != false) $pagi .= "/".$pagitwo;
        if($pagithree != false) $pagi .= "/".$pagithree;
          $redirect = "package/".$function."/".$pagi; 
          $pk_msg = ($pk_status == 1) ? "Unpublished" : "Published";
        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The package have been '.$pk_msg.' successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$pk_msg.' record on table name package.');
            redirect($redirect);
        }
    }

    /*
    * pulic function deletePackageById
    * @param $pk_id (int) 
    * return boolean
    * redirect to the current page
    */
    public function deletePackageById($pk_id, $pagione = false, $pagitwo = false,$pagithree = false){
        $total_rows = MU_Model::count_all_data('package_conjection', array('pkcon_deleted' => 0));
        $deleted = MU_Model::deleteRecordById('package_conjection', array("pkcon_deleted" => 1), array('pkcon_id' => $pk_id));
        $pagi = "";
        if($this->session->userdata('search_package')){ $function = "search_package"; }else{ $function = "list_record"; }
        if($total_rows > 0){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

           $redirect = "package/".$function."/".$pagi; 
        }else{ 
            $redirect = "package/".$function; 
        }

        if($deleted){
            $this->session->set_userdata('msg_success', 'The package have been deleted successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name package.');
            redirect($redirect);
        }
    }
    // function to view detial of activities
    public function actdetail($act_id, $pk_id){
        $selectAct = $this->mod_package->getActivitiesPackage($pk_id);        
        $activities = array();
        if($selectAct->num_rows() > 0){
            foreach($selectAct->result() as $sltAct){                
                $activities = unserialize($sltAct->pk_activities);
            }
        }
        $this->showDetailsAct($activities['main-activities'][$act_id]);
    }
    // function to view detial of accommodation
    public function accdetail($acc_id, $pk_id){
        $selectAcc = $this->mod_package->getAccommodationPackage($pk_id);        
        $accommodations = array();
        if($selectAcc->num_rows() > 0){
            foreach($selectAcc->result() as $sltAcc){                
                $accommodations = unserialize($sltAcc->pk_accomodation);
            }
        }
        $this->showDetailsAcc($accommodations['main-accommodation'][$acc_id]);
    }

    // function to view detial of transportation
    public function tpdetail($tpsid, $pk_id){
        $selectTps = $this->mod_package->getTransportPackage($pk_id);        
        $transportation = array();
        if($selectTps->num_rows() > 0){
            foreach($selectTps->result() as $sltTps){                
                $transportation = unserialize($sltTps->pk_transportation);
            }
        }
        $this->showDetailsTps($transportation['main-transport'][$tpsid]);
    }

    // function to view detial of subactivities
    public function subactdetail($act_id, $pk_id, $subAct){
        $selectAct = $this->mod_package->getActivitiesPackage($pk_id);        
        $activities = array();
        if($selectAct->num_rows() > 0){
            foreach($selectAct->result() as $sltAct){                
                $activities = unserialize($sltAct->pk_activities);
            }
        }
        $this->showDetailsAct($activities['sub-activities'][$act_id][$subAct]);
    }
    // function to view detial of subaccommodation
    public function subaccdetail($acc_id, $pk_id, $subAcc){
        $selectAcc = $this->mod_package->getAccommodationPackage($pk_id);        
        $accommodations = array();
        if($selectAcc->num_rows() > 0){
            foreach($selectAcc->result() as $sltAcc){                
                $accommodations = unserialize($sltAcc->pk_accomodation);
            }
        }
        $this->showDetailsAcc($accommodations['sub-accommodation'][$acc_id][$subAcc]);
    }

    // function to view detial of transportation
    public function subtpsdetail($tpsid, $pk_id, $subTps){
        $selectTps = $this->mod_package->getTransportPackage($pk_id);        
        $transportation = array();
        if($selectTps->num_rows() > 0){
            foreach($selectTps->result() as $sltTps){                
                $transportation = unserialize($sltTps->pk_transportation);
            }
        }
        $this->showDetailsTps($transportation['sub-transport'][$tpsid][$subTps]);
    }

    // function to displaydetail
    public function showDetailsAct($details){
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
    // function to displaydetail
    public function showDetailsAcc($details){
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

    // function to displaydetail
    public function showDetailsTps($details){
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

    // function detail of extraproduct
    public function epdetail($feild ,$actacctps_id, $pk_id, $ep_id){
        if($feild == 'act'){
            $selectActAccTps = $this->mod_package->getActivitiesPackage($pk_id); 
            $dotVariable = 'pk_activities'; 
        }else if($feild == 'acc'){
            $selectActAccTps = $this->mod_package->getAccommodationPackage($pk_id); 
            $dotVariable = 'pk_accomodation'; 
        }else if($feild == 'tps'){
            $selectActAccTps = $this->mod_package->getTransportPackage($pk_id); 
            $dotVariable = 'pk_transportation'; 
        }      
        $actacctps = array();
        if($selectActAccTps->num_rows() > 0){
            foreach($selectActAccTps->result() as $sltActAccTps){                
                $sltActAccTps = unserialize($sltActAccTps->$dotVariable);
            }
        }
        $this->showDetailsep($sltActAccTps['extraproduct-pk'][$actacctps_id][$ep_id]);
    }

    // function display extraproduct details
    function showDetailsep($detials){
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

/* End of file package.php */
/* Location: ./application/controllers/package.php */