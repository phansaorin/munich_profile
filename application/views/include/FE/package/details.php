<div class="row txtTitleChoose" style="border-bottom: 1px solid #ccc; margin-bottom:10px;">
	<h2>Booking Tours</h2>
	<h3>Your Package Details</h3>
</div>
<div class="row clearfix">
<div class="col-lg-10" style="padding-left:0px;">
	<?php 
		if($packagesdetail->num_rows > 0){
			foreach($packagesdetail->result() as $rows){
				$this->session->set_userdata('pkprice', $rows->pkcon_saleprice);
				$this->session->set_userdata('pkstartdate', $rows->pkcon_start_date);
				$this->session->set_userdata('pkenddate', $rows->pkcon_end_date);
	?>
		<div class="media col-lg-12" style="">
		  <div class="col-lg-4 pk_img">
			    <?php 
			    $imgname = $rows->pho_name;
			    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
			    ?>
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading"><?php echo $rows->pkcon_name; ?></h4>
		    <p></p>
		    <table width="80%">
		    	<tr>
		    		<td><b>Date: </b></td>
		    		<td><?php echo $rows->pkcon_start_date;?>&nbsp; <b> to </b>&nbsp;<?php echo $rows->pkcon_end_date;?></td>
		    		<td><b>Festival: </b></td>
		    		<td><?php echo $rows->ftv_name;?></td>
		    	</tr>
		    	<tr>
		    		<td><b>Price: </b></td>
		    		<td><?php echo $rows->pkcon_saleprice; ?> $</td>
		    		<td><b>Location:</b></td>
		    		<td><?php echo $rows->lt_name;?></td>
		    	</tr>
		    </table>
		    <p></p>
		    <p><?php echo $rows->pkcon_description;?></p>
		  </div>
		</div>
	<!-- display activities -->
	<?php
			if(isset($rows->pk_activities)){
				echo '<h4>Activities</h4>';
				echo '<div class="mainmadia">';	
				$pkactivities = unserialize($rows->pk_activities);
				foreach($pkactivities['main-activities'] as $mainactivities){
	?>
				<div class="media col-lg-12">
				  <div class="col-lg-2 pk_img">
					    <?php 
					    $imgname = $mainactivities['pho_name'];
					    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
					    ?>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading"><?php echo $mainactivities['act_name']; ?></h4>
				    <table width="100%">
				    	<tr>
				    		<td width="8%"><b>Date: </b></td>
				    		<td width="23%"><?php echo $mainactivities['start_date']; ?>&nbsp; <b> to </b>&nbsp;<?php echo $mainactivities['end_date']; ?></td>
				    		<td><b>Festival: </b></td>
				    		<td><?php echo $mainactivities['ftv_name']; ?></td>
				    	</tr>
				    	<tr>
				    		<td><b>Time: </b></td>
				    		<td><?php echo $mainactivities['start_time']; ?>&nbsp; <b> to </b>&nbsp;<?php echo $mainactivities['end_time']; ?></td>
				    		<td><b>Location:</b></td>
				    		<td><?php echo $mainactivities['lt_name']; ?></td>
				    	</tr>
				    	<tr>
				    		<td><b>Price: </b></td>
				    		<td><?php echo $mainactivities['act_saleprice']; ?> $</td>
				    		<td><b>Available day: </b></td>
				    		<td>
				    		<?php 
				    			echo $mainactivities['monday'] == 1? '<span class="day">Monday </span>': NULL; 
				    			echo $mainactivities['tuesday'] == 1? '<span class="day">Tuesday </span>': NULL; 
				    			echo $mainactivities['wednesday'] == 1? '<span class="day">Wednesday </span>': NULL; 
				    			echo $mainactivities['thursday'] == 1? '<span class="day">Thursday </span>': NULL; 
				    			echo $mainactivities['friday'] == 1? '<span class="day">Friday </span>': NULL; 
				    			echo $mainactivities['saturday'] == 1? '<span class="day">Saturday </span>': NULL; 
				    			echo $mainactivities['sunday'] == 1? '<span class="day">Sunday </span>': NULL;
				    		?>
				    		</td>
				    	</tr>
				    </table>
				    <p><?php echo $mainactivities['act_bookingtext']; ?></p>

				    <?php 
				    	$act_id = $mainactivities['act_id'];
				    	if(isset($pkactivities['sub-activities'][$act_id])){
				    		foreach ($pkactivities['sub-activities'][$act_id] as $subactivities) {
				    ?>
			    			<div class="media col-lg-12" style="">
							  <div class="col-lg-2 pk_img">
								    <?php 
								    $imgname = $subactivities['pho_name'];
								    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
								    ?>
							  </div>
							  <div class="media-body">
							    <h4 class="media-heading"><?php echo $subactivities['act_name']; ?></h4>
							    <p><b>Price: </b> &nbsp; &nbsp; <?php echo $subactivities['act_saleprice']; ?> $</p>
							    <p><?php echo $subactivities['act_bookingtext']; ?></p>
							    </div>
							</div>		
				    <?php		
				    	 	}
				    	}
				    ?>
				    <?php 
				      if(isset($pkactivities['extraproduct-pk'][$act_id])){
				      	foreach($pkactivities['extraproduct-pk'][$act_id] as $epact){
				    ?>
						 <div class="media col-lg-12" style="">
							  <div class="col-lg-2 pk_img">
								    <?php 
								    $imgname = $epact['pho_name'];
								    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
								    ?>
							  </div>
							  <div class="media-body">
							    <h4 class="media-heading"><?php echo $epact['ep_name']; ?></h4>
							    <p><b>Price: </b> &nbsp; &nbsp; <?php echo $epact['ep_saleprice']; ?> $</p>
							    <p><?php echo $epact['ep_bookingtext']; ?></p>
							    </div>
							</div>	
				    <?php
				    	}
				      }
				    ?>
				  </div>
				</div>
	<?php
				}
				echo '</div>';
			}
	?>
	<!-- display accommodation -->
	<?php
			if(isset($rows->pk_accomodation)){				
				echo '<h4>Accommodation</h4>';				
			    echo '<div class="mainmadia">';	
				$pkaccommodation = unserialize($rows->pk_accomodation);
				foreach($pkaccommodation['main-accommodation'] as $mainaccommodation){
	?>
				<div class="media col-lg-12">
				  <div class="col-lg-2 pk_img">
					    <?php 
					    $imgname = $mainaccommodation['pho_name'];
					    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
					    ?>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading"><?php echo $mainaccommodation['acc_name']; ?></h4>
				    <table width="100%">
				    	<tr>
				    		<td width="8%"><b>Date: </b></td>
				    		<td width="23%"><?php echo $mainaccommodation['start_date']; ?>&nbsp; <b> to </b>&nbsp;<?php echo $mainaccommodation['end_date']; ?></td>
				    		<td><b>Festival: </b></td>
				    		<td><?php echo $mainaccommodation['ftv_name']; ?></td>
				    	</tr>
				    	<tr>
				    		<td><b>Time: </b></td>
				    		<td><?php echo $mainaccommodation['start_time']; ?>&nbsp; <b> to </b>&nbsp;<?php echo $mainaccommodation['end_time']; ?></td>
				    		<td><b>Location:</b></td>
				    		<td><?php echo $mainaccommodation['lt_name']; ?></td>
				    	</tr>
				    	<tr>
				    		<td><b>Price: </b></td>
				    		<td><?php echo $mainaccommodation['acc_saleprice']; ?> $</td>
				    		<td><b>Available day: </b></td>
				    		<td>
				    		<?php 
				    			echo $mainaccommodation['monday'] == 1? '<span class="day">Monday </span>': NULL; 
				    			echo $mainaccommodation['tuesday'] == 1? '<span class="day">Tuesday </span>': NULL; 
				    			echo $mainaccommodation['wednesday'] == 1? '<span class="day">Wednesday </span>': NULL; 
				    			echo $mainaccommodation['thursday'] == 1? '<span class="day">Thursday </span>': NULL; 
				    			echo $mainaccommodation['friday'] == 1? '<span class="day">Friday </span>': NULL; 
				    			echo $mainaccommodation['saturday'] == 1? '<span class="day">Saturday </span>': NULL; 
				    			echo $mainaccommodation['sunday'] == 1? '<span class="day">Sunday </span>': NULL;
				    		?>
				    		</td>
				    	</tr>
				    </table>
				    <p><?php echo $mainaccommodation['acc_bookingtext']; ?></p>
				    <?php 
				    	$acc_id = $mainaccommodation['acc_id'];
				    	if(isset($pkaccommodation['sub-accommodation'][$acc_id])){
				    		foreach ($pkaccommodation['sub-accommodation'][$acc_id] as $subaccommodation) {
				    ?>
			    			<div class="media col-lg-12" style="">
							  <div class="col-lg-2 pk_img">
								    <?php 
								    $imgname = $subaccommodation['pho_name'];
								    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
								    ?>
							  </div>
							  <div class="media-body">
							    <h4 class="media-heading"><?php echo $subaccommodation['acc_name']; ?></h4>
							    <p><b>Price: </b> &nbsp; &nbsp; <?php echo $subaccommodation['acc_saleprice']; ?> $</p>
							    <p><?php echo $subaccommodation['acc_bookingtext']; ?></p>
							   </div>
							</div>		
				    <?php		
				    	 	}
				    	}
				    ?>
				    <?php 
				      if(isset($pkaccommodation['extraproduct-pk'][$acc_id])){
				      	foreach($pkaccommodation['extraproduct-pk'][$acc_id] as $epacc){
				    ?>
						 <div class="media col-lg-12" style="">
							  <div class="col-lg-2 pk_img">
								    <?php 
								    $imgname = $epacc['pho_name'];
								    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
								    ?>
							  </div>
							  <div class="media-body">
							    <h4 class="media-heading"><?php echo $epacc['ep_name']; ?></h4>
							    <p><b>Price: </b> &nbsp; &nbsp; <?php echo $epacc['ep_saleprice']; ?> $</p>
							    <p><?php echo $epacc['ep_bookingtext']; ?></p>
							    </div>
							</div>	
				    <?php
				    	}
				      }
				    ?>
				    </div>
				</div>
	<?php
				}
				echo '</div>';
			}
	?>
	<!-- transportation diplay -->
	<?php
			if(isset($rows->pk_transportation)){				
				echo '<h4>Transportation</h4>';				
			    echo '<div class="mainmadia">';
				$pktransportation = unserialize($rows->pk_transportation);
				foreach($pktransportation['main-transport'] as $maintransport){
	?>
				<div class="media col-lg-12">
				  <div class="col-lg-2 pk_img">
					    <?php 
					    $imgname = $maintransport['pho_name'];
					    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
					    ?>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading"><?php echo $maintransport['tp_name']; ?></h4>
				    <table width="100%">
				    	<tr>
				    		<td width="8%"><b>Date: </b></td>
				    		<td width="23%"><?php echo $maintransport['start_date']; ?>&nbsp; <b> to </b>&nbsp;<?php echo $maintransport['end_date']; ?></td>
				    		<td><b>Festival: </b></td>
				    		<td><?php echo $maintransport['ftv_name']; ?></td>
				    	</tr>
				    	<tr>
				    		<td><b>Time: </b></td>
				    		<td><?php echo $maintransport['start_time']; ?>&nbsp; <b> to </b>&nbsp;<?php echo $maintransport['end_time']; ?></td>
				    		<td><b>Location:</b></td>
				    		<td><?php echo $maintransport['lt_name']; ?></td>
				    	</tr>
				    	<tr>
				    		<td><b>Price: </b></td>
				    		<td><?php echo $maintransport['tp_saleprice']; ?> $</td>
				    		<td><b>Available day: </b></td>
				    		<td>
				    		<?php 
				    			echo $maintransport['monday'] == 1? '<span class="day">Monday </span>': NULL; 
				    			echo $maintransport['tuesday'] == 1? '<span class="day">Tuesday </span>': NULL; 
				    			echo $maintransport['wednesday'] == 1? '<span class="day">Wednesday </span>': NULL; 
				    			echo $maintransport['thursday'] == 1? '<span class="day">Thursday </span>': NULL; 
				    			echo $maintransport['friday'] == 1? '<span class="day">Friday </span>': NULL; 
				    			echo $maintransport['saturday'] == 1? '<span class="day">Saturday </span>': NULL; 
				    			echo $maintransport['sunday'] == 1? '<span class="day">Sunday </span>': NULL;
				    		?>
				    		</td>
				    	</tr>
				    </table>
				    <p><?php echo $maintransport['tp_textbooking']; ?></p>
				    <?php 
				    	$tp_id = $maintransport['tp_id'];
				    	if(isset($pktransportation['sub-transport'][$tp_id])){
				    		foreach ($pktransportation['sub-transport'][$tp_id] as $subtransport) {
				    ?>
			    			<div class="media col-lg-12" style="">
							  <div class="col-lg-2 pk_img">
								    <?php 
								    $imgname = $subtransport['pho_name'];
								    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
								    ?>
							  </div>
							  <div class="media-body">
							    <h4 class="media-heading"><?php echo $subtransport['tp_name']; ?></h4>
							    <p><b>Price: </b> &nbsp; &nbsp; <?php echo $subtransport['tp_saleprice']; ?> $</p>
							    <p><?php echo $subtransport['tp_textbooking']; ?></p>
							   </div>
							</div>		
				    <?php		
				    	 	}
				    	}
				    ?>
				    <?php 
				      if(isset($pktransportation['extraproduct-pk'][$tp_id])){
				      	foreach($pktransportation['extraproduct-pk'][$tp_id] as $eptp){
				    ?>
						 <div class="media col-lg-12" style="">
							  <div class="col-lg-2 pk_img">
								    <?php 
								    $imgname = $eptp['pho_name'];
								    echo img(array('src'=>'user_uploads/thumbnail/original/'.$imgname ,'alt'=>'packages','class'=>'img-responsive img-thumbnail')); 
								    ?>
							  </div>
							  <div class="media-body">
							    <h4 class="media-heading"><?php echo $eptp['ep_name']; ?></h4>
							    <p><b>Price: </b> &nbsp; &nbsp; <?php echo $eptp['ep_saleprice']; ?> $</p>
							    <p><?php echo $eptp['ep_bookingtext']; ?></p>
							    </div>
							</div>	
				    <?php
				    	}
				      }
				    ?>
				    </div>
				</div>
	<?php
				}
				echo '</div>';
			}
	?>

	<?php
		echo '<br />'.anchor('site/packages/showservice/','Continue', 'class="btn btn-primary"').nbs(5);
		echo anchor('site/packages/','Back', 'class="btn btn-default"');
		}
	}else{
		echo "No record was found...";
	}
	?>
	</div>
	<div class="col-lg-2">
	<!-- <div class="col-lg-2" id="sticky" style="background: blue;position:fixed; right:0"> -->
		<?php echo $this->session->userdata('pkprice'); ?>
	</div>
</div>