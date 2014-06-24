<?php $this->load->view(INCLUDE_FE.'before_content'); ?> 
<?php $this->load->view(INCLUDE_FE.'booking/location'); ?>
<?php 
	if($show_festival > 0){
		foreach($show_festival as $rows){
			echo $rows->act_id;
	}
}
?>
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>