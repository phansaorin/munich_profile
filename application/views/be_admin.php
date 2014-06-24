<?php $this->load->view('include/BE/be_header'); ?>
<div class="row-fluid">
    <div class="span2 nav-left">
        <?php $this->load->view('include/BE/be_menu'); ?>
    </div>
    <div class="span10 main_content">
        
        <?php
        //$this->load->view('ct_admin/includes/show_sms');

        if (!$this->uri->segment(2)) {
        } else {
            $this->load->view($this->uri->segment(1) . '/' . $this->uri->segment(2));
        }
        ?>
    </div>
</div>
<?php $this->load->view('include/BE/be_header'); ?>
