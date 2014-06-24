<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller {
	
	 public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_room'));
    }

	public function list_record(){
		$data['title'] = "Room";
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

        $config['total_rows'] = MU_Model::count_all_data('room_types', array('rt_deleted' => 0));
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
        $data['room'] = $this->mod_room->ShowRoom($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}
	 public function view_room() {
        $data['title'] = "View Room";
        $data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['view_room'] = $this->mod_room->view_room($get_id);
		$data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $this->load->view('munich_admin', $data);
    }

	 public function add_room(){
		  $data['title'] = "Add New Room";
		  $data['dashboard'] = "management";
		  $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
		  $session = $this->session->set_userdata($data);
		 
				  if ($this->input->post('addRoom')) {
					  $config = array(
								  array('field' => 'roomName','label' => 'Room name','rules' => 'trim|required|min_length[2]|max_length[50]|xss_clean'),
								);
					  $this->form_validation->set_rules($config);
					  $this->session->set_userdata('create',$data);
						  if($this->form_validation->run() == FALSE){
							  $this->session->set_userdata('create', show_message('Please check your completed form!', 'error'));
						  }else{
									$roomName =   $this->input->post('roomName');
									$Status    = $this->input->post('txtStatus');
									$insert_room= $this->mod_room->createRoom($roomName,$Status);
									if($insert_room> 0){
									$this->session->set_userdata('create', show_message('Your data was successfully added.', 'success'));
										//redirect('room/list_record');
										redirect('room/view_room/'.$insert_room);
									  }
						  }
				  }
				   $this->load->view('munich_admin', $data);
	}

	 public function edit_room() {
        $data['title'] = "Edit Room";
        $data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['old_txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $data['get_room'] = $this->mod_room->selectRoomByID($get_id);
          if ($this->input->post('edit_room')){
					$dataUpdate = array(
						          array('field' => 'old_roomname','label' => 'Room name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
								 );
			$this->form_validation->set_rules($dataUpdate);
			$this->session->set_userdata('create',$data);
			  if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
			  }else{
                       $get_roomname =   $this->input->post('old_roomname');
                       $get_txtStatus      = $this->input->post('old_txtStatus');
					   $roomupdate = $this->mod_room->edit_room($get_id,$get_roomname,$get_txtStatus);
                       if($roomupdate > 0){
						   $this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
						  // redirect('room/list_record');
						  redirect('room/view_room/'.$get_id);
						}   
               }
          }

        $this->load->view('munich_admin', $data);
    }
	 public function deleteRoomById($room_id,$pagination = false){
  	 // $total_count = MU_Model::count_all_room('room_types',array('rt_deleted' => 0));
  	  $delete_room = MU_Model::deleteRecordById('room_types',array("rt_deleted" => 1) ,array('rt_id' => $room_id));
		  if($delete_room){
			  redirect(strtolower(get_class()).'/list_record');
		 }
  	}	
	public function deleteRoomMultiple(){
		$multiCheck = $this->input->post("check_checkbox");
	    $update['delete'] = 1;
	    $result = $this->mod_room->deleteMultipleRooms($update,$multiCheck);
	    if($result > 0){
			$this->session->set_userdata('msg_success', 'Your data was deleted!.');
			echo "t";
		} else {
			$this->session->set_userdata('msg_error', 'Your data was deleted!.');
			echo "f";
		}
	}
	public function deleteRoomPermenent(){
		$multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_room->deletePermenentRooms($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'Your data was removed!.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'Your data was removed!.');
            echo "f";
        }
	} 
	
	 public function search_room(){
		$data['title'] = "Search Room";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = 'search_room';
        if($this->input->post('searchRoomName')){
			$this->session->set_userdata("room_name", $this->input->post('searchRoomName'));
		}else{
			$this->session->set_userdata("room_name", "");	
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
            $config['total_rows'] = MU_Model::count_all_data('room_types', array('rt_deleted' => 0),array("rt_name"=>$this->session->userdata("room_name")));
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
            $data['search_room'] = $this->mod_room->search_room($config['per_page'], $page, $sortby, $data['sort'],$this->session->userdata("room_name"));
            $data['pagination'] = $this->pagination->create_links();
            $this->load->view('munich_admin', $data);
	}
	public function status_room($room_status, $room_id){
        $total_rows = MU_Model::count_all_data('room_types', array('rt_deleted' => 0));
        $room_status = ($room_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('room_types', array("rt_status" => $room_status), array('rt_id' => $room_id));
        $room_msg = ($room_status == 1) ? "Published" : "Unpublished";

        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The room have been '.$room_msg.' successfully.');
            redirect('room/list_record');
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$room_msg.' record on table name room.');
           redirect('room/list_record');
        }
    }

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */