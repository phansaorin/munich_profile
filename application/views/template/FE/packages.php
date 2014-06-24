<?php $this->load->view(INCLUDE_FE.'before_content'); ?>   
<?php 
	if(! $this->uri->segment(4)){
		$this->load->view(INCLUDE_FE.'package');
	}else{
		$this->load->view(INCLUDE_FE.'package/'.$this->uri->segment(4));
	}
	 
?>
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>
