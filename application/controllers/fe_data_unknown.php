<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Munich_admin extends CI_Controller {
	
	 public function __construct() {
        parent::__construct();
    } 
	public function index()
	{
		$this->fe_data();
	} 
	public function booking(){
		$fe_data['title'] = "Booking";
		$fe_data['booking'] = "Default Font End";
		$this->load->view('fe_data', $fe_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 