<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("booking/list_record","Manage Booking"); ?></li>
  <li>Add Booking</li>
</ol>
<h2 class="action-header"><b>Create Booking</b></h2>
<div class="row">
    <?php echo form_open('booking/add_booking', 'role="form" class="frm_booking form-horizontal"'); ?>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Booking Date <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <!-- <input type="text" class="form-control"> -->
            <?php echo form_input(array('name' => 'bkDate','data-date-format'=>'yyyy-mm-dd', 'value' => set_value('bkDate'), 'class' => 'bkDate form-control', 'id' => 'bkDate','placeholder'=>'Y-m-d')); ?>
            <span style="color:red;"><?php echo form_error('bkDate'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Arrival Date <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkArrivalDate','data-date-format'=>'yyyy-mm-dd', 'value' => set_value('bkArrivalDate'), 'class' => 'bkArrivalDate form-control', 'id' => 'bkArrivalDate','placeholder'=>'Y-m-d')); ?>
            <span style="color:red;"><?php echo form_error('bkArrivalDate'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Amount Of People <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkTotalPeople', 'value' => set_value('bkTotalPeople'), 'class' => 'bkTotalPeople form-control', 'id' => 'bkTotalPeople','placeholder'=>'enter number')); ?>
            <span style="color:red;"><?php echo form_error('bkTotalPeople'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Price($) <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkPrice', 'value' => set_value('bkPrice'), 'class' => 'bkPrice form-control', 'id' => 'bkPrice','placeholder'=>'enter price')); ?>
            <span style="color:red;"><?php echo form_error('bkPrice'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Pay date <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php echo form_input(array('name' => 'bkPayDate','data-date-format'=>'yyyy-mm-dd', 'value' => set_value('bkPayDate'), 'class' => 'bkPayDate form-control', 'id' => 'bkPayDate','placeholder'=>'Y-m-d')); ?>
            <span style="color:red;"><?php echo form_error('bkPayDate'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Booking Type <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <?php 
                $bktype = array(''=>'--- select ---', 'package'=>'Package', 'customize'=>'Customize');
                echo form_dropdown('bkType', $bktype, '', 'class="bkType form-control"'); 
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
                echo form_dropdown('bkpass', $passengers, '', 'class="ppname form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('bkpass'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label"><?php echo ucfirst('package/Customize'); ?> <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <select name="pkORcus" class="pkcus form-control">
              <option value=''>--- select ---</option>
              <optgroup label="Package">
                <?php 
                    if($getpk->num_rows > 0){
                        foreach($getpk->result() as $value){
                            echo '<option value="'.$value->pkcon_id.'">'.$value->pkcon_name.'</option>';
                        }
                    }
                ?>
              </optgroup>
              <optgroup label="Customize">
                <?php 
                    if($getcus->num_rows > 0){
                        foreach($getcus->result() as $valcus){
                            echo '<option value="'.$valcus->cuscon_id.'">'.$valcus->cuscon_name.'</option>';
                        }
                    }
                ?>
              </optgroup>
            </select>
            <span style="color:red;"><?php echo form_error('pkORcus'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Pay status <span class="require">*</span>:</label>
        <div class="col-sm-4">
            <!-- <input type="text" class="form-control"> -->
            <?php 
                $bkstatus[''] = '--- select ---';
                $bkstatus[1] = 'Paid';
                $bkstatus[0] = 'Unpaid';
                echo form_dropdown('bkPaystatus', $bkstatus, '', 'class="bkPaystatus form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('bkPaystatus'); ?></span>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Status:</label>
        <div class="col-sm-4">
            <!-- <input type="text" class="form-control"> -->
            <?php 
                $bkstatusb[''] = '--- select ---';
                $bkstatusb[1] = 'Publish';
                $bkstatusb[0] = 'Unpublish';
                echo form_dropdown('bkstatus', $bkstatusb, '', 'class="bkstatus form-control"'); 
            ?>
        </div>
    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-offset-2 col-sm-10">
          <?php echo form_submit('btnbookingsubmit', 'Save','class="btn btn-primary"'); ?>                     
          <?php echo anchor('booking/list_record', 'Close', 'class="btn btn-default"'); ?>                     
        </div>
    </div>
<?php echo form_close() ?>
</div>
    