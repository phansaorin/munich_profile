<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model(array('mod_supplier'));
    }
	
	/*
	*@: List all Supplier
	*/
	
	public function list_record(){
		$data['title'] = "Supplier";
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

        $config['total_rows'] = MU_Model::count_all_data('supplier', array('sup_deleted' => 0));
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

		$data['supplier'] = $this->mod_supplier->list_record($config['per_page'], $page, $sortby, $data['sort']);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('munich_admin', $data);
	}
	
	/*
	*@: Search Supplier
	*/
	
	public function search_supplier(){
		$data['title'] = "Search Supplier";
		$data['dashboard'] = "management";
		$controller = $this->uri->segment(1);
        $function = 'search_supplier';
        if($this->input->post('search_supplier_name')){
			$this->session->set_userdata("supplier_name", $this->input->post('search_supplier_name'));
		}else{
			$this->session->set_userdata("supplier_name", "");	
		}

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
                $data['sort'] = "ASC";
                $config['base_url'] = site_url($controller . "/" . $function);
                $config['uri_segment'] = 3;
            }
            $config['total_rows'] = MU_Model::count_all_data('supplier', array('sup_deleted' => 0),array("sup_fname"=>$this->session->userdata("supplier_name")));
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
            $data['search_supplier'] = $this->mod_supplier->search_supplier($config['per_page'], $page, $sortby, $data['sort'],$this->session->userdata("supplier_name"));
            $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);
	}
	
	/*
	*@: Delete supplier by id
	*/
	
	public function deleteSupplierById($supplier_id,$pagination = false){
  	  $total_count = MU_Model::count_all_data('supplier',array('sup_deleted' => 0));
  	  $delete_supplier = MU_Model::deleteRecordById('supplier',array("sup_deleted" => 1) ,array('sup_id' => $supplier_id));
	  	  if($delete_supplier){
	  		  redirect(strtolower(get_class()).'/list_record');
	  	 }
	}

	/*
	*@: Delete multiple supplier
	*/	 
	public function deleteMultiSupplier(){
	  $multiCheck = $this->input->post("check_checkbox");
	  $update['sup_deleted'] = 1;
	  $result = $this->mod_supplier->deleteMultipleSupplier($update,$multiCheck);
	  
	  if($result > 0){
            $this->session->set_userdata('msg_success', 'The suppliers have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_error', 'Cannot delete record on table name supplier.');
            echo "f";
       }
  	}
	
	/*
	*@: Delete Permenent Supplier
	*/
	
	public function deletePermenentSupplier() {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_supplier->deletePermenentSupplier($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The supplier have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The supplier record can not delete from table');
            echo "f";
        }
    }

	/*
	*@: View supplier
	*/
	
	public function view_supplier(){
		$data['title'] = "View Supplier";
		$data['dashboard'] = "management";
		$get_id = $this->uri->segment(3);
		$data['view_supplier'] = $this->mod_supplier->view_supplier($get_id);
		$this->load->view('munich_admin', $data);
	}

	/*
	*@: Add Supplier
	*/
	
	public function add_supplier(){
		  $data['title'] = "Add New Supplier";
		  $data['dashboard'] = "management";
		  $session = $this->session->set_userdata($data);
		 
				  if($this->input->post('addSupplier')) {
					  $config = array(
									array('field' => 'txtCompanyName','label' => 'Company Name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'txtFirstName','label' => 'First Name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'txtLastName','label' => 'Last Name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'txtOccupation','label' => 'Occupation','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'txtSector','label' => 'Sector','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'txtService','label' => 'Service Provistion','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'txtCountry','label' => 'Country','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'txtCity','label' => 'City','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'txtMobile','label' => 'Mobile Phone','rules' => 'trim|required|numeric'),
									array('field' => 'txtHomePhone','label' => 'Home Phone','rules' => 'trim|numeric'),
									array('field' => 'txtEmail','label' => 'Email','rules' => 'required|valid_email'),
									array('field' => 'txtWebsite','label' => 'Website','rules' => 'trim|max_length[256]'),
									array('field' => 'txtAddress','label' => 'Address','rules' => 'trim|required|min_length[2]|max_length[30]|xss_clean'),
									array('field' => 'txtCode','label' => 'Postal Code','rules' => 'trim|numeric'),
							);
					  $this->form_validation->set_rules($config);
					  $this->session->set_userdata('create',$data);
						  if($this->form_validation->run() == FALSE){
							  $this->session->set_userdata('create', show_message('Please check your completed form!', 'error'));
						  }else{
									$txtCompanyName =   $this->input->post('txtCompanyName');
									$txtFirstName = $this->input->post('txtFirstName');
									$txtLastName = $this->input->post('txtLastName');
									$txtOccupation = $this->input->post('txtOccupation');
									$txtSector = $this->input->post('txtSector');
									$txtService = $this->input->post('txtService');
									$txtCountry = $this->input->post('txtCountry');
									$txtCity = $this->input->post('txtCity');
									$txtMobile = $this->input->post('txtMobile');
									$txtHomePhone = $this->input->post('txtHomePhone');
									$txtEmail = $this->input->post('txtEmail');
									$txtWebsite = $this->input->post('txtWebsite');
									$txtAddress = $this->input->post('txtAddress');
									$txtCode = $this->input->post('txtCode');
									$supplier = $this->mod_supplier->add_supplier($txtCompanyName,$txtFirstName,$txtLastName,$txtOccupation,$txtSector,$txtService,$txtCountry,$txtCity,$txtMobile, $txtHomePhone, $txtEmail,$txtWebsite,$txtAddress,$txtCode);
									if($supplier > 0){
										$this->session->set_userdata('create', show_message('Your data was successfully added.', 'success'));
										// redirect('supplier/list_record');
										redirect('supplier/view_supplier/'.$supplier);
									}
						  }
				  }
				   $this->load->view('munich_admin', $data);
	}
  
	/*
	* public function edit_supplier
	*@: Edit Supplier
	*/

	public function edit_supplier() {
        $data['title'] = "Edit Supplier";
        $data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['get_supplier'] = $this->mod_supplier->selectSupplierByID($get_id);
            if ($this->input->post('edit_supplier')){
					$dataUpdate = 	array(
						          	array('field' => 'old_txtCompanyName','label' => 'Company Name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'old_txtFirstName','label' => 'First Name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'old_txtLastName','label' => 'Last Name','rules' => 'trim|required|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'old_txtOccupation','label' => 'Occupation','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'old_txtSector','label' => 'Sector','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'old_txtService','label' => 'Service Provistion','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'old_txtCountry','label' => 'Country','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'old_txtCity','label' => 'City','rules' => 'trim|min_length[2]|max_length[20]|xss_clean'),
									array('field' => 'old_txtMobile','label' => 'Mobile Phone','rules' => 'trim|required|numeric'),
									array('field' => 'old_txtHomePhone','label' => 'Home Phone','rules' => 'trim|numeric'),
									array('field' => 'old_txtEmail','label' => 'Email','rules' => 'required|valid_email'),
									array('field' => 'old_txtWebsite','label' => 'Website','rules' => 'trim|max_length[256]'),
									array('field' => 'old_txtAddress','label' => 'Address','rules' => 'trim|required|min_length[2]|max_length[30]|xss_clean'),
									array('field' => 'old_txtCode','label' => 'Postal Code','rules' => 'trim|numeric'),
					);
            $this->form_validation->set_rules($dataUpdate);
            $this->session->set_userdata('create',$data);
              if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata('create', show_message('Your input was not success! Please check your data again', 'error'));
			  }else{
                       				$get_txtCompanyName =   $this->input->post('old_txtCompanyName');
									$get_txtFirstName = $this->input->post('old_txtFirstName');
									$get_txtLastName = $this->input->post('old_txtLastName');
									$get_txtOccupation = $this->input->post('old_txtOccupation');
									$get_txtSector = $this->input->post('old_txtSector');
									$get_txtService = $this->input->post('old_txtService');
									$get_txtCountry = $this->input->post('old_txtCountry');
									$get_txtCity = $this->input->post('old_txtCity');
									$get_txtMobile = $this->input->post('old_txtMobile');
									$get_txtHomePhone = $this->input->post('old_txtHomePhone');
									$get_txtEmail = $this->input->post('old_txtEmail');
									$get_txtWebsite = $this->input->post('old_txtWebsite');
									$get_txtAddress = $this->input->post('old_txtAddress');
									$get_txtCode = $this->input->post('old_txtCode');
									$supplierUpdate = $this->mod_supplier->edit_supplier($get_id, $get_txtCompanyName,$get_txtFirstName,$get_txtLastName,$get_txtOccupation,$get_txtSector,$get_txtService,$get_txtCountry,$get_txtCity,$get_txtMobile, $get_txtHomePhone, $get_txtEmail,$get_txtWebsite,$get_txtAddress,$get_txtCode);
									//var_dump($supplierUpdate); die();
									// echo $supplierUpdate;die();

									
                       if($supplierUpdate > 0){
						   $this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
						   // redirect('supplier/list_record');
						   redirect('supplier/view_supplier/'.$get_id);
					   }   

               }
          }

        $this->load->view('munich_admin', $data);
    }

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/supplier.php */