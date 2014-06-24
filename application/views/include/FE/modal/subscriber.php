<div class="modal fade subscribe_lg" tabindex="-1" role="dialog" aria-labelledby="subscribeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<?php 
      		echo form_open("ajaxController/subscriber",'class="form_subscribe"');
      	?>
      	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h2 class="modal-title">Sign up to our newsletter</h2>
      	</div>
	    <div class="modal-body">
		    <div class="alert alert-danger alert-dismissable error-s">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <span>error...</span>
			</div>
			<div class="alert alert-info alert-dismissable success-s">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <span>success...</span>
			</div>
	      	<?php 
	      		echo '<p>'.form_input(array("name"=>"fs_name","id"=>"fs_name","value"=>set_value("fs_name"),"class"=>"form-control","placeholder"=>"your firstname...")).'</p>';
	      		echo '<p>'.form_input(array("name"=>"ls_name","id"=>"ls_name","value"=>set_value("fs_name"),"class"=>"form-control","placeholder"=>"your lastname...")).'</p>';
	      		echo '<p>'.form_input(array("name"=>"es_name","id"=>"es_name","value"=>set_value("fs_name"),"class"=>"form-control","placeholder"=>"your email...")).'</p>';
	      	?>
	    </div>
	    <div class="modal-footer">
	    	<?php echo img(array("src"=>"assets/img/General/ajax-loader.gif","alt"=>"ajax loader","class"=>"hiddenSTH")).nbs(10); ?>
	    	<?php echo form_submit(array("name"=>"s_submit","id"=>"s_submit","value"=>set_value("s_submit","submit"),"class"=>"btn btn-primary")); ?>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
	    <?php 
      		echo form_close();
      	?>
    </div>
  </div>
</div>