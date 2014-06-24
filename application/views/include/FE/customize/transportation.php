<?php  echo form_open_multipart('site/customizes/transportation', 'class="form-horizontal"'); ?>
<div class="col-sm-12 form-booking" id="transportation">
	<h2> Choose Transportation </h2>
	<hr>
	   		<div class="col-sm-12">
	   			<?php //var_dump($recordTransportation);?>
	   			<?php foreach ($recordTransportation as $tp_record) {?>
	   			<div class="col-sm-3">
	   				<?php $transportation = array('src' => 'user_uploads/thumbnail/original/'.$tp_record['pho_source'],'alt' => 'customize','class' => 'img-thumbnail images-dashboard','title' => 'Customize');?>
		    		<?php echo img($transportation);?>
	   			</div>
	   			<div class="col-sm-9">
	   				<label><input type="checkbox">  <?php echo $tp_record['tp_name'];?></label>
	   				<p><?php echo $tp_record['tp_textbooking'];?></p>
	   				<div class="form-group">
				        <label class="col-sm-2 control-label">Departure Date :</label>
				        <div class="col-sm-4">
				            <?php 
				        		$day_avaliable['monday'] = $tp_record['monday'];
				                $day_avaliable['tuesday'] = $tp_record['tuesday'];
				                $day_avaliable['wednesday'] = $tp_record['wednesday'];
				                $day_avaliable['thursday'] = $tp_record['thursday'];
				                $day_avaliable['friday'] = $tp_record['friday'];
				                $day_avaliable['saturday'] = $tp_record['saturday'];
				                $day_avaliable['sunday'] = $tp_record['sunday'];
				            	$new = site::convertDateToRangeFromFE($day_avaliable, $tp_record['start_date'], $tp_record['end_date']);
				            echo form_dropdown('txtDate', $new,'', 'class="form-control"');  
				            ?>
				        </div>
				        <label class="col-sm-2 control-label">Return Date :</label>
				        <div class="col-sm-4">
				            <?php 
				        		$day_avaliable['monday'] = $tp_record['monday'];
				                $day_avaliable['tuesday'] = $tp_record['tuesday'];
				                $day_avaliable['wednesday'] = $tp_record['wednesday'];
				                $day_avaliable['thursday'] = $tp_record['thursday'];
				                $day_avaliable['friday'] = $tp_record['friday'];
				                $day_avaliable['saturday'] = $tp_record['saturday'];
				                $day_avaliable['sunday'] = $tp_record['sunday'];
				            	$new = site::convertDateToRangeFromFE($day_avaliable, $tp_record['start_date'], $tp_record['end_date']);
				            echo form_dropdown('txtDate', $new,'', 'class="form-control"');  
				            ?>
				        </div>
			    	</div>
			    	<div class="form-group">
				        <label class="col-sm-4 control-label">Number of Passenger :</label>
				        <div class="col-sm-2">
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
							$subTransportation = mod_feCustomize::selectSubTransportation($this->session->userdata('ftvID'), $this->session->userdata('lcID'), $tp_record['tp_id']);
							$subtransportation = array();
							if($subTransportation->num_rows() > 0){
								foreach($subTransportation->result() as $subtp){
									$recodeavaliable = site::convertDateToRangeSub($findate, $subtp->start_date, $subtp->end_date);				
									if($recodeavaliable){
										$avRecord = json_decode(json_encode($subtp), true); 
										array_push($subtransportation, $avRecord);
									}
								}
							}
				    ?>	
				    <?php foreach ($subtransportation as $sub_transportation) {?>   	
			    	<div class="col-sm-12">
			    		<div class="col-sm-3">
			    			<?php $transportation = array('src' => 'user_uploads/thumbnail/original/'.$tp_record['pho_source'],'alt' => 'customize','class' => 'img-thumbnail images-dashboard','title' => 'Customize');?>
		    				<?php echo img($transportation);?>
			    		</div>
			    		<div class="col-sm-7">
			    			<label><input type="checkbox">  <?php echo $sub_transportation['tp_name'];?></label>
	   						<p><?php echo $sub_transportation['tp_textbooking'];?></p>
			    		</div>
			    		<div class="col-sm-2">
			    			<label class="col-sm-3 control-label">N/Passenger:</label>
			    				<select class="form-control col-sm-4">
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
			    		</div>
			    	</div>
			    	<?php }?>
	   			</div>
	   			<?php }?>
	   		</div>	   			
	   		<!--<button type="button" class="btn btn-primary btn-sm"> Back </button>-->
	   		<button type="button" class="btn btn-primary btn-sm"><?php echo anchor("site/customizes/accommodation","Previous"); ?></button>
			<?php $input = array('name' => 'btnTransportation', 'class' => 'btn btn-primary btn-sm', 'value' => ' Next '); echo form_submit($input);?>
			<p></p>
			<?php echo form_close(); ?>
</div>