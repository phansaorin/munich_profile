<div class="modal fade tellafriend-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<?php 
      		echo form_open("ajaxController/tellafriend",'class="form_tellafriend"');
      	?>
      	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h2 class="modal-title">Tell Your Friends !</h2>
      	</div>
	    <div class="modal-body">
	    <div class="alert alert-danger alert-dismissable error-tf">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <span>error...</span>
		</div>
		<div class="alert alert-info alert-dismissable success-tf">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <span>success...</span>
		</div>

	      	<?php
	      		echo '<p>'.form_input(array("name"=>"tff_name","id"=>"tff_name","value"=>set_value("tff_name"),"class"=>"form-control","placeholder"=>"your firstname...")).'</p>';
	      		echo '<p>'.form_input(array("name"=>"tfl_name","id"=>"tfl_name","value"=>set_value("tfl_name"),"class"=>"form-control","placeholder"=>"your lastname...")).'</p>';
	      		echo '<p>'.form_input(array("name"=>"tfe_name","id"=>"tfe_name","value"=>set_value("tfe_name"),"class"=>"form-control","placeholder"=>"your email...")).'</p>';
	      		echo '<p>'.form_input(array("name"=>"tfef_name","id"=>"tfef_name","value"=>set_value("tfef_name"),"class"=>"form-control","placeholder"=>"one@example.com, two@example.com...")).'</p>';
	      	?>
	    </div>
	    <div class="modal-footer">
	    	<?php echo img(array("src"=>"assets/img/General/ajax-loader.gif","alt"=>"ajax loader","class"=>"hiddenSTH")).nbs(10); ?>
	    	<?php echo form_submit(array("name"=>"tf_submit","id"=>"tf_submit","value"=>set_value("tf_submit","submit"),"class"=>"btn btn-primary")); ?>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	        
	    </div>
	    <?php
      		echo form_close();
      	?>
    </div>
  </div>
</div>