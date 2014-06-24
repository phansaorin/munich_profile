<?php echo form_hidden('acc_subof', $this->uri->segment(3)); ?>
<table class="table_sub">
    <tr>
        <td width="30%"><label class="control-label">Name <span class="require">*</span> :</label></td>
        <td>
        <?php $accommodationName = array('name' =>'accommodationName','value'=> set_value('accommodationName'),'class' => 'form-control'); echo form_input($accommodationName);?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Charge By <span class="require">*</span> :</label></td>
        <td>
            <?php $chergeby = array("" => "please select", 1 => "By person", 2 => 'By booking'); ?>
            <?php echo form_dropdown('chergeby', $chergeby, '','class="form-control"'); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Date <span class="require">*</span> :</label></td>
        <td>
            <div class="input-daterange input-group" id="datepicker">
            <?php $txtFrom = array('id'=>'sdp1' ,'name' => 'txtFrom', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtFrom')); echo form_input($txtFrom); ?>
            <span class="input-group-addon">to</span>
            <?php $txtTo = array('id'=>'sdp2' ,'name' => 'txtTo', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtTo')); echo form_input($txtTo); ?>
            </div>
            <div id="alert"><strong></strong></div>
        </td>
    </tr>
    <!-- start of new code -->
     <tr>
        <td><label class="control-label">Facility<span class="require">*</span> :</label></td>
        <td>
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
        </td>
    </tr>
    <!-- end of new code -->
    <tr>
        <td><label class="control-label">Available Day: <span class="require">*</span></label></td>
        <td>
            <label class="checkbox-inline fist_check"> <?php echo form_checkbox(array('id' => 'day_sub1', 'value' => '1_everyday','name' => 'check_sub[]','class'=>"everyday","checked"=>$dayavailable[0])); ?> Everyday</label>
            <label class="checkbox-inline"> <?php echo form_checkbox(array('id' => 'day_sub2', 'value' => '1_monday','name' => 'check_sub[]','class'=>"day","checked"=>$dayavailable[1])); ?> Mon </label>
            <label class="checkbox-inline"> <?php echo form_checkbox(array('id' => 'day_sub3', 'value' => '1_tuesday','name' => 'check_sub[]','class'=>"day","checked"=>$dayavailable[2])); ?> Tue </label>
            <label class="checkbox-inline"> <?php echo form_checkbox(array('id' => 'day_sub4', 'value' => '1_wednesday','name' => 'check_sub[]','class'=>"day","checked"=>$dayavailable[3])); ?> Wed </label>
            <label class="checkbox-inline"> <?php echo form_checkbox(array('id' => 'day_sub5', 'value' => '1_thursday','name' => 'check_sub[]','class'=>"day","checked"=>$dayavailable[4])); ?> Thu </label>
            <label class="checkbox-inline"> <?php echo form_checkbox(array('id' => 'day_sub6', 'value' => '1_friday','name' => 'check_sub[]','class'=>"day","checked"=>$dayavailable[5])); ?> Fri </label>
            <label class="checkbox-inline"> <?php echo form_checkbox(array('id' => 'day_sub7', 'value' => '1_saturday','name' => 'check_sub[]','class'=>"day","checked"=>$dayavailable[6])); ?> Sat </label>
            <label class="checkbox-inline"> <?php echo form_checkbox(array('id' => 'day_sub8', 'value' => '1_sunday','name' => 'check_sub[]','class'=>"day","checked"=>$dayavailable[7])); ?> Sun </label>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Time <span class="require">*</span> :</label></td>
        <td>
            <div class="input-daterange input-group datepicker">
                <?php $startTime = array('id' => 'timepicker5' ,'name' => 'txtStartTime','class' => 'input-sm form-control timepicker5', 'value'=> set_value('txtStartTime')); echo form_input($startTime); ?>
                <span class="input-group-addon">to</span>
                <?php $endTime   = array('id' => 'timepicker6','name' => 'txtEndTime','class' => 'input-sm form-control timepicker6','value'=> set_value('txtEndTime')); echo form_input($endTime); ?>
            </div>
        </td>
    </tr>
    <!-- new code of add sub accommmdation -->
    <tr>
        <td><label class="control-label">Room Type <span class="require">*</span> :</label></td>
        <td>
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
        </td>
    </tr>
     <tr>
        <td><label class="control-label">Classification<span class="require">*</span> :</label></td>
        <td>
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
        </td>
    </tr>
    <!-- end of add sub accommadation -->
    <tr>
        <td><label class="control-label">Location <span class="require">*</span> :</label></td>
        <td>
            <?php $locations = array(); $locations[''] = "--- select ---";
                    if($txtLocation->num_rows > 0){
                        foreach($txtLocation->result() as $value){ $locations[$value->lt_id] = $value->lt_name; }
                    }
            echo form_dropdown('txtLocation', $locations, '', 'class="form-control"');  ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Festival <span class="require">*</span> :</label></td>
        <td><?php $fastivals = array(); $fastivals[''] = "--- select ---";
                    if($txtFastival->num_rows > 0){
                        foreach($txtFastival->result() as $value){ $fastivals[$value->ftv_id] = $value->ftv_name; }
                    }
            echo form_dropdown('txtFastival', $fastivals,$ftv, 'class="form-control"'); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Supplier <span class="require">*</span> :</label></td>
        <td><?php $suppliers = array(); $suppliers[''] = "--- select ---";
                    if($txtSupplier->num_rows > 0){
                        foreach($txtSupplier->result() as $value){ $suppliers[$value->sup_id] = $value->sup_company_name; }
                    }
            echo form_dropdown('txtSupplier', $suppliers, $spl, 'class="form-control"');  ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Choose Image <span class="require">*</span> :</label></td>
        <td><?php $photos = array(); $photos[''] = "--- select ---";
                    if($txtPhotos->num_rows > 0){
                        foreach($txtPhotos->result() as $value){ $photos[$value->photo_id] = $value->pho_name; }
                    }
            echo form_dropdown('txtPhotos', $photos, $chosimg, 'class="form-control"'); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Purchase Price <span class="require">*</span> :</label></td>
        <td>
            <?php  $purchasePrice = array('name' => 'purchasePrice','class' => 'form-control', 'value' => set_value('purchasePrice'));  echo form_input($purchasePrice); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Sale Price <span class="require">*</span> :</label></td>
        <td>
            <?php $salePrice = array('name' => 'salePrice','class' => 'form-control','value' => set_value('salePrice')); echo form_input($salePrice); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Original Stock <span class="require">*</span> :</label></td>
        <td>
            <?php $originalStock = array('name' => 'originalStock','class' => 'form-control', 'value' => set_value('originalStock')); echo form_input($originalStock); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Actual Stock <span class="require">*</span> :</label></td>
        <td>
            <?php $actualStock = array('name' => 'actualStock','class' => 'form-control', 'value' => set_value('actualStock')); echo form_input($actualStock);?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Organizer Contract: </label></td>
        <td>
            <?php $contract = array('id'=>'dps1' ,'name' => 'contract', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('contract',$orContract)); echo form_input($contract); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Paid :</label></td>
        <td>
            <?php $payed = array( 'id'=>'dps2','name' => 'txtPayed', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtPayed',$payed)); echo form_input($payed); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Deadline :</label></td>
        <td>
            <?php $deadline = array( 'id'=>'dps3','name' => 'txtDeadline', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtDeadline',$deadline));  echo form_input($deadline); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Booking Text <span class="require">*</span> :</label></td>
        <td>
            <?php  $txtBooking = array('name'=>'txtBooking', 'class' => 'form-control textarea', 'value' => set_value('txtBooking'),"rows" => 3); echo form_textarea($txtBooking); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">E-ticket Text <span class="require">*</span> :</label></td>
        <td>
            <?php $txtEticket = array('name'=>'txtEticket', 'class' => 'form-control textarea', 'value' => set_value('txtEticket'),"rows" => 3);  echo form_textarea($txtEticket); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Text for admin :</label></td>
        <td>
            <?php  $txtAdmin = array('name' => 'txtAdmin', 'class' => 'form-control textarea', 'value' => set_value('txtAdmin'),"rows" => 3); echo form_textarea($txtAdmin); ?>
        </td>
    </tr>
    <tr>
        <td><label class="control-label">Status :</label></td>
        <td><?php echo form_dropdown('txtStatus', $txtStatus, set_value('txtStatus',$status),'class="form-control"'); ?></td>
    </tr>
</table>