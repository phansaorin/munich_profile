<!-- start accommodation -->
<?php  echo form_open_multipart('site/customizes/accommodation', 'class="form-horizontal"'); ?>
	   <div class="col-sm-12 form-booking" id="accommodation">
	   		<h2>Choose Accommodation</h2>
	   		<hr>
	   		<div class="col-sm-12">
	   			<?php foreach ($recordAccommodation as $acc) {?>
	   					<div class="col-sm-3">
	   				<?php 
			            $accomodation_img = array('src' => 'user_uploads/thumbnail/original/'.$acc['pho_source'], 'alt' => 'accomodation','class' => 'img-thumbnail images-dashboard','title' => 'Accomodation'
			            );
			        ?>
			        <?php echo anchor('accommodation/list_record',img($accomodation_img)).br(1);?>
	   			</div>
	   			<div class="col-sm-9">
	   				<label><?php echo $acc['acc_name'];?></label>
	   				<p><?php echo $acc['acc_bookingtext'];?></p>
	   				<div class="form-group">
				        <label class="col-sm-2 control-label">Check In :</label>
				        <div class="col-sm-4">
				            <select class="form-control">
								<option> Monday to Friday </option>
								<option> Tuesday to Sunday </option>
								<option> Sunday to Wednesday </option>
							</select>
						</div>
						<label class="col-sm-2 control-label">Check Out :</label>
						<div class="col-sm-4">
							<select class="form-control">
								<option> Monday to Friday </option>
								<option> Tuesday to Sunday </option>
								<option> Sunday to Wednesday </option>
							</select>
				        </div>
			    	</div>
			    	<div class="form-group">
				        <label class="col-sm-3 control-label">Amount of Room :</label>
				        <div class="col-sm-3">
				            <select class="form-control">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
				        </div>
			    	</div>
			    	
			    	<?php
				    		if($this->session->userdata('txtFrom') AND $this->session->userdata('txtTo')) $findate = array($this->session->userdata('txtFrom'), $this->session->userdata('txtTo'));
							$subAccommodation = mod_fecustomize::selectSubAccommodation($this->session->userdata('ftvID'), $this->session->userdata('lcID'), $acc['acc_id']);
							$subaccommodation = array();
							if ($subAccommodation->num_rows() > 0) {
								foreach ($subAccommodation->result() as $subacc) {
									$recodeavaliable = site::convertDateToRangeSub($findate, $subacc->start_date, $subacc->end_date);	
									if ($recodeavaliable) {
										$avRecord = json_decode(json_encode($subacc), true);
										array_push($subaccommodation, $avRecord);
									}
								}
							}
				    ?>
				    	<?php foreach ($subaccommodation as $sub_accommodation) {?>
					    	<div class="col-sm-12">
					    		<div class="col-sm-3">
					   				<?php $customize_img = array('src' => 'user_uploads/thumbnail/original/'.$sub_accommodation['pho_source'],'alt' => 'customize','class' => 'img-thumbnail images-dashboard','title' => 'Customize');?>
						    		<?php echo img($customize_img).br(1);?>
					   			</div>
					   			<div class="col-sm-9">
					   				<label>
					   					<?php echo form_checkbox($checkbox_accommodation = array('name' => 'checkbox_accommodation[]', 'id' => 'checkbox_accommodation'), $sub_accommodation['acc_id']);?>   
					   					<?php echo $sub_accommodation['acc_name'];?>
					   				</label>
					   				<p><?php echo $sub_accommodation['acc_bookingtext']; ?></p>
					   			</div>
					    	</div>
				    	<?php }?>
				    	
	   			</div>
	   			<?php }?>	
	   		</div> 			
	   		<!--<button type="button" class="btn btn-primary btn-sm"> Back </button>-->
	   		<button type="button" class="btn btn-primary btn-sm"><?php echo anchor("site/customizes/activities","Previous"); ?></button>
			<?php $input = array('name' => 'btnAccommodation', 'class' => 'btn btn-primary btn-sm', 'value' => ' Next '); echo form_submit($input);?>
			<p></p>
	   </div>
<?php echo form_close(); ?>
<!-- end accommodation -->