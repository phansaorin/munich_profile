<?php $this->load->view(INCLUDE_FE.'before_content'); ?> 
<?php $this->load->view(INCLUDE_FE.'booking/location'); ?>
<div class="row clearfix">
		<div class="col-md-12">
		<?php $this->load->view(INCLUDE_FE.'booking/detail');?>
	    </div>
</div> 
<!-- end of step -->
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>