<!-- start activity -->
<?php  echo form_open_multipart('site/customizes/activities', 'class="form-horizontal"'); ?>
	   <div class="col-sm-12 form-booking" id="activities">
	   		<h2>Choose Activity</h2>
	   		<hr>
	   		<?php foreach ($recordActivities as $rows){ ?> 					
	   			<div class="col-sm-3">
	   				<?php $customize_img = array('src' => 'user_uploads/thumbnail/original/'.$rows['pho_source'],'alt' => 'customize','class' => 'img-thumbnail images-dashboard','title' => 'Customize');?>
		    		<?php echo img($customize_img).br(1);?>
	   			</div>
	   			<div class="col-sm-9">
	   				<h4><input type="checkbox">  <?php echo $rows['act_name'];?></h4>
	   				<p><?php echo $rows['act_bookingtext'];?></p>
	   				<div class="form-group">
				        <label class="col-sm-4 control-label">Select Avaliable Date :</label>
				        <div class="col-sm-6">
				        	<?php 
				        		$day_avaliable['monday'] = $rows['monday'];
				                $day_avaliable['tuesday'] = $rows['tuesday'];
				                $day_avaliable['wednesday'] = $rows['wednesday'];
				                $day_avaliable['thursday'] = $rows['thursday'];
				                $day_avaliable['friday'] = $rows['friday'];
				                $day_avaliable['saturday'] = $rows['saturday'];
				                $day_avaliable['sunday'] = $rows['sunday'];
				            	$new = site::convertDateToRangeFromFE($day_avaliable, $rows['start_date'], $rows['end_date']);
				            echo form_dropdown('txtDate', $new,'', 'class="form-control"');  
				            ?>
				        </div>
			    	</div>
			    	<div class="form-group">
				        <label class="col-sm-4 control-label">Number of Passenger :</label>
				        <div class="col-sm-4">
				            <select class="form-control">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
				        </div>
				    </div>
				    <?php
				    		if($this->session->userdata('txtFrom') AND $this->session->userdata('txtTo')) $findate = array($this->session->userdata('txtFrom'), $this->session->userdata('txtTo'));
							// select join with table photo, location, festival, by session and where lcID and ftvID
							$subActivity = mod_feCustomize::selectSubActivity($this->session->userdata('ftvID'), $this->session->userdata('lcID'), $rows['act_id']);
							$subactivity = array();
							if($subActivity->num_rows() > 0){
								foreach($subActivity->result() as $subact){
									$recodeavaliable = site::convertDateToRangeSub($findate, $subact->start_date, $subact->end_date);				
									if($recodeavaliable){
										$avRecord = json_decode(json_encode($subact), true); 
										array_push($subactivity, $avRecord);
									}
								}
							}
				    ?>
				    	<?php foreach ($subactivity as $sub_activity) {?>
					    	<div class="col-sm-12">
					    		<div class="col-sm-3">
					   				<?php $customize_img = array('src' => 'user_uploads/thumbnail/original/'.$rows['pho_source'],'alt' => 'customize','class' => 'img-thumbnail images-dashboard','title' => 'Customize');?>
						    		<?php echo img($customize_img).br(1);?>
					   			</div>
					   			<div class="col-sm-9">
					   				<label><input type="checkbox">  <?php echo $sub_activity['act_name'];?></label>
					   				<p><?php echo $sub_activity['act_bookingtext']; ?></p>
					   			</div>
					    	</div>
				    	<?php }?>
	   			</div>
	   			<?php }?>
	   			<?php //$input = array('name' => 'back', 'class' => 'btn btn-primary btn-sm', 'value' => ' Back '); echo form_submit($input);?>
	   			<button type="button" class="btn btn-primary btn-sm"><?php echo anchor("site/customizes/","Previous"); ?></button>
				<?php $input = array('name' => 'btnActivity', 'class' => 'btn btn-primary btn-sm', 'value' => ' Next '); echo form_submit($input);?>	   			   			   			
			
	   		<p></p>		
	   </div>
<?php echo form_close(); ?>
<!-- end activity -->