<?php $this->load->view(INCLUDE_FE.'before_content'); ?>   
<div class="row clearfix">
	<div class="content col-lg-9">
		<?php $this->load->view(INCLUDE_FE.'content_text'); ?>
	</div>
	<div class="side_right col-lg-3">
		<?php $this->load->view(INCLUDE_FE.'side_bar'); ?>
	</div>
</div>
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>
