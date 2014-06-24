<h4>Accommodation &nbsp; &nbsp; <span class="cusconaddaccommocation cusconadd btn-info btn-sm" data-toggle='modal' data-target='.modal-cusconaddaccommocation'>Add Accommodation</span></h4>
<div class="panel-group" id="accordion">
	<?php 
	if(isset($customize_accomodation)){ 
		$customize_accomodation = unserialize($customize_accomodation); 
		if(isset($customize_accomodation['main-accommodation'])){
		foreach($customize_accomodation['main-accommodation'] as $main_accommodation){
	  	$accID = $main_accommodation['acc_id'];
	?>
	<div class="panel panel-default">
	    <div class="panel-heading">
	      <div class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#acc<?php echo $accID; ?>"><?php echo $main_accommodation['acc_name']; ?></a>
	        <span class="icon-list-alt cusconadd clickDetailacc" data-url="<?php echo base_url(); ?>customize/accdetail/<?php echo $accID; ?>/<?php echo $this->uri->segment(3); ?>" data-toggle='modal' data-target='.modalDetials' title="Details" style="float:right; margin-left:5px;"></span>
	      	<?php echo form_checkbox(array('class' => 'check_acc_checkbox acc_click','id' => 'check_acc_checkbox', 'name' => 'acc_checkbox['.$accID.']', 'style' => 'margin:2px;float:right;', 'checked' => true, "data-subchecked" => "#acc".$accID), $accID );  ?>
	      </div>
	    </div>
	    <div id="acc<?php echo $accID; ?>" class="panel-collapse collapse">
	      <div class="panel-body">
	      	<?php 
	      		if(isset($customize_accomodation['sub-accommodation'][$accID])){
	      			$data['sub_accommodation'] = $customize_accomodation['sub-accommodation'][$accID];
	      			$data['accID'] = $accID;
	      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_cuscon_subaccommodation', $data);
	      		} 
	      	?>
	      	<?php 
	      		if(isset($customize_accomodation['extraproduct-cuscon'][$accID])){
	      			$extraproduct['extraproduct_cuscon'] = $customize_accomodation['extraproduct-cuscon'][$accID];
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