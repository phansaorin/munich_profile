<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login_admin extends MU_Controller {

   public function __construct() {
        parent::__construct();
        $this->load->model('mod_admin');
    }

    public function index() {
        // $this->loginAdmin();
        $data['title'] = "Administrator Login";
        $data['admin'] = "admin";
        // $this->load->view('login', $data);
        $this->load->view("include/BE/login_admin/login", $data);
      }
    /*public function loginAdmin() {
        $data['title'] = "Administrator Login";
        $data['admin'] = "admin";
        // $this->load->view('login', $data);
        $this->load->view("include/BE/login_admin/login", $data);
        
    }*/
     public function loginAdmin(){
        // $data['title'] = "Administrator Login";
        // $data['admin'] = "admin";
        if ($this->input->post("btn_login")) {
           $this->form_validation->set_rules('txt_email', 'Username', 'required|trim');
            $this->form_validation->set_rules('txt_password', 'Password', 'required|trim');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('login_error', show_message('Your username or password is not match!', 'error'));
                redirect('login_admin/');
            }else{
                $username = $this->input->post('txt_email');
                $password = $this->input->post('txt_password');
                $this->session->set_userdata('old_pass',$password);
                $data['login'] = $this->mod_admin->signin_admin($username, $password);
                if ($data['login']->num_rows() > 0) {
                     foreach ($data['login']->result() as $rows) {
                        $user = array(
                                    'user_id'=> $rows->user_id,
                                    'user_email'=> $rows->user_mail
                     );
                        /* Remember user-name and password */
                          if ($this->input->post('remember')) {
                               $this->input->set_cookie('remem_user', $username, time() + (30 * 3600));
                               $this->input->set_cookie('remem_pass', $password, time() + (30 * 3600));
                             } else {
                                 delete_cookie('remem_user');
                             } /* End of remember */
                            $id = $rows->user_id;
                            if ($rows->role_title ==='admin'){
                                $this->session->set_userdata('admin', $id);
                                redirect('munich_admin');
                            }
                    $this->session->set_userdata('admin', $user);
                    $this->session->set_userdata('success_msg', show_message("Your login was successfully", "success"));
                    redirect('munich_admin/');
                        }

                }else{
                    echo "error";
                    $this->session->set_userdata('login_error', show_message('Your username or password is not match!', 'error'));
                    redirect('login_admin');
                }

            }
        } else {
            $this->index();
        }
    }

      /*
     * login
     */
    // public function loginAdmin(){
    //     echo "login form";
    //     $data['title'] = 'Login';
    //     if($this->input->post('btn_login')) {
    //         $this->form_validation->set_rules('txt_email', '', 'required|trim');
    //         $this->form_validation->set_rules('txt_password', '', 'required|trim');
    //         if ($this->form_validation->run() == FALSE) {
    //             echo "false";
    //             $this->session->set_userdata('login', show_message('Your username or password is not match!', 'error'));
    //              redirect('login_admin/');
    //         } else {
    //             echo "pass";
    //             $username = $this->input->post('txt_email');
    //             $password = $this->input->post('txt_password');
    //             $this->session->set_userdata('old_pass', md5($password));
    //             $data['login'] = $this->mod_admin->signin_admin($username, $password);
    //             var_dump($data['login']);
    //             if ($this->check_user_session() || $data['login']) {
    //                 if ($data['login']->num_rows() > 0) {
    //                     foreach ($data['login']->result() as $rows) {
    //                         $this->session->set_userdata('adminEmail', $rows->user_mail);
    //                         echo $rows->user_mail; die();
    //                         $this->session->set_userdata('full_name', ucfirst($rows->user_fname). ' ' .strtoupper($rows->user_lname));
    //                         /* Remember user-name and password */
    //                         if ($this->input->post('remember')) {
    //                             $this->input->set_cookie('remem_user', $username, time() + (30 * 3600));
    //                             $this->input->set_cookie('remem_pass', $password, time() + (30 * 3600));
    //                         } else {
    //                             delete_cookie('remem_user');
    //                         } /* End of remember */
    //                         $id = $rows->user_id;
    //                         if ($rows->role_title ==='admin'){
    //                             $this->session->set_userdata('admin', $id);
    //                             redirect('munich_admin');
    //                         }
    //                     }
    //                 } else {
    //                     echo "login";
    //                     $this->session->set_userdata('login', show_message('Your username or password is not match!', 'error'));
    //                     //redirect('rentatent_admin/');
    //                     // $this->view_login_form($data);
    //                      redirect('login_admin');
    //                 }
    //             } else {
    //                 echo "login1";
    //                 $this->session->set_userdata('login', show_message('Your username or password is not match!', 'error'));
    //                 redirect('login_admin');
    //             }
    //         }
    //     } else {
    //         echo "echo3";
    //         $this->load->view('login_admin');
    //     }
    // }
    public function logout(){
         $this->session->set_userdata('sign_out', show_message('You have been logout!', 'notice'));
        $this->session->unset_userdata('admin');
        redirect('login_admin');
}
   

    public function master_page() {
        // $this->load->view('include/BE/master_page');
    }

}

/* End of file mu_admin.php */
/* Location: ./application/controllers/mu_admin.php */