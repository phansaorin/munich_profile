<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
  ?>
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("booking/list_record","Manage Booking"); ?></li>
  <li>Search Booking</li>
</ol>

<div class="row">
    <div class="col-md-7 column search">
        <?php
        echo form_open("booking/search_booking", 'class="navbar-form navbar-left" role="search"');
        
        echo '<div class="form-group">';
        echo form_input(
                array('name' => 'search_bookingID',
                    'value' => set_value('search_id', $this->session->userdata('searchBooking')),
                    'class' => 'form-control input-sm',
                    'placeholder' => 'Booking ID'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "filter", "class" => "btn btn-primary btn-sm"));
        echo form_close();
        ?>
    </div>
    <div class="col-md-5 column top-action">
        <?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
               echo anchor("booking/deleteMultipleBooking","",'class="tdelete" style="display:none;"'); 
        ?>
        <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
              echo anchor("booking/deletePermenentBooking", "", 'class="pdelete" style="display:none;"');
        ?>
        <?php 
          echo anchor('booking/add_booking', 'Add New','class="btn btn-primary btn-sm"');
        ?>
    </div>
</div>
<table class="table table-striped table-hover table-bordered">
    <tr> 
        <th width="5%"><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
        <th width="7%"><?php echo anchor("booking/search_booking/ID/" . $sort, "ID"); ?></th>
        <th>Date</th>
        <th>Arrival</th>
        <th>Paid</th>
        <th>Price($)</th>
        <th>People</th>
        <th>Type</th>
        <th>Status</th>
        <th width="8%">Action</th>
    </tr>   
    <?php if ($getbooking->num_rows > 0) { ?>
      <?php foreach ($getbooking->result() as $data) { ?>
            <tr>
                <td>
                    <?php echo form_checkbox( array('class' => 'check_checkbox', 'id' => 'check_checkbox', 'name' => 'check_checkbox[]'), $data->bk_id ); ?>
                </td>
                <td><?php echo $data->bk_id; ?></td>
                <td><?php echo $data->bk_date; ?></td>
                <td><?php echo $data->bk_arrival_date; ?></td>
                <td><?php echo $data->bk_pay_date; ?></td>
                <td><?php echo $data->bk_pay_price; ?></td>
                <td><?php echo $data->bk_total_people; ?></td>
                <td><?php echo $data->bk_type; ?></td>
                <td><?php echo $data->bk_pay_status == 1 ? "paid" : "un-paid";?></td>
                <td>
                <?php
                    $status = '';
                    $uri = "";
                    if($this->uri->segment(3)) $uri = $this->uri->segment(3); 
                    if($this->uri->segment(4)) $uri .= '/'.$this->uri->segment(4);
                    if($this->uri->segment(5)) $uri .= '/'.$this->uri->segment(5);
                    if ($data->bk_status == 1) {
                      $status = anchor('booking/status_booking/' . $data->bk_status . '/' . $data->bk_id.'/'.$uri, '<span class="icon-ok"></span>', 'title="published" data-toggle="tooltip" id="tooltip"');
                    } else if ($data->bk_status == 0) {
                      $status = anchor('booking/status_booking/' . $data->bk_status . '/' . $data->bk_id.'/'.$uri, '<span class="icon-minus-sign"></span>', 'title="Unpublished" data-toggle="tooltip" id="tooltip"');
                    }
                    echo $status. ' | ' . anchor('booking/view_booking_'.$data->bk_type.'/'.$data->bk_id.'/'.$data->bk_type, '<span class="icon-eye-open" title="View" ></span>') . ' | ' .
                    anchor('booking/deleteBookingById/' . $data->bk_id . '/' . $uri, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                ?>
                </td>
            </tr>
        <?php } ?>
    <?php
    } else {
        echo '<tr><td colspan="10">No record was found !!!</td></tr>';
    }
    ?>
</table> 
<ul class="pagination">
    <?php echo $pagination; ?>
</ul>
                
            
                    
