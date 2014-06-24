    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("subscribers/list_record","Manage"); ?></li>
      <li>View</li>
    </ol>
    <h1 class="action_page_header">View Festival</h1>
<?php  echo form_open('subscribers/view_subscriber/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_subscriber->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	
        <div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>First Name</th> <td><?php echo $row->sub_fname; ?></td>
                </tr>
                <tr>
                	<th>Last Name</th> <td><?php echo $row->sub_lname ; ?></td>
                </tr>
                <tr>
                    <th>Email</th> <td><?php echo $row->sub_email; ?></td>
                </tr>
               
            </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('subscribers/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>  
<?php echo form_close(); ?>