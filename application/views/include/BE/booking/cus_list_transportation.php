<h4>Transportation</h4>
<div class="panel-group" id="accordion">
	<?php 
	if(isset($cus_transportation)){ 
	  $cus_transportation = unserialize($cus_transportation); 
		foreach ($cus_transportation as $transportation) {
			foreach ($transportation as $transport) {
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
				      <div class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#tp<?php echo $transport['info']->tp_id; ?>"><?php echo $transport['info']->tp_name; ?></a>
				        <!-- <span class="icon-list-alt pkadd clickDetailtp" data-url="<?php echo base_url(); ?>customize/tpdetail/<?php echo $transport['info']->tp_id; ?>/<?php echo $this->uri->segment(3); ?>" data-toggle='modal' data-target='.modalDetials' title="Details" style="float:right; margin-left:5px;"></span> -->
				      </div>
				    </div>
				    <div id="tp<?php echo $transport['info']->tp_id; ?>" class="panel-collapse collapse">
				      <div class="panel-body">
				      	<?php 
				      		if(isset($transport['extra_pro'])){
				      			$extraproduct['extraproduct_cus'] = $transport['extra_pro'];
				      			$extraproduct['tpsID'] = $transport['info']->tp_id;
				      			$this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_cus_tps_extraproducts', $extraproduct);
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