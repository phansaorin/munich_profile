
<h4>User detail information</h4>
<?php
        foreach ($detail_info->result() as $row) {
            ?>
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>No</th> <td><?php echo $row->user_id ; ?></td>
                </tr>
                <tr>
                	<th>First Name</th> <td><?php echo $row->user_fname; ?></td>
                </tr>
                <tr>
                	<th>Last Name</th> <td><?php echo $row->user_lname; ?></td>
                </tr>
                
                <tr>
                	<th>Email</th> <td><?php echo $row->user_mail; ?></td>
                </tr>
                <tr>
                	<th>Phone number 1</th> <td><?php echo $row->user_telone; ?></td>
                </tr>
                <tr>
                	<th>Phone number 2</th> <td><?php echo $row->user_teltwo; ?></td>
                </tr>
                <tr>
                	<th>Address</th> <td><?php echo $row->user_address; ?></td>
                </tr>
                 <tr>
                	<th>Company</th> <td><?php echo $row->user_company ; ?></td>
                </tr>
                <tr>
                	<th>Title</th> <td><?php echo $row->role_title; ?></td>
                </tr>
               
            </table>
        </div>
    
	<?php } ?>
    <?php
      //  echo anchor($this->load->view('munich_admin'), form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
</div>
            <?php
echo form_close();
?>