<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 class Gallery extends MU_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('mod_gallery'));
    }

    public function list_record(){
		$data['title'] = "Gallery";
        $data['dashboard'] = "management";
        $controller = $this->uri->segment(1);
        $function = $this->uri->segment(2);
        $data['photoTypes'] = $this->mod_gallery->getGallery();
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
        $config['total_rows'] = MU_Model::count_all_data('photo', array('pho_delete' => 0));
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
        // $config['use_page_numbers'] = true;
        $this->pagination->initialize($config); //function to show all pages
        $page = ($this->uri->segment($config['uri_segment']) && $this->uri->segment($config['uri_segment']) > 0) ? $this->uri->segment($config['uri_segment']) : 0;
        $data['galleries'] = $this->mod_gallery->show_galleries($config['per_page'], $page, $sortby, $data['sort']);
       // var_dump($data['galleries']); die();
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);

	}
    public function add_galleries(){
        $data['title'] = "Add New Gallery";
        $data['dashboard'] = "management";
        $session = $this->session->set_userdata($data);
        $data['txtStatus'] = array('' =>'--Select--','0' => 'Unpublished','1' => 'Published');
       // $data['phototype'] = array(''=>'--Select--','1'=>'Activity','2'=>'Accommidation','3'=>'Fetival');
        $data['photoTypes'] = $this->mod_gallery->getGallery();
       // var_dump($data['photoTypes']);
        if ($this->input->post('addImage')) {
            $this->form_validation->set_rules('name', 'Image Name', 'trim|required');
            $this->form_validation->set_rules('txtStatus','Status', 'required');
            $this->form_validation->set_rules('detail', 'Image Detail', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('munich_admin', $data);
            } else {
                    $get_name = $this->input->post('name');
                    $get_status = $this->input->post('txtStatus');
                    $get_detail = $this->input->post('detail');
                    $get_phototype = $this->input->post('photoType');
                    //upload image
                    $config = array(
                        'upload_path' => 'user_uploads/thumbnail/original/',
                        'allowed_types' => 'gif|jpg|png|GIF|JPG|PNG',
                        'max_size' => '20000'
                    ); 
                    $this->load->library('upload', $config);   
                    $configThumb = array(
                        'image_library' => 'gd2',
                        'upload_path' => 'user_uploads/thumbnail/thumb/',
                        'source_image' => '',
                        'create_thumb' => TRUE,
                        'maintain_ratio' => TRUE
                    );
                    $this->load->library('image_lib');
                    $files = $_FILES;
                    $cpt = count($_FILES['img_name']['name']);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['img_name']['name'] = str_replace(" ", "_", $files['img_name']['name'][$i]);
                        $_FILES['img_name']['name'] = str_replace("-", "_", $files['img_name']['name'][$i]);
                        //$_FILES['txt_photo']['name'] = $files['txt_photo']['name'][$i];
                        $_FILES['img_name']['tmp_name'] = $files['img_name']['tmp_name'][$i];
                        $_FILES['img_name']['type'] = $files['img_name']['type'][$i];
                        $_FILES['img_name']['size'] = $files['img_name']['size'][$i];     
                        if ($this->upload->do_upload('img_name')) {

                            if (file_exists ($config['upload_path']. $_FILES['img_name']['name'] )) {
                                $image[$i] = $this->upload->data();
                                $image[$i] = $_FILES['img_name']['name'];
                                $data = $this->upload->data();
                                if($data['is_image'] == 1) {
                                    //Replace string URL of full_path upload
                                    $data['full_path'] = str_replace('original', 'thumb', $data['full_path']);
                                    $configThumb['source_image'] = $data['full_path'];
                                   // var_dump( $configThumb['source_image']); die();
                                    $this->image_lib->initialize($configThumb);
                                    $this->image_lib->resize();
                                    //Get last element of string
                                    $last_start[$i] = strrpos($data['full_path'], '/');
                                    if($last_start[$i] !== false) {
                                      $last_field = substr($data['full_path'], $last_start[$i]);
                                    } else {
                                      $last_field = $data['full_path'];
                                    }
                                    // Get the name of gallery
                                    $image[$i] = ltrim ($last_field, '/');  //remove first character of string
                                }
                                if ($image[$i] != "") {
                                    $this->resize_image($config['upload_path'], $image[$i], 150, 300);
                                }
                                // $image[$i] = $this->random(5).'-'.$image[$i];
                            } else {
                               //  var_dump($config['upload_path']); die();
                                $image[$i] = $this->upload->data();
                                $image[$i] = $_FILES['img_name']['name'];
                               // var_dump($image[$i]);
                                if ($image[$i] != "") {
                                    $this->resize_image($config['upload_path'], $image[$i], 150, 300);
                                }
                            }
                        /* End of uploading */
                        } else {
                            $image = '';
                        }
                    }
              
                 $result = $this->mod_gallery->add_galleries($get_name,$image,$get_status,$get_detail,$get_phototype);
                // var_dump($result); die();

              if ($result>0) { //show message, already exist  
              $this->session->set_userdata('create', show_message('Your data input was successfully.', 'success'));
              //redirect('gallery/list_record');
              redirect('gallery/view_galleries/'.$result);
                        }
            }
         }
         $this->load->view('munich_admin', $data);
     }
    public function search_galleries(){
        $data['title'] = "search username";
        $data['dashboard'] = "management";
        $data['search_photo_name'] = $this->input->post("search_name");
        if($this->input->post('search_name') !=""){
            $data['search_photo_name'] = $this->input->post("search_name");
        }
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
            $data['sort'] = "ASC";
            $config['base_url'] = site_url($controller . "/" . $function);
            $config['uri_segment'] = 3;
        }
        $config['total_rows'] = MU_Model::count_all_data('photo', array('pho_delete' => 0));
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
        // $data['users'] = $this->mod_user->getSearchName($config['per_page'], $page, $sortby, $data['sort']);
        $data['photos'] = $this->mod_gallery->getSearchName($data['search_photo_name'],$config['per_page'], $page, $sortby, $data['sort']);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('munich_admin', $data);

     }
     // public function edit_galleries(){
     //    $data['title'] = "Add New Gallery";
     //    $data['dashboard'] = "management";
     //    $get_id = $this->uri->segment(3);
     //    $data['get_gallery'] = $this->mod_gallery->select_gallery($get_id);
     //    $session = $this->session->set_userdata($data);
     //    $data['txtStatus'] = array('' =>'--Select--','0' => 'Unpublished','1' => 'Published');
     //    $data['phototype'] = array(''=>'--Select--','1'=>'Activity','2'=>'Accommidation','3'=>'Fetival');
     //    if ($this->input->post('UpdateImage')) {
     //        $this->form_validation->set_rules('old_name', 'Image Name', 'trim|required');
     //        // $this->form_validation->set_rules('image', 'Image', 'trim|required');
     //        $this->form_validation->set_rules('old_txtStatus','Status', 'required');
     //        $this->form_validation->set_rules('old_detail', 'Image Detail', 'required');
     //        if ($this->form_validation->run() == FALSE) {
     //            $this->load->view('munich_admin', $data);
     //        } else {
     //                $get_name = $this->input->post('old_name');
     //              //  $get_image = $this->input->post('old_img_name');
     //                $get_status = $this->input->post('old_txtStatus');
     //                $get_detail = $this->input->post('old_detail');
     //                $get_phototype = $this->input->post('old_photoType'); 
     //                  //upload image
     //                $config = array(
     //                    'upload_path' => 'user_uploads/thumbnail/original/',
     //                    'allowed_types' => 'gif|jpg|png|GIF|JPG|PNG',
     //                    'max_size' => '20000'
     //                ); 
     //                $this->load->library('upload', $config);   
     //                $configThumb = array(
     //                    'image_library' => 'gd2',
     //                    'upload_path' => 'user_uploads/thumbnail/thumb/',
     //                    'source_image' => '',
     //                    'create_thumb' => TRUE,
     //                    'maintain_ratio' => TRUE
     //                );
     //                $this->load->library('image_lib');
     //                $files = $_FILES;
     //                $cpt = count($_FILES['old_img_name']['name']);
     //                for ($i = 0; $i < $cpt; $i++) {
     //                    $_FILES['old_img_name']['name'] = str_replace(" ", "_", $files['old_img_name']['name'][$i]);
     //                    $_FILES['old_img_name']['name'] = str_replace("-", "_", $files['old_img_name']['name'][$i]);
     //                    //$_FILES['txt_photo']['name'] = $files['txt_photo']['name'][$i];
     //                    $_FILES['old_img_name']['tmp_name'] = $files['old_img_name']['tmp_name'][$i];
     //                    $_FILES['old_img_name']['type'] = $files['old_img_name']['type'][$i];
     //                    $_FILES['old_img_name']['size'] = $files['old_img_name']['size'][$i];     
     //                    if ($this->upload->do_upload('old_img_name')) {

     //                        if (file_exists ($config['upload_path']. $_FILES['old_img_name']['name'] )) {
     //                            $image[$i] = $this->upload->data();
     //                            $image[$i] = $_FILES['old_img_name']['name'];
     //                            $data = $this->upload->data();
     //                            if($data['is_image'] == 1) {
     //                                //Replace string URL of full_path upload
     //                                $data['full_path'] = str_replace('original', 'thumb', $data['full_path']);
     //                                $configThumb['source_image'] = $data['full_path'];
     //                               // var_dump( $configThumb['source_image']); die();
     //                                $this->image_lib->initialize($configThumb);
     //                                $this->image_lib->resize();
     //                                //Get last element of string
     //                                $last_start[$i] = strrpos($data['full_path'], '/');
     //                                if($last_start[$i] !== false) {
     //                                  $last_field = substr($data['full_path'], $last_start[$i]);
     //                                } else {
     //                                  $last_field = $data['full_path'];
     //                                }
     //                                // Get the name of gallery
     //                                $image[$i] = ltrim ($last_field, '/');  //remove first character of string
     //                            }
     //                            if ($image[$i] != "") {
     //                                $this->resize_image($config['upload_path'], $image[$i], 150, 300);
     //                            }
     //                            // $image[$i] = $this->random(5).'-'.$image[$i];
     //                        } else {
     //                           //  var_dump($config['upload_path']); die();
     //                            $image[$i] = $this->upload->data();
     //                            $image[$i] = $_FILES['old_img_name']['name'];
     //                           // var_dump($image[$i]);
     //                            if ($image[$i] != "") {
     //                                $this->resize_image($config['upload_path'], $image[$i], 150, 300);
     //                            }
     //                        }
     //                    /* End of uploading */
     //                    } else {
     //                        $image = '';
     //                    }
     //                }
     //             $result = $this->mod_gallery->edit_galleries($get_id,$get_name,$image,$get_status,$get_detail,$get_phototype);
     //            if ($result>0) { //show message, already exist  
     //          $this->session->set_userdata('create', show_message('Your data update was successfully.', 'success'));
     //          redirect('gallery/list_record');
     //                    }
     //        }
     //     }
     //     $this->load->view('munich_admin', $data);


     // }
     public function view_galleries(){
        $data['title'] = "View galleries";
        $data['dashboard'] = "management";
        $get_id = $this->uri->segment(3);
        $data['view_galleries'] = $this->mod_gallery->view_galleriess($get_id);
        $data['txtStatus'] = array('0' => 'Unpublished','1' => 'Published');
        $this->load->view('munich_admin', $data);
    }
      public function deletePhotoMultiple(){
        $multiCheck = $this->input->post("check_checkbox");
        $update['pho_delete'] = 1;
        $result = $this->mod_gallery->deleteMultiplePhoto($update,$multiCheck);

        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The  have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The gallery record can not delete from table');
            echo "f";
        }
    }
    public function deletePhotoPermenent() {
        $multiCheck = $this->input->post("check_checkbox");
        $result = $this->mod_gallery->deletePermenentPhoto($multiCheck);
        if ($result > 0) {
            $this->session->set_userdata('msg_success', 'The gallery have been deleted successfully.');
            echo "t";
        } else {
            $this->session->set_userdata('msg_success', 'The gallery record can not delete from table');
            echo "f";
        }
    }
     //delete activities by id
   public function deletePhotoById($photo_id,$pagination = false){
    $total_count = MU_Model::count_all_data('photo',array('pho_delete' => 0));
    $delete_photo = MU_Model::deleteRecordById('photo',array("pho_delete" => 1) ,array('photo_id' => $photo_id));
    if($delete_photo){
    redirect(strtolower(get_class()).'/list_record');
    }
  //end delete activities by id
    }

   public function status_gallery($gal_status, $gal_id, $pagione = false, $pagitwo = false, $pagithree = false){
        $total_rows = MU_Model::count_all_data('photo', array('pho_delete' => 0));
        $gal_status = ($gal_status == 1) ? 0 : 1;
        $statuschaged = MU_Model::updateStatusById('photo', array("pho_status" => $gal_status), array('photo_id' => $gal_id));
        $pagi = "";
        if($this->session->userdata('search')){ $function = "search_content"; }else{ $function = "list_record"; }
        if($total_rows > 2){ 
            if($pagione != false) $pagi = $pagione;
            if($pagitwo != false) $pagi .= "/".$pagitwo;
            if($pagithree != false) $pagi .= "/".$pagithree;

            $redirect = "gallery/".$function."/".$pagi; 
        }else{ 
            $redirect = "gallery/".$function; 
        }

        $con_msg = ($con_status == 1) ? "Published" : "Unpublished";

        if($statuschaged){
            $this->session->set_userdata('msg_success', 'The  photo have been '.$con_msg.' successfully.');
            redirect($redirect);
        }else{
            $this->session->set_userdata('msg_error', 'Cannot '.$con_msg.' record on table name photo.');
            redirect($redirect);
        }
    }
  



}// the end of big function
    ?>