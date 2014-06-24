<h4>Transportation &nbsp; &nbsp; <span class="cusconaddtransport cusconadd btn-info btn-sm" data-toggle='modal' data-target='.modal-cusconaddtransport'>Add Transportation</span></h4>
<div class="panel-group" id="accordion">
	<?php 
	if(isset($customize_transportation)){ 
	    $customize_transportation = unserialize($customize_transportation); 
	    if(isset($customize_transportation['main-transport'])){
	    foreach($customize_transportation['main-transport'] as $main_transport){
	  	$tpsID = $main_transport['tp_id'];
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
	      <div class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#tp<?php echo $tpsID; ?>"><?php echo $main_transport['tp_name']; ?></a>
	        <span class="icon-list-alt cusconadd clickDetailtp" data-url="<?php echo base_url(); ?>customize/tpdetail/<?php echo $tpsID; ?>/<?php echo $this->uri->segment(3); ?>" data-toggle='modal' data-target='.modalDetials' title="Details" style="float:right; margin-left:5px;"></span>
	      	<?php echo form_checkbox(array('class' => 'check_tp_checkbox tp_click','id' => 'check_tp_checkbox', 'name' => 'tp_checkbox['.$tpsID.']', 'style' => 'margin:2px;float:right;', 'checked' => true, "data-subchecked" => "#tp".$tpsID), $tpsID );  ?>
	      </div>
	    </div>
	    <div id="tp<?php echo $tpsID; ?>" class="panel-collapse collapse">
	      <div class="panel-body">
	      	<?php 
	      		if(isset($customize_transportation['sub-transport'][$tpsID])){
	      			$data['sub_transport'] = $customize_transportation['sub-transport'][$tpsID];
	      			$data['tpsID'] = $tpsID;
	      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_cuscon_subtransportation', $data);
	      		} 
	      	?>
	      	<?php 
	      		if(isset($customize_transportation['extraproduct-cuscon'][$tpsID])){
	      			$extraproduct['extraproduct_cuscon'] = $customize_transportation['extraproduct-cuscon'][$tpsID];
	      			$extraproduct['tpsID'] = $tpsID;
	      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_tps_extraproducts', $extraproduct);
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