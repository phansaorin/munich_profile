<?php  echo form_open('activities/edit_activities/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>

<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
<h4>Edit Activity</h4>
<?php
        foreach ($get_activities->result() as $row) {
            ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $ativitiesName = array('name' => 'old_activitiesName','value'=> $row->act_name,'class' => 'form-control');
                echo form_input($ativitiesName); 
                ?>
            <span style="color:red;"><?php echo form_error('old_activitiesName'); ?></span>
        </div>
        <button type="button" class="btn btn-primary btn-xs"  data-toggle="tooltip" data-placement="right" title="The name of Activities must be unique.">Note</button>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Choice Item <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php 
                echo form_dropdown('old_txtchoiceItem', $old_txtchoiceItem, $row->act_choiceitem,'class="form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('old_txtchoiceItem'); ?></span>
        </div>
    </div>
    <?php echo form_hidden('calendar_available_id', $row->ca_id); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">From :</label>
        <div class="col-sm-4">
            <div id="alert">
                <strong></strong>
                <?php
                    $txtFrom = array('id'=>'dp4' ,'name' => 'old_txtFrom', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:210px;', 'value'=> $row->start_date);
                    echo form_input($txtFrom);
                ?>
            </div>
            <span style="color:red;"><?php echo form_error('old_txtFrom'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">To :</label>
        <div class="col-sm-4">
            <div id="alert">
                <strong></strong>
                <?php
                    $txtTo = array('id'=>'dp5' ,'name' => 'old_txtTo', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:210px;', 'value' => $row->end_date);
                    echo form_input($txtTo);
                ?>
            </div>
            <span style="color:red;"><?php echo form_error('old_txtTo'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"><span class="require">*</span></label>
        <div class="col-sm-7">
            <?php
                    $checkDate = array(); 
                    if($get_activities->num_rows() > 0){
                        foreach($get_activities->result() as $val){
                            $checkDate[$val->calendar_available_id] = $val->calendar_available_id;
                        }
                    }
            ?>
            <label class="checkbox-inline">
              <?php echo form_checkbox(array('id' => 'inlineCheckbox1', 'value' => '1_everyday','name' => 'check[]','id'=>"everyday")); ?>
                Everyday
            </label>
            <label class="checkbox-inline">
              <?php 
              if($row->monday == 1){ $check = TRUE; }else{ $check = FALSE; }
              echo form_checkbox(array('id' => 'inlineCheckbox2', 'value' => '1_monday','name' => 'check[]','class'=>"weekday","checked"=>$check)); ?> Mon
            </label>
            <label class="checkbox-inline">
                <?php 
                    if($row->tuesday == 1){ $check = TRUE; }else{ $check = FALSE; }
                    echo form_checkbox(array('id' => 'inlineCheckbox3', 'value' => '1_tuesday','name' => 'check[]','class'=>"weekday","checked" => $check)); ?> Tue
            </label>
            <label class="checkbox-inline">
                <?php 
                    if($row->wednesday == 1){ $check = TRUE; }else{ $check = FALSE; }
                    echo form_checkbox(array('id' => 'inlineCheckbox4', 'value' => '1_wednesday','name' => 'check[]','class'=>"weekday","checked" => $check)); ?> Wed
            </label>
            <label class="checkbox-inline">
                <?php 
                    if($row->thursday == 1){ $check = TRUE; }else{ $check = FALSE; }
                    echo form_checkbox(array('id' => 'inlineCheckbox5', 'value' => '1_thursday','name' => 'check[]','class'=>"weekday","checked" => $check)); ?> Thu
            </label>
            <label class="checkbox-inline">
                <?php 
                    if($row->friday == 1){ $check = TRUE; }else{ $check = FALSE; }
                    echo form_checkbox(array('id' => 'inlineCheckbox6', 'value' => '1_friday','name' => 'check[]','class'=>"weekday","checked" => $check)); ?> Fri
            </label>
            <label class="checkbox-inline">
                <?php
                    if($row->saturday == 1){ $check = TRUE; }else{ $check = FALSE; } 
                    echo form_checkbox(array('id' => 'inlineCheckbox7', 'value' => '1_saturday','name' => 'check[]','class'=>"weekday","checked" => $check)); ?> Sat
            </label>
            <label class="checkbox-inline">
                <?php 
                    if($row->sunday == 1){ $check = TRUE; }else{ $check = FALSE; }
                    echo form_checkbox(array('id' => 'inlineCheckbox8', 'value' => '1_sunday','name' => 'check[]','class'=>"weekday","checked" => $check)); ?> Sun
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Time <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <div class="input-daterange input-group" id="datepicker">
                <?php
                    $startTime = array('id' => 'timepicker3' ,'name' => 'old_txtStartTime','class' => 'input-sm form-control', 'value'=> $row->start_time);
                    echo form_input($startTime);
                ?>
                <span class="input-group-addon">to</span>
                <?php
                    $endTime   = array('id' => 'timepicker4','name' => 'old_txtEndTime','class' => 'input-sm form-control','value'=> $row->end_time);
                    echo form_input($endTime);
                ?>
            </div>
            <span style="color:red;"><?php echo form_error('old_txtStartTime'); ?></span>
            <span style="color:red;"><?php echo form_error('old_txtEndTime'); ?></span>
        </div>
    </div><div class="form-group">
        <label class="col-sm-2 control-label">Location <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $old_locations = array();
                    if($txtLocation->num_rows > 0){
                        $old_locations['0'] = "--- select ---";
                        foreach($txtLocation->result() as $value){
                            $old_locations[$value->lt_id] = $value->lt_name;
                        }
                    }
            echo form_dropdown('old_txtLocation', $old_locations,$row->lt_id, 'class="form-control"');  
            ?>
            <span style="color:red;"><?php echo form_error('old_txtLocation'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Text for booking form <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $txtBooking = array('name'=>'old_txtBooking', 'class' => 'form-control textarea', 'value' => $row->act_bookingtext);
                echo form_textarea($txtBooking);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtBooking'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">File input <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $photos = array();
                    if($txtPhotos->num_rows > 0){   
                        foreach($txtPhotos->result() as $value){
							$photos['0'] = "--- select ---";
                            $photos[$value->photo_id] = $value->pho_name;

                        }
                    }
            echo form_dropdown('old_txtPhotos', $photos, $row->photo_id, 'class="form-control"');  
            ?>
            <span style="color:red;"><?php echo form_error('old_txtPhotos'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Text for E-ticket <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtEticket = array('name'=>'old_txtEticket', 'class' => 'form-control textarea', 'value' => $row->act_texteticket); 
                echo form_textarea($txtEticket);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtEticket'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Purchase Price <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php
                $purchasePrice = array('name' => 'old_purchasePrice','class' => 'form-control', 'value' => $row->act_purchaseprice);
                echo form_input($purchasePrice);
            ?>
        </div>
        <div class="col-sm-4">
            <span style="color:red;"><?php echo form_error('old_purchasePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sale Price <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php
                $salePrice = array('name' => 'old_salePrice','class' => 'form-control','value' => $row->act_saleprice);
                echo form_input($salePrice);
            ?>
        </div>
        <div class="col-sm-4">
            <span style="color:red;"><?php echo form_error('old_salePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Original Stock <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php
                $originalStock = array('name' => 'old_originalStock','class' => 'form-control', 'value' => $row->act_originalstock);
                echo form_input($originalStock);
                echo form_hidden('old_originalStock', $row->act_originalstock);
            ?>
        </div>
        <div class="col-sm-4">
            <span style="color:red;"><?php echo form_error('old_originalStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Actual Stock <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php
                $actualStock = array('name' => 'old_actualStock','class' => 'form-control', 'value'=> $row->act_actualstock);
                echo form_input($actualStock);
            ?>
        </div>
        <div class="col-sm-4">
            <span style="color:red;"><?php echo form_error('old_actualStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Booking Contract with Activity Organizer :</label>
        <div class="col-sm-4">
            <div id="alert">
                <strong></strong>
                <?php
                    $contract = array('id'=>'dp1' ,'name' => 'old_contract', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:210px;', 'value' => $row->act_organiserdate);
                    echo form_input($contract);
                ?>
            </div>
            <span style="color:red;"><?php echo form_error('old_contract'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Payed :</label>
        <div class="col-sm-4">
            <strong></strong>
            <?php
                $payed = array( 'id'=>'dp2','name' => 'old_txtPayed', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:210px;', 'value' => $row->act_payeddate);
                echo form_input($payed);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtPayed'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Deadline :</label>
        <div class="col-sm-4">
            <?php
                $deadline = array( 'id'=>'dp3','name' => 'old_txtDeadline', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:210px;', 'value' => $row->act_deadline);
                echo form_input($deadline);
            ?>
            <span style="color:red;"><?php echo form_error('old_txtDeadline'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Text for admin :</label>
        <div class="col-sm-4">
            <?php 
                $txtAdmin = array('name' => 'old_txtAdmin', 'class' => 'form-control textarea', 'value' => $row->act_admintext);
                echo form_textarea($txtAdmin);
                
            ?>
            <span style="color:red;"><?php echo form_error('old_txtAdmin'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('old_txtStatus', $txtStatus,$row->act_status ,'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('old_txtStatus'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <label class="control-label"> Sub Activity:</label>
            <div class="table-responsive">
                <table class="table table-bordered">
                <tr>
                    <th><input type="checkbox" name="check_id_subactivity" id="check_id_subactivity"></th>
                    <th>No</th>
                    <th>Sub Activity Name</th>
                    <th>Sub Activity Description</th>
                </tr>
                <?php
                    $checkbox = array(); 
                    if($tbSubActExist->num_rows() > 0){
                        foreach($tbSubActExist->result() as $val){
                            $checkbox[$val->subactivies_id] = $val->subactivies_id;
                        }
                    }
                ?>
                <?php foreach($tbSubActivity->result() as $data){?>
               <tr>
                <td>
                    <?php 
                        if(array_search($data->sub_act_id, $checkbox) > 0){
                            echo form_checkbox(array('class' => 'check_checkbox', 'id' => 'check_id_subactivity', 'name' => 'check_id_subactivity[]','checked'=>TRUE),$data->sub_act_id);                      
                        }else{
                            echo form_checkbox(array('class' => 'check_checkbox', 'id' => 'check_id_subactivity', 'name' => 'check_id_subactivity[]'),$data->sub_act_id);                      
                        }  
                    ?>
                </td>
                <td><?php echo $data->sub_act_id; ?></td>
                <td><?php echo $data->sub_act_title; ?></td>
                <td><?php echo $data->sub_act_value; ?></td>
                </tr>
                <?php } ?>
            </table> 
           </div>   
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <label class="control-label"> Extra Products:</label>
              <div class="table-responsive">
                <table class="table table-bordered">
                <tr>
                    <th><input type="checkbox" name="checkbox_extPro" id="checkbox_extPro"></th>
                    <th>No</th>
                    <th>Extra Product</th>
                    <th>Ext/person</th>
                    <th>Ext/booking</th>
                    <th>Ext/ e-Ticket</th>
                    <th>Ext. purchase price</th>
                    <th>Ext. sale price</th>
                    <th>Original Stock</th>
                    <th>Actual Stock</th>
                    <th>Provide date</th>
                    <th>payed date</th>
                    <th>Deadline</th>
                    <?php
                        $checkExtPro = array(); 
                        if($tbExtProExist->num_rows() > 0){
                            foreach($tbExtProExist->result() as $val){
                                $checkExtPro[$val->extraproduct_id] = $val->extraproduct_id;
                            }
                        }
                    ?>
                    <?php foreach($tbExtProduct->result() as $extra){?>
                </tr>
               <tr>
                <td>
                    <?php 
                        if(array_search($extra->ep_id, $checkExtPro) > 0){
                            echo form_checkbox(array('class' => 'check_checkbox', 'id' => 'check_idExtPro', 'name' => 'check_idExtPro[]','checked'=>TRUE),$extra->ep_id);                      
                        }else{
                            echo form_checkbox(array('class' => 'check_checkbox', 'id' => 'check_idExtPro', 'name' => 'check_idExtPro[]'),$extra->ep_id);                      
                        }  
                    ?>
                 </td>
                <td><?php echo $extra->ep_id; ?></td>
                <td><?php echo $extra->ep_name; ?></td>
                <td><?php echo $extra->ep_perperson; ?></td>
                <td><?php echo $extra->ep_perbooking ; ?></td>
                <td><?php echo $extra->ep_etickettext; ?></td>
                <td><?php echo $extra->ep_purchaseprice; ?></td>
                <td><?php echo $extra->ep_saleprice; ?></td>
                <td><?php echo $extra->ep_originalstock; ?></td>
                <td><?php echo $extra->ep_actualstock; ?></td>
                <td><?php echo $extra->ep_providerdate; ?></td>
                <td><?php echo $extra->ep_payeddate; ?></td>
                <td><?php echo $extra->ep_deadline; ?></td>
                </tr>
                <?php } ?>
            </table>
            </div>    
        </div>
    </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('edit_activities', 'Update',"class='btn btn-primary'");
            echo '  ';
			echo anchor('activities/list_record', form_button('btn_close', 'Cancel', 'class="btn btn-primary"'));
        ?>
    </div>
  </div>
<?php } ?>
<!-- </form> -->
</div>
            <?php
echo form_close();
?>