<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("user/list_record","Manage"); ?></li>
      <li>Add</li>
</ol>
<?php 
    if($this->session->userdata('add_fail')){
        echo $this->session->userdata('add_fail');
        $this->session->unset_userdata('add_fail');
    }
?>
<h1 class="action_page_header">Add User</h1>
<?php  echo form_open('user/add_user', 'class="form-horizontal add_activities"'); ?>

<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
    <div class="form-group">
        <label class="col-sm-2 control-label">First Name<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $fName = array('name' =>'fname','value'=> set_value('fname'),'class' => 'form-control');
                echo form_input($fName);
            ?>
            <span style="color:red;"><?php echo form_error('fname'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Last Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $lname = array('name' =>'lname','value'=> set_value('lname'),'class' => 'form-control');
                echo form_input($lname);
            ?>
            <span style="color:red;"><?php echo form_error('lname'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">User Name<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $userName = array('name' =>'username','value'=> set_value('username'),'class' => 'form-control');
                echo form_input($userName);
            ?>
            <span style="color:red;"><?php echo form_error('username'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Password<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $password = array('name' =>'password','value'=> set_value('password'),'class' => 'form-control');
                echo form_password($password);
            ?>
            <span style="color:red;"><?php echo form_error('paassword'); ?></span>
        </div>
       
    </div>
    <!-- start new code -->
    <div class="form-group">
        <label class="col-sm-2 control-label">Mobile<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $mobile = array('name' =>'txtmobile','value'=> set_value('txtmobile'),'class' => 'form-control');
                echo form_input($mobile);
            ?>
            <span style="color:red;"><?php echo form_error('txtmobile'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Fax<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $fix = array('name' =>'txtfix','value'=> set_value('txtfix'),'class' => 'form-control');
                echo form_input($fix);
            ?>
            <span style="color:red;"><?php echo form_error('txtfix'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Website<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $website = array('name' =>'website','value'=> set_value('website'),'class' => 'form-control');
                echo form_input($website);
            ?>
            <span style="color:red;"><?php echo form_error('website'); ?></span>
        </div>
    </div>
    <!-- end of new code -->
    <div class="form-group">
        <label class="col-sm-2 control-label">Phone Number One<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $phone_num = array('name'=>'phone_num', 'class' => 'form-control', 'value' => set_value('phone_num')); 
                echo form_input($phone_num);
            ?>
            <span style="color:red;"><?php echo form_error('phone_num'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Phone Number Two:</label>
        <div class="col-sm-4">
            <?php
                $phone_num_two = array('name'=>'phone_num_two', 'class' => 'form-control', 'value' => set_value('phone_num_two')); 
                echo form_input($phone_num_two);
            ?>
            
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">User Type<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('usertype', $option_role, set_value('usertype'),'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('usertype'); ?></span>
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
        <label class="col-sm-2 control-label">Email<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $email = array('name'=>'email', 'class' => 'form-control', 'value' => set_value('email'));
                echo form_input($email);
            ?>
            <span style="color:red;"><?php echo form_error('email'); ?></span>
        </div>
    </div>
        <div class="form-group">
        <label class="col-sm-2 control-label">Company<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $company = array('name'=>'company', 'class' => 'form-control', 'value' => set_value('company'));
                echo form_input($company);
            ?>
            <span style="color:red;"><?php echo form_error('company'); ?></span>
        </div>
    </div>
  <div class="form-group">
        <label class="col-sm-2 control-label">Address<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $address = array('name'=>'address', 'class' => 'form-control textarea', 'value' => set_value('address'));
                echo form_textarea($address);
            ?>
            <span style="color:red;"><?php echo form_error('address'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-primary btn-xs"  data-toggle="tooltip" data-placement="right" title="* are requries">Note</button><span class="require"> All (*) are requries.</span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('addUsers', 'Add',"class='btn btn-primary'");
                echo '  ';
                echo anchor('user/list_record', 'Cancel', "class='btn btn-sm btn-default'");
            ?>
        </div>
    </div>

<!-- </form> -->
            <?php echo form_close(); ?>
