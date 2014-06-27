<?php
  if ($this->session->userdata('warning')) {
    echo $this->session->userdata('warning');
    $this->session->unset_userdata('warning');
  } 
  if ($this->session->userdata('error')) {
    echo $this->session->userdata('error');
    $this->session->unset_userdata('error');
  }
  if ($this->session->userdata('success')) {
    echo $this->session->userdata('success');
    $this->session->unset_userdata('success');
  }
   ?>
<div class="row">
  <div class="col-md-4">
    <?php if ($profile->num_rows > 0) { ?>
      <?php foreach($profile->result() as $row) { ?>
        <span>
           <h2>Welcome to :<?php echo nbs(2).ucfirst($row->pass_fname).'&nbsp;'.strtoupper($row->pass_lname); ?></h2>
        </span>

        <div class="table-responsive">
          <table class="table table-bordered">

            <tr>
              <th>First Name</th> 
              <td><?php echo $row->pass_fname; ?></td>
            </tr>
            <tr>
              <th>Last Name</th> 
              <td><?php echo $row->pass_lname; ?></td>
            </tr>
            <tr>
              <th>Email</th> 
              <td><?php echo $row->pass_email; ?></td>
            </tr>
            <tr>
              <th>Phone Number </th> 
              <td><?php echo $row->pass_phone; ?></td>
            </tr>
            <tr>
              <th>Address</th> 
              <td><?php echo $row->pass_address; ?></td>
            </tr>
            <tr>
              <th>Company</th> 
              <td><?php echo $row->pass_company ; ?></td>
            </tr>
            <tr>
              <th>Gender</th> 
              <td><?php echo $row->pass_gender; ?></td>
            </tr>
            
        </table>
        </div>
      <?php }?>
    <?php }?>
   <!--  <?php $this->load->view(INCLUDE_FE_MODEL."updateprofile"); ?>
      <a href="#"><button class="btn btn-default" data-toggle="modal" data-target=".updateprofileuser">Edit Profile</button></a> -->
  </div>
  <div class="col-md-8">
    <?php $this->load->view(INCLUDE_FE_MODEL."morepassenger"); ?> 
      <div class="table-responsive">
        <div style="float:right;padding-bottom:13px;">
          <?php 
          if ($this->session->userdata('hiddens')) {
              echo $this->session->userdata('hiddens');
            ?>
            <a href="#"><button class="btn-info btn-sm" data-toggle="modal" data-target=".contact_admin">Send Mail</button></a>
             <?php $this->load->view(INCLUDE_FE_MODEL."contact_admin"); ?>
          <?php } ?>
          <!-- end of sending mail -->
            <a href="#"><button class="btn-info btn-sm" data-toggle="modal" data-target=".addmorepassenger">More Passenger</button></a>
         <?php $this->load->view(INCLUDE_FE_MODEL."upgrade_booking"); ?>
            <a href="#"><button class="btn-info btn-sm" data-toggle="modal" data-target=".upgrade_booking">Upgrade Booking</button></a>
        </div>
        <h2>Passenger Booking information</h2>
        <table class="table table-bordered">
          <tr> 
              <!-- <th>Passenger come with</th> -->
              <th>No</th>
              <th>Booking Dates</th>
              <th>Arrival Dates</th>
              <th>Booking Total People</th>
              <th>Booking Pay Dates</th>
              <th>Booking Pay Prices</th>
              <th>Action</th>
          </tr>
          <tbody class="tbl_body">
          <?php if ($passengerbooking_info->num_rows > 0) { ?>
            <?php foreach($passengerbooking_info->result() as $row) { ?>
              <tr>
                <!-- <td><?php// echo $row->pbk_pass_come_with; ?></td> -->
                <td><?php echo $row->bk_id;?></td>
                <td><?php echo $row->bk_date; ?></td>
                <td><?php echo $row->bk_arrival_date; ?></td>
                <td><?php echo $row->bk_total_people; ?></td>
                <td><?php echo $row->bk_pay_date; ?></td>
                <td><?php echo $row->bk_pay_price; ?></td>            
                <td>
                <?php if ($row->bk_status == 1) {
                  echo "Un-paid";
                } elseif ($row->bk_status == 0) {
                  if($row->bk_type == 'package'){
                    echo anchor('site/package_eticket/'.$row->bk_id,'<span class="icon-download"></span>','title="Download E-ticket" data-toggle="tooltip" id="tooltip"').'|'.anchor ('site/package_eticket/'.$row->bk_id,'<span class="icon-list-alt"></span>','title="Detail"');
                      // echo anchor ('site/package_eticket/'.$row->bk_id,'<span class="icon-list-alt"></span>','title="Print"');
                  } elseif ($row->bk_type == 'customize') {
                ?>
                  <span class="icon-list-alt pkadd clickDetailact" data-url="<?php echo base_url(); ?>site/package_eticket/<?php echo $row->bk_id; ?>/<?php echo $this->uri->segment(3); ?>" data-toggle='modal' data-target='.modalDetials' title="Details" style="float:right; margin-left:5px;"></span>

                  <?php $detail = $this->load->view(INCLUDE_FE_MODEL."passenger_detailbookingform"); ?>
                  <?php echo anchor('site/view_detail_bk/'.$row->bk_id, '<span class="icon-list-alt"></span>'); ?>
                  <!-- <a href=""><span class="icon-list-alt" data-toggle="modal" data-target=".passenger_detailbookingform"></span></a> -->
                  <?php
                    echo anchor('site/customize_eticket/'.$row->bk_id,'<span class="icon-download"></span>','title="Download E-ticket" data-toggle="tooltip" id="tooltip"').'|'.$detail;
                  }
                }?>
              </td>
              </tr>
         <?php }?>
  <?php }?>
          </tbody>
          
      </table>
       
   </div>   
  </div>
</div>