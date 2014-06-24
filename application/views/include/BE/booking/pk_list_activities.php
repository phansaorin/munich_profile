<h4>Activities</h4>
<div class="panel-group" id="accordion">
	<?php 
	if(isset($pg_activities)){ 
	  $pg_activities = unserialize($pg_activities);
	  if(isset($pg_activities['main-activities'])){
	  foreach($pg_activities['main-activities'] as $main_activities){
	  	$actID = $main_activities['act_id'];
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
	      <div class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#act<?php echo $actID; ?>"><?php echo $main_activities['act_name']; ?></a>
	        <!-- <span class="icon-list-alt pkadd clickDetailact" data-url="<?php // echo base_url(); ?>package/actdetail/<?php //echo $actID; ?>/<?php // echo $this->uri->segment(3); ?>" data-toggle='modal' data-target='.modalDetials' title="Details" style="float:right; margin-left:5px;"></span> -->
	      	<?php //echo form_checkbox(array('class' => 'check_act_checkbox act_click','id' => 'check_act_checkbox', 'name' => 'act_checkbox['.$actID.']', 'style' => 'margin:2px;float:right;', 'checked' => true, "data-subchecked" => "#act".$actID), $actID );  ?>
	      </div>
	    </div>
	    <div id="act<?php echo $actID; ?>" class="panel-collapse collapse">
	      <div class="panel-body">
	      	<?php 
	      		if(isset($pg_activities['sub-activities'][$actID])){
	      			$data['sub_activites'] = $pg_activities['sub-activities'][$actID];
	      			$data['actID'] = $actID;
	      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_pk_subactivities', $data);
	      		} 
	      	?>
	      	<?php 
	      		if(isset($pg_activities['extraproduct-pk'][$actID])){
	      			$extraproduct['extraproduct_pk'] = $pg_activities['extraproduct-pk'][$actID];
	      			$extraproduct['actID'] = $actID;
	      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_act_extraproducts', $extraproduct);
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