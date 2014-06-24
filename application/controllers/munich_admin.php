<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Munich_admin extends CI_Controller {
	
	 public function __construct() {
        parent::__construct();
    } 
	public function index()
	{
		$this->dashboard_mn();
	} 
	public function dashboard_mn(){
		$data['title'] = "Dashboard";
		$data['dashboard'] = "Default Dashboard";
		$this->load->view('munich_admin', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 