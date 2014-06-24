
    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("subscribers/list_record","Manage"); ?></li>
      <li>Edit</li>
    </ol>
    <h1 class="action_page_header">Edit Subscriber</h1>



<?php  echo form_open('subscribers/edit_subscribers/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>

<?php
        foreach ($get_subscriber->result() as $row) {
            ?>
              <div class="form-group">
                    <label class="col-sm-2 control-label">First Name <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $firstnamesub = array('name' => 'old_firstnamesub','value'=> $row->sub_fname,'class' => 'form-control');
                            echo form_input($firstnamesub); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_firstnamesub'); ?></span>
                    </div>
    		 </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $lastnamesub = array('name' => 'old_lastnamesub','value'=> $row->sub_lname,'class' => 'form-control');
                            echo form_input($lastnamesub); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_lastnamesub'); ?></span>
                    </div>
    		 </div>
             <div class="form-group">
                    <label class="col-sm-2 control-label">Email <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $emailsub = array('name' => 'old_emailsub','value'=> $row->sub_email,'class' => 'form-control');
                            echo form_input($emailsub); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_emailsub'); ?></span>
                    </div>
    		 </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown('old_txtStatussub', $old_txtStatussub,$row->sub_status,'class="form-control"'); ?>
                    <span style="color:red;"><?php echo form_error('old_txtStatussub'); ?></span>
                </div>
             </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php 
                        echo form_submit('edit_subscribers', 'Save',"class='btn btn-primary'");
                        echo '  ';
                        echo anchor('subscribers/list_record', 'Cancel', "class='btn btn-sm btn-default'");
                    ?>
                </div>
            </div
            
<?php } ?>  
          
<?php echo form_close();?>