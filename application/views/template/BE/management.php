<div class="container-fluid">
    <?php $this->load->view(INCLUDE_BE.'tm_header'); ?>
    <?php $this->load->view(INCLUDE_BE.'be_menu'); ?>   
    <div class="col-md-10">
    	<div class=" main_content">
    <?php
        $this->load->view(INCLUDE_BE.$this->uri->segment(1) . '/' . $this->uri->segment(2));
    ?>
    	<div style="clear:both">&nbsp;</div>
    	</div>
    </div>
    <?php $this->load->view(INCLUDE_BE.'tm_footer'); ?> 
</div>