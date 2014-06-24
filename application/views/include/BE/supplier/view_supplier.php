<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("supplier/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("supplier/search_supplier","Search"); ?></li>
  <?php }?>
  <li>View</li>
</ol>
<h1 class="action_page_header">View Supplier</h1>
<?php
        foreach ($view_supplier->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>Company Name</th> 
                    <td><?php echo $row->sup_company_name; ?></td>
                </tr>
              	<tr>
                	<th>First Name</th> 
                    <td><?php echo $row->sup_fname; ?></td>
                </tr>
                <tr>                   
                	<th>Last Name</th>
                    <td><?php echo $row->sup_lname; ?></td>
                </tr>
                <tr>
                    <th>Occupation</th> 
                    <td><?php echo $row->sup_occupation; ?>
                </tr>
                <tr>
                	<th>Sector</th> 
                    <td><?php echo $row->sup_sector; ?></td>
                </tr>
                <tr>
                    <th>Service Provision</th> 
                    <td><?php echo $row->sup_service_provision; ?></td>
                </tr>
                <tr>
                    <th>Country</th> 
                    <td> <?php  echo $row->sup_country; ?> </td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><?php echo $row->sup_city; ?></td>
                </tr>
                <tr>
                    <th>Mobile Phone</th> 
                    <td><?php echo $row->sup_phone; ?></td>
                </tr>
                <tr>
                    <th>Land Line</th> 
                    <td><?php echo $row->sup_home_phone; ?></td>
                </tr>
                <tr>
                	<th>Email</th> 
                    <td><?php echo $row->sup_email; ?></td>
                </tr>
                <tr>
                	<th>Website</th> 
                    <td><?php echo $row->sup_website; ?></td>
                </tr>
                <tr>
                    <th>Address</th> 
                    <td><?php echo $row->sup_address; ?></td>
                </tr>
                <tr>
                    <th>Postal Code</th> 
                    <td><?php echo $row->sup_postcode; ?></td>
                </tr>
              </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('supplier/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
            <?php echo form_close(); ?>