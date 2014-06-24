<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Festival extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_festival') );
    }

	public function list_record(){
		$data['title'] = "Festival";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);     
        $data['festivalPhotos'] = $this->mod_festival->getPhotos();
        $data['festivalLocation'] = $this->mod_festival->getLocation();
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

        $config['total_rows'] = MU_Model::count_all_data('festival', array('ftv_deleted' => 0));
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

		$data['getAllFestival'] = $this->mod_festival->getAllFestivals($config['per_page'], $page, $sortby, $data['sort']);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin', $data);
	}

	/* 
	@: search festival by name
	*/
	public function search_festival(){
		$data['title'] = "Search Festival";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $data['festivalPhotos'] = $this->mod_festival->getPhotos(); 
        $data['festivalLocation'] = $this->mod_festival->getLocation();
        $function = 'search_festival';
        if($this->input->post('search_festival_name')){
			$this->session->set_userdata("festival_name", $this->input->post('search_festival_name'));
		}else{
			$this->session->set_userdata("festival_name", "");	
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
            $config['total_rows'] = MU_Model::count_all_data('festival', array('ftv_deleted' => 0),array("ftv_name"=>$this->session->userdata("festival_name")));
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
            $page = ($this->uri->segment($config['uri_segment']) && $this->uri->segment($config['uri_segment']) > 0) ? 		$this->uri->segment($config['uri_segment']) : 0;
            $data['search_festival'] = $this->mod_festival->getSearchFestival($config['per_page'], $page, $sortby, $data['sort'],$this->session->userdata("festival_name"));
            $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}
	/*
	@: delete festival by id
	*/
	public function deleteFestivalById($festival_id,$pagination = false){
  	  $total_count = MU_Model::count_all_data('festival',array('ftv_deleted' => 0));
  	  $delete_festival = MU_Model::deleteRecordById('festival',array("ftv_deleted" => 1) ,array('ftv_id' => $festival_id));
	  	  if($delete_festival){
	  		  redirect(strtolower(get_class()).'/list_record');
	  	 }
	}
	/************
		**** @: delete multiple festivals ******
	*/	 
	public function deleteMultipleFestival(){
	  $multiCheck = $this->input->post("check_checkbox");
	  $update['ftv_deleted'] = 1;
	  $result = $this->mod_festival->deleteMultipleFestival($update,$multiCheck);
	  if($result > 0){
            $this->session->set_userdata('create', 'The festival have been deleted successfully.', 'success');
            echo "t";
       } else {
            $this->session->set_userdata('create', 'Cannot delete record on table name festival.', 'error');
            echo "f";
       }
  }
      /***********
        @: remove permanent of festivals
      **************/
        public function deletePermenentFestival(){
      $multiCheck = $this->input->post("check_checkbox");
      $result = $this->mod_festival->deletePermenentFestival($multiCheck);
      if($result > 0){
          $this->session->set_userdata('create','The festival have been deleted successfully.', 'success');
          echo "t";
      }else{
          $this->session->set_userdata('create','The festival record can not delete from table', 'error');
          echo "f";
          }
      }
	/*
	@: ** add new festival
	*/
	public function add_festival(){
		if($this->input->post('addFestival')){
			$addFestival  = array(
				array('field' => 'festivalName','label' => 'Festival Name','rules' => 'trim|required' ),
                array('field' => 'txtPhotos','label' => 'Festival Photos','rules' => 'trim|required' ),
			    array('field' => 'festivalLocation', 'label' => 'Festival Location', 'rules' => 'trim|required') 
            );
			$this->form_validation->set_rules($addFestival);
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
            }else{
            	$festivalName = $this->input->post('festivalName');
                $festivalPhotos = $this->input->post('txtPhotos');
                $festivalLocation = $this->input->post('festivalLocation');
                $festivalDetail = $this->input->post('festivalDetail');
            	$insert_festival = $this->mod_festival->add_festival($festivalName, $festivalPhotos, $festivalDetail,$festivalLocation);
            	$this->session->set_userdata('create', show_message('Your data input was successfully.', 'success'));
            	//redirect('festival/list_record');
            	redirect('festival/view_festival/'.$insert_festival);
            }
		}
	}

	// view activities
	 public function view_festival(){
		$data['title'] = "View Festival";
		$data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['view_festival'] = $this->mod_festival->select_festivalId($get_id);
		$this->load->view('munich_admin', $data);
	}

    /*
    @: *** status of festival ***
    */
    public function fest_status() {
            $current_status = $this->uri->segment(3);
            $ftv_id = $this->uri->segment(4);
            $changed_status = MU_Model::update_status($ftv_id, $current_status, 'ftv_status', 'ftv_id', 'festival');
            $data['ftvid'] = MU_Model::getStatus($ftv_id, 'ftv_id', 'festival');
            foreach ($data['ftvid']->result() as $row) {
                $ftv_name = ucfirst($row->ftv_name);
            }
            if ($changed_status > 0) {
                $sms_enable = $ftv_name . ' was published!';
                $sms_unable = $ftv_name . ' was unpublished!';
                if ($current_status == '0') {
                    $this->session->set_userdata('status', show_message($sms_enable, 'success'));
                    if ($this->session->userdata('per_page')) {
                        redirect('festival/list_record/' . $this->session->userdata('cur_page') . '/' . $this->session->userdata('pagination') . '?limit=' . $this->session->userdata('per_page'));
                    }
                    redirect('festival/list_record/' . $this->session->userdata('cur_page') . '/' . $this->session->userdata('pagination'));
                } else {
                    $this->session->set_userdata('status', show_message($sms_unable, 'success'));
                    if ($this->session->userdata('per_page')) {
                        redirect('festival/list_record/' . $this->session->userdata('cur_page') . '/' . $this->session->userdata('pagination') . '?limit=' . $this->session->userdata('per_page'));
                    }
                    redirect('festival/list_record/' . $this->session->userdata('cur_page') . '/' . $this->session->userdata('pagination'));
                }
            }
    }

	// edit activities
	public function edit_festival(){
		$data['title'] = "Edit Festival";
		$data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['get_festival'] = $this->mod_festival->select_festivalId($get_id);
	        $data['txtPhotos'] = $this->mod_festival->getPhotos();
	        $data['festivalLocation'] = $this->mod_festival->getLocation();
		if($this->input->post('edit_festival')){
			$updateFestival  = array(
				array('field' => 'festivalName','label' => 'Festival Name','rules' => 'trim|required' ),
                array('field' => 'txtPhotos','label' => 'Festival Photo','rules' => 'trim|required' ),
                array('field' => 'old_txtLocation', 'label' => 'Festival Location', 'rules' => 'trim|required')  
            );
			$this->form_validation->set_rules($updateFestival);
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
            }else{
            	$get_festivalName = $this->input->post('festivalName');
                $get_festivalDetail = $this->input->post('festivalDetail');
                $get_festivalPhotos = $this->input->post('txtPhotos');
                $get_festivalLocation = $this->input->post('old_txtLocation');
            	$this->mod_festival->edit_festival($get_id, $get_festivalName, $get_festivalDetail, $get_festivalPhotos,$get_festivalLocation);
            	$this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
            	// redirect('festival/list_record');
            	redirect('festival/view_festival/'.$get_id);
            }
		}
		$this->load->view('munich_admin', $data);
	}

}

/* End of file festival.php */
/* Location: ./application/controllers/festival.php */