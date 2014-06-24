<?php $this->load->view(INCLUDE_FE.'before_content'); ?>   
<br />
<br />

<div class="row clearfix wrap_customize">
	<div class="col-sm-12 titleBooking">
		<h1>Booking Tour</h1>
	</div>
	<div class="col-sm-12">
		<div class="col-sm-10">
			<ul class="nav nav-tabs menu_customize">
			   <li><?php echo anchor("site/customizes/","Trip info"); ?></li>
			   <li><?php echo anchor("site/customizes/activities","Activities"); ?></li>
			   <li><?php echo anchor("site/customizes/accommodation","Accommodation"); ?></li>
			   <li><?php echo anchor("site/customizes/transportation","Transportation"); ?></li>
			   <li><?php echo anchor("site/customizes/extra-service","Extra Services"); ?></li>
			   <li><?php echo anchor("site/customizes/personal-info","Personal Information"); ?></li>
			   <li><?php echo anchor("site/customizes/payments","Payment"); ?></li>
			</ul>			
		<hr>
			<div class="tab-content">
			   	<?php 
			   		if($this->uri->segment(4)){
			   			$this->load->view(INCLUDE_FE_CUSTOMIZE.$this->uri->segment(4));
			   		}else{
			   			$this->load->view(INCLUDE_FE_CUSTOMIZE.'trip-info');
			   		}
			   	?>
			</div>
		</div>
		<!-- start calculate form order -->
		<div class="col-sm-2 form-order">
			<h3>Order</h3>
			<div class="table-responsive">
			    <table class="table">
			    	<tr>
			    		<td>List of Activities order </td>
			    		<td> : </td>
			    		<td> $ </td>
			    	</tr>
			    	<tr>
			    		<td>List of Accommodation order</td>
			    		<td> : </td>
			    		<td> $ </td>
			    	</tr>
			    	<tr>
			    		<td>List of Transportation order</td>
			    		<td> : </td>
			    		<td> $ </td>
			    	</tr>
			    	<tr>
			    		<td>List of Extra product order</td>
			    		<td> : </td>
			    		<td> $ </td>
			    	</tr>
			    	<tr>
			    		<td><h3><b>Total</b></h3></td>
			    		<td><h3><b> : </b></h3></td>
			    		<td><h3><b> $ </b></h3></td>
			    	</tr>
			    </table>
			</div>
		</div>
		<!-- end calculate form order -->		
	</div>
	<hr>

	
	<!-- I am in include/fe/customize.php -->
</div>

<?php $this->load->view(INCLUDE_FE.'after_content'); ?>

