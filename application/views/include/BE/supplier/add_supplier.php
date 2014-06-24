<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("supplier/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("supplier/search_supplier","Search"); ?></li>
  <?php }?>
  <li>Add</li>
</ol>
<h1 class="action_page_header">Add Supplier</h1>
<?php 
    echo form_open("supplier/add_supplier",'class="form-horizontal" role="form"');
?>
	<div class="form-group">
        <label class="col-sm-2 control-label">Company Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtCompanyName = array('name' =>'txtCompanyName','value'=> set_value('txtCompanyName'),'class' => 'form-control');
                echo form_input($txtCompanyName);
            ?>
            <span style="color:red;"><?php echo form_error('txtCompanyName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">First Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtFirstName = array('name' =>'txtFirstName','value'=> set_value('txtFirstName'),'class' => 'form-control');
                echo form_input($txtFirstName);
            ?>
            <span style="color:red;"><?php echo form_error('txtFirstName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Last Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtLastName = array('name' =>'txtLastName','value'=> set_value('txtLastName'),'class' => 'form-control');
                echo form_input($txtLastName);
            ?>
            <span style="color:red;"><?php echo form_error('txtLastName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Occupation :</label>
        <div class="col-sm-4">
            <?php
                $txtOccupation = array('name' =>'txtOccupation','value'=> set_value('txtOccupation'),'class' => 'form-control');
                echo form_input($txtOccupation);
            ?>
            <span style="color:red;"><?php echo form_error('txtOccupation'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sector :</label>
        <div class="col-sm-4">
            <?php
                $txtSector = array('name' =>'txtSector','value'=> set_value('supplierSector'),'class' => 'form-control');
                echo form_input($txtSector);
            ?>
            <span style="color:red;"><?php echo form_error('txtSector'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Service Provistion :</label>
        <div class="col-sm-4">
            <?php
                $txtService = array('name' =>'txtService','value'=> set_value('txtService'),'class' => 'form-control');
                echo form_input($txtService);
            ?>
            <span style="color:red;"><?php echo form_error('txtService'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Country :</label>
        <div class="col-sm-4">
            <?php
                $txtCountry = array('name' =>'txtCountry','value'=> set_value('txtCountry'),'class' => 'form-control');
                echo form_input($txtCountry);
            ?>
            <span style="color:red;"><?php echo form_error('txtCountry'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">City :</label>
        <div class="col-sm-4">
            <?php
                $txtCity = array('name' =>'txtCity','value'=> set_value('txtCity'),'class' => 'form-control');
                echo form_input($txtCity);
            ?>
            <span style="color:red;"><?php echo form_error('txtCity'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Mobile <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtMobile = array('name' =>'txtMobile','value'=> set_value('txtMobile'),'class' => 'form-control');
                echo form_input($txtMobile);
            ?>
            <span style="color:red;"><?php echo form_error('txtMobile'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Home :</label>
        <div class="col-sm-4">
            <?php
                $txtHomePhone = array('name' =>'txtHomePhone','value'=> set_value('txtHomePhone'),'class' => 'form-control');
                echo form_input($txtHomePhone);
            ?>
            <span style="color:red;"><?php echo form_error('txtHomePhone'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtEmail = array('name' =>'txtEmail','value'=> set_value('txtEmail'),'class' => 'form-control');
                echo form_input($txtEmail);
            ?>
            <span style="color:red;"><?php echo form_error('txtEmail'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Website :</label>
        <div class="col-sm-4">
            <?php
                $txtWebsite = array('name' =>'txtWebsite','value'=> set_value('txtWebsite'),'class' => 'form-control');
                echo form_input($txtWebsite);
            ?>
            <span style="color:red;"><?php echo form_error('txtWebsite'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Address <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtAddress = array('name' =>'txtAddress','value'=> set_value('txtAddress'),'class' => 'form-control');
                echo form_input($txtAddress);
            ?>
            <span style="color:red;"><?php echo form_error('txtAddress'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Postal Code :</label>
        <div class="col-sm-4">
            <?php
                $txtCode = array('name' =>'txtCode','value'=> set_value('txtCode'),'class' => 'form-control');
                echo form_input($txtCode);
            ?>
            <span style="color:red;"><?php echo form_error('txtCode'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('addSupplier', 'Add',"class='btn btn-primary'");
				echo '  ';
				echo anchor('supplier/list_record', 'Cancel', "class='btn btn-sm btn-default'");
            ?>
        </div>
    </div>
<!-- </form> -->
<?php echo form_close();?>

 