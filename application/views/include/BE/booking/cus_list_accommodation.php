<h4>Accommodation</h4>
<div class="panel-group" id="accordion">
	<?php 
	if(isset($cus_accomodation)){ 
	  $cus_accomodation = unserialize($cus_accomodation); 
		foreach ($cus_accomodation as $accommodations) {
			foreach ($accommodations as $acc) {
				$data['departure'] = $acc['departure'];
            	$data['return_date'] = $acc['return_date'];
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
				      <div class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#acc<?php echo $acc['info']->acc_id; ?>"><?php echo $acc['info']->acc_name; ?></a>
				        <!-- <span class="icon-list-alt pkadd clickDetailacc" data-url="<?php echo base_url(); ?>customize/accdetail/<?php echo $acc['info']->acc_id; ?>/<?php echo $this->uri->segment(3); ?>" data-toggle='modal' data-target='.modalDetials' title="Details" style="float:right; margin-left:5px;"></span> -->
				      </div>
				    </div>
				    <div id="acc<?php echo $acc['info']->acc_id; ?>" class="panel-collapse collapse">
				      <div class="panel-body">
				      	<?php 
				      		if(isset($acc['accom'])){
				      			foreach ($acc['accom'] as $sub_acc) {
				      				$data['sub_accommodation'] = $sub_acc;
				      				$data['accID'] = $acc['info']->acc_id;
				      				$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_cus_subaccommodation', $data);
				      			}
				      		} 
				      	?>
				      	<?php 
				      		if(isset($acc['extra_pro'])){
				      			$extraproduct['extraproduct_cus'] = $acc['extra_pro'];
				      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_cus_acc_extraproducts', $extraproduct);
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