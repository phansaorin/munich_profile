<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_profile');
    }
	
    public function detail_profile(){
            $data['title'] = "Detail user login information";
            $data['dashboard'] = "management";
            $get_id = $this->uri->segment(3);
            $data['detail_info'] = $this->mod_profile->profile_adminloging($get_id);
            $this->load->view('munich_admin', $data);
    }
}

/* End of file mu_admin.php */
/* Location: ./application/controllers/mu_admin.php */