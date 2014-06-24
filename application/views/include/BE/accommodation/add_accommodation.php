<?php  echo form_open_multipart('accommodation/add_accommodation', 'class="form-horizontal add_accommodation"'); ?>
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("accommodation/list_record","Manage Accommodation"); ?></li>
  <li>Add</li>
</ol>
<h1 class="action_page_header">Create New Accommodation</h1>
<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
<div class="row">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                 $accommodationName = array('name' =>'accommodationName','value'=> set_value('accommodationName'),'class' => 'form-control');
                 echo form_input($accommodationName);
            ?>
            <span style="color:red;"><?php echo form_error('accommodationName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date <span class="require">*</span> :</label>
        <div class="col-sm-4">
        <div class="input-daterange input-group" id="datepicker">
            <?php
                $txtFrom = array('id'=>'dp4' ,'name' => 'txtFrom', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtFrom'));
               echo form_input($txtFrom);
            ?>
            <span class="input-group-addon">to</span>
            <?php
                $txtTo = array('id'=>'dp5' ,'name' => 'txtTo', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtTo'));
                echo form_input($txtTo);
            ?>
        </div>
        <div id="alert"><strong></strong></div>
        <span style="color:red;"><?php if(form_error('txtFrom') or form_error('txtTo')) echo "The date field is required."; ?></span>
        </div>
    </div>
    <!-- new code -->
<div class="form-group">
<label class="col-sm-2 control-label">Facility <span class="require">*</span> :</label>
<div class="col-sm-4">
    <?php
    $facility = array();
    $facility[''] = "--- select ---";
    if($get_facility->num_rows > 0){
    foreach($get_facility->result() as $value){
        $facility[$value->facilities_id] = $value->facilities_title;
        echo $value->facilities_title;
    ?>
        <?php echo form_checkbox(array('name' => 'txtFaciliti[]','value' => $value->facilities_id));?> </br>
       
        
    <?php
       }
     }
    ?>

<span style="color:red;"><?php echo form_error('txtFaciliti'); ?></span>
</div>
</div>
<!-- end of new code -->

    <div class="form-group">
        <label class="col-sm-2 control-label">Available Day: <span class="require">*</span></label>
        <div class="col-sm-7">
            <label class="checkbox-inline">
              <?php echo form_checkbox(array('id' => 'inlineCheckbox1', 'value' => '1_everyday','name' => 'check[]','id'=>"everyday","checked"=>$dayavailable[0])); ?>
                Everyday
            </label>
            <label class="checkbox-inline">
              <?php echo form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked"=>$dayavailable[1])); ?> Mon
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked"=>$dayavailable[2])); ?> Tue
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked"=>$dayavailable[3])); ?> Wed
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked"=>$dayavailable[4])); ?> Thu
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked"=>$dayavailable[5])); ?> Fri
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked"=>$dayavailable[6])); ?> Sat
            </label>
            <label class="checkbox-inline">
                <?php echo form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked"=>$dayavailable[7])); ?> Sun
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Time <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <div class="input-daterange input-group" id="datepicker">
                <?php
                    $startTime = array('id' => 'timepicker3' ,'name' => 'txtStartTime','class' => 'input-sm form-control', 'value'=> set_value('txtStartTime'));
                   echo form_input($startTime);
                ?>
                <span class="input-group-addon">to</span>
                <?php
                    $endTime   = array('id' => 'timepicker4','name' => 'txtEndTime','class' => 'input-sm form-control','value'=> set_value('txtEndTime'));
                    echo form_input($endTime);
                ?>
            </div>
            <span style="color:red;"><?php if(form_error('txtStartTime') or form_error('txtEndTime')) echo "The time field is required."; ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Room Type <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $roomtypes = array();
                $roomtypes[''] = "--- select ---";
                    if($txtRoom->num_rows > 0){
                        foreach($txtRoom->result() as $value){
                            $roomtypes[$value->rt_id] = $value->rt_name;
                        }
                    }
            echo form_dropdown('txtRoom', $roomtypes,$lc, 'class="form-control"');  
            ?>
            <span style="color:red;"><?php echo form_error('txtRoom'); ?></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Classification <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $classification = array();
                $classification[''] = "--- select ---";
                    if($txtClassification->num_rows > 0){
                        foreach($txtClassification->result() as $value){
                            $classification[$value->clf_id] = $value->clf_name;
                        }
                    }
            echo form_dropdown('txtClassification', $classification,$lc, 'class="form-control"');  
            ?>
            <span style="color:red;"><?php echo form_error('txtLocation'); ?></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Location <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $locations = array();
                $locations[''] = "--- select ---";
                    if($txtLocation->num_rows > 0){
                        foreach($txtLocation->result() as $value){
                            $locations[$value->lt_id] = $value->lt_name;
                        }
                    }
            echo form_dropdown('txtLocation', $locations,$lc, 'class="form-control"');  
            ?>
            <span style="color:red;"><?php echo form_error('txtLocation'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Festival <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $fastivals = array();
                $fastivals[''] = "--- select ---";
                    if($txtFastival->num_rows > 0){
                        foreach($txtFastival->result() as $value){
                            $fastivals[$value->ftv_id] = $value->ftv_name;
                        }
                    }
            echo form_dropdown('txtFastival', $fastivals,$ftv, 'class="form-control"');  
            ?>
            <span style="color:red;"><?php echo form_error('txtFastival'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Supplier <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $suppliers = array();
                $suppliers[''] = "--- select ---";
                    if($txtSupplier->num_rows > 0){
                        foreach($txtSupplier->result() as $value){
                            $suppliers[$value->sup_id] = $value->sup_company_name;
                        }
                    }
            echo form_dropdown('txtSupplier', $suppliers, $spl, 'class="form-control"');  
            ?>
            <span style="color:red;"><?php echo form_error('txtSupplier'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Choose Image <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <select id="demo-htmlselect-basic" name="txtPhotos">
                <?php
                    if($txtPhotos->num_rows() > 0){
                        foreach($txtPhotos->result() as $value){    
                            $exploded = explode('.', $value->pho_source);
                            $img = $exploded['0'] . '_thumb.'.$exploded['1'];
                            $photos[$value->photo_id]="<option value='".$value->photo_id."' id='demo-htmlselect-basic' data-imagesrc=".site_url('user_uploads/thumbnail/thumb/'. $img).">".$value->pho_name."</option>";
                            echo $photos[$value->photo_id];
                        } 
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Purchase Price <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $purchasePrice = array('name' => 'purchasePrice','class' => 'form-control', 'value' => set_value('purchasePrice'));
                echo form_input($purchasePrice);
            ?>
            <span style="color:red;"><?php echo form_error('purchasePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sale Price <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $salePrice = array('name' => 'salePrice','class' => 'form-control','value' => set_value('salePrice'));
                echo form_input($salePrice);
            ?>
            <span style="color:red;"><?php echo form_error('salePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Original Stock <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $originalStock = array('name' => 'originalStock','class' => 'form-control', 'value' => set_value('originalStock'));
                echo form_input($originalStock);
            ?>
            <span style="color:red;"><?php echo form_error('originalStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Actual Stock <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $actualStock = array('name' => 'actualStock','class' => 'form-control', 'value' => set_value('actualStock'));
                echo form_input($actualStock);
            ?>
            <span style="color:red;"><?php echo form_error('actualStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Organizer Contract: </label>
        <div class="col-sm-4">
            <div id="alert">
                <strong></strong>
                <?php
                    $contract = array('id'=>'dp1' ,'name' => 'contract', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('contract',$orContract));
                    echo form_input($contract);
                ?>
            </div>
            <span style="color:red;"><?php echo form_error('contract'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Paid :</label>
        <div class="col-sm-4">
            <strong></strong>
            <?php
                $payed = array( 'id'=>'dp2','name' => 'txtPayed', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtPayed',$payed));
                echo form_input($payed);
            ?>
            <span style="color:red;"><?php echo form_error('txtPayed'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Deadline :</label>
        <div class="col-sm-4">
            <?php
                $deadline = array( 'id'=>'dp3','name' => 'txtDeadline', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtDeadline',$deadline));
                echo form_input($deadline);
            ?>
            <span style="color:red;"><?php echo form_error('txtDeadline'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Booking Text <span class="require">*</span> :</label>
        <div class="col-sm-9">
            <?php 
                $txtBooking = array('name'=>'txtBooking', 'class' => 'form-control textarea', 'value' => set_value('txtBooking'),"rows" => 3);
                echo form_textarea($txtBooking);
            ?>
            <span style="color:red;"><?php echo form_error('txtBooking'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">E-ticket Text <span class="require">*</span> :</label>
        <div class="col-sm-9">
            <?php
                $txtEticket = array('name'=>'txtEticket', 'class' => 'form-control textarea', 'value' => set_value('txtEticket'),"rows" => 3); 
                echo form_textarea($txtEticket);
            ?>
            <span style="color:red;"><?php echo form_error('txtEticket'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Text for admin :</label>
        <div class="col-sm-9">
            <?php 
                $txtAdmin = array('name' => 'txtAdmin', 'class' => 'form-control textarea', 'value' => set_value('txtAdmin'),"rows" => 3);
                echo form_textarea($txtAdmin);
            ?>
            <span style="color:red;"><?php echo form_error('txtAdmin',$txtadmin); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Status :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('txtStatus', $txtStatus, set_value('txtStatus',$status),'class="form-control"'); ?>
        </div>
    </div>
    <div class="action-bottom"></div> 
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('addAccommodation', 'Add',"class='btn btn-primary btn-md check_value'");
                echo ' '.nbs(1);
                echo anchor('accommodation/list_record', 'Cancel', "class='btn btn-primary btn-sm'")
            ?>
            <p style="display:none; color:red">Some Field is wrong!... Please check Data Again before you submit.</p>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
</div>
