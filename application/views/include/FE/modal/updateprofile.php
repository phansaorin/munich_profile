<div class="modal fade updateprofileuser" tabindex="-1" role="dialog" aria-labelledby="subscribeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      	<?php 
      		echo form_open("site/profile",'class="form_subscribe"');
      	?>
      	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h2 class="modal-title">Update Profile</h2>
      	</div>
	    <div class="modal-body">
                <?php if ($profile->num_rows > 0) { ?>
                        <?php foreach($profile->result() as $row) { ?>
                            <div class="form-group">
                               <label class="col-sm-4 control-label">First Name <span class="require">*</span> :</label>
                               <div class="col-sm-6">
                                   <?php
                                       $firstnamepass = array('name' => 'old_firstname','value'=> $row->pass_fname,'class' => 'form-control');
                                       echo form_input($firstnamepass); 
                                       ?>
                                   <span style="color:red;"><?php echo form_error('old_firstname'); ?></span>
                               </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Last Name <span class="require">*</span> :</label>
                                <div class="col-sm-6">
                                    <?php
                                        $lastnamepass = array('name' => 'old_lastname','value'=> $row->pass_lname,'class' => 'form-control');
                                        echo form_input($lastnamepass); 
                                        ?>
                                    <span style="color:red;"><?php echo form_error('old_lastname'); ?></span>
                                </div>
                             </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label">Email <span class="require">*</span> :</label>
                                <div class="col-sm-6">
                                    <?php
                                        $emailpass = array('name' => 'old_email','value'=> $row->pass_email,'class' => 'form-control');
                                        echo form_input($emailpass); 
                                        ?>
                                    <span style="color:red;"><?php echo form_error('old_email'); ?></span>
                                </div>
                             </div>
                             <div class="form-group">
                                <label class="col-sm-4 control-label">Phone number <span class="require">*</span> :</label>
                                <div class="col-sm-6">
                                    <?php
                                        $phonepass = array('name' => 'old_phone','value'=> $row->pass_phone,'class' => 'form-control');
                                        echo form_input($phonepass); 
                                        ?>
                                    <span style="color:red;"><?php echo form_error('old_phone'); ?></span>
                                </div>
                             </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label">Address <span class="require">*</span> :</label>
                                <div class="col-sm-6">
                                    <?php
                                        $addresspass = array('name' => 'old_address','value'=> $row->pass_address,'class' => 'form-control');
                                        echo form_textarea($addresspass); 
                                        ?>
                                    <span style="color:red;"><?php echo form_error('old_address'); ?></span>
                                </div>
                             </div>
                             <div class="form-group">
                                <label class="col-sm-4 control-label">Company <span class="require">*</span> :</label>
                                <div class="col-sm-6">
                                    <?php
                                        $companypass = array('name' => 'old_company','value'=> $row->pass_company,'class' => 'form-control');
                                        echo form_input($companypass); 
                                        ?>
                                    <span style="color:red;"><?php echo form_error('old_company'); ?></span>
                                </div>
                             </div>
                            <div class="form-group">
                            <label class="col-sm-4 control-label">Gender<span class="require">*</span> :</label>
                                <div class="col-sm-6">
                                    <?php echo form_dropdown('old_gender', $old_gender,$row->pass_gender ,'class="form-control"'); ?>
                                    <span style="color:red;"><?php echo form_error('old_gender'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-sm-4 control-label">Status<span class="require">*</span> :</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown('old_txtStatus', $old_txtStatus,$row->pass_status ,'class="form-control"'); ?>
                                <span style="color:red;"><?php echo form_error('old_txtStatus'); ?></span>
                            </div>
                           </div>
                           
	    </div>
         <?php } ?>
        <?php } ?>
	     <div class="btn_popup">
          <?php echo form_submit(array("name"=>"frm_profile","class"=>"frm_profile","id"=>"frm_profile","value"=>set_value("frm_profile","submit"),"class"=>"btn btn-primary")); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
	    <?php 
      		echo form_close();
      	?>
    </div>
  </div>
</div>