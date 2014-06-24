<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facilities extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_facilities') );
    }

	public function list_record(){
		$data['title'] = "Facilities";
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
            $data['sort'] = "ASC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }

        $config['total_rows'] = MU_Model::count_all_data('facilities', array('facilities_deleted' => 0));
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

		$data['getAllFacilities'] = $this->mod_facilities->getAllFacilities($config['per_page'], $page, $sortby, $data['sort']);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin', $data);
	}

	/* 
	@: search facilities by name
	*/
	public function search_facilities(){
		$data['title'] = "Search Facilities";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = 'search_facilities';
        if($this->input->post('search_facilities_name')){
			$this->session->set_userdata("facilities_title", $this->input->post('search_facilities_name'));
		}else{
			$this->session->set_userdata("facilities_title", "");	
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
            } else {
                $sortby = "ID";
                $data['sort'] = "ASC";
                $config['base_url'] = site_url($controller . "/" . $function);
                $config['uri_segment'] = 3;
            }
            $config['total_rows'] = MU_Model::count_all_data('facilities', array('facilities_deleted' => 0),array("facilities_title"=>$this->session->userdata("facilities_title")));
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
            $data['search_facilities'] = $this->mod_facilities->getSearchFacilities($config['per_page'], $page, $sortby, $data['sort'],$this->session->userdata("facilities_title"));
            $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}
	/*
	@: delete facilities by id
	*/
	public function deleteFacilitiesById($facilities_id,$pagination = false){
  	  $total_count = MU_Model::count_all_data('facilities',array('facilities_deleted' => 0));
  	  $delete_facilities = MU_Model::deleteRecordById('facilities',array("facilities_deleted" => 1) ,array('facilities_id' => $facilities_id));
	  	  if($delete_facilities){
	  		  redirect(strtolower(get_class()).'/list_record');
	  	 }
	}
	/************
		**** @: delete multiple facilities ******
	*/	 
	public function deleteMultipleFacilities(){
	  $multiCheck = $this->input->post("check_checkbox");
	  $update['facilities_deleted'] = 1;
	  $result = $this->mod_facilities->deleteMultipleFacilities($update,$multiCheck);
	  if($result > 0){
            $this->session->set_userdata('create', 'The facilities have been deleted successfully.', 'success');
            echo "t";
       } else {
            $this->session->set_userdata('create', 'Cannot delete record on table name facilities.', 'error');
            echo "f";
       }
  }
      /***********
        @: remove permanent of facilities
      **************/
        public function deletePermenentFacilities(){
      $multiCheck = $this->input->post("check_checkbox");
      $result = $this->mod_facilities->deletePermenentFacilities($multiCheck);
      if($result > 0){
          $this->session->set_userdata('create','The facilities have been deleted successfully.', 'success');
          echo "t";
      }else{
          $this->session->set_userdata('create','The facilities record can not delete from table', 'error');
          echo "f";
          }
      }
	/*
	@: ** add new facilities
	*/
	public function add_facilities(){
		if($this->input->post('addFacilities')){
			$addFacilities  = array(
				array('field' => 'facilitiesName','label' => 'Facilities Name','rules' => 'trim|required' ),
                array('field' => 'facilitiesValue','label' => 'Facilities Value','rules' => 'trim|required' ),
    		);
			$this->form_validation->set_rules($addFacilities);
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
            }else{
            	$facilitiesName = $this->input->post('facilitiesName');
                $facilitiesValue = $this->input->post('facilitiesValue');
            	$insert_facilities = $this->mod_facilities->add_facilities($facilitiesName, $facilitiesValue);
            	$this->session->set_userdata('create', show_message('Your data input was successfully.', 'success'));
            	// redirect('facilities/list_record');
            	redirect('facilities/view_facilities/'.$insert_facilities);
            }
		}
		// $this->load->view('munich_admin', $data);
	}

	// view activities
	 public function view_facilities(){
		$data['title'] = "View Facilities";
		$data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['view_facilities'] = $this->mod_facilities->select_facilitiesId($get_id);
		$this->load->view('munich_admin', $data);
	}

    /*
    @: *** status of facilities ***
    */
    public function fact_status() {
            $current_status = $this->uri->segment(3);
            $facilities_id = $this->uri->segment(4);
            $changed_status = MU_Model::update_status($facilities_id, $current_status, 'facilities_status', 'facilities_id', 'facilities');
            $data['ftvid'] = MU_Model::getStatus($facilities_id, 'facilities_id', 'facilities');
            foreach ($data['ftvid']->result() as $row) {
                $ftv_name = ucfirst($row->ftv_name);
            }
            if ($changed_status > 0) {
                $sms_enable = $ftv_name . ' was published!';
                $sms_unable = $ftv_name . ' was unpublished!';
                if ($current_status == '0') {
                    $this->session->set_userdata('status', show_message($sms_enable, 'success'));
                    if ($this->session->userdata('per_page')) {
                        redirect('facilities/list_record/' . $this->session->userdata('cur_page') . '/' . $this->session->userdata('pagination') . '?limit=' . $this->session->userdata('per_page'));
                    }
                    redirect('facilities/list_record/' . $this->session->userdata('cur_page') . '/' . $this->session->userdata('pagination'));
                } else {
                    $this->session->set_userdata('status', show_message($sms_unable, 'success'));
                    if ($this->session->userdata('per_page')) {
                        redirect('facilities/list_record/' . $this->session->userdata('cur_page') . '/' . $this->session->userdata('pagination') . '?limit=' . $this->session->userdata('per_page'));
                    }
                    redirect('facilities/list_record/' . $this->session->userdata('cur_page') . '/' . $this->session->userdata('pagination'));
                }
            }
    }

	// edit activities
	public function edit_facilities(){
		$data['title'] = "Edit Facilities";
		$data['dashboard'] = "management";
		 $get_id = $this->uri->segment(3);
		 $data['get_facilities'] = $this->mod_facilities->select_facilitiesId($get_id);
		if($this->input->post('edit_facilities')){
			$updateFacilities  = array(
				array('field' => 'facilitiesName','label' => 'Facilities Name','rules' => 'trim|required' ),
                array('field' => 'facilitiesValue','label' => 'Facilities Value','rules' => 'trim|required' )
			);
			$this->form_validation->set_rules($updateFacilities);
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
            }else{
            	$get_facilitiesName = $this->input->post('facilitiesName');
                $get_facilitiesValue = $this->input->post('facilitiesValue');
            	$this->mod_facilities->edit_facilities($get_id, $get_facilitiesName, $get_facilitiesValue);
            	$this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
            	// redirect('facilities/list_record');
            	redirect('facilities/view_facilities/'.$get_id);
            }
		}
		$this->load->view('munich_admin', $data);
	}

}

/* End of file facilities.php */
/* Location: ./application/controllers/facilities.php */