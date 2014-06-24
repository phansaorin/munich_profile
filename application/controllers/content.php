<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_menu','mod_content'));
    }

    /*
    * function name list_record as public
    * Pagination each page 10 record
    * model mod_menu->getAllContent(@param1, @param2);
    * template management
    * return object record of content
    */

    public function list_record(){
        $this->session->unset_userdata('search');
        $data['title'] = "Management content";
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

        $config['total_rows'] = MU_Model::count_all_data('content', array('con_delete' => 0));
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
        $data['content_record'] = $this->mod_content->getAllContent($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
    }

    /*
    * function name search_content as public
    * Pagination each page 10 record
    * model mod_menu->getAllMenu(@param1, @param2);
    * template management
    * return object record of menu
    */

	public function search_content(){
		$data['title'] = "Management content";
		$data['dashboard'] = "management";
        if($this->input->post("search_title")) $this->session->set_userdata('search', $this->input->post("search_title")) ;
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

        $config['total_rows'] = MU_Model::count_all_data('content', array('con_delete' => 0),array('con_title'=>$this->session->userdata('search')));
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
        $data['content_record'] = $this->mod_content->getSearchContent($this->session->userdata('search'),$config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin', $data);
	}

    /*
    * public function getPerent menu as public
    * model mod_menu->getAllParentMenu();
    * return the menu parent object
    * no @param
    * return as menu option
    */
    public function getParents(){
        $menu_parent = $this->mod_menu->getAllParentMenu();
        $option[''] = "--- select ---";
        foreach($menu_parent->result() as $menuname){
            $option[$menuname->menu_id] = $menuname->menu_title;
        }
        return $option;
    }
    /*
    * public function getphotos as public
    * model mod_content->getAllPhoto();
    * return the menu parent object
    * no @param
    * return as photo option
    */
    public function getphotos(){
        $photos = $this->mod_content->getAllPhotos();
        // $option[''] = "--- select ---";
        foreach($photos->result() as $photo){
            $option[$photo->photo_id] = $photo->pho_name;
        }
        return $option;
    }

    /*
    * public function add_content
    * load view munich admin
    * inlude file add_content.php
    * @noparam
    */
    public function add_content(){
        if($this->input->post("content_add")){
            $insert["con_title"] = trim($this->input->post('ctitle'));
            $insert["con_text"] = trim($this->input->post('cText'));
            $insert["con_template"] = trim($this->input->post('contemplate'));
            $insert["meta_key"] = trim($this->input->post('cKey'));
            $insert["meta_describe"] = trim($this->input->post('cDescripe'));
            $insert["con_status"] = trim($this->input->post('cstatus'));
            $photoContent = $this->input->post('cphoto');
            if($this->input->post('stayInMenu') != "") $insert["con_menu_id"] = trim($this->input->post('stayInMenu'));
            $return = $this->mod_content->insertContent($insert);
            if(! isset($return)){
                $this->session->set_userdata('msg_error', 'Cannot edit the record on table name content.'); 
            }else{ 
                if(count($photoContent) > 0){
                    if(isset($photoContent[0])){
                        for($i = 0; $i < count($photoContent); $i++){
                            $insertContentPhoto['con_id'] = $return;
                            $insertContentPhoto['photo_id'] = $photoContent[$i];
                            $this->mod_content->insertIntoContentPhoto($insertContentPhoto);
                        }
                    }
                }
                $this->session->set_userdata('msg_success', 'The content have been submited successfully.'); 
            }
            // redirect('content/add_content/');
            redirect('content/view_content/'.$return);
        }else{
            $data['title'] = "Management content";
            $data['dashboard'] = "management";
            $data['all_menu'] = $this->getParents();
            $data['all_photos'] = $this->getphotos();
            $data['con_photo'] = MU_Model::getConjunctionRecordById("content_photo", "photo_id"); 
            $data['conTemplate'] = array('' => '--- Please select ---', 'fullwidth'=>"Full width", 'sideright'=>'Side right','sideleft'=>'Side left');
            $this->load->view('munich_admin', $data);
        }
    }

    /*
    * public function edit_content
    * load view munich admin
    * inlude file edit_content.php
    * @param $con_id (int)
    * @param $con_menu_id (int)
    */
    public function edit_content($con_id, $con_menu_id){
        if($this->input->post("content_edit")){
            $update["con_title"] = trim($this->input->post('ctitle'));
            $update["con_text"] = trim($this->input->post('cText'));
            $update["con_template"] = trim($this->input->post('contemplate'));
            $update["meta_key"] = trim($this->input->post('cKey'));
            $update["meta_describe"] = trim($this->input->post('cDescripe'));
            $update["con_status"] = trim($this->input->post('cstatus'));
            $photoContent = $this->input->post('cphoto');
            if($this->input->post('stayInMenu') != "") $update["con_menu_id"] = trim($this->input->post('stayInMenu'));
            $return = $this->mod_content->updateContent($update, $con_id);
            if(! isset($return)){
                $this->session->set_userdata('msg_error', 'Cannot edit the record on table name content.'); 
            }else{ 
                $deleted = MU_Model::deletedRecordById("content_photo",array("con_id"=>$con_id));
                if(count($photoContent) > 0){
                    if(isset($photoContent[0])){
                        for($i = 0; $i<count($photoContent); $i++){
                            $insertContentPhoto['con_id'] = $con_id;
                            $insertContentPhoto['photo_id'] = $photoContent[$i];
                            $this->mod_content->insertIntoContentPhoto($insertContentPhoto);
                        }
                    }
                }
                $this->session->set_userdata('msg_success', 'The content have been submited successfully.'); 
            }
            // redirect('content/edit_content/'.$con_id.'/'.$con_menu_id);
            redirect('content/view_content/'.$con_id);
        }else{
            $data['title'] = "Management content";
            $data['dashboard'] = "management";
            $data['all_menu'] = $this->getParents();
            $data['all_photos'] = $this->getphotos();
            $data['con_photo'] = MU_Model::getConjunctionRecordById("content_photo", "photo_id"); 
            $data['conTemplate'] = array(''=>'--- Please select ---', 'fullwidth'=>"Full width", 'sideright'=>'Side right','sideleft'=>'Side left');
            $data['contentById'] = $this->mod_content->getContentById($con_id);
            $this->load->view('munich_admin', $data);
        }
    }

    /*
    * pulic function deleteById
    * @param $con_id (int) 
    * return boolean
    * redirect to the current page
    */
    public function deleteById($con_id, $pagione = false, $pagitwo = false,$pagithree = false){
        $total_rows = MU_Model::count_all_data('content', array('con_delete' => 0));
        $deleted = MU_Model::deleteRecordById('content', array("con_delete" => 1), array('con_id' => $con_id));
        $pagi = "";
        if($this->session->userdata('search')){ $function = "search_content"; }else{ $function = "list_record"; }
        if($total_rows > 10){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

            $redirect = "content/".$function."/".$pagi; 
        }else{ 
            $redirect = "content/".$function; 
        }

        if($deleted){
            $this->session->set_userdata('msg_success', 'The content have been deleted successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name content.');
            redirect($redirect);
        }
    }

    /*
    * public function delete_multi
    * @noparam
    * Ajax request from script.js
    * return string success of false
    */
    public function delete_multi(){
        $multiCheckbox = $this->input->post("check_checkbox");
        $update['con_delete'] = 1;
        $result = $this->mod_content->deleteMultiple($update, $multiCheckbox);
        if($result > 0){
            $this->session->set_userdata('msg_success', 'The menu have been deleted successfully.');
            echo "t";
        }else{
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name menu.');
            echo "f";
        }
    }

    /*
    * public function delete_permanent
    * @noparam
    * Ajax request from script.js
    * return string success of false
    */
    public function delete_permanent(){
        $multiCheckbox = $this->input->post("check_checkbox");
        $result = $this->mod_content->deleteMultiplePermanent($multiCheckbox);
        if($result > 0){
            $this->session->set_userdata('msg_success', 'The content have been deleted successfully.');
            echo "t";
        }else{
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name content.');
            echo "f";
        }
    }

    /*
    * pulic function status_content
    * @param $con_status (int)
    * @param $con_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function status_content($con_status, $con_id, $pagione = false, $pagitwo = false, $pagithree = false){
        $total_rows = MU_Model::count_all_data('content', array('con_delete' => 0));
        $con_status = ($con_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('content', array("con_status" => $con_status), array('con_id' => $con_id));
        $pagi = "";
        if($this->session->userdata('search')){ $function = "search_content"; }else{ $function = "list_record"; }
        if($total_rows > 2){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

            $redirect = "content/".$function."/".$pagi; 
        }else{ 
            $redirect = "content/".$function; 
        }

        $con_msg = ($con_status == 1) ? "Published" : "Unpublished";

        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The content have been '.$con_msg.' successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$con_msg.' record on table name content.');
            redirect($redirect);
        }
    }

    /*
    * pulic function view_content
    * @param $con_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function view_content($con_id){
        $data['title'] = "Management content";
        $data['dashboard'] = "management";
        $data['viewContent'] = $this->mod_content->getContentView($con_id);
        $this->load->view('munich_admin', $data);
    }

}

/* End of file content.php */
/* Location: ./application/controllers/content.php */