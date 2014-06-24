<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_admin');
    }
	 public function index() {
        $this->loginAdmin();
    }
    public function loginAdmin() {
    	$data['title'] = "Administrator Login";
        $data['admin'] = "admin";
		if($this->input->post('btn_login')){
			$this->form_validation->set_rules('txt_email', 'Username', 'required');
			$this->form_validation->set_rules('txt_password', 'Password', 'required');
			if($this->form_validation->run() == FALSE){
				$this->load->view('login',$data);
			}else{
				$username = $this->input->post('txt_email');
				$password = $this->input->post('txt_password');	
				$data['login'] = $this->mod_admin->signin_admin($username, $password);
               	if($data['login']->num_rows() > 0){
					foreach($data['login']->result() as $rows){
						$user = array(
										'user_id'=> $rows->user_id,
										'user_email'=> $rows->user_mail
										
						 );
                            
						$id = $rows->user_id;
						$this->session->set_userdata('admin', $user);
						$this->session->set_userdata('userid',($rows->user_id));
						$this->session->set_userdata('full_username', ucfirst($rows->user_fname) . ' ' . strtoupper($rows->user_lname));						redirect('munich_admin/');
					}
				}else{
						$this->load->view('login',$data);
					}
			}
		}else{
		   $this->load->view('login',$data);	

		}
		
    }
	public function sign_out() {
        $this->session->unset_userdata('admin');
        redirect('login');
    }	
}

/* End of file mu_admin.php */
/* Location: ./application/controllers/mu_admin.php */