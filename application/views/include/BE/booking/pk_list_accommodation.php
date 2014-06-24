<h4>Accommodation</h4>
<div class="panel-group" id="accordion">
	<?php 
	if(isset($package_accomodation)){ 
	  $package_accomodation = unserialize($package_accomodation); 
	  if(isset($package_accomodation['main-accommodation'])){
	  foreach($package_accomodation['main-accommodation'] as $main_accommodation){
	  	$accID = $main_accommodation['acc_id'];
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
	      <div class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#acc<?php echo $accID; ?>"><?php echo $main_accommodation['acc_name']; ?></a>
	        <!-- <span class="icon-list-alt pkadd clickDetailacc" data-url="<?php // echo base_url(); ?>package/accdetail/<?php // echo $accID; ?>/<?php // echo $this->uri->segment(3); ?>" data-toggle='modal' data-target='.modalDetials' title="Details" style="float:right; margin-left:5px;"></span> -->
	      	<?php // echo form_checkbox(array('class' => 'check_acc_checkbox acc_click','id' => 'check_acc_checkbox', 'name' => 'acc_checkbox['.$accID.']', 'style' => 'margin:2px;float:right;', 'checked' => true, "data-subchecked" => "#acc".$accID), $accID );  ?>
	      </div>
	    </div>
	    <div id="acc<?php echo $accID; ?>" class="panel-collapse collapse">
	      <div class="panel-body">
	      	<?php 
	      		if(isset($package_accomodation['sub-accommodation'][$accID])){
	      			$data['sub_accommodation'] = $package_accomodation['sub-accommodation'][$accID];
	      			$data['accID'] = $accID;
	      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_pk_subaccommodation', $data);
	      		} 
	      	?>
	      	<?php 
	      		if(isset($package_accomodation['extraproduct-pk'][$accID])){
	      			$extraproduct['extraproduct_pk'] = $package_accomodation['extraproduct-pk'][$accID];
	      			$extraproduct['accID'] = $accID;
	      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_acc_extraproducts', $extraproduct);
	      		}
	      	?>
	      </div>
	    </div>
	</div>
	<?php 
			}
		}
	}
	?>
</div>