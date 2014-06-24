<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("user/list_record","Manage"); ?></li>
      <li>Edit</li>
</ol>
<h1 class="action_page_header">Edit User</h1>
<?php  echo form_open('user/edit_user/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
    <div class="form-group">
        <label class="col-sm-2 control-label">First Name<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php foreach($get_users->result() as $row){?>
            <?php
                $old_fName = array('name' =>'old_fname','value'=> $row->user_fname,'class' => 'form-control');
                echo form_input($old_fName);
            ?>
            <span style="color:red;"><?php echo form_error('old_fname'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Last Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_lname = array('name' =>'old_lname','value'=> $row->user_lname,'class' => 'form-control');
                echo form_input($old_lname);
            ?>
            <span style="color:red;"><?php echo form_error('old_lname'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">User Name<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_userName = array('name' =>'old_username','value'=> $row->user_name,'class' => 'form-control');
                echo form_input($old_userName);
            ?>
            <span style="color:red;"><?php echo form_error('old_username'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Password<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_password = array('name' =>'old_password','value'=> $row->user_password,'class' => 'form-control');
                echo form_password($old_password);
            ?>
            <span style="color:red;"><?php echo form_error('old_paassword'); ?></span>
        </div>
       
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Phone Number<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_phone_num = array('name'=>'old_phone_num', 'class' => 'form-control', 'value' => $row->user_telone); 
                echo form_input($old_phone_num);
            ?>
            <span style="color:red;"><?php echo form_error('old_phone_num'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">User Type<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('old_usertype', $option_role,$row->role_id,'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('old_usertype'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Gender<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('old_gender', $gender,$row->user_gender,'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('old_gender'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('old_txtStatus', $old_txtStatus,$row->user_status,'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('old_txtStatus'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $old_email = array('name'=>'old_email', 'class' => 'form-control', 'value' => $row->user_mail);
                echo form_input($old_email);
            ?>
            <span style="color:red;"><?php echo form_error('old_email'); ?></span>
        </div>
    </div>
        <div class="form-group">
        <label class="col-sm-2 control-label">Company<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $old_company = array('name'=>'old_company', 'class' => 'form-control', 'value' => $row->user_company);
                echo form_input($old_company);
            ?>
            <span style="color:red;"><?php echo form_error('old_company'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Address<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $old_address = array('name'=>'old_address', 'class' => 'form-control textarea', 'value' => $row->user_address);
                echo form_textarea($old_address);
            ?>
            <span style="color:red;"><?php echo form_error('old_address'); ?></span>
        </div>
    </div>
    <?php } ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-primary btn-xs"  data-toggle="tooltip" data-placement="right" title="* are requries">Note</button><span class="require"> All (*) are requries.</span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('edit_user', 'Edit',"class='btn btn-primary'");
                echo '  ';
                echo anchor('user/list_record', 'Cancel', "class='btn btn-sm btn-default'");
            ?>
        </div>
    </div>

<!-- </form> -->
            <?php echo form_close(); ?>
