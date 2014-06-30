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
  <ol class="breadcrumb">
    <li><?php echo anchor("site/profile","Profile"); ?></li>
    <?php 
    if ($this->uri->segment('4') == "view_detail_bk") { ?>
      <li>View Booking</li>
    <?php } else if ($this->uri->segment('4') == "customize_eticket") { ?>
      <li>Download E-ticket</li>
    <?php }
    ?>
  </ol>
  <div class="col-md-4">
    <?php if ($profile->num_rows() > 0) { ?>
      <?php foreach($profile->result() as $row) { ?>
        <span>
           <h2 class="h2_pass_profile">Welcome to :<?php echo nbs(2).ucfirst($row->pass_fname).'&nbsp;'.strtoupper($row->pass_lname); ?></h2>
        </span>

        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
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
          <?php if (!isset($booking_info)) { ?>
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
              <!-- <a href=""><button class="btn-info btn-sm" data-toggle="modal" data-target=".sendtoadmin">Sending</button></a> -->
              <?php // $this->load->view(INCLUDE_FE_MODEL."sendtoadmin"); ?>
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
            <?php 
            if ($passengerbooking_info->num_rows() > 0) { 
              foreach($passengerbooking_info->result() as $row) { ?>
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
                    } elseif ($row->bk_type == 'customize') {
                  ?>
                    <?php $this->load->view(INCLUDE_FE_MODEL."passenger_detailbookingform"); ?>
                    <?php echo anchor('site/profile/view_detail_bk/'.$row->bk_id, '<span class="icon-list-alt"></span>'); ?>
                    <?php
                      echo anchor('site/customize_eticket/'.$row->bk_id,'<span class="icon-download"></span>','title="Download E-ticket" data-toggle="tooltip" id="tooltip"');
                    }
                  }?>
                </td>
                </tr>
              <?php } ?>
            <?php } ?>
          </tbody>
      </table>
   <?php } elseif (isset($booking_info)) {
      foreach ($booking_info->result() as $info) { ?>
        <h2 class="h2_pass_profile">Detail Passenger Booking: <?php echo $info->bk_id; ?></h2>
        <div class="col-md-12">
          <table class="table table-striped table-hover">
            <tbody>
              <tr>
                <td class='td-title'>Festival</td>
                <td>
                  <?php
                  $field_select = array('ftv_name');
                  $festivalInfo = $this->mod_fecustomize->get_info_of_main_obj('festival', 'ftv_id', $info->cuscon_ftv_id, $field_select);
                  echo $festivalInfo->ftv_name;
                  ?>
                </td>
              </tr>
              <tr>
                <td class='td-title'>Location</td>
                <td>
                  <?php 
                  $field_select = array('lt_name');
                  $locationInfo = $this->mod_fecustomize->get_info_of_main_obj('location', 'lt_id', $info->cuscon_lt_id, $field_select);
                  echo $locationInfo->lt_name;
                  ?>
                </td>
              </tr>
              <tr>
                <td class='td-title'>Booking Type</td>
                <td><?php echo $info->bk_type; ?></td>
              </tr>
              <tr>
                <td class='td-title'>Booking Date</td>
                <td><?php echo $info->bk_date; ?></td>
              </tr>
              <tr>
                <td class='td-title'>Arrival Date</td>
                <td><?php echo $info->bk_arrival_date; ?></td>
              </tr>
              <?php if ($info->bk_type == 'customize') { ?>
                <tr>
                  <td class='td-title'>Return Date</td>
                  <td><?php echo $info->bk_return_date; ?></td>
                </tr>
              <?php } ?>
              <tr>
                <td class='td-title'>Amount of Passenger</td>
                <td><?php echo $info->bk_total_people; ?></td>
              </tr>
              <tr>
                <td class='td-title' colspan="2">Transportation<span class="caret"></span></td>
              </tr>
              <tr class='hidden tr-detail'>
                <td colspan="2">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Transportation</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Unit Purchase($)</th>
                      </tr> 
                      </thead>
                      <tbody class="sub_acc_pk_body tbl_bodyacc<?php //echo $accID; ?>">
                    <?php 
                    if ($info->cuscon_transportation) {
                      $transportations = unserialize($info->cuscon_transportation);
                      foreach ($transportations as $transportation) { 
                        foreach ($transportation as $transport) {
                          ?>
                          <tr class="real_sub_acc_pk remove<?php //echo $accID; ?>">
                            <td><?php echo $transport['info']->tp_name; ?></td>
                            <td><?php echo $transport['departure']; ?></td>
                            <td><?php echo $transport["return_date"]; ?></td>
                            <td><?php echo $transport['info']->tp_saleprice; ?></td>
                          </tr>
                        <?php 
                        }
                      }
                    }
                    ?>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td class='td-title' colspan="2">Accommodation<span class="caret"></span></td>
              </tr>
              <tr class='hidden tr-detail'>
                <td colspan="2">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Room Type</th>
                        <!-- <th>From Date</th>
                        <th>To Date</th> -->
                        <th>Sale($)</th>
                        <th>Per Room</th>
                        <th>Amount Room</th>
                      </tr> 
                      </thead>
                      <tbody class="sub_acc_pk_body tbl_bodyacc<?php //echo $accID; ?>">
                    <?php 
                    if ($info->cuscon_accomodation) {
                      $accommodations = unserialize($info->cuscon_accomodation);
                      foreach ($accommodations as $accommodation) { 
                        foreach ($accommodation as $accom) {
                          foreach ($accom['accom'] as $acc) {
                          ?>
                            <tr class="real_sub_acc_pk remove<?php //echo $accID; ?>">
                              <td><?php echo $acc->ht_name; ?></td>
                              <td><?php echo $acc->rt_name; ?></td>
                              <td><?php echo $acc->dhht_price; ?></td>
                              <td><?php echo $acc->rt_people_per_room; ?></td>
                              <td><?php echo $acc->amount_bked; ?></td>
                            </tr>
                          <?php 
                          }
                        }
                      }
                    }
                    ?>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td class='td-title' colspan="2">Activity<span class="caret"></span></td>
              </tr>
              <tr class='hidden tr-detail'>
                <td colspan="2">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Activity</th>
                        <th>Unit Purchase($)</th>
                        <th>Amount</th>
                      </tr> 
                      </thead>
                      <tbody class="sub_acc_pk_body tbl_bodyacc<?php //echo $accID; ?>">
                    <?php 
                    if ($info->cuscon_activities) {
                      $activities = unserialize($info->cuscon_activities);
                      foreach ($activities as $sub_activity) { 
                        foreach ($sub_activity as $activity) {
                          foreach ($activity['activity'] as $act) {
                          ?>
                            <tr class="real_sub_acc_pk remove<?php //echo $accID; ?>">
                              <td><?php echo $act->act_name; ?></td>
                              <td><?php echo $act->act_saleprice; ?></td>
                              <td><?php echo $act->amount_bked; ?></td>
                            </tr>
                          <?php 
                          }
                        }
                      }
                    }
                    ?>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td class='td-title' colspan="2">Extra Product<span class="caret"></span></td>
              </tr>
              <tr class='hidden tr-detail'>
                <td colspan="2">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Unit Purchase($)</th>
                        <th>Amount Book</th>
                      </tr> 
                      </thead>
                      <tbody class="sub_acc_pk_body tbl_bodyacc<?php //echo $accID; ?>">
                    <?php 
                    if ($info->bk_addmoreservice) {
                      $moreservice = unserialize($info->bk_addmoreservice);
                      foreach ($moreservice as $products) { 
                        foreach ($products as $product) {
                          ?>
                          <tr class="real_sub_acc_pk remove<?php //echo $accID; ?>">
                            <td><?php echo $product->ep_name; ?></td>
                            <td><?php echo $product->ep_saleprice; ?></td>
                            <td><?php echo $product->amount_bked; ?></td>
                          </tr>
                        <?php 
                        }
                      }
                    }
                    ?>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td class='td-title'>Total Price</td>
                <td><?php echo "$".$info->cuscon_totalprice; ?></td>
              </tr>
              <tr>
                <td class='td-title'>Pay Date</td>
                <td><?php echo $info->bk_pay_date; ?></td>
              </tr>
              <tr>
                <td class='td-title'>Deposite</td>
                <td><?php echo "$".$info->bk_deposit; ?></td>
              </tr>
              <tr>
                <td class='td-title'>Balance</td>
                <td><?php echo "$".$info->bk_balance; ?></td>
              </tr>
              <tr>
                <td class='td-title'>Pay Status</td>
                <td><?php 
                if ($info->bk_pay_status == 'Completed') {
                  echo "Paid";
                } else {
                  echo "Unpaid";
                }
                ?>
                </td>
              </tr>
              
            </tbody>
          </table>
        </div>
        <hr>  

        <h2 class="h2_pass_profile">Passenger Detail</h2>
        <div class="col-md-12">
          <?php 
          if ($info->pbk_pass_come_with) {
            $come_with_pass = unserialize($info->pbk_pass_come_with);
            foreach ($come_with_pass as $passID) {
              $passInfo = $this->mod_fecustomize->customizePersonal_info($passID);
              ?>
              <h5>Passenger ID: <?php echo $passID; ?></h5>
              <table class="table table-striped table-hover">
                <tbody>
                  <tr>
                    <td class='td-title'>First Name</td>
                    <td><?php echo $passInfo->pass_fname; ?></td>
                  </tr>
                  <tr>
                    <td class='td-title'>Last Name</td>
                    <td><?php echo $passInfo->pass_lname; ?></td>
                  </tr>
                  <tr>
                    <td class='td-title'>Email</td>
                    <td><?php echo $passInfo->pass_email; ?></td>
                  </tr>
                  <tr>
                    <td class='td-title'>Phone</td>
                    <td><?php echo $passInfo->pass_phone; ?></td>
                  </tr>
                  <tr>
                    <td class='td-title'>Address</td>
                    <td><?php echo $passInfo->pass_address; ?></td>
                  </tr>
                  
                </tbody>
            </table>
              <?php
            }
          } else { ?>
      <div class="col-md-12 no-passenger">
      <?php echo "No member for this booking."; ?>  
      </div>
      <?php
      }
          ?>
        </div>

      <?php }
    echo anchor("site/profile"," Back ", array('role'=>'button', 'class'=>'btn btn-default btn-sm'));
    }
    ?>   
    </div> 


  </div>
</div>