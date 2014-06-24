<?php

	if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MU_Controller extends CI_Controller{

    public function __construct() {
        parent::__construct();
    }
    public function resize_image($upload_path, $image, $new_width, $new_height) {
	        $img_cfg_thumb['image_library'] = 'gd2'; //gd2 is the library image in ci
	        $img_cfg_thumb['source_image'] = $upload_path . $image;
		$img_cfg_thumb['create_thumb'] = TRUE;
	        $img_cfg_thumb['maintain_ratio'] = TRUE;
	        /* Get path of upload for thumbnail */
	        $data['thumb_path'] = str_replace('original', 'thumb', $upload_path);
		$img_cfg_thumb['new_image'] = $data['thumb_path'] . $image;
		
	        list($width, $height) = getimagesize($img_cfg_thumb['source_image']); //Get width, height from image
	        if ($upload_path) {
	            $img_cfg_thumb['width'] = $new_width;
	            $img_cfg_thumb['height'] = $new_height;
	        } else {
	            $img_cfg_thumb['width'] = $new_width;
	            $img_cfg_thumb['height'] = ($height * $new_width) / $width;
	        }
				
	        $this->load->library('image_lib');
	        $this->image_lib->initialize($img_cfg_thumb);
	        $this->image_lib->resize();
    }
    // Check user session for login
    public function check_user_session() {
    	 if (!$this->session->userdata("admin")) {
    	 	redirect("login_admin");
        } else {
        	return true;
        }
    }
	
}

/* End of file MU_Controller.php */
/* Location: ./application/core/MU_Controller.php */