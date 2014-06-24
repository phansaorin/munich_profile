<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("location/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("location/search_location","Search"); ?></li>
  <?php }?>
  <li>View</li>
</ol>
<h1 class="action_page_header">View Location</h1>
<?php  echo form_open('location/view_location/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_location->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>Location Name</th> <td><?php echo $row->lt_name; ?></td>
                </tr>
              </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('location/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
<?php
    echo form_close();
?>