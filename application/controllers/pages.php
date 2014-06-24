<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MU_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_index','mod_booking'));
    }

    /*
    * index function is a function for load the default page
    * @noparam
    * Load index.php in folder view
    */

	public function index($menu_id = false)
	{
		$fe_data['menu_fe'] = $this->mod_index->getAllMenu();
		$fe_data['site_setting'] = "default";
		$this->load->view('index',$fe_data);
	}


	/*
	* function redirect from route.php in folder config
	* public function page
	* display the page by id
	* used table content and menu
	* load view index.php
	*/

	public function page()
	{
		if($this->uri->segment(4)){ $menu_id = $this->uri->segment(4); }elseif($this->uri->segment(3)){ $menu_id = $this->uri->segment(3); }else{ $menu_id = $this->uri->segment(2); }
		$fe_data['menu_fe'] = $this->mod_index->getAllMenu();
		$fe_data['content_fe'] = $this->mod_index->getContentById($menu_id);
		$fe_data['site_setting'] = $this->getTemplate($menu_id);
		if($fe_data['site_setting'] == "feedback") $fe_data['feedback'] = $this->mod_index->getFeedback();
		if($fe_data['site_setting'] == "contact") $fe_data['contact'] = $this->mod_index->getAdminProfile();
		if($fe_data['site_setting'] == "booking") $fe_data['show_festival'] = $this->mod_booking->getFestival();
		//if($fe_data['site_setting'] == "booking") $fe_data['detail'] = $this->mod_booking->getFestival();
		$this->load->view('index',$fe_data);
	}

	/*
	* public function getTemplate()
	* @param menu_id (int)
	* used table content
	* return $tmpl
	*/
	public function getTemplate($menu_id){
		$tmpl = "";
		$template = $this->mod_index->getContentTemplate($menu_id);
		if($template->num_rows() > 0){
			foreach($template->result() as $value){
				$tmpl = $value->con_template;
			}
			return $tmpl;
		}
		return $tmpl;
	}
	/*
	* public function feedback()
	* @noparam
	* used table feedback
	* return object
	*/
	public function feedback(){
		if($this->uri->segment(2)) $fb_id = $this->uri->segment(2); else $fb_id = ""; 
		$fe_data['menu_fe'] = $this->mod_index->getAllMenu();
		$fe_data['single_fb'] = $this->mod_index->getFeedbackById($fb_id);
		$fe_data['back_to'] = 'page/'.$fb_id; // wrong
		$fe_data['site_setting'] = "view_feedback";
		$this->load->view('index', $fe_data);
	}

	// edit activities
	public function detail(){
		$fe_data['menu_fe'] = $this->mod_index->getAllMenu();
		$fe_data['title'] = "detail";
		$fe_data['site_setting'] = "booking_detail";
		$this->load->view('index', $fe_data);
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */