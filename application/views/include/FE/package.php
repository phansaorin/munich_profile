<div class="row clearfix">
	<div class="col-lg-12 txtTitleChoose">
		<h2>Booking Tours</h2>
		<h3>Choose a Package</h3>
	</div>
	<?php 
		if($allpackages->num_rows > 0){
			foreach($allpackages->result() as $rows){
	?>
		<div class="media col-lg-6" style="padding-left:5px; border-left: 2px solid #3F703F;">
		  <div class="col-lg-4 pk_img">
			    <?php 
			    $key = "90408752631";
                $pk_id = base64_encode($key.$rows->pkcon_id);
			    echo anchor('site/packages/details/'.$pk_id, img(array('src'=>'assets/img/FE/package.jpg','alt'=>'packages','class'=>'img-responsive img-thumbnail'))); 
			    ?>
			  <div class="pricepackages"><?php echo $rows->pkcon_saleprice; ?> USD</div>
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading"><?php echo anchor('site/packages/details/'.$pk_id, character_limiter($rows->pkcon_name, 40)); ?></h4>
		    <p><?php echo character_limiter($rows->pkcon_description, 320);?></p>
		    <span><?php echo anchor('site/packages/details/'.$pk_id, 'More detail...'); ?></span>
		  </div>
		</div>
	<?php
			}
		}else{
			echo "No record was found...";
		}
			
	?>
</div>