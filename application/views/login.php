<?php
  define("TEMPLATE_BE", "template/BE/");
  define("TEMPLATE_FE", "template/FE/");

  if(isset($admin)){
    $this->load->view(TEMPLATE_BE."login");
  }elseif(isset($fe)){
    $this->load->view(TEMPLATE_FE."login");
  }else{
    echo "Error not found...";
  }
?>