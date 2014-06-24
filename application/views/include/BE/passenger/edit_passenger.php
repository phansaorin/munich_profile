<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("passenger/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("passenger/search_passenger","Search"); ?></li>
  <?php }?>
  <li>Edit</li>
</ol>
<h1 class="action_page_header">Edit Passenger</h1>
<?php  echo form_open('passenger/edit_passenger/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>

<?php
        foreach ($get_passenger->result() as $row) {
            ?>
              <div class="form-group">
                    <label class="col-sm-2 control-label">First Name <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $firstnamepass = array('name' => 'old_firstname','value'=> $row->pass_fname,'class' => 'form-control');
                            echo form_input($firstnamepass); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_firstname'); ?></span>
                    </div>
    		 </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $lastnamepass = array('name' => 'old_lastname','value'=> $row->pass_lname,'class' => 'form-control');
                            echo form_input($lastnamepass); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_firstname'); ?></span>
                    </div>
    		 </div>
             <div class="form-group">
                    <label class="col-sm-2 control-label">Email <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $emailpass = array('name' => 'old_email','value'=> $row->pass_email,'class' => 'form-control');
                            echo form_input($emailpass); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_email'); ?></span>
                    </div>
    		 </div>
             <div class="form-group">
                    <label class="col-sm-2 control-label">Phone number <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $phonepass = array('name' => 'old_phone','value'=> $row->pass_phone,'class' => 'form-control');
                            echo form_input($phonepass); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_phone'); ?></span>
                    </div>
    		 </div>
             <div class="form-group">
                    <label class="col-sm-2 control-label">Address <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $addresspass = array('name' => 'old_address','value'=> $row->pass_address,'class' => 'form-control');
                            echo form_textarea($addresspass); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_address'); ?></span>
                    </div>
    		 </div>
             <div class="form-group">
                    <label class="col-sm-2 control-label">Company <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $companypass = array('name' => 'old_company','value'=> $row->pass_company,'class' => 'form-control');
                            echo form_input($companypass); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_company'); ?></span>
                    </div>
    		 </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Password <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $passwordpass = array('name' => 'old_password','value'=> $row->pass_password,'class' => 'form-control','type' => 'password');
                            echo form_input($passwordpass); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_password'); ?></span>
                    </div>
    		 </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Gender<span class="require">*</span> :</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown('old_gender', $old_gender,$row->pass_gender ,'class="form-control"'); ?>
                    <span style="color:red;"><?php echo form_error('old_gender'); ?></span>
                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown('old_txtStatus', $old_txtStatus,$row->pass_status ,'class="form-control"'); ?>
                    <span style="color:red;"><?php echo form_error('old_txtStatus'); ?></span>
                </div>
             </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php 
                        echo form_submit('edit_passenger', 'Update',"class='btn btn-primary check_value'");
                        echo '  ';
                        echo anchor('passenger/list_record', form_button('close', 'Cancel', "class='btn btn-sm btn-default'"));
                    ?>
                </div>
            </div>
            
          <?php } ?>  
          
            <?php
echo form_close();?>