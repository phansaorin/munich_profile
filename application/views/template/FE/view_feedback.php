<?php $this->load->view(INCLUDE_FE.'before_content'); ?>   
<br />
<div class="row clearfix">
	<?php 
		if(isset($single_fb)){
			if($single_fb->num_rows()  > 0){
				foreach($single_fb->result() as $fb_single){
					echo $fb_single->fb_text;
				}
			}
		}
		if($this->session->userdata('back_to')){
			echo anchor($this->session->userdata('back_to'), "Back to feedback",'class="btn btn-primary"');
			$this->session->unset_userdata("back_to");
		}
	?>
</div>
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>