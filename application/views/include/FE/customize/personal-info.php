<?php  echo form_open_multipart('site/customizes/personal-info', 'class="form-horizontal"'); ?>
<div class="col-sm-12 form-booking" id="personal_info">
	   		<h2>Personal Information</h2>
	   		<hr>
	   		<div class="col-sm-12">
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Passenger firstname :</label>
	   				<div class="col-sm-5">
				        <?php $pfname = array('name' => 'pfname', 'class' => 'form-control', 'placeholder' => 'Passenger firstname'); echo form_input($pfname); ?>
				    </div>
	   			</div>
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Passenger lastname :</label>
	   				<div class="col-sm-5">
				         <?php $plname = array('name' => 'plname', 'class' => 'form-control', 'placeholder' => 'Passenger lastname'); echo form_input($plname); ?>
				    </div>
	   			</div>
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Email </label>
	   				<div class="col-sm-5">
				         <?php $pmobile = array('name' => 'pemail', 'class' => 'form-control', 'placeholder' => 'Email'); echo form_input($pmobile); ?>
				    </div>
	   			</div>
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Home phone :</label>
	   				<div class="col-sm-5">
				         <?php $phphone = array('name' => 'phphone', 'class' => 'form-control', 'placeholder' => 'Home phone number'); echo form_input($phphone); ?>
				    </div>
	   			</div>
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Address :</label>
	   				<div class="col-sm-5">
				         <?php $paddress = array('name' => 'paddress', 'class' => 'form-control', 'placeholder' => 'Passenger Address'); echo form_input($paddress); ?>
				    </div>
	   			</div>
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Company :</label>
	   				<div class="col-sm-5">
				         <?php $pcode = array('name' => 'pcompany', 'class' => 'form-control', 'placeholder' => 'Company'); echo form_input($pcode); ?>
				    </div>
	   			</div>
	   			<!-- <div class="form-group">
	   				<label class="col-sm-3 control-label">City :</label>
	   				<div class="col-sm-5">
				         <?php $pcity = array('name' => 'pcity', 'class' => 'form-control', 'placeholder' => 'City'); echo form_input($pcity); ?>
				    </div>
	   			</div>
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Country :</label>
	   				<div class="col-sm-5">
				         <?php $pcountry = array('name' => 'pcountry', 'class' => 'form-control', 'placeholder' => 'Country'); echo form_input($pcountry); ?>
				    </div>
	   			</div> -->
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Gender :</label>
	   				<div class="col-sm-5">
				         <?php $pgender = array('selected' => '--- selected --- ','F' => 'Female' , 'M' => 'Male'); echo form_dropdown('pgender',$pgender, $pgender,'class="form-control"'); ?>
				    </div>
	   			</div>
	   			<div class="form-group">
	   				<label class="col-sm-3 control-label">Passenger N<sup>o</sup> :</label>
	   				<div class="col-sm-5">
				         <?php $pnumber = array('name' => 'pnumber', 'class' => 'form-control'); echo form_input($pnumber); ?>
				    </div>
	   			</div>
	   		</div>
	   		<!--<input type="button" class="btn btn-primary btn-sm" name="back" value="Back" />-->
	   		<button type="button" class="btn btn-primary btn-sm"><?php echo anchor("site/customizes/extra-service","Previous "); ?></button>
			<?php $input = array('name' => 'btnExtraService', 'class' => 'btn btn-primary btn-sm', 'value' => ' Next '); echo form_submit($input);?>
<p></p>
<?php echo form_close(); ?>
</div>
	   <!-- end div home -->