<?php 
    if(isset($bookingedit)){
        if($bookingedit->num_rows() > 0){
            foreach ($bookingedit->result() as $rows) {
                // booking
                $bkID = $rows->bk_id;
                $bkDate = $rows->bk_date;
                $bkArrivalDate = $rows->bk_arrival_date;
                $bkamountpeople = $rows->bk_total_people;
                $bkpaydate = $rows->bk_pay_date;
                $bkpayprice = $rows->bk_pay_price;
                $bkpaystatus = $rows->bk_pay_status;
                $bookingtype = $rows->bk_type;
                $bkstatusdb = $rows->bk_status;
                // passenger
                $passid = $rows->pass_id;
                $passwith = $rows->pbk_pass_come_with;
                $this->session->set_userdata('passid', $passid);
                $passemail = $rows->pass_email;
                $passphone = $rows->pass_phone;
                $passaddress = $rows->pass_address;
                $passcompany = $rows->pass_company;
                $passgender = $rows->pass_gender;
                // package
                $pkID = $rows->pkcon_id;
                $pkstartdate = $rows->pkcon_start_date;
                $pkenddate = $rows->pkcon_end_date;
                $pkname = $rows->pkcon_name;
                $pkstockactual = $rows->pkcon_actualstock;
                $pkprice = $rows->pkcon_saleprice;
                // pkactivities
                $package_activities['pg_activities'] = $rows->pk_activities;
                // pkaccommodation
                $package_accomodation['package_accomodation'] = $rows->pk_accomodation;
                // pktransportation
                $package_transportation['package_transportation'] = $rows->pk_transportation;
                // extraservice
                $pkextraservice = $rows->bk_addmoreservice;
            }
        }
    }
 ?>
 <?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("booking/list_record","Manage Booking"); ?></li>
  <li>View Booking</li>
</ol>
<h2 class="action-header"><b>View Booking</b></h2>
<blockquote class="blockquote">
  <span>Note, all the field below have been disabled.</span> &nbsp; <span class="view_enable_booking">Enable for editing</span>
</blockquote>
<div class="row">
    <?php echo form_open('booking/view_booking_package/'.$bkID.'/'.$bookingtype, 'role="form" class="frm_booking_view form-horizontal"'); ?>
    <?php echo form_hidden('pkconprice', $pkprice); ?>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Booking Date <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkDate','data-date-format'=>'yyyy-mm-dd', 'value' => set_value('bkDate', $bkDate), 'class' => 'bkDate form-control', 'id' => 'bkDate','placeholder'=>'Y-m-d')); ?>
            <span style="color:red;"><?php echo form_error('bkDate'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Arrival Date <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkArrivalDate','data-date-format'=>'yyyy-mm-dd', 'value' => set_value('bkArrivalDate', $bkArrivalDate), 'class' => 'bkArrivalDate form-control', 'id' => 'bkArrivalDate','placeholder'=>'Y-m-d')); ?>
            <span style="color:red;"><?php echo form_error('bkArrivalDate'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Amount Of People <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkTotalPeople', 'value' => set_value('bkTotalPeople', $bkamountpeople), 'class' => 'bkTotalPeople form-control', 'id' => 'bkTotalPeople','placeholder'=>'enter number')); ?>
            <span style="color:red;"><?php echo form_error('bkTotalPeople'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Price($) <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkPrice', 'value' => set_value('bkPrice',$bkpayprice), 'class' => 'bkPrice form-control', 'id' => 'bkPrice','placeholder'=>'enter price')); ?>
            <span style="color:red;"><?php echo form_error('bkPrice'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Pay date <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkPayDate','data-date-format'=>'yyyy-mm-dd', 'value' => set_value('bkPayDate',$bkpaydate), 'class' => 'bkPayDate form-control', 'id' => 'bkPayDate','placeholder'=>'Y-m-d')); ?>
            <span style="color:red;"><?php echo form_error('bkPayDate'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Booking Type <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php 
                $bktype = array(''=>'--- select ---', 'package'=>'Package');
                echo form_dropdown('bkType', $bktype, $bookingtype, 'class="bkType form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('bkType'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">passenger email <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php 
                $passengers = array();
                $passengers[''] = "--- select ---";
                    if($passenger->num_rows > 0){
                        foreach($passenger->result() as $value){
                            $passengers[$value->pass_id] = $value->pass_email;
                        }
                    }
                echo form_dropdown('bkpass', $passengers, $passid, 'class="ppname form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('bkpass'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label"><?php echo ucfirst('package'); ?> <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php 
                $pkcus = array();
                $pkcus[''] = "--- select ---";
                    if($getpkORcus->num_rows > 0){
                        foreach($getpkORcus->result() as $value){
                            $pkcus[$value->pkcon_id] = $value->pkcon_name;
                        }
                    }
                echo form_dropdown('pkORcus', $pkcus, $pkID, 'class="pkcus form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('pkORcus'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Pay status <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php 
                $bkstatus[''] = '--- select ---';
                $bkstatus[1] = 'Paid';
                $bkstatus[0] = 'Unpaid';
                echo form_dropdown('bkPaystatus', $bkstatus, $bkpaystatus, 'class="bkPaystatus form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('bkPaystatus'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Status:</label>
        <div class="col-sm-4">
            <?php 
                $bkstatusb[''] = '--- select ---';
                $bkstatusb[1] = 'Publish';
                $bkstatusb[0] = 'Unpublish';
                echo form_dropdown('bkstatus', $bkstatusb, $bkstatusdb, 'class="bkstatus form-control"'); 
            ?>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-offset-2 col-sm-10">
          <?php echo form_submit('btnviewsubmit', 'Save Change','class="btn btn-primary"'); ?>                     
          <?php echo anchor('booking/list_record', 'Close', 'class="btn btn-default"'); ?>                     
        </div>
    </div>
<!-- passenger -->
<div id="passenger" style="padding-right:15px;padding-left:15px;">
    <div id="passbooking" style="padding-right:15px;padding-left:15px;border:1px solid #cccccc;margin-bottom:8px;">
      <h3>Passenger &nbsp; &nbsp; <span class="bkpassenger pkadd btn-info btn-sm" data-toggle='modal' data-target='.modal-passenger'>Add Passenger</span></h3>
      <table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
        <thead>
        <tr>
            <th><input type="checkbox" name="checkbox_all" id="checkbox_all" checked="true"></th>
            <th>ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Company</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Type passenger</th>
        </tr> 
        </thead>
        <tbody class="body-passenger">
        <tr>
            <td><?php // echo form_checkbox( array('class' => 'check_checkbox pass_checkbox', 'id' => 'pass_checkbox', 'name' => 'pass_checkbox[]','checked'=>true,'disabled'=>true), $passid ); ?></td>
            <td><?php echo $passid; ?></td>
            <td><?php echo $passemail; ?></td>
            <td><?php echo $passphone; ?></td>
            <td><?php echo $passcompany; ?></td>
            <td><?php echo $passgender; ?></td>
            <td><?php echo $passaddress; ?></td>
            <td>Booker</td>
        </tr>
        <?php 
            if(isset($passwith)){
                $passwith = unserialize($passwith);
                $passwithrecords = mod_booking::getpassengerin($passwith);
            foreach ($passwithrecords->result() as $key => $value) {
        ?>
                <tr>
                    <td><?php echo form_checkbox( array('class' => 'check_checkbox', 'id' => 'check_checkbox', 'name' => 'pass_checkbox[]','checked'=>true), $value->pass_id ); ?></td>
                    <td><?php echo $value->pass_id; ?></td>
                    <td><?php echo $value->pass_email; ?></td>
                    <td><?php echo $value->pass_phone; ?></td>
                    <td><?php echo $value->pass_company; ?></td>
                    <td><?php echo $value->pass_gender; ?></td>
                    <td><?php echo $value->pass_address; ?></td>
                    <td>Accompanyer</td>
                </tr>
        <?php
                }
            }
        ?>
      </table> 
    </div>
</div>
<!-- package -->
<div id="package_booking" style="padding-right:15px;padding-left:15px;">
    <div id="packcontent" style="border:1px solid #cccccc;padding-left:15px;">
    <h3>Package</h3>
    <table class="table table-striped table-hover table-bordered" style="font-size: 12px;width:99%;">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Sale($)</th>
        </tr> 
        </thead>
        <tbody>
        <tr>
            <td><?php echo $pkID; ?></td>
            <td><?php echo $pkname; ?></td>
            <td><?php echo $pkstartdate; ?></td>
            <td><?php echo $pkenddate; ?></td>
            <td><?php echo $pkprice; ?></td>
        </tr>
    </table> 
        <?php if(isset($package_activities['pg_activities'])){ ?>   
        <div class="pk_activities">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/pk_list_activities', $package_activities); ?>
        </div>
        <?php } ?>
        <?php if(isset($package_accomodation['package_accomodation'])){ ?>   
        <div class="pk_accommodation">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/pk_list_accommodation', $package_accomodation); ?>
        </div>
        <?php } ?>
        <?php if(isset($package_transportation['package_transportation'])){ ?>   
        <div class="pk_transportation">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/pk_list_transportation', $package_transportation); ?>
        </div>
        <?php } ?>
        <p>&nbsp;</p>
    </div>
</div>
<!-- extra service -->
<div id="passenger" style="padding-right:15px;padding-left:15px;">
    <div id="passbooking" style="padding-right:15px;padding-left:15px;border:1px solid #cccccc;margin-bottom:8px;margin-top:8px;">
      <h3>Extra Service &nbsp; &nbsp; <span class="bkpassenger pkadd btn-info btn-sm" data-toggle='modal' data-target='.modal-extraservice'>Add Extra Services</span></h3>
      <table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
        <thead>
        <tr>
            <th><input type="checkbox" name="checkbox_all" id="checkbox_all" checked="true"></th>
            <th>ID</th>
            <th>Name</th>
            <th>From</th>
            <th>To</th>
            <th>Purchase($)</th>
            <th>Sale($)</th>
            <th>Original Stock</th>
            <th>Actual Stock</th>
        </tr> 
        </thead>
        <tbody class="body-extraservice">
        <?php 
            if(isset($pkextraservice)){
                $extraservcie = unserialize($pkextraservice);
            foreach ($extraservcie as $epacc) {
        ?>
                <tr class="real_ep_pk remove<?php echo $epacc['ep_id']; ?>">
                    <td><?php echo form_checkbox(array('class' => 'check_checkbox','id' => 'check_checkbox', 'name' => 'epacc_checkbox[]', "checked" => true), $epacc['ep_id'] );  ?></td>
                    <td><?php echo $epacc['ep_id']; ?></td>
                    <td><?php echo character_limiter($epacc['ep_name'], 7); ?></td>
                    <td><?php echo $epacc['start_date']; ?></td>
                    <td><?php echo $epacc['end_date']; ?></td>
                    <td><?php echo $epacc['ep_purchaseprice']; ?></td>
                    <td><?php echo $epacc['ep_saleprice']; ?></td>
                    <td><?php echo $epacc['ep_originalstock']; ?></td>
                    <td><?php echo $epacc['ep_actualstock']; ?></td>
                </tr>
        <?php
                }
            }
        ?>
      </table> 
    </div>
</div>
<?php echo form_close() ?>
</div>

<?php 
    $this->load->view(INCLUDE_BE.'modal/booking-modal'); 
?>
    