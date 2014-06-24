<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MU_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_menu'));
    }
    /*
    * function name list_record as public
    * Pagination each page 10 record
    * model mod_menu->getAllMenu(@param1, @param2);
    * template management
    * return object record of menu
    */
    public function list_record(){
        $data['title'] = "Management Menu";
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
        $config['total_rows'] = MU_Model::count_all_data('menu', array('menu_delete' => 0));
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
        $data['menu_record'] = $this->mod_menu->getAllMenu($config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
    }
    /*
    * function name search_menu as public
    * Pagination each page 10 record
    * model mod_menu->getAllMenu(@param1, @param2);
    * template management
    * return object record of menu
    */
	public function search_menu(){
		$data['title'] = "Management Menu";
		$data['dashboard'] = "management";
        if($this->input->post("search_title")) $this->session->set_userdata('searchMenu', $this->input->post("search_title")) ;
		$controller = $this->uri->segment(1);
    	$function = $this->uri->segment(2);

        if($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))){
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $data['menu_search_title'] = $this->uri->segment(5);
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

        $config['total_rows'] = MU_Model::count_all_data('menu', array('menu_delete' => 0),array('menu_title'=>$this->session->userdata('searchMenu')));
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
        $data['menu_record'] = $this->mod_menu->getSearchMenu($this->session->userdata('searchMenu'),$config['per_page'], $page, $sortby, $data['sort']);
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
    * public function add_menu
    * load view munich admin
    * inlude file add_menu.php
    * @noparam
    */
    public function add_menu(){
        $data['title'] = "Management Menu";
        $data['dashboard'] = "management";
        $data['parent_menu'] = $this->getParents();
        $data['position_menu'] = array('' => '-- Select --', '1' => '1', '2' => '2', '3' => '3', '4' => '4', 
            '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', 
            '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', 
            '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', 
            '29' => '29', '30' => '30', '31' => '31', '32' => '32', '33' => '33', '34' => '34', '35' => '35'
            , '36' => '36', '37' => '37', '38' => '38', '39' => '39', '40' => '40');
        if($this->input->post("menu_add")){
            $insert["menu_title"] = trim($this->input->post('mtitle'));
            $insert["menu_aliase"] = strtolower(trim($this->input->post('maliase')));
            if($this->input->post('mparent') != "") $insert["menu_menu_id"] = trim($this->input->post('mparent'));
            $insert["menu_position"] = trim($this->input->post('mposition'));
            $insert["menu_status"] = trim($this->input->post('mstatus'));
            
            $return = $this->mod_menu->insertMenu($insert);
            if(!$return){ 
                $this->session->set_userdata('msg_error', 'Cannot insert into database on table name menu.'); 
            }else{ 
                $this->session->set_userdata('msg_success', 'The menu have been submited successfully.'); 
            }
            redirect('menu/list_record');
        }else{
            $this->load->view('munich_admin', $data);
        }
    }

    /*
    * public function edit_menu
    * load view munich admin
    * inlude file edit_menu.php
    * @param $menu_id
    */
    public function edit_menu($menu_id){
        $data['title'] = "Management Menu";
        $data['dashboard'] = "management";
        $data['parent_menu'] = $this->getParents();
        $data['position_menu'] = array('' => '-- Select --', '1' => '1', '2' => '2', '3' => '3', '4' => '4', 
            '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', 
            '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', 
            '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', 
            '29' => '29', '30' => '30', '31' => '31', '32' => '32', '33' => '33', '34' => '34', '35' => '35'
            , '36' => '36', '37' => '37', '38' => '38', '39' => '39', '40' => '40');
        if($this->input->post("menu_edit")){
            $menuId = $this->input->post("menu_id");
            $update["menu_title"] = trim($this->input->post('mtitle'));
            $update["menu_aliase"] = strtolower(trim($this->input->post('maliase')));
            if($this->input->post('mparent') != "" AND $this->input->post('mparent') != $menuId) $update["menu_menu_id"] = trim($this->input->post('mparent'));
            $menu_parent = trim($this->input->post('mparent'));
            $update['menu_position'] = trim($this->input->post('mposition'));
            $update["menu_status"] = trim($this->input->post('mstatus'));
            
            $return = $this->mod_menu->updateMenu($update, $menu_id);
            if(!$return){ 
                $this->session->set_userdata('msg_error', 'Cannot edit the record on table name menu.'); 
            }else{ 
                $this->session->set_userdata('msg_success', 'The menu have been submited successfully.'); 
            }
            //redirect('menu/edit_menu/'.$menu_id.'/'.$menu_parent);
            redirect('menu/list_record');
        }else{
            $data['menuById'] = $this->mod_menu->getMenuById($menu_id);
            $this->load->view('munich_admin', $data);
        }
    }

    /*
    * pulic function deleteById
    * @param $menu_id (int) 
    * return boolean
    * redirect to the current page
    */
    public function deleteById($menu_id, $pagione = false, $pagitwo = false,$pagithree = false){
        $total_rows = MU_Model::count_all_data('menu', array('menu_delete' => 0));
        $deleted = MU_Model::deleteRecordById('menu', array("menu_delete" => 1), array('menu_id' => $menu_id));
        $pagi = "";
        if($this->session->userdata('searchMenu')){ $function = "search_menu"; }else{ $function = "list_record"; }
        if($total_rows > 3){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

           $redirect = "menu/".$function."/".$pagi; 
        }else{ 
            $redirect = "menu/".$function; 
        }

        if($deleted){
            $this->session->set_userdata('msg_success', 'The menu have been deleted successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name menu.');
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
        $update['menu_delete'] = 1;
        $result = $this->mod_menu->deleteMultiple($update, $multiCheckbox);
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
        $result = $this->mod_menu->deleteMultiplePermanent($multiCheckbox);
        if($result > 0){
            $this->session->set_userdata('msg_success', 'The menu have been deleted successfully.');
            echo "t";
        }else{
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name menu.');
            echo "f";
        }
    }

    /*
    * pulic function status_menu
    * @param $menu_status (int)
    * @param $menu_id (int)  
    * @noreturn
    * redirect to the current page
    */
    public function status_menu($menu_status, $menu_id, $pagione = false, $pagitwo = false, $pagithree = false){
        $total_rows = MU_Model::count_all_data('menu', array('menu_delete' => 0));
        $menu_status = ($menu_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('menu', array("menu_status" => $menu_status), array('menu_id' => $menu_id));
        $pagi = "";
        if($this->session->userdata('searchMenu')){ $function = "search_menu"; }else{ $function = "list_record"; }
        if($total_rows > 3){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

           $redirect = "menu/".$function."/".$pagi; 
        }else{ 
            $redirect = "menu/".$function; 
        }

        $menu_msg = ($menu_status == 1) ? "Published" : "Unpublished";

        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The menu have been '.$menu_msg.' successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$menu_msg.' record on table name menu.');
            redirect($redirect);
        }
    }

}
/* End of file menu.php */
/* Location: ./application/controllers/menu.php */