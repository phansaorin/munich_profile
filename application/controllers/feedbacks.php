<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 class Feedbacks extends MU_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_feedback','mod_user'));
     }
    public function add_feedback(){
    	$data['title'] = "Add New Passenger";
		$data['dashboard'] = "management";
		$data['txtStatus'] = array('' =>'--Selec'field' => 'name', 'label' => 'Name','rules' => 'trim|required'),
                          array('field' => 'email','label' => 'Email','rules' => 'trim|required'),
    $session = $this->session->set_userdata($data);
    if ($this->input->post('add_feedback')) {
            $config = array(                          array('field' => 'txtStatus','label' =>t--','0' => 'Unpublished','1' => 'Published');

                          array( 'Status','rules' => 'trim|required'),
                          array('field' => 'date', 'label' => 'Date','rules' => 'trim|required'),
                          array('field' => 'subject','label' => 'Subject','rules' => 'trim|required'),
                          array('field' => 'text','label' => 'Text','rules' => 'trim|required'),
			);
			$this->form_validation->set_rules($config);
			$this->session->set_userdata('create',$data);
			if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('create', show_message('Please check your completed form!', 'error'));
			$this->load->view('munich_admin', $data);
			}else{
						$username =   $this->input->post('name');
                        $email  =   $this->input->post('email');
                        $txtStatus = $this->input->post('txtStatus');
                        $date = $this->input->post('date');
						$subject   =   $this->input->post('subject');
						$text   =   $this->input->post('text');
			  $resulf = $this->mod_feedback->getDataFeedback($username,$email,$txtStatus,$date,$subject,$text); 
			if($resulf > 0){
			$this->session->set_userdata('create', show_message('Your data input was successfully.', 'success'));
			//redirect('feedbacks/list_record');
			redirect('feedbacks/view_feedback/'.$resulf);
			}else{
				echo "can not insert";
			}
		}
	}
		$this->load->view('munich_admin', $data);

    }
public function list_record(){
    	$data['title'] = "Feedback";
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
        $config['total_rows'] = MU_Model::count_all_data('feedback', array('fb_deleted' => 0));
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
        $data['show_feedback'] = $this->mod_feedback->showDateFeedback($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);

    }
    // eidt function
    public function edit_feedback(){
        $data['title'] = "Add New Passenger";
        $data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['get_feedback'] = $this->mod_feedback->select_feedback($get_id);
        $data['txtStatus'] = array('' =>'--Select--','0' => 'Unpublished','1' => 'Published');
    $session = $this->session->set_userdata($data);
    if ($this->input->post('edit_feedback')) {
            $config = array(
                          array('field' => 'old_name', 'label' => 'Name','rules' => 'trim|required'),
                          array('field' => 'old_email','label' => 'Email','rules' => 'trim|required'),
                          array('field' => 'old_txtStatus','label' => 'Status','rules' => 'trim|required'),
                          array('field' => 'old_date', 'label' => 'Date','rules' => 'trim|required'),
                          array('field' => 'old_subject','label' => 'Subject','rules' => 'trim|required'),
                          array('field' => 'old_text','label' => 'Text','rules' => 'trim|required'),
            );
            $this->form_validation->set_rules($config);
            $this->session->set_userdata('create',$data);
            if($this->form_validation->run() == FALSE){
            $this->session->set_userdata('create', show_message('Please check your completed form!', 'error'));
            $this->load->view('munich_admin', $data);
            }else{
                        $get_username =   $this->input->post('old_name');
                        $get_email  =   $this->input->post('old_email');
                        $get_txtStatus = $this->input->post('old_txtStatus');
                        $get_date = $this->input->post('old_date');
                        $get_subject   =   $this->input->post('old_subject');
                        $get_text   =   $this->input->post('old_text');
            $resulf = $this->mod_feedback->editDataFeedback($get_id,$get_username,$get_email,$get_txtStatus,$get_date,$get_subject,$get_text); 
            if($resulf > 0){
            $this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
            //redirect('feedbacks/list_record');
            redirect('feedbacks/view_feedback/'.$get_id);
            }else{
                echo "can not insert";
            }
        }
    }
        $this->load->view('munich_admin', $data);

    }
    public function search_feedback(){
		$data['title'] = "search feedback";
		$data['dashboard'] = "management";
        $data['search_feedback_name'] = $this->input->post("search_name");
	    if($this->input->post('search_name')){
		 $data['search_feedback_name'] = $this->input->post("search_name");

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
        $config['total_rows'] = MU_Model::count_all_data('feedback', array('fb_deleted' => 0));
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
        $data['feedbacks'] = $this->mod_feedback->getSearchFeedback($data['search_feedback_name'],$config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}
	public function view_feedback(){
		$data['title'] = "View Feedback";
		$data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['view_feedback'] = $this->mod_feedback->view_feedback($get_id);
		$data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $this->load->view('munich_admin', $data);

	// edit activities
    }
	public function deleteFeedbackMultiple(){
        $multiCheck = $this->input->post("check_checkbox");
        $update['fb_deleted'] = 1;
        $result = $this->mod_feedback->deleteFeedbackMultiple($update,$multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The feedback have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The feedback record can not delete from table');
            echo "f";
        }
    }
    public function deletePermenentFeedback() {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_feedback->deletePermenentFeedback($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The feedback have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The feedback record can not delete from table');
            echo "f";
        }
    }
    public function deleteFeedbackByID($feedback_id,$pagination = false){
        $total_count = MU_Model::count_all_data('feedback',array('fb_deleted' => 0));
        $delete_feedback = MU_Model::deleteRecordById('feedback',array("fb_deleted" => 1) ,array('fb_id' => $feedback_id));
            if($delete_feedback){
            redirect(strtolower(get_class()).'/list_record');
            }
   }
}   

