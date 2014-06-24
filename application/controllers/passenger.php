<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passenger extends CI_Controller {
	
	 public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_passenger'));
    }

	public function list_record(){
		$data['title'] = "Passenger";
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
            $data['sort'] = "ASC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }

        $config['total_rows'] = MU_Model::count_all_data('passenger', array('pass_deleted' => 0));
        $config['per_page'] = 10;
		$config['next_tag_open'] = '<li>';
        $config['uri_segment'] = 3;
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
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment($config['uri_segment']) && $this->uri->segment($config['uri_segment']) > 0) ? $this->uri->segment($config['uri_segment']) : 0;
        $data['passenger'] = $this->mod_passenger->ListPassenger($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}


	public function view_passenger() {
        $data['title'] = "View Passenger";
        $data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['view_passenger'] = $this->mod_passenger->view_passenger($get_id);
		$data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $this->load->view('munich_admin', $data);
    }

	public function add_passenger(){
		  $data['title'] = "Add New Passenger";
		  $data['dashboard'] = "management";
		  $data['gender'] = array('' => '-- Select --', 'F' => 'Female', 'M' => 'Male');
		  $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
		  $session = $this->session->set_userdata($data);
		 
				  if ($this->input->post('addPassenger')) {
					  $config = array(
								  array('field' => 'firstName','label' => 'First name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
								  array('field' => 'lastName', 'label' => 'Last name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
								  array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
								  array('field' => 'phone','label' => 'Phone','rules' => 'trim|required|numeric'),
								  array('field' => 'address','label' => 'Address','rules' => 'trim|required'),
								  array('field' => 'company','label' => 'Company','rules' => 'trim|required' ),
								  array('field' => 'password', 'label' => 'Password','rules' => 'trim|required|min_length[5]|max_length[20]|xss_clean'),
							);
					  $this->form_validation->set_rules($config);
					  $this->session->set_userdata('create',$data);
						  if($this->form_validation->run() == FALSE){
							  $this->session->set_userdata('create', show_message('Please check your completed form!', 'error'));
						  }else{
									$firstName =   $this->input->post('firstName');
									$lastName  =   $this->input->post('lastName');
									$Email     =   $this->input->post('email');
									$Phone     =   $this->input->post('phone');
									$Address   =   $this->input->post('address');
									$Company   =   $this->input->post('company');
									$Password  =   $this->input->post('password');
									$Gender    =   $this->input->post('gender');
									$Status    = $this->input->post('txtStatus');
									$passenger = $this->mod_passenger->createPassenger($firstName,$lastName,$Email,$Phone,$Address,$Company,$Password,$Gender,$Status);
									if($passenger > 0){
									$this->session->set_userdata('create', show_message('Your data was successfully added.', 'success'));
										// redirect('passenger/list_record');
										redirect('passenger/view_passenger/'.$passenger);
									  }
						  }
				  }
				   $this->load->view('munich_admin', $data);
	}

	 public function edit_passenger() {
        $data['title'] = "Edit Passenger";
        $data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
		$data['old_gender'] = array('' => '-- Select --', 'F' => 'Female', 'M' => 'Male');
        $data['old_txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $data['get_passenger'] = $this->mod_passenger->selectPassengerByID($get_id);
          if ($this->input->post('edit_passenger')){
					$dataUpdate = array(
						          array('field' => 'old_firstname','label' => 'First name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
								  array('field' => 'old_lastname', 'label' => 'Last name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
								  array('field' => 'old_email','label' => 'Email','rules' => 'required|valid_email'),
								  array('field' => 'old_phone','label' => 'Phone','rules' => 'trim|required|numeric'),
								  array('field' => 'old_address','label' => 'Address','rules' => 'trim|required'),
								  array('field' => 'old_company','label' => 'Company','rules' => 'trim|required' ),
								  array('field' => 'old_password', 'label' => 'Password','rules' => 'trim|required|min_length[5]|max_length[20]|xss_clean'),
							);
            $this->form_validation->set_rules($dataUpdate);
            $this->session->set_userdata('create',$data);
              if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
			  }else{
                       $get_firstname =   $this->input->post('old_firstname');
                       $get_lastname  =   $this->input->post('old_lastname');
                       $get_email     =   $this->input->post('old_email');
                       $get_phone     =   $this->input->post('old_phone');
                       $get_address   =   $this->input->post('old_address');
                       $get_company   =   $this->input->post('old_company');
                       $get_password  =   $this->input->post('old_password');
                       $get_gender    =   $this->input->post('old_gender');
                       $get_txtStatus      = $this->input->post('old_txtStatus');
					   $passengerupdate = $this->mod_passenger->edit_passenger($get_id,$get_firstname,$get_lastname,$get_email,$get_phone,$get_address,$get_company,$get_password,$get_gender,$get_txtStatus);
                       if($passengerupdate > 0){
						   $this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
						   // redirect('passenger/list_record');
						   redirect('passenger/view_passenger/'.$get_id);
						}   
               }
          }

        $this->load->view('munich_admin', $data);
    }
	 public function deletePassengerById($passenger_id,$pagination = false){
  	  $total_count = MU_Model::count_all_data('passenger',array('pass_deleted' => 0));
  	  $delete_passenger = MU_Model::deleteRecordById('passenger',array("pass_deleted" => 1) ,array('pass_id' => $passenger_id));
		  if($delete_passenger){
			  redirect(strtolower(get_class()).'/list_record');
		 }
  	}	
	public function deletePassengerMultiple(){
		$multiCheck = $this->input->post("check_checkbox");
	    $update['pass_deleted'] = 1;
	    $result = $this->mod_passenger->deleteMultiplePassenger($update,$multiCheck);
	    if($result > 0){
			$this->session->set_userdata('msg_success', 'The passenger have been deleted successfully.');
			echo "t";
		} else {
			$this->session->set_userdata('msg_error', 'Cannot delete record on table name passenger.');
			echo "f";
		}
	}
	public function deletePassengerPermenent(){
		$multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_passenger->deletePermenentPassenger($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The passenger have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The passenger record can not delete from table');
            echo "f";
        }
	} 
	
	public function search_passenger(){
		$data['title'] = "Search Passenger";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = 'search_passenger';
        if($this->input->post('searchPassengerName')){
			$this->session->set_userdata("passenger_name", $this->input->post('searchPassengerName'));
		}else{
			$this->session->set_userdata("passenger_name", "");	
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
            $config['total_rows'] = MU_Model::count_all_data('passenger', array('pass_deleted' => 0),array("pass_fname"=>$this->session->userdata("passenger_name")));
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
            $data['search_passenger'] = $this->mod_passenger->search_passenger($config['per_page'], $page, $sortby, $data['sort'],$this->session->userdata("passenger_name"));
            $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */