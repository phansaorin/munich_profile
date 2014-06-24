<?php $this->load->view(INCLUDE_FE.'before_content'); ?>   
<br />
<div class="row clearfix">
	<span class="btn btn-default btn_fb">Give us your feedback</span>
</div>
<br />
<div class="row clearfix">
	<div class="fb_form">
		<table class="table table-striped table-bordered">
			<tr>
				<td><h2>Let us know what you think!</h2></td>
			</tr>
			<tr>
				<td>
					<?php 
						echo form_open("ajaxController/submitFeedback", 'class="form_feedback"');
						echo '<p>'.form_input(array("name"=>"fb_name", "value"=>"", "class"=>"fb_name form-control", "placeholder"=>"Your name...")).'</p>';
						echo '<p>'.form_input(array("name"=>"fb_email", "value"=>"", "class"=>"fb_email form-control", "placeholder"=>"Your email...","type"=>"email")).'</p>';
						echo '<p>'.form_input(array("name"=>"fb_subject", "value"=>"", "class"=>"fb_subject form-control", "placeholder"=>"Subject...")).'</p>';
						echo '<p>'.form_textarea(array("name"=>"fb_text", "value"=>"", "class"=>"fb_text form-control", "placeholder"=>"Your message...")).'</p>';
					?>
				</td>
			</tr>
			<tr>
				<td>
				<?php 
					echo '<p>'.form_submit(array("name"=>"fb_submit", "value"=>"Submit", "class"=>"btn btn-primary btnsubmitfb"));
					echo form_close();
				?>
				</td>
			</tr>
		</table>
	</div>
	<div class="feedback_list">
		<?php 
			if(isset($feedback)){
				if($feedback->num_rows()  > 0){
					foreach($feedback->result() as $fb_val){
							echo '<div class="fblist clearfix">';
							//echo '<div class="col-lg-2 br_left"><strong>'.anchor('site/feedback/'.$fb_val->fb_id, character_limiter($fb_val->fb_subject, 20)).'</strong></div>';
							echo '<div class="col-lg-2 br_left"><strong>'.$fb_val->fb_id,character_limiter($fb_val->fb_subject, 20).'</strong></div>';
							echo '<div class="col-lg-8 br_left">'.character_limiter($fb_val->fb_text, 120).'</div>';
							echo '<div class="col-lg-2 br_left">'.$fb_val->fb_date.'</div>';
							echo '</div>';
					}
				}
			}
		$this->session->set_userdata('back_to', uri_string());
		// echo uri_string().br(1);
		// echo site_url();
		?>
	</div>

</div>
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>