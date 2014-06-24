<?php 

    if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Fe_Login extends MU_Controller {

            public function __construct() {
                parent::__construct();
                 $this->load->model('mod_felogin');         
            }
            public function index() {
                $this->loginuser();
            }
            public function loginuser() {
                $data['title'] = "Passenger Login";
                $data['passenger'] = "passenger";
                if($this->input->post('btn_loginfe')){
                        
                        $this->form_validation->set_rules('txt_email', 'Email', 'required');
                        $this->form_validation->set_rules('txt_password', 'Password', 'required');
                        if ($this->form_validation->run() == FALSE){
                           $this->load->view('template/FE/loginuser');
                        }else{
                $username = $this->input->post('txt_email');
				$password = $this->input->post('txt_password');	
				$data['login'] = $this->mod_felogin->login_fe($username, $password);
                                if($data['login']->num_rows() > 0){
					foreach($data['login']->result() as $rows){
						$user = array(
                                                'pass_id'=> $rows->pass_id,
                                                'pass_email'=> $rows->pass_email
										
						 );
                            
						$id = $rows->pass_id;
						$this->session->set_userdata('passenger', $user);
						$this->session->set_userdata('passengerid',($rows->pass_id));
						$this->session->set_userdata('passengerfullname', ucfirst($rows->pass_fname) . ' ' . strtoupper($rows->pass_lname));
                                                redirect('site/profile');
					}
				}else{
					$this->load->view('template/FE/loginuser');
					}
                            
                        }
                }else{
                        $this->load->view('template/FE/loginuser');
                }
            }
            
          public function logout() {
      		$this->session->set_userdata('sign_out');
                $this->session->unset_userdata('passenger');
                redirect('site');
    	}
    }

?>