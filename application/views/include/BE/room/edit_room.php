<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("room/list_record","Manage"); ?></li>
      <li>Edit</li>
</ol>
<h1 class="action_page_header">Edit Room</h1>
<?php  echo form_open('room/edit_room/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>

<?php
        foreach ($get_room->result() as $row) {
            ?>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Room Name <span class="require">*</span> :</label>
                    <div class="col-sm-4">
                        <?php
                            $roomtypename = array('name' => 'old_roomname','value'=> $row->rt_name,'class' => 'form-control');
                            echo form_input($roomtypename); 
                            ?>
                        <span style="color:red;"><?php echo form_error('old_roomname'); ?></span>
                    </div>
    		 </div>
             
             <div class="form-group">
                <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown('old_txtStatus', $old_txtStatus,$row->rt_status ,'class="form-control"'); ?>
                    <span style="color:red;"><?php echo form_error('old_txtStatus'); ?></span>
                </div>
             </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('edit_room', 'Update',"class='btn btn-primary'");
				echo '  ';
				echo anchor('room/list_record', form_button('close', 'Cancel', 'class="btn btn-sm btn-default"'));
            ?>
        </div>
    </div>
            
    <?php } ?>  
          
    <?php echo form_close();?>