<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("supplier/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("extra_products/search_extra_products","Search"); ?></li>
  <?php }?>
  <li>View</li>
</ol>
<h1 class="action_page_header">View Extra Product</h1>

<?php  echo form_open('extra_products/view_extra_products/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_extra_products->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>Extra Products Name</th> <td><?php echo $row->ep_name; ?></td>
                </tr>
                <tr>                   
                	 <th>Per Person</th>
                    <td><?php $item = $row->ep_perperson;
						if($item == 1){
							echo "Yes";
						}else{
							echo "No";
						}?>
                     </td>
                </tr>
                <tr>                   
                	 <th>Per Booking</th>
                    <td><?php $item = $row->ep_perbooking;
						if($item == 1){
							echo "Yes";
						}else{
							echo "No";
						}?>
                     </td>
                </tr>
                <tr>
                    <th>Text for Booking</th> <td><?php echo $row->ep_bookingtext; ?></td>
                </tr>
                <tr>                   
                    <th>File Photo</th>
                    <?php    
                        $id = 1;
                    if ($this->uri->segment(3)) {
                        $id = $this->uri->segment(3) + 1;
                    } else {
                        $id = 1;
                    }   
                        $exploded = explode('.', $row->pho_source);
                        $img = $exploded['0'] . '_thumb.'.$exploded['1'];
                        $image_properties = array('src' => site_url('user_uploads/thumbnail/thumb/' . $img), 'alt' => $row->pho_name,'class' => 'style_img', 'title' => $row->pho_name);            
                    ?>
                    <td><?php echo img($image_properties); ?></td> 
                </tr>
                <!-- <tr>
                    <th>File photo</th> <td> <?php  // echo $row->pho_name; ?> </td>
                </tr> -->
                <tr>
                    <th>Text for Eticket</th>
                    <td><?php echo $row->ep_etickettext; ?></td>
                </tr>
                <tr>
                    <th>Purchase price</th> <td><?php echo $row->ep_purchaseprice; ?></td>
                </tr>
                <tr>
                    <th>Sale price</th> <td><?php echo $row->ep_saleprice; ?></td>
                </tr>
                <tr>
                	<th>Original Stock</th> <td><?php echo $row->ep_originalstock; ?></td>
                </tr>
                <tr>
                    <th>Actual Stock</th> <td><?php echo $row->ep_actualstock; ?></td>
                </tr>
                <tr>
                    <th>Provider Date</th> <td><?php echo $row->ep_providerdate; ?></td>
                </tr>
                <tr>
                    <th>Paid Date</th> <td><?php echo $row->ep_payeddate; ?></td>
                </tr>
                <tr>
                    <th>Deadline</th> <td><?php echo $row->ep_deadline; ?></td>
                </tr>
                <tr>
                    <th>Text for admin</th> <td><?php echo $row->ep_admintext; ?></td>
                </tr>
              </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('extra_products/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
            <?php
echo form_close();
?>