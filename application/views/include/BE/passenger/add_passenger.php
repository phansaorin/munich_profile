<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("passenger/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("passenger/search_passenger","Search"); ?></li>
  <?php }?>
  <li>Add</li>
</ol>
<h1 class="action_page_header">Add Passenger</h1>
<?php  echo form_open_multipart('passenger/add_passenger', 'class="form-horizontal add_passenger"'); ?>
  
    <div class="form-group">
        <label class="col-sm-2 control-label">First Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $firstname = array('name' =>'firstName','value'=> set_value('firstName'),'class' => 'form-control','placeholder'=>'First Name');
                echo form_input($firstname);
            ?>
            <span style="color:red;"><?php echo form_error('firstName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Last Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $lastname = array('name' =>'lastName','value'=> set_value('lastName'),'class' => 'form-control','placeholder'=>'Last Name');
                echo form_input($lastname);
            ?>
            <span style="color:red;"><?php echo form_error('lastName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $email = array('name' =>'email','value'=> set_value('email'),'class' => 'form-control','placeholder'=>'Email');
                echo form_input($email);
            ?>
            <span style="color:red;"><?php echo form_error('email'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Phone number <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $phone = array('name' =>'phone','value'=> set_value('phone'),'class' => 'form-control','placeholder'=>'Phone','type'=>'number');
                echo form_input($phone);
            ?>
            <span style="color:red;"><?php echo form_error('phone'); ?></span>
        </div>
    </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">Address <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $address = array('name' =>'address','value'=> set_value('address'),'class' => 'form-control','placeholder'=>'Address');
                echo form_textarea($address);
            ?>
            <span style="color:red;"><?php echo form_error('address'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Company <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $company = array('name' =>'company','value'=> set_value('company'),'class' => 'form-control','placeholder'=>'Company Name');
                echo form_input($company);
            ?>
            <span style="color:red;"><?php echo form_error('company'); ?></span>
        </div>
    </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">Password <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $password = array('name' =>'password','value'=> set_value('password'),'class' => 'form-control','type'=>'password','placeholder'=>'Password');
                echo form_input($password);
            ?>
            <span style="color:red;"><?php echo form_error('password'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Gender<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('gender', $gender, set_value('gender'),'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('gender'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('txtStatus', $txtStatus, set_value('txtStatus'),'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('txtStatus'); ?></span>
        </div>
    </div>
    
     <div class="form-group">
        <div <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('addPassenger', 'Add',"class='btn btn-primary'");
				echo '  ';
				echo anchor('passenger/list_record', 'Cancel', "class='btn btn-sm btn-default'");
            ?>
        </div>
    </div>
<!-- </form> -->
            <?php
echo form_close();?>
