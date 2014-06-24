<?php $this->load->view(INCLUDE_FE.'before_content'); ?> 
<?php 
	if(isset($include_type)){

		if($include_type == "first"){
			$this->load->view(INCLUDE_FE.'booking/location'); 
		 	$this->load->view(INCLUDE_FE.'booking/festival');
		}else{
			if(isset($include_type)) $this->load->view(INCLUDE_FE.'booking/'.$include_type);
		}
	}else{
		echo "cannot include it...";
	}
 ?> 
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>