    <div class="div-after-content">&nbsp;</div>
    <div class="row top_footer">
        <div class="col-md-12"></div>
        <?php $this->load->view(INCLUDE_FE_MODEL."tellafriend"); ?>
        <?php $this->load->view(INCLUDE_FE_MODEL."subscriber"); ?>
    </div>

    <div class="row footer_tem">
            	<div class="col-md-6"></div>
            	<div class="col-md-6 icon_footer">
                        <a href="#"><button class="btn btn-default" data-toggle="modal" data-target=".subscribe_lg">subscribe for newslatter</button></a>
                    	<a href="#"><button class="btn btn-default" data-toggle="modal" data-target=".tellafriend-lg">Tell Friends</button></a>
                        <a href="#"><img src="<?php echo base_url();?>/assets/img/FE/youtube.png" class="img-responsive" alt="Responsive image"/></a>
			<a href="#"><img src="<?php echo base_url();?>/assets/img/FE/facebook.png" class="img-responsive" alt="Responsive image"/></a>
            	</div>
    </div>		
</div>
</body>
</html>