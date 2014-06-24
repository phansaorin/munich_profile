<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("room/list_record","Manage"); ?></li>
      <li>View</li>
</ol>
<h1 class="action_page_header">View Room</h1>
<?php  echo form_open('room/view_room/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_room->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>Room Name</th> <td><?php echo $row->rt_name; ?></td>
                </tr>
                
            </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('room/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
<?php echo form_close(); ?>