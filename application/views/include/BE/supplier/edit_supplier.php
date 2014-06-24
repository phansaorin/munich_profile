
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("supplier/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("supplier/search_supplier","Search"); ?></li>
  <?php }?>
  <li>Edit</li>
</ol>
<h1 class="action_page_header">Edit Supplier</h1>
<?php 
    echo form_open("supplier/edit_supplier/".$this->uri->segment(3),'class="form-horizontal" role="form"');
?>
<?php
    foreach ($get_supplier->result() as $row) {
?>

	<div class="form-group">
        <label class="col-sm-2 control-label">Company Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_txtCompanyName = array('name' =>'old_txtCompanyName','value'=> $row->sup_company_name,'class' => 'form-control');
                echo form_input($old_txtCompanyName);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtCompanyName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">First Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_txtFirstName = array('name' =>'old_txtFirstName','value'=> $row->sup_fname,'class' => 'form-control');
                echo form_input($old_txtFirstName);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtFirstName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Last Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_txtLastName = array('name' =>'old_txtLastName','value'=> $row->sup_lname,'class' => 'form-control');
                echo form_input($old_txtLastName);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtLastName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Occupation :</label>
        <div class="col-sm-4">
            <?php
                $old_txtOccupation = array('name' =>'old_txtOccupation','value'=> $row->sup_occupation,'class' => 'form-control');
                echo form_input($old_txtOccupation);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtOccupation'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sector :</label>
        <div class="col-sm-4">
            <?php
                $old_txtSector = array('name' =>'old_txtSector','value'=> $row->sup_sector,'class' => 'form-control');
                echo form_input($old_txtSector);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtSector'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Service Provistion :</label>
        <div class="col-sm-4">
            <?php
                $old_txtService = array('name' =>'old_txtService','value'=> $row->sup_service_provision,'class' => 'form-control');
                echo form_input($old_txtService);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtService'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Country :</label>
        <div class="col-sm-4">
            <?php
                $old_txtCountry = array('name' =>'old_txtCountry','value'=> $row->sup_country,'class' => 'form-control');
                echo form_input($old_txtCountry);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtCountry'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">City :</label>
        <div class="col-sm-4">
            <?php
                $old_txtCity = array('name' =>'old_txtCity','value'=> $row->sup_city,'class' => 'form-control');
                echo form_input($old_txtCity);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtCity'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Mobile <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_txtMobile = array('name' =>'old_txtMobile','value'=> $row->sup_phone,'class' => 'form-control');
                echo form_input($old_txtMobile);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtMobile'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Home :</label>
        <div class="col-sm-4">
            <?php
                $old_txtHomePhone = array('name' =>'old_txtHomePhone','value'=> $row->sup_home_phone,'class' => 'form-control');
                echo form_input($old_txtHomePhone);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtHomePhone'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_txtEmail = array('name' =>'old_txtEmail','value'=> $row->sup_email,'class' => 'form-control');
                echo form_input($old_txtEmail);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtEmail'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Website :</label>
        <div class="col-sm-4">
            <?php
                $old_txtWebsite = array('name' =>'old_txtWebsite','value'=> $row->sup_website,'class' => 'form-control');
                echo form_input($old_txtWebsite);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtWebsite'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Address <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_txtAddress = array('name' =>'old_txtAddress','value'=> $row->sup_address,'class' => 'form-control');
                echo form_input($old_txtAddress);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtAddress'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Postal Code :</label>
        <div class="col-sm-4">
            <?php
                $old_txtCode = array('name' =>'old_txtCode','value'=> $row->sup_postcode,'class' => 'form-control');
                echo form_input($old_txtCode);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtCode'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('edit_supplier', 'Update',"class='btn btn-primary check_value'");
				echo '  ';
				echo anchor('supplier/list_record', form_button('close', 'Cancel', "class='btn btn-sm btn-default'"));
            ?>
        </div>
    </div>
<?php } ?>		
<?php echo form_close();?>

 