<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AjaxController extends MU_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_index'));
    } 
	/*
	* public function submitFeedback()
	* @noparam
	* used table feedback
	* return object
	*/

	public function submitFeedback(){
	if ($this->check_user_session()) {
		if($this->session->userdata("subjectfeedback") == $this->input->post("fb_subject")){
			echo "Your have submit the same.";
		}else{
			$dateformat = "%Y-%m-%d";
			$insert['fb_name'] = $this->input->post("fb_name");
			$insert['fb_email'] = $this->input->post("fb_email");
			$insert['fb_subject'] = $this->input->post("fb_subject");
			$insert['fb_text'] = $this->input->post("fb_text");
			$insert['fb_date'] = mdate($dateformat,now()); 
			if($insert['fb_name'] != "" AND $insert['fb_email'] != "" AND $insert['fb_subject'] != "" AND $insert['fb_text'] != ""){
				$result = $this->mod_index->insertFeedback($insert);
				if($result > 0){
 					$adminMail = MU_Model::getAdminEmail();
 					if($adminMail == ""){
 						$adminMail = "mysoftware77@gmail.com";
 					}
					 $message = "Date: ".$insert['fb_date'].
					 "Name: ".$insert['fb_name'].
					 "Email: ".$insert['fb_email'].
					 "Subject: ".$insert['fb_subject'].
					 "Text: ".$insert['fb_text'];
 						$this->email->clear();	    
 			            $this->email->to($adminMail);
 			            $this->email->from($insert['fb_email']);
 			            $this->email->subject("You have a new feedback up coming");
 			            $this->email->message($message);
			            $result = $this->email->send();
					$this->session->set_userdata("subjectfeedback", $this->input->post("fb_subject"));
					echo "t";
				}else{
					echo "You feedback could not submit.";
				}
			}else{
				echo "Your feedback could not accept because have some input blank...";
			}
		}
	}
}
	/*
	* Public function tellafriend
	* @noparam
	* insert record to table subscribe
	* echo true or false.
	*/
	public function tellafriend(){
	if ($this->check_user_session()) {
		$tlafr['sub_fname'] = $this->input->post("tff_name");
		$tlafr['sub_lname'] = $this->input->post("tfl_name");
		$tlafr['sub_email'] = $this->input->post("tfe_name");
		$tlafr['sub_status'] = 1;
		$tlafr['role_id'] 	= 6;
		$tfef_ename = $this->input->post("tfef_name");
		if($tlafr['sub_email'] !="" AND $tfef_ename != ""){
			$existORnot = MU_Model::checkExistEmail('subscriber','sub_email',array("sub_email"=>$tlafr['sub_email']));
			if($existORnot != "exist"){
				$resultInsert = $this->mod_index->insertSubscriber($tlafr);
			}
			$subject = "Your friend ".$tlafr['sub_fname']." ".$tlafr['sub_lname']." want you access to ".base_url();
			$message = "Dear,

Your have been recieved a suggestion from ".$tlafr['sub_fname']." ".$tlafr['sub_lname'].".
Which it is a good website you have to know.
Via this link: ".base_url()." you will get more information.

Yours sincerely,";
			$tfef_ename = explode(",",$tfef_ename);
			$this->email->clear();
			$this->email->to($tfef_ename);
			$this->email->from($tlafr['sub_email']);
			$this->email->subject($subject);
			$this->email->message($message);
			$send = $this->email->send();
			if($send){
				if(isset($resultInsert)) $this->emailTOadmin($tlafr);
				echo "t";
			}else{
				echo "f";
			}
		}else{
			echo "f";
		}
	}

	/*
	* Public function subscriber
	* @noparam
	* insert record to table subscribe
	* echo true or false.
	*/
	public function subscriber(){
		$subsc['sub_fname'] = $this->input->post("fs_name");
		$subsc['sub_lname'] = $this->input->post("ls_name");
		$subsc['sub_email'] = $this->input->post("es_name");
		$subsc['sub_status'] = 1;
		$subsc['role_id'] 	= 5;
		if($subsc['sub_email'] != ""){
			$existORnot = MU_Model::checkExistEmail('subscriber','sub_email',array("sub_email"=>$subsc['sub_email']));
			if($existORnot != "exist"){
				$result = $this->mod_index->insertSubscriber($subsc);
				if($result > 0){
					$this->emailTOadmin($subsc);
					echo "t";
				}else{
					echo "f";
				}
			}
		}else{
			echo "f";
		}
	}

	/*
	* public function emailTOadmin
	* @param $data (array)
	* return success or failed.
	* for subscribe and tellafriend
	*/
	public function emailTOadmin($data){
		$adminMail = MU_Model::getAdminEmail();
		if($adminMail == ""){
			$adminMail = "mysoftware77@gmail.com";
		}
	$message = "Firstname: ".$data['sub_fname'].
	"Lastname: ".$data['sub_lname'].
	"Email: ".$data['sub_email'];
		$this->email->clear();	    
        $this->email->to($adminMail);
        $this->email->from($data['sub_email']);
        $this->email->subject("You got a new subscriber.");
        $this->email->message($message);
        $send = $this->email->send();
	}

	/*
	* Public function contactus
	* @noparam
	* no table related
	* echo true or false.
	*/
	public function contactus(){
		$contact['con_name'] = $this->input->post("cn_name");
		$contact['con_email'] = $this->input->post("ce_name");
		$contact['con_subject'] = $this->input->post("csj_name");
		$contact['con_text'] = $this->input->post("ctxt_name");
		if($contact['con_email'] != "" AND $contact['con_subject'] != "" AND $contact['con_text'] != "" AND $contact['con_name'] != ""){
			$messages = "Name: ".$contact['con_name']."
			Email: ".$contact['con_email']."
			Subject: ".$contact['con_subject']."
			Text: ".$contact['con_text'];

			$adminMail = MU_Model::getAdminEmail();
			if($adminMail == ""){
				$adminMail = "mysoftware77@gmail.com";
			}
			$this->email->to($adminMail);
	        $this->email->from($contact['con_email']);
	        $this->email->subject("You have received a contact.");
	        $this->email->message($messages);
	        $send = $this->email->send();

	        if($send){
	        	echo "t";
	        }else{
	        	echo "f";
	        }

		}else{
			echo "f";
		}
	}
        
        public function validateProfile(){
            $dataUpdate = array(
                    array('field' => 'old_firstname','label' => 'First name','rules' => 'trim|required'),
                    array('field' => 'old_lastname', 'label' => 'Last name','rules' => 'trim|required'),
                    array('field' => 'old_email','label' => 'Email','rules' => 'required|valid_email'),
                    array('field' => 'old_phone','label' => 'Phone','rules' => 'trim|required'),
                    array('field' => 'old_address','label' => 'Address','rules' => 'trim|required' ),
                    array('field' => 'old_company', 'label' => 'Company','rules' => 'trim|required'),
                    array('field' => 'old_gender', 'label' => 'Gender','rules' => 'trim|required'),
                    array('field' => 'old_txtStatus', 'label' => 'Status','rules' => 'trim|required'),
                  );
            $this->form_validation->set_rules($dataUpdate);
            if ($this->form_validation->run() == FALSE) {
               echo 'error';
            }else{
               echo 'true'; 
            }
        }
}
/* End of file ajaxController.php */
/* Location: ./application/controllers/ajaxController.php */