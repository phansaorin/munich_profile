<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("facilities/list_record","Manage"); ?></li>
      <li>View</li>
</ol>
<h1 class="action_page_header">View Facility</h1>
<?php  echo form_open('facilities/view_facilities/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_facilities->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>Facility Name</th> <td><?php echo $row->facilities_title; ?></td>
                </tr> 
                <tr>
                  <th>Facility Value</th> <td><?php echo $row->facilities_value; ?></td>
                </tr>               
              </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('facilities/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
            <?php echo form_close(); ?>