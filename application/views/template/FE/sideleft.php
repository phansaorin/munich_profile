<?php $this->load->view(INCLUDE_FE.'before_content'); ?>   
<div class="row clearfix">
	<div class="side_left col-lg-3">
		<?php $this->load->view(INCLUDE_FE.'side_bar'); ?>
	</div>
	<div class="content col-lg-9">
		<?php $this->load->view(INCLUDE_FE.'content_text'); ?>
	</div>
</div>
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>