<h4>Activities</h4>
<div class="panel-group" id="accordion">
	<?php 
	if(isset($cus_activities)){ 
	  $cus_activities = unserialize($cus_activities);
	  foreach ($cus_activities as $activities) {
	  	foreach ($activities as $act) {
	  		?>
	  		<div class="panel panel-default">
				<div class="panel-heading">
			      <div class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#act<?php echo $act['info']->act_id; ?>"><?php echo $act['info']->act_name; ?></a>
			        <!-- <span class="icon-list-alt pkadd clickDetailact" data-url="<?php echo base_url(); ?>customize/actdetail/<?php echo $act['info']->act_id; ?>/<?php echo $this->uri->segment(3); ?>" data-toggle='modal' data-target='.modalDetials' title="Details" style="float:right; margin-left:5px;"></span> -->
			      </div>
			    </div>
			    <div id="act<?php echo $act['info']->act_id; ?>" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<?php 
			      		if(isset($act['activity'])){
			      			foreach ($act['activity'] as $sub_act) {
			      				$data['sub_activites'] = $sub_act;
			      				$data['actID'] = $sub_act->act_id;
			      				$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_cus_subactivities', $data);
			      			}
			      		} 
			      	?>
			      	<?php 
			      		if(isset($act['extra_pro'])){
			      			$extraproduct['extraproduct_cus'] = $act['extra_pro'];
			      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_cus_act_extraproducts', $extraproduct);
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