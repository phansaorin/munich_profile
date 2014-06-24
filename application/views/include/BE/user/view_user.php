<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("user/list_record","Manage"); ?></li>
      <li>View</li>
</ol>
<h1 class="action_page_header">View User</h1>
<?php  echo form_open('user/view_user/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_user->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>User Name</th> 
                	<td><?php echo $row->user_name; ?></td>
                </tr>
                <tr>                   
                	<th>Gender</th>
                    <td><?php echo $row->user_gender;?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $row->user_mail; ?></td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td><?php echo $row->user_telone; ?></td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td><?php $pisition = $row->role_id; 
                    	if($pisition == 1){
                    		echo "Admin";
                    	}elseif ($pisition == 2) {
                    		echo "Simple";
                    	}
                    ?></td>
                </tr>
                 <tr>
                    <th>Address</th>
                    <td><?php echo $row->user_address; ?></td>
                </tr>
                 <tr>
                    <th>Company</th>
                    <td><?php echo $row->user_company; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo anchor ('user/list_record','<span class="btn btn-primary">Back</span>');?></td>
                </tr>
                
                <?php } ?>
        </table>
    </div>
<?php echo form_close(); ?>


