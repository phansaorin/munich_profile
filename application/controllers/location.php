<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_location') );
    }

	public function list_record(){
		$data['title'] = "Location";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);

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

        $config['total_rows'] = MU_Model::count_all_data('location', array('lt_deleted' => 0));
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

		$data['getAllLocations'] = $this->mod_location->getAllLocations($config['per_page'], $page, $sortby, $data['sort']);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin', $data);
	}

	/* 
	@: search location by name
	*/
	public function search_location(){
		$data['title'] = "Search Location";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = 'search_location';
        if($this->input->post('search_location_name')){
			$this->session->set_userdata("location_name", $this->input->post('search_location_name'));
		}else{
			$this->session->set_userdata("location_name", "");	
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
            $config['total_rows'] = MU_Model::count_all_data('location', array('lt_deleted' => 0),array("lt_name"=>$this->session->userdata("location_name")));
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
            $data['search_location'] = $this->mod_location->getSearchLocation($config['per_page'], $page, $sortby, $data['sort'],$this->session->userdata("location_name"));
            $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}
	/*
	@: delete location by id
	*/
	public function deleteLocationById($location_id,$pagination = false){
  	  $total_count = MU_Model::count_all_data('location',array('lt_deleted' => 0));
  	  $delete_location = MU_Model::deleteRecordById('location',array("lt_deleted" => 1) ,array('lt_id' => $location_id));
	  	  if($delete_location){
	  		  redirect(strtolower(get_class()).'/list_record');
	  	 }
	}
	/************
		**** @: delete multiple locations ******
	*/	 
	public function deleteMultipleLocation(){
	  $multiCheck = $this->input->post("check_checkbox");
	  $update['lt_deleted'] = 1;
	  $result = $this->mod_location->deleteMultipleLocation($update,$multiCheck);
	  if($result > 0){
            $this->session->set_userdata('create', 'The locations have been deleted successfully.', 'success');
       } else {
            $this->session->set_userdata('create', 'Cannot delete record on table name location.', 'error');
       }
  }
      /***********
        @: remove permanent of locations
      **************/
        public function deletePermenentLocation(){
      $multiCheck = $this->input->post("check_checkbox");
      $result = $this->mod_location->deletePermenentLocation($multiCheck);
      if($result > 0){
          $this->session->set_userdata('create','The location have been deleted successfully.', 'success');
          echo "t";
      }else{
          $this->session->set_userdata('create','The location record can not delete from table', 'error');
          echo "f";
          }
      }
	/*
	@: ** add new location
	*/
	public function add_location(){
		if($this->input->post('addLocation')){
			$addLocation  = array(
				array('field' => 'locationName','label' => 'Location Name','rules' => 'trim|required' ),
			);
			$this->form_validation->set_rules($addLocation);
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
            }else{
            	$locationName = $this->input->post('locationName');
            	$locationStatus = $this->input->post('lstatus');
            	$insert_location = $this->mod_location->add_location($locationName, $locationStatus);
            	$this->session->set_userdata('create', show_message('Your data input was successfully.', 'success'));
            	//redirect('location/list_record');
            	redirect('location/view_location/'.$insert_location);
            }
		}
	}

	// view activities
	 public function view_location(){
		$data['title'] = "View Location";
		$data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['view_location'] = $this->mod_location->select_locationId($get_id);
		$this->load->view('munich_admin', $data);
	}

	// edit activities
	public function edit_location(){
		$data['title'] = "Edit Location";
		$data['dashboard'] = "management";
		$data['option_lstatus'] = array('0' => 'Unpublished','1' => 'Published');
		$get_id = $this->uri->segment(3);
		$data['get_location'] = $this->mod_location->select_locationId($get_id);
		if($this->input->post('edit_location')){
			$updateLocation  = array(
				array('field' => 'locationName','label' => 'Location Name','rules' => 'trim|required' ),
			);
			$this->form_validation->set_rules($updateLocation);
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
            }else{
            	$get_locationName = $this->input->post('locationName');
            	$get_locationStatus = $this->input->post('lstatus');
            	$this->mod_location->edit_location($get_id, $get_locationName, $get_locationStatus);
            	$this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
            	// redirect('location/list_record');
            	redirect('location/view_location/'.$get_id);
            }
		}
		$this->load->view('munich_admin', $data);
	}

}

/* End of file location.php */
/* Location: ./application/controllers/location.php */