<div class="row txtTitleChoose" style="border-bottom: 1px solid #ccc; margin-bottom:10px;">
	<h2>Booking Tours</h2>
	<h3>Provide Your Informations</h3>
</div>
<?php  echo form_open('site/packages/infostep', 'class="frminfo"'); ?>
<div class="row clearfix">
	<div class="col-lg-10" style="padding-left: 0px;">	
	<?php 
		$std = $this->session->userdata('pkstartdate') ? $this->session->userdata('pkstartdate') : "";
		$endd = $this->session->userdata('pkenddate') ? $this->session->userdata('pkenddate') : "";
		echo form_hidden('std',$std);
		echo form_hidden('endd',$endd);	
		echo form_hidden('pkPrice', $this->session->userdata('pkprice'));	
	?>
<!-- Trip Information -->
	<h4 class="infoheader">Trip Information</h4>
		<table class="tb error">
			<tr>
				<td class="firstTD"><strong>Amount People <span class="required">*</span>:</strong></td>
				<td><?php echo form_input(array('name'=>'numPassenger', 'value'=>set_value('numPassenger'),'class'=>'form-control')); ?></td>
				<td><?php echo form_error('numPassenger'); ?></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>Departure Date <span class="required">*</span>:</strong> </td>
				<td><?php echo form_input(array('name'=>'dpDate', 'value'=>set_value('dpDate', $std),'class'=>'form-control dpDatef', 'data-date-format'=>'yyyy-mm-dd')); ?></td>
				<td><?php echo form_error('dpDate'); ?></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>Return Date <span class="required">*</span>: </strong></td>
				<td><?php echo form_input(array('name'=>'rtDate', 'value'=>set_value('rtDate', $endd), 'class'=>'form-control rtDatef', 'data-date-format'=>'yyyy-mm-dd')); ?></td>
				<td><?php echo form_error('rtDate'); ?></td>
			</tr>	
		</table>
<!-- Personal Information -->
	<h4 class="infoheader">Personal Information</h4>
		<table class="tb error">
			<tr>
				<td class="firstTD"><strong>First Name <span class="required">*</span>:</strong></td>
				<td><?php echo form_input(array('name'=>'fname', 'value'=>set_value('fname'),'class'=>'form-control')); ?></td>
				<td><?php echo form_error('fname'); ?></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>Last Name <span class="required">*</span>:</strong> </td>
				<td><?php echo form_input(array('name'=>'lname', 'value'=>set_value('lname'),'class'=>'form-control')); ?></td>
				<td><?php echo form_error('lname'); ?></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>Gender <span class="required">*</span>: </strong></td>
				<td>
				<?php 
					if(isset($packagefinalStep['gendercheck']) and $packagefinalStep['gendercheck'] == 'M') $m = true; else $m = false;
					if(isset($packagefinalStep['gendercheck']) and $packagefinalStep['gendercheck'] == 'F') $f = true; else $f = false;
					if(isset($packagefinalStep['gendercheck']) and $packagefinalStep['gendercheck'] == 'O') $o = true; else $o = false;
				?>
				<?php echo form_radio(array('name'=>'gender', 'value'=>'M', 'class'=>set_value('m'), 'checked'=> $m)).nbs(3).'Male'.nbs(5); ?>
				<?php echo form_radio(array('name'=>'gender', 'value'=>'F', 'class'=>set_value('f'), 'checked'=> $f)).nbs(3).'Female'.nbs(5); ?>
				<?php echo form_radio(array('name'=>'gender', 'value'=>'O', 'class'=>set_value('o'), 'checked'=> $o)).nbs(3).'Other'; ?></td>
				<td><p><?php if(isset($packagefinalStep['gendercheck']) and $packagefinalStep['gendercheck'] == FALSE) echo "The gender field is required"; else echo ''; ?></p></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>Email <span class="required">*</span>:</strong> </td>
				<td><?php echo form_input(array('name'=>'uemail', 'value'=>set_value('uemail'),'class'=>'form-control')); ?></td>
				<td><?php echo form_error('uemail'); ?></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>Phone <span class="required">*</span>:</strong> </td>
				<td><?php echo form_input(array('name'=>'phone', 'value'=>set_value('phone'),'class'=>'form-control')); ?></td>
				<td><?php echo form_error('phone'); ?></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>Mobile Phone :</strong> </td>
				<td><?php echo form_input(array('name'=>'mobilephone', 'value'=>set_value('mobilephone', $packagefinalStep['mobilephoneinput']),'class'=>'form-control')); ?></td>
				<td><p><?php if(isset($packagefinalStep['mobilePhoneError'])) echo $packagefinalStep['mobilePhoneError']; else echo ''; ?></p></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>Country <span class="required">*</span>:</strong> </td>
				<td><?php echo form_input(array('name'=>'country', 'value'=>set_value('country'),'class'=>'form-control')); ?></td>
				<td><?php echo form_error('country'); ?></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>City <span class="required">*</span>:</strong> </td>
				<td><?php echo form_input(array('name'=>'city', 'value'=>set_value('city'),'class'=>'form-control')); ?></td>
				<td><?php echo form_error('city'); ?></td>
			</tr>
			<!-- <tr>
				<td class="firstTD"><strong>Postal Code <span class="required">*</span>:</strong> </td>
				<td><?php //echo form_input(array('name'=>'postalcode', 'value'=>set_value('postalcode'),'class'=>'form-control')); ?></td>
				<td><?php //echo form_error('postalcode'); ?></td>
			</tr> -->
			<tr>
				<td class="firstTD"><strong>Address <span class="required">*</span>:</strong> </td>
				<td><?php echo form_input(array('name'=>'address', 'value'=>set_value('address'),'class'=>'form-control')); ?></td>
				<td><?php echo form_error('address'); ?></td>
			</tr>
			<tr>
				<td class="firstTD"><strong>About You :</strong> </td>
				<td><?php echo form_textarea(array('name'=>'aboutYou', 'value'=>set_value('aboutYou', $packagefinalStep['aboutYouInput']),'class'=>'form-control','rows'=>'2')); ?></td>
				<td></td>
			</tr>	
		</table>
<!-- Payment Information -->
	<h4 class="infoheader">Payment Information</h4>
		<p>Select your preference payment method</p>
		<?php 
			if(isset($packagefinalStep['paycheck']) and $packagefinalStep['paycheck'] == 'paypal') $p = true; else $p = false;
			if(isset($packagefinalStep['paycheck']) and $packagefinalStep['paycheck'] == 'ideal') $i = true; else $i = false;
		?>
		<span class="txtError"><p><?php if(isset($packagefinalStep['paycheck']) and $packagefinalStep['paycheck'] == FALSE) echo "The payment method field is required"; else echo ''; ?> </p></span>
		<?php echo form_radio(array('name'=>'payby', 'value'=>set_value('paypal','paypal'), 'class'=>'', 'checked'=>$p)).nbs(3).'PayPal'.br(1); ?>
		<?php echo form_radio(array('name'=>'payby', 'value'=>set_value('ideal', 'ideal'), 'class'=>'', 'checked'=>$i)).nbs(3).'IDeal'.br(2); ?>
<!-- Additional Information -->
	<h4 class="infoheader">Additional Information</h4>
		<?php 
			if(isset($packagefinalStep['bookingfeecheck']) and $packagefinalStep['bookingfeecheck'] == TRUE) $bf = true; else $bf = false;
		?>
		<?php echo form_checkbox(array('name'=>'bookingfee', 'value'=>set_value('bookingfee',15), 'class'=>'','checked'=>$bf)).nbs(3).'Booking Fee 15$'.br(1); ?>
		<span class="txtError"><p><?php if(isset($packagefinalStep['bookingfeecheck']) and $packagefinalStep['bookingfeecheck'] == FALSE) echo "The booking fee field is required"; else echo ''; ?> </p></span>
		<?php 
			if(isset($packagefinalStep['termcheck']) and $packagefinalStep['termcheck'] == TRUE) $tc = true; else $tc = false;
		?>
		<?php echo form_checkbox(array('name'=>'term','value'=>set_value('term','checkterm'), 'class'=>'','checked'=>$tc)).nbs(3).'Agree with Term and Condition'.br(1); ?>
		<span class="txtError"><p><?php if(isset($packagefinalStep['termcheck']) and $packagefinalStep['termcheck'] == FALSE) echo "The term and condition field is required"; else echo ''; ?> </p></span>
		<br />

	<?php echo form_submit(array('name'=>'btnFinalstep', 'value'=>'Submit', 'class'=>'btn btn-primary btnfinalstep')).nbs(3); ?>
	<?php echo anchor('site/packages/showservice','Back', 'class="btn btn-default"'); ?>
	</div>
<?php  echo form_close(); ?>
	<div class="col-lg-2">
		<p><?php echo $this->session->userdata('pkprice'); ?></p>
		<p class="moreprice"></p>
	</div>
</div>

<style>
	.tb td {
		padding:10px;
		font-size: 12px;
	}
	.firstTD {
		padding-left: 0px !important;
	}
	.infoheader {
		color:#3F703F;
	}
	.error p, .txtError, .required{
		color:red;
	}
</style>