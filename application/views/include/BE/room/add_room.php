<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("room/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("room/search_room","Search"); ?></li>
  <?php }?>
  <li>Add</li>
</ol>
<h1 class="action_page_header">Add Room</h1>
<?php  echo form_open_multipart('room/add_room', 'class="form-horizontal add_room"'); ?>
  
    <div class="form-group">
        <label class="col-sm-2 control-label">Room Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $roomname = array('name' =>'roomName','value'=> set_value('roomName'),'class' => 'form-control','placeholder'=>'Room Name');
                echo form_input($roomname);
            ?>
            <span style="color:red;"><?php echo form_error('roomName'); ?></span>
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
                echo form_submit('addRoom', 'Add',"class='btn btn-primary'");
                echo '  ';
                echo anchor('room/list_record', 'Cancel', "class='btn btn-sm btn-default'");
            ?>
        </div>
    </div>
<!-- </form> -->
<?php echo form_close();?>
