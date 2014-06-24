<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_calendar'));
    }
	
	public function list_accCalendar(){
		$data['title'] = "Accomodation calendar";
        $data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
        if ($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))) {
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $config['base_url'] = site_url($controller . "/" . $function . "/" . $uri3 . "/" . $uri4);
            $config['uri_segment'] = 5;
            $sortby = $uri3;
            if ($uri4 == 'ASC') {
                $data['sort'] = "DESC";
            } elseif ($uri4 == "DESC") {
                $data['sort'] = "ASC";
            }
        } else {
            $sortby = "ID";
            $data['sort'] = "DESC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }
        $config['total_rows'] = MU_Model::count_all_data('acc_calendar');
        $config['per_page'] = 10;
		$config['next_tag_open'] = '<li>';
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
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
        $data['acc_calendar'] = $this->mod_calendar->showacc_calendar($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
		}
	public function detail_acc(){
		$data['title'] = "Detail accommodation";
        $data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['detail_accommodation'] = $this->mod_calendar->detail_accom($get_id);
        $this->load->view('munich_admin', $data);
		}
	public function detail_acti(){
		$data['title'] = "Detail activities";
        $data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['detail_activiteis'] = $this->mod_calendar->detail_activities($get_id);
        $this->load->view('munich_admin', $data);
		}
	public function detail_transp(){
		$data['title'] = "Detail transportation";
        $data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['detail_transporta'] = $this->mod_calendar->detail_transport($get_id);
        $this->load->view('munich_admin', $data);
		}
	public function detail_extrapro(){
		$data['title'] = "Detail extraproducts";
        $data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['detail_extrapr'] = $this->mod_calendar->detail_extraproducts($get_id);
        $this->load->view('munich_admin', $data);
		}
	public function list_actiCalendar(){
		$data['title']= "Activities calendar";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
        if ($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))) {
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $config['base_url'] = site_url($controller . "/" . $function . "/" . $uri3 . "/" . $uri4);
            $config['uri_segment'] = 5;
            $sortby = $uri3;
            if ($uri4 == 'ASC') {
                $data['sort'] = "DESC";
            } elseif ($uri4 == "DESC") {
                $data['sort'] = "ASC";
            }
        } else {
            $sortby = "ID";
            $data['sort'] = "DESC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }
        $config['total_rows'] = MU_Model::count_all_data('acti_calendar');
        $config['per_page'] = 10;
		$config['next_tag_open'] = '<li>';
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
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
        $data['activi_calendar'] = $this->mod_calendar->showacti_calendar($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin',$data);
		}
	public function list_transportationCalendar(){
		$data['title']="Transportation calendar";
		$data['dashboard']="management";
		$controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
        if ($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))) {
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $config['base_url'] = site_url($controller . "/" . $function . "/" . $uri3 . "/" . $uri4);
            $config['uri_segment'] = 5;
            $sortby = $uri3;
            if ($uri4 == 'ASC') {
                $data['sort'] = "DESC";
            } elseif ($uri4 == "DESC") {
                $data['sort'] = "ASC";
            }
        } else {
            $sortby = "ID";
            $data['sort'] = "DESC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }
        $config['total_rows'] = MU_Model::count_all_data('tp_calendar');
        $config['per_page'] = 10;
		$config['next_tag_open'] = '<li>';
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
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
        $data['transp_calendar']= $this->mod_calendar->showtran_calendar($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin',$data);
		}
	public function list_extraproductsCalendar(){
		$data['title']="Extra Products calendar";
		$data['dashboard']="management";
		$controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
        if ($this->uri->segment(3) != "" AND !is_numeric($this->uri->segment(3))) {
            $uri3 = $this->uri->segment(3);
            $uri4 = $this->uri->segment(4);
            $config['base_url'] = site_url($controller . "/" . $function . "/" . $uri3 . "/" . $uri4);
            $config['uri_segment'] = 5;
            $sortby = $uri3;
            if ($uri4 == 'ASC') {
                $data['sort'] = "DESC";
            } elseif ($uri4 == "DESC") {
                $data['sort'] = "ASC";
            }
        } else {
            $sortby = "ID";
            $data['sort'] = "DESC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }
        $config['total_rows'] = MU_Model::count_all_data('extraproduct_calendar');
        $config['per_page'] = 10;
		$config['next_tag_open'] = '<li>';
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
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
        $data['extrapro_calendar']= $this->mod_calendar->showextrapro_calendar($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin',$data);
		}
	
}