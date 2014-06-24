<?php $this->load->view(INCLUDE_FE.'before_content'); ?> 
<br />
<div class="row clearfix">
	<div class="col-lg-4" style="padding-left:0px;">
		<table class="contact_info">
		<?php 
		if(isset($contact)){
		  	if($contact->num_rows() > 0){
		  		foreach($contact->result() as $value){
		?>
				<?php if($value->user_company){ ?>
					<tr><td><strong>Company</strong></td><td><b> : </b></td><td><?php echo $value->user_company; ?></td></tr>
				<?php } ?>
				<?php if($value->user_fname OR $value->user_lname){ ?>
					<tr><td><strong>Contact</strong></td><td><b> : </b></td><td><?php echo $value->user_fname." ".$value->user_lname; ?></td></tr>
				<?php } ?>
				<?php if($value->user_mail){ ?>
					<tr><td><strong>Email</strong></td><td><b> : </b></td><td><?php echo $value->user_mail; ?></td></tr>
				<?php } ?>
				<?php if($value->user_telone){ ?>
					<tr><td><strong>Telphone</strong></td><td><b> : </b></td><td><?php echo $value->user_telone; if($value->user_teltwo){ echo " / ".$value->user_teltwo; } ?></td></tr>
				<?php } ?>
				<?php if($value->user_mobile){ ?>
					<tr><td><strong>Mobile</strong></td><td><b> : </b></td><td><?php echo $value->user_mobile; ?></td></tr>
				<?php } ?>
				<?php if($value->user_fax){ ?>
					<tr><td><strong>Fax</strong></td><td><b> : </b></td><td><?php echo $value->user_fax; ?></td></tr>
				<?php } ?>
				<?php if($value->user_website){ ?>
					<tr><td><strong>Website</strong></td><td><b> : </b></td><td><?php echo $value->user_website; ?></td></tr>
				<?php } ?>				
				<?php if($value->user_address){ ?>
					<tr><td><strong>Address</strong></td><td><b> : </b></td><td><?php echo $value->user_address; ?></td></tr>
				<?php } ?>

		<?php
		  	    } // end foreach
		  	} // num_rows > 0 condition
		} // isset condition
		?>
			<?php ?>
		</table>
	</div>
	<div class="col-lg-8" style="padding-right:0px;">
		<h2 class="bh2_botttom">Get in contact with us</h2>
		<div class="alert alert-danger alert-dismissable error-c">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <span>error...</span>
		</div>
		<div class="alert alert-info alert-dismissable success-c">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <span>success...</span>
		</div>
		<?php 
			echo form_open("ajaxController/contactus",'class="form_contact"');
	      	echo '<p>'.form_input(array("name"=>"cn_name","id"=>"cf_name","value"=>set_value("cf_name"),"class"=>"form-control","placeholder"=>"your name...")).'</p>';
	      	echo '<p>'.form_input(array("name"=>"ce_name","id"=>"ce_name","value"=>set_value("ce_name"),"class"=>"form-control","placeholder"=>"your email...")).'</p>';
	      	echo '<p>'.form_input(array("name"=>"csj_name","id"=>"csj_name","value"=>set_value("csj_name"),"class"=>"form-control","placeholder"=>"subject...")).'</p>';
	      	echo '<p>'.form_textarea(array("name"=>"ctxt_name","id"=>"ctxt_name","value"=>set_value("ctxt_name"),"class"=>"form-control","placeholder"=>"text...","rows"=>"5")).'</p>';
	    ?>
	    <p>
		<?php echo form_submit(array("name"=>"c_submit","id"=>"c_submit","value"=>set_value("c_submit","submit"),"class"=>"btn btn-primary")).nbs(10); ?>
		<?php echo img(array("src"=>"assets/img/General/ajax-loader.gif","alt"=>"ajax loader","class"=>"hiddenSTH")); ?>
		</p>
	</div>
</div>
<br />
<?php $this->load->view(INCLUDE_FE.'after_content'); ?>