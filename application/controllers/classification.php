<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classification extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_classification') );
    }

	public function list_record(){
		$data['title'] = "Classification";
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

        $config['total_rows'] = MU_Model::count_all_data('classification', array('clf_deleted' => 0));
        $config['per_page'] = 5;

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

		$data['getAllClassification'] = $this->mod_classification->getAllClassification($config['per_page'], $page, $sortby, $data['sort']);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin', $data);
	}

	/* 
	@: search classification by name
	*/
	public function search_classification(){
		$data['title'] = "Search Classification";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = 'search_classification';
        if($this->input->post('search_classification_name')){
			$this->session->set_userdata("classification_name", $this->input->post('search_classification_name'));
		}else{
			$this->session->set_userdata("classification_name", "");	
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
            $config['total_rows'] = MU_Model::count_all_data('classification', array('clf_deleted' => 0),array("clf_name"=>$this->session->userdata("classification_name")));
            $config['per_page'] = 5;
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
            $data['search_classification'] = $this->mod_classification->getSearchClassification($config['per_page'], $page, $sortby, $data['sort'],$this->session->userdata("classification_name"));
            $data['pagination'] = $this->pagination->create_links();  
        $this->load->view('munich_admin', $data);
	}
	/*
	@: delete classification by id
	*/
	public function deleteClassificationById($classification_id,$pagination = false){
  	  $total_count = MU_Model::count_all_data('classification',array('clf_deleted' => 0));
  	  $delete_classification = MU_Model::deleteRecordById('classification',array("clf_deleted" => 1) ,array('clf_id' => $classification_id));
	  	  if($delete_classification){redirect('classification/list_record');
			  $this->session->set_userdata('create', show_message('The classification have been deleted successfully.', 'success'));
	  		  redirect('classification/list_record');
	  	 }
	}
	/************
		**** @: delete multiple classification ******
	*/	 
	public function deleteMultipleClassification(){
	  $multiCheck = $this->input->post("check_checkbox");
	  $update['clf_deleted'] = 1;
	  $result = $this->mod_classification->deleteMultipleClassification($update,$multiCheck);
	  if($result > 0){
            $this->session->set_userdata('create', show_message('The classification have been deleted successfully.', 'success'));
            echo "t";
       } else {
            $this->session->set_userdata('create', show_message('Cannot delete record on table name classification.', 'error'));
            echo "f";
       }
  }
      /***********
        @: remove permanent of classification
      **************/
        public function deletePermenentClassification(){
      $multiCheck = $this->input->post("check_checkbox");
      $result = $this->mod_classification->deletePermenentClassification($multiCheck);
      if($result > 0){
          $this->session->set_userdata('create','The classification have been deleted successfully.', 'success');
          echo "t";
      }else{
          $this->session->set_userdata('create','The classification record can not delete from table', 'error');
          echo "f";
          }
      }
	/*
	@: ** add new classification
	*/
	public function add_classification(){
		$data['title'] = "Add Classification";
		$data['dashboard'] = "management";
		if($this->input->post('addClassification')){
			$addClassification  = array(
				array('field' => 'classificationName','label' => 'Classification Name','rules' => 'trim|required' ),
				array('field' => 'classificationValue','label' => 'Classification Value','rules' => 'trim|required'),
			);
			$this->form_validation->set_rules($addClassification);
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
            }else{
            	$classificationName = $this->input->post('classificationName');
            	$classificationValue = $this->input->post('classificationValue');
            	$insert_classification = $this->mod_classification->add_classification($classificationName, $classificationValue);
				$this->session->set_userdata('create', show_message('Your data input was successfully.', 'success'));
					// redirect('classification/list_record');
					redirect('classification/view_classification/'.$insert_classification);
					
				
            }
		}
		$this->load->view('munich_admin', $data);
	}

	// view classification
	 public function view_classification(){
		$data['title'] = "View Classification";
		$data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['view_classification'] = $this->mod_classification->select_classificationId($get_id);
		$this->load->view('munich_admin', $data);
	}

	// edit classification
	public function edit_classificaion(){
		$data['title'] = "Edit Classification";
		$data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['get_classification'] = $this->mod_classification->select_classificationId($get_id);
		if($this->input->post('edit_classification')){
			$updateClassification  = array(
				array('field' => 'classificationName','label' => 'Classification Name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean' ),
				array('field' => 'classificationValue','label' => 'Classification Value','rules' => 'trim|required|numeric' ),
			);
			$this->form_validation->set_rules($updateClassification);
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
            }else{
            	$get_classificationName = $this->input->post('classificationName');
            	$get_classificationValue = $this->input->post('classificationValue');
            	$classificationUpdate = $this->mod_classification->edit_classification($get_id, $get_classificationName, $get_classificationValue);
				if($classificationUpdate>0){
					$this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
					// redirect('classification/list_record');
					redirect('classification/view_classification/'.$get_id);
				}
            }
		}
		$this->load->view('munich_admin', $data);
	}

}

/* End of file classification.php */
/* Classificaion: ./application/controllers/classification.php */