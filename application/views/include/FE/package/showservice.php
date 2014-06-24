<div class="row txtTitleChoose" style="border-bottom: 1px solid #ccc; margin-bottom:10px;">
	<h2>Booking Tours</h2>
	<h3>Add Extra Services</h3>
</div>
<div class="row clearfix">
	<div class="col-lg-10" style="padding-left: 0px;">
		<div class="mainmadia">
		<?php 
			echo form_open("site/packages/showservice", 'class="frmService"');
			if(isset($packageExtraservice)){
				if($packageExtraservice->num_rows() > 0){
					foreach($packageExtraservice->result() as $service){
		?>
				<div class="media col-lg-12">
				  <div class="col-lg-2 pk_img">
				  	<?php 
					    $imgname = $service->pho_source;
					    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'Extra service','class'=>'img-responsive img-thumbnail')); 
					?>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading"><?php echo form_checkbox(array('name' => 'epchecked[]','value'=>set_value('epchecked',$service->ep_id), 'class'=>'checkIt')).nbs(3); echo $service->ep_name; ?></h4>
				    <p><?php echo $service->ep_bookingtext; ?></p>
				  </div>
				</div>
		<?php
					}

				}else{
					echo "No Extra Services available...";
				}
			}else{
				echo "No Extra Services available...";
			}
		?>
		</div>
		<br />
		<?php 
			$key = "90408752631";
            $pk_id = base64_encode($key.$this->session->userdata('pkID'));
			echo form_submit(array('name'=>'submitService','value'=>'Continue','class'=>"btn btn-primary")).nbs(5);
			echo anchor('site/packages/details/'.$pk_id,'Back', 'class="btn btn-default"');
		echo form_close();
		?>
	</div>
	<div class="col-lg-2">
		<?php echo $this->session->userdata('pkprice'); ?>
	</div>
</div>