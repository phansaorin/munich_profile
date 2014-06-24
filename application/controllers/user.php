<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        // $this->load->model(array('mod_admin'));
        $this->load->model('mod_user');
    }
	public function list_record(){
		$data['title'] = "Users";
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
        $config['total_rows'] = MU_Model::count_all_data('user', array('user_deleted' => 0));
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
        // $config['use_page_numbers'] = true;
        $this->pagination->initialize($config); //function to show all pages
        $page = ($this->uri->segment($config['uri_segment']) && $this->uri->segment($config['uri_segment']) > 0) ? $this->uri->segment($config['uri_segment']) : 0;
        $data['users'] = $this->mod_user->show_user($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);

	}
	public function add_user(){
	$data['title'] = "Add New Passenger";
	$data['dashboard'] = "management";
	$data['gender'] = array('' => '-- Select --', 'female' => 'Female', 'Male' => 'Male');
	$data['option_role'] = $this->mod_user->get_role();
	$data['txtStatus'] = array('' =>'--Select--','0' => 'Unpublished','1' => 'Published');
	$session = $this->session->set_userdata($data);
	if ($this->input->post('addUsers')) {
			$config = array(
						  array('field' => 'fname', 'label' => 'First Name','rules' => 'trim|required'),
                          array('field' => 'lname','label' => 'Last Name','rules' => 'trim|required'),
                          array('field' => 'txtStatus','label' => 'Status','rules' => 'trim|required'),
                          array('field' => 'gender','label' => 'Gender','rules' => 'trim|required'),
                          array('field' => 'usertype','label' => 'User Type','rules' => 'trim|required'),
                          array('field' => 'username', 'label' => 'User Name','rules' => 'trim|required'),
                          array('field' => 'email','label' => 'Email','rules' => 'trim|required'),
                          array('field' => 'phone_num','label' => 'Phone Number','rules' => 'trim|required'),
                          array('field' => 'address','label' => 'Address','rules' => 'trim|required'),
                          array('field' => 'company','label' => 'Company','rules' => 'trim|required' ),
						  array('field' => 'password', 'label' => 'Password','rules' => 'trim|required'),
                          array('field' => 'txtmobile','label' => 'Mobile','rules' => 'trim|required'),
                          array('field' => 'txtfix','label' => 'Fax','rules' => 'trim|required' ),
                          array('field' => 'website', 'label' => 'Website','rules' => 'trim|required')
			);
			$this->form_validation->set_rules($config);
			$this->session->set_userdata('create',$data);
			if($this->form_validation->run() == FALSE){

    //             	$this->session->set_userdata('add_fail', show_message('Can not add new user, please check again!', 'error'));
    //                	$this->view_main($data);
				// echo "fail";
			$this->session->set_userdata('add_fail', show_message('Can not add new user, please check again!', 'error'));
			$this->load->view('munich_admin', $data);
			}else{
			// echo "pass";
			$fname =   $this->input->post('fname');
                        $lname  =   $this->input->post('lname');
                        $username = $this->input->post('username');
                        $password = $this->input->post('password');
                        $gender =   $this->input->post('gender');
                        $email  =   $this->input->post('email');
			$phone   =   $this->input->post('phone_num');
                        $phone_two = $this->input->post('phone_num_two');
			$usertype = $this->input->post('usertype');
                        $address    =   $this->input->post('address');
                        $company     =   $this->input->post('company');
                        $txtStatus      = $this->input->post('txtStatus');
                        $fix    =   $this->input->post('txtmobile');
                        $mobile     =   $this->input->post('txtfix');
                        $website      = $this->input->post('website');
			$resulf = $this->mod_user->add_user($fname,$lname,$username,$password,$gender,$usertype,$email,$phone,$phone_two,$address,$company,$txtStatus,$fix,$mobile,$website); 
			if($resulf > 0){
				$this->session->set_userdata('create', show_message('Your data input was successfully.', 'success'));
				// redirect('user/list_record');
				redirect('user/view_user/'.$resulf);
			}
		}
	}
	$this->load->view('munich_admin', $data);
	}
	public function search_username(){
		$data['title'] = "search username";
		$data['dashboard'] = "management";
		  $data['search_user_name'] = $this->input->post("search_name");
		if($this->input->post('search_name')){
		  $data['search_user_name'] = $this->input->post("search_name");
		}
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
        $config['total_rows'] = MU_Model::count_all_data('user', array('user_deleted' => 0));
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
        // $data['users'] = $this->mod_user->getSearchName($config['per_page'], $page, $sortby, $data['sort']);
        $data['users'] = $this->mod_user->getSearchName($data['search_user_name'],$config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}
	// view activities
	 public function view_user(){
		$data['title'] = "View User";
		$data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['view_user'] = $this->mod_user->view_users($get_id);
		$data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $this->load->view('munich_admin', $data);

	// edit activities
    }
	public function edit_user(){
		$data['title'] = "Add New Passenger";
	$data['dashboard'] = "management";
	$get_id = $this->uri->segment(3);
	$data['get_users'] = $this->mod_user->select_user($get_id);
	$data['gender'] = array('' => '-- Select --', 'female' => 'Female', 'Male' => 'Male');
	$data['option_role'] = $this->mod_user->get_role();
	$data['old_txtStatus'] = array('' =>'--Select--','0' => 'Unpublished','1' => 'Published');
	$session = $this->session->set_userdata($data);
	if ($this->input->post('edit_user')){
	$dataUpdate = array(
						 array('field' => 'old_fname', 'label' => 'First Name','rules' => 'trim|required'),
                          array('field' => 'old_lname','label' => 'Last Name','rules' => 'trim|required'),
                          array('field' => 'old_txtStatus','label' => 'Status','rules' => 'trim|required'),
                          array('field' => 'old_gender','label' => 'Gender','rules' => 'trim|required'),
                          array('field' => 'old_usertype','label' => 'User Type','rules' => 'trim|required'),
                          array('field' => 'old_username', 'label' => 'User Name','rules' => 'trim|required'),
                          array('field' => 'old_email','label' => 'Email','rules' => 'trim|required'),
                          array('field' => 'old_phone_num','label' => 'Phone Number','rules' => 'trim|required'),
                          array('field' => 'old_address','label' => 'Address','rules' => 'trim|required'),
                          array('field' => 'old_company','label' => 'Company','rules' => 'trim|required' ),
						  array('field' => 'old_password', 'label' => 'Password','rules' => 'trim|required')
);
$this->form_validation->set_rules($dataUpdate);
$this->session->set_userdata('create',$data);
	if ($this->form_validation->run() == FALSE) {
	$this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
	}else{
		$get_fname = $this->input->post('old_fname');
		$get_lname = $this->input->post('old_lname');
		$get_email = $this->input->post('old_email');
		$get_phone = $this->input->post('old_phone_num');
		$get_address = $this->input->post('old_address');
		$get_company = $this->input->post('old_company');
		$get_password = $this->input->post('old_password');
		$get_gender = $this->input->post('old_gender');
		$get_txtStatus = $this->input->post('old_txtStatus');
		$get_usertype = $this->input->post('old_usertype');
		$get_username = $this->input->post('old_username');
		$userupdate = $this->mod_user->edit_user($get_id,$get_fname,$get_lname,$get_email,$get_phone,$get_address,$get_company,$get_password,$get_gender,$get_txtStatus,$get_usertype,$get_username);
	if($userupdate > 0){
	$this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
	//redirect('user/list_record');
	redirect('user/view_user/'.$get_id);
	}
		}
	}

$this->load->view('munich_admin', $data);
}
 public function deletePermenentUser() {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_user->deletePermenentAct($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The activities have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The activities record can not delete from table');
            echo "f";
        }
    }
    public function deleteUserMultiple(){
		$multiCheck = $this->input->post("check_checkbox");
		$update['user_deleted'] = 1;
		$result = $this->mod_user->deleteMultipleUser($update,$multiCheck);
		if($result > 0){
		$this->session->set_userdata('msg_success', 'The passenger have been deleted successfully.');
		echo "t";
		} else {
		$this->session->set_userdata('msg_error', 'Cannot delete record on table name passenger.');
		echo "f";
		}
	}
      //delete activities by id
   public function deleteUserById($user_id,$pagination = false){
	$total_count = MU_Model::count_all_data('user',array('user_deleted' => 0));
	$delete_user = MU_Model::deleteRecordById('user',array("user_deleted" => 1) ,array('user_id' => $user_id));
	if($delete_user){
	redirect(strtolower(get_class()).'/list_record');
	}
  //end delete activities by id
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */