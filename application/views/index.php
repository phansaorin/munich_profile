<?php 
	define("INCLUDE_FE", "include/FE/");
	define("TEMPLATE_FE", "template/FE/");
	define("INCLUDE_FE_MODEL", "include/FE/modal/");
	define("INCLUDE_FE_CUSTOMIZE", "include/FE/customize/");
?>
<?php $this->load->view(INCLUDE_FE.'header'); ?>
<?php
	if(isset($site_setting) && $site_setting == "sideleft"){
		$this->load->view(TEMPLATE_FE.'sideleft');
	}elseif(isset($site_setting) && $site_setting == "sideright"){
		$this->load->view(TEMPLATE_FE.'sideright');
	}elseif(isset($site_setting) && $site_setting == "fullwidth"){
		$this->load->view(TEMPLATE_FE.'fullwidth');
	}elseif(isset($site_setting) && $site_setting == "packages"){
		$this->load->view(TEMPLATE_FE.'packages');
	}elseif(isset($site_setting) && $site_setting == "customizes"){
		$this->load->view(TEMPLATE_FE.'customizes');
	}else{
		if(isset($site_setting) && $site_setting != ""){
			$this->load->view(TEMPLATE_FE.$site_setting);
		}else{
			$this->load->view(TEMPLATE_FE.'nocontent');
		}
	}
?>
<?php $this->load->view(INCLUDE_FE.'footer'); ?>