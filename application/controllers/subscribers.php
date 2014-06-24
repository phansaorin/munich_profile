<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribers extends CI_Controller {
	
	 public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_subscribers','mod_admin'));
    }

	public function list_record(){
		$data['title'] = "Subscribers";
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

        $config['total_rows'] = MU_Model::count_all_data('subscriber', array('sub_deleted' => 0));
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
        $data['subscriber'] = $this->mod_subscribers->ShowSubscriber($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        
        
        
        $this->load->view('munich_admin', $data);
	}
	 public function view_subscribers() {
        $data['title'] = "View Subscribers";
        $data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['view_subscriber'] = $this->mod_subscribers->view_subscribers($get_id);
		$data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $this->load->view('munich_admin', $data);
    }

	public function edit_subscribers() {
        $data['title'] = "Edit Subscribers";
        $data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['old_txtStatussub'] = array('0' => 'Unpublished','1' => 'Published');
        $data['get_subscriber'] = $this->mod_subscribers->selectSubscriberByID($get_id);
          if ($this->input->post('edit_subscribers')){
					$dataUpdate = array(
						          array('field' => 'old_firstnamesub','label' => 'First name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
								  array('field' => 'old_lastnamesub', 'label' => 'Last name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
								  array('field' => 'old_emailsub','label' => 'Email','rules' => 'required|valid_email'),
								);
            $this->form_validation->set_rules($dataUpdate);
            $this->session->set_userdata('create',$data);
              if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
			  }else{
                       $get_subfirstname =   $this->input->post('old_firstnamesub');
                       $get_sublastname  =   $this->input->post('old_lastnamesub');
                       $get_subemail     =   $this->input->post('old_emailsub');
					   $get_subtxtStatus    = $this->input->post('old_txtStatussub');
                      
					   $subscribersupdate = $this->mod_subscribers->edit_subscrib($get_id,$get_subfirstname,$get_sublastname,$get_subemail,$get_subtxtStatus,$get_subtxtRole);
                       if($subscribersupdate > 0){
						   $this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
						   // redirect('subscribers/list_record');
						   redirect('subscribers/view_subscribers/'.$get_id);
						}   
               }
          }

        $this->load->view('munich_admin', $data);
    }
	
	 public function deleteSubscriberById($subscribe_id,$pagination = false){
  	  $delete_subscribe= MU_Model::deleteRecordById('subscriber',array("sub_deleted" => 1) ,array('sub_id' => $subscribe_id));
		  if($delete_subscribe){
			  redirect(strtolower(get_class()).'/list_record');
		 }
  	}	
	public function deleteSubscriberMultiple(){
		$multiCheck = $this->input->post("check_checkbox");
	    $update['sub_deleted'] = 1;
	    $result = $this->mod_subscribers->deleteMultipleSubscrib($update,$multiCheck);
	    if($result > 0){
			$this->session->set_userdata('msg_success', 'The subscriber have been deleted successfully.');
			echo "t";
		} else {
			$this->session->set_userdata('msg_error', 'Cannot delete record on table name subscriber.');
			echo "f";
		}
	}
	public function deleteSubscriberPermenent(){
		$multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_subscribers->deletePermenentSubscrib($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The subscriber have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The subscriber record can not delete from table');
            echo "f";
        }
	} 
	
	 public function search_subscribers(){
		$data['title'] = "Search Subscribers";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = 'search_passenger';
        if($this->input->post('searchSubscribersName')){
			$this->session->set_userdata("subscribers_name", $this->input->post('searchSubscribersName'));
		}else{
			$this->session->set_userdata("subscribers_name", "");	
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
            $config['total_rows'] = MU_Model::count_all_data('subscriber', array('sub_deleted' => 0),array("sub_fname"=>$this->session->userdata("subscribers_name")));
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
            $data['search_subscribers'] = $this->mod_subscribers->search_subscribers($config['per_page'], $page, $sortby, $data['sort'],$this->session->userdata("subscribers_name"));
            $data['pagination'] = $this->pagination->create_links();
			
			
        $this->load->view('munich_admin', $data);
	}
	public function status_subscribers($subscriber_status, $subscriber_id){
        $total_rows = MU_Model::count_all_data('subscriber', array('sub_deleted' => 0));
        $subscriber_status = ($subscriber_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('subscriber', array("sub_status" => $subscriber_status), array('sub_id' => $subscriber_id));
        $subscribers_msg = ($subscriber_status == 1) ? "Published" : "Unpublished";

        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The subscribers have been '.$subscribers_msg.' successfully.');
            redirect('subscribers/list_record');
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$subscribers_msg.' record on table name subscriber.');
           redirect('subscribers/list_record');
        }
    }
	public function sendEmail(){
		
		    $data['title'] = "Send Email Subscribers";
        	$data['dashboard'] = "management";
		    $data['value'] = $this->mod_subscribers->getSubscriber();
		    $user_id = $this->session->userdata('admin');
        	$data['emailAdmin'] = $this->mod_admin->getEmailAdmin($user_id);
			$recievers = '<div>';
			$recievers .= '<ul class="nav nav-list">';
				foreach($data['value'] as $value) {
                			$checkBox = form_checkbox(array('class' => 'check_checkbox recievers','id' => 'check_checkbox','name' => 'sb_checkbox[]'),$value->sub_email); 
			    		$recievers .= '<li>'.$checkBox.' '.$value->sub_email.'</li>';			
              			  }
		            	$recievers .= '</ul></div>';
		            	
		            											
        $this->load->view('munich_admin', $data);
			
	}
	 public function sendToEmail(){
        $data['title'] = "Send Email Subscribers";
        $data['dashboard'] = "management";
                if ($this->input->post('btnSend')) {

                    $recievers = $_POST['sb_checkbox'];
                    $sender = $_POST['sender'];
                    $subject = $_POST['subject'];
                    foreach ($recievers as $name => $address)
                                {
                                    $data['name'] = $this->mod_subscribers->SubscribersName($address);
                                            foreach($data['name'] as $item){
                                            
                                            $message = strip_tags($_POST['messages']);
                                            $message = str_replace("&nbsp;","\n", $message);
                                            $firstname = ucfirst($item->sub_fname);
                                            $img_header = '<img src="http://masterbooking.codingate.com/assets/img/FE/header.PNG" />';
                                            $message = str_replace("@firstname", $firstname, $message);
                                            $bodyMessage = $img_header."\n". $message;
                                            $this->email->set_mailtype("html");
                                            $this->email->clear();
                                    
                                            $this->email->to($address);
                                            $this->email->from($sender);
                                            $this->email->subject($subject);
                                            $this->email->message($bodyMessage);
                                            $this->email->send();
                                          
                                            }
                                }
                
               
               }
           $this->session->set_userdata('success_msg', show_message("Your email was successfully sent", "success"));
                    
          redirect('subscribers/list_record');      
    }
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */