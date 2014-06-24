<?php  echo form_open_multipart('transportation/view_transportation/'.$this->uri->segment(3), 'class="form-horizontal view_transportation"'); ?>
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("transportation/list_record","Manage transportation"); ?></li>
  <li>View Transportation</li>
</ol>
<h1 class="action_page_header">View Transportation</h1>
<?php
    if($getUpdateTransportation->num_rows() > 0){
        foreach($getUpdateTransportation->result() as $value){
            $exploded = explode('.', $value->pho_source);
            $pho_source = $exploded['0'].'_thumb.'.$exploded['1'];        
            $lc         = $value->tp_pickuplocation;
            $ftv        = $value->tp_ftv_id;
            $chosimg    = $value->photo_id;
            $orContract = $value->tp_providerdate;
            $payed      = $value->tp_payeddate;
            $deadline   = $value->tp_deadline;
            $status     = $value->tp_status; 
            $txtadmin   = $value->tp_admintext;
            $spl   = $value->tp_supplier_id;
            $ArrivalDate = $value->tp_arrival_date;
            $tp_texteticket   = $value->tp_texteticket;
            $tp_purchaseprice = $value->tp_purchaseprice;
            $tp_saleprice     = $value->tp_saleprice;
            $tp_actualstock   = $value->tp_actualstock;
            $tp_originalstock = $value->tp_originalstock;
            $tp_name          = $value->tp_name;
            $tp_textbooking   = $value->tp_textbooking;

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
    echo form_hidden('tp_subof', $this->uri->segment(3));
    echo form_hidden('sub_deteted', base_url()."transportation/deleted_sub");
?>

<blockquote class="blockquote">
  <span>Note, all the field below have been disabled.</span> &nbsp; <span class="view_enable">Enable for editing</span>
</blockquote>
<div class="row">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $transportationName = array('name' =>'transportationName','value'=> set_value('transportationName',$tp_name),'class' => 'form-control');
                echo form_input($transportationName);
            ?>
            <span style="color:red;"><?php echo form_error('transportationName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Departure Date <span class="require">*</span> :</label>
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
            <select id="demo-htmlselect-basic" style="width:400px;" name="txtPhotos">
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
                $purchasePrice = array('name' => 'purchasePrice','class' => 'form-control', 'value' => set_value('purchasePrice',$tp_purchaseprice));
                echo form_input($purchasePrice);
            ?>
            <span style="color:red;"><?php echo form_error('purchasePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sale Price <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $salePrice = array('name' => 'salePrice','class' => 'form-control','value' => set_value('salePrice',$tp_saleprice));
                echo form_input($salePrice);
            ?>
            <span style="color:red;"><?php echo form_error('salePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Original Stock <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $originalStock = array('name' => 'originalStock','class' => 'form-control', 'value' => set_value('originalStock',$tp_originalstock));
                echo form_input($originalStock);
            ?>
            <span style="color:red;"><?php echo form_error('originalStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Actual Stock <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $actualStock = array('name' => 'actualStock','class' => 'form-control', 'value' => set_value('actualStock',$tp_actualstock));
                echo form_input($actualStock);
            ?>
            <span style="color:red;"><?php echo form_error('actualStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Hotel Contract: </label>
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
    <!-- new code -->
    <div class="form-group">
        <label class="col-sm-2 control-label">Arrival Date :</label>
        <div class="col-sm-4">
            <?php
                $Arrivaldate = array( 'id'=>'dp6','name' => 'txtArrivalDate', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtArrivalDate',$ArrivalDate));
                echo form_input($Arrivaldate);
            ?>
            <span style="color:red;"><?php echo form_error('txtArrivalDate'); ?></span>
        </div>
    </div>
    <!-- end code -->
    <div class="form-group">
        <label class="col-sm-2 control-label">Booking Text <span class="require">*</span> :</label>
        <div class="col-sm-9">
            <?php 
                $txtBooking = array('name'=>'txtBooking', 'class' => 'form-control textarea', 'value' => set_value('txtBooking', $tp_textbooking),"rows" => 3);
                echo form_textarea($txtBooking);
            ?>
            <span style="color:red;"><?php echo form_error('txtBooking'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">E-ticket Text <span class="require">*</span> :</label>
        <div class="col-sm-9">
            <?php
                $txtEticket = array('name'=>'txtEticket', 'class' => 'form-control textarea', 'value' => set_value('txtEticket',$tp_texteticket),"rows" => 3); 
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
                echo form_submit('SaveChangeTransportation', 'Save Change',"class='btn btn-primary btn-md check_value tp_save_change'");
                echo ' '.nbs(1);
                echo form_button('SaveChangeTransportation', 'Add Subtransportation', "class='btn btn-primary btn-md check_value addsub' data-toggle='modal' data-target='.modal-subtransportation' ");
                echo ' '.nbs(1);
                echo form_button('SaveChangeTransportation', 'Add Products', "class='btn btn-primary btn-md check_value addpro' data-toggle='modal' data-target='.modal-extraproduct' ");
                echo ' '.nbs(1);
                echo anchor('transportation/list_record', 'Back', "class='btn btn-primary'")
            ?>
            <p style="display:none; color:red">Some Field is wrong!... Please check Data Again before you submit.</p>
        </div>
    </div>
</div>
<!-- include the subtransportation list here -->
<?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_subtransportation'); ?>
<!-- include the extraproducts list here -->
<?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/list_extraproducts'); ?>
<?php echo form_close(); ?>
</div>
<!-- modal for add new sub transportation -->
<?php $this->load->view(INCLUDE_BE.'modal/sub_tp_pro'); ?>
<!-- modal for detail -->
<?php $this->load->view(INCLUDE_BE.'modal/detail_tp'); ?>