<?php  echo form_open_multipart('activities/view_activities/'.$this->uri->segment(3), 'class="form-horizontal view_activities"'); ?>
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("activities/list_record","Manage activities"); ?></li>
  <li>View activities</li>
</ol>
<?php
    if($getUpdateActivities->num_rows() > 0){
        foreach($getUpdateActivities->result() as $value){
            $exploded = explode('.', $value->pho_source);
            $pho_source = $exploded['0'].'_thumb.'.$exploded['1'];        
            $lc         = $value->location_id;
            $ftv        = $value->act_ftv_id;
            $chosimg    = $value->photo_id;
            $orContract = $value->act_organiserdate;
            $payed      = $value->act_payeddate;
            $deadline   = $value->act_deadline;
            $status     = $value->act_status;
            $choice     = $value->act_choiceitem; 
            $txtadmin   = $value->act_admintext;
            $spl   = $value->act_supplier_id;
            $act_texteticket   = $value->act_texteticket;
            $act_purchaseprice = $value->act_purchaseprice;
            $act_saleprice     = $value->act_saleprice;
            $act_actualstock   = $value->act_actualstock;
            $act_originalstock = $value->act_originalstock;
            $act_name          = $value->act_name;
            $act_bookingtext   = $value->act_bookingtext;

            $dayavailable[1] = $value->monday;
            $dayavailable[2] = $value->tuesday;
            $dayavailable[3] = $value->wednesday;
            $dayavailable[4] = $value->thursday;
            $dayavailable[5] = $value->friday;
            $dayavailable[6] = $value->saturday;
            $dayavailable[7] = $value->sunday;
            $stDate          = $value->start_date;
            $enDate          = $value->end_date;
            $stTime          = $value->start_time;
            $enTime          = $value->end_time;
            $cal_id          = $value->ca_id;
            if($dayavailable[1] != 0 AND $dayavailable[2] != 0 AND $dayavailable[3] != 0 AND $dayavailable[4] != 0 AND $dayavailable[5] != 0 AND $dayavailable[6] != 0 AND $dayavailable[7] != 0){ $dayavailable[0] = 1; }else{ $dayavailable[0] = 0; }
        }
    }
    echo form_hidden('cal_id', $cal_id);
    echo form_hidden('act_subof', $this->uri->segment(3));
    echo form_hidden('sub_deteted', base_url()."activities/deleted_sub");
?>
<h2 class="action-header view_header"><b>View Activity</b></h2>
<blockquote class="blockquote">
  <span>Note, all the field below have been disabled.</span> &nbsp; <span class="view_enable">Enable for editing</span>
</blockquote>
<div class="row">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $ativitiesName = array('name' =>'activitiesName','value'=> set_value('activitiesName',$act_name),'class' => 'form-control');
                echo form_input($ativitiesName);
            ?>
            <span style="color:red;"><?php echo form_error('activitiesName'); ?></span>
        </div>
        <label class="col-sm-2 control-label">Choice Item <span class="require">*</span> :</label>
        <div class="col-sm-3">
            <?php 
                echo form_dropdown('txtchoiceItem', $txtchoiceItem, $choice,'class="form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('txtchoiceItem'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date <span class="require">*</span> :</label>
        <div class="col-sm-4">
        <div class="input-daterange input-group" id="datepicker">
            <?php
                $txtFrom = array('id'=>'dp4' ,'name' => 'txtFrom', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtFrom',$stDate));
               echo form_input($txtFrom);
            ?>
            <span class="input-group-addon">to</span>
            <?php
                $txtTo = array('id'=>'dp5' ,'name' => 'txtTo', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtTo',$enDate));
                echo form_input($txtTo);
            ?>
        </div>
        <div id="alert"><strong></strong></div>
        <span style="color:red;"><?php if(form_error('txtFrom') or form_error('txtTo')) echo "The date field is required."; ?></span>
        </div>
    </div>
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
                    $startTime = array('id' => 'timepicker3' ,'name' => 'txtStartTime','class' => 'input-sm form-control', 'value'=> set_value('txtStartTime',$stTime));
                   echo form_input($startTime);
                ?>
                <span class="input-group-addon">to</span>
                <?php
                    $endTime   = array('id' => 'timepicker4','name' => 'txtEndTime','class' => 'input-sm form-control','value'=> set_value('txtEndTime',$enTime));
                    echo form_input($endTime);
                ?>
            </div>
            <span style="color:red;"><?php if(form_error('txtStartTime') or form_error('txtEndTime')) echo "The time field is required."; ?></span>
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
                        foreach($txtPhotos->result() as $values){ 
                            $exploded = explode('.', $values->pho_source);
                            $image = $exploded['0'].'_thumb.'.$exploded['1'];
                            if($pho_source == $image){
                                $photos[$values->photo_id]="<option selected='selected' value='".$values->photo_id."' id='demo-htmlselect-basic' data-imagesrc=".site_url('user_uploads/thumbnail/thumb/'.$image).">".$values->pho_name."</option>";                                   
                            }else{
                                $photos[$values->photo_id]="<option value='".$values->photo_id."' id='demo-htmlselect-basic' data-imagesrc=".site_url('user_uploads/thumbnail/thumb/'.$image).">".$values->pho_name."</option>";
                            }
                            echo $photos[$values->photo_id];
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
                $purchasePrice = array('name' => 'purchasePrice','class' => 'form-control', 'value' => set_value('purchasePrice',$act_purchaseprice));
                echo form_input($purchasePrice);
            ?>
            <span style="color:red;"><?php echo form_error('purchasePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sale Price <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $salePrice = array('name' => 'salePrice','class' => 'form-control','value' => set_value('salePrice',$act_saleprice));
                echo form_input($salePrice);
            ?>
            <span style="color:red;"><?php echo form_error('salePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Original Stock <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $originalStock = array('name' => 'originalStock','class' => 'form-control', 'value' => set_value('originalStock',$act_originalstock));
                echo form_input($originalStock);
            ?>
            <span style="color:red;"><?php echo form_error('originalStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Actual Stock <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $actualStock = array('name' => 'actualStock','class' => 'form-control', 'value' => set_value('actualStock',$act_actualstock));
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
        <label class="col-sm-2 control-label">Payed :</label>
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
                $txtBooking = array('name'=>'txtBooking', 'class' => 'form-control textarea', 'value' => set_value('txtBooking', $act_bookingtext),"rows" => 3);
                echo form_textarea($txtBooking);
            ?>
            <span style="color:red;"><?php echo form_error('txtBooking'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">E-ticket Text <span class="require">*</span> :</label>
        <div class="col-sm-9">
            <?php
                $txtEticket = array('name'=>'txtEticket', 'class' => 'form-control textarea', 'value' => set_value('txtEticket',$act_texteticket),"rows" => 3); 
                echo form_textarea($txtEticket);
            ?>
            <span style="color:red;"><?php echo form_error('txtEticket'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Text for admin :</label>
        <div class="col-sm-9">
            <?php 
                $txtAdmin = array('name' => 'txtAdmin', 'class' => 'form-control textarea', 'value' => set_value('txtAdmin',$txtadmin),"rows" => 3);
                echo form_textarea($txtAdmin);
            ?>
            <span style="color:red;"><?php echo form_error('txtAdmin'); ?></span>
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
                echo form_submit('SaveChangeActivity', 'Save Change',"class='btn btn-primary btn-md check_value act_save_change'");
                echo ' '.nbs(1);
                echo form_button('SaveChangeActivity', 'Add Sub Activity', "class='btn btn-primary btn-md check_value addsub' data-toggle='modal' data-target='.modal-subactivities' ");
                echo ' '.nbs(1);
                echo form_button('SaveChangeActivity', 'Add Product', "class='btn btn-primary btn-md check_value addpro' data-toggle='modal' data-target='.modal-extraproduct' ");
                echo ' '.nbs(1);
                echo anchor('activities/list_record', 'Back', "class='btn btn-primary'")
            ?>
            <p style="display:none; color:red">Some Field is wrong!... Please check Data Again before you submit.</p>
        </div>
    </div>
</div>
<!-- include the sub activity list here -->
<?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_subactivities'); ?>
<!-- include the extraproducts list here -->
<?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_extraproducts'); ?>
<?php echo form_close(); ?>
</div>
<!-- modal for add new sub activity -->
<?php $this->load->view(INCLUDE_BE.'modal/sub_act_pro'); ?>
<!-- modal for detail -->
<?php $this->load->view(INCLUDE_BE.'modal/detail'); ?>