<?php
    if ($this->session->userdata('success_msg')) {
        echo $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
    } 
?>
<?php 
    define("INCLUDE_BE","include/BE/");
    define("TEMPLATE_BE","template/BE/");
?>
<?php $this->load->view(INCLUDE_BE.'be_header'); ?>
    <?php 
        if(isset($dashboard) AND $dashboard == 'Default Dashboard'){
            $this->load->view(TEMPLATE_BE.'dashboard');
        }elseif(isset($dashboard) AND $dashboard == 'management'){
            $this->load->view(TEMPLATE_BE.'management');
        }
    ?>
<?php $this->load->view(INCLUDE_BE.'be_footer'); ?>
