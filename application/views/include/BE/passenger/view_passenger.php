<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("passenger/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("passenger/search_passenger","Search"); ?></li>
  <?php }?>
  <li>View</li>
</ol>
<h1 class="action_page_header">View Passenger</h1>
<?php  echo form_open('passenger/view_passenger/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_passenger->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>First Name</th> <td><?php echo $row->pass_fname; ?></td>
                </tr>
                <tr>
                	<th>Last Name</th> <td><?php echo $row->pass_lname ; ?></td>
                </tr>
                <tr>
                    <th>Email</th> <td><?php echo $row->pass_email; ?></td>
                </tr>
                <tr>
                    <th>Phone Number</th> <td><?php echo $row->pass_phone; ?></td>
                </tr>
                <tr>
                    <th>Address</th> <td><?php echo $row->pass_address; ?></td>
                </tr>
                <tr>
                	<th>Company</th> <td><?php echo $row->pass_company; ?></td>
                </tr>
                <tr>
                    <th>Gender</th> <td><?php echo $row->pass_gender; ?></td>
                </tr>
            </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('passenger/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
            <?php
echo form_close();
?>