<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("extra_products/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("extra_products/search_extra_products","Search"); ?></li>
  <?php }?>
  <li>Add</li>
</ol>
<h1 class="action_page_header">Add Extra Product</h1>
<?php  echo form_open_multipart('extra_products/add_extra_products', 'class="form-horizontal add_extra_products"'); ?>

    <div class="form-group">
        <label class="col-sm-2 control-label">Name <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $extraproductsName = array('name' =>'txtName','value'=> set_value('txtName'),'class' => 'form-control');
                echo form_input($extraproductsName);
            ?>
            <span style="color:red;"><?php echo form_error('txtName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Per Person<span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php 
                echo form_dropdown('txtPerperson', $txtPerperson, set_value('txtPerperson'),'class="form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('txtPerperson'); ?></span>
        </div>
    </div>
    <!-- new code of date -->
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
        <label class="col-sm-2 control-label">Supplier<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
          //  var_dump($txtSupplier); die();
                $suppliers = array();
                $suppliers[''] = "--- select ---";
                    if($txtSupplier->num_rows > 0){
                        foreach($txtSupplier->result() as $value){
                            $suppliers[$value->sup_id] = $value->sup_company_name;
                        }
                    }
                    //var_dump($suppliers); die();
            echo form_dropdown('txtSupplier', $suppliers, $spl, 'class="form-control"');  
            ?>
            <span style="color:red;"><?php echo form_error('txtSupplier'); ?></span>
        </div>
    </div>
    <!-- end of date code -->
    <div class="form-group">
        <label class="col-sm-2 control-label">Per Booking<span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php 
                echo form_dropdown('txtPerbooking', $txtPerbooking, set_value('txtPerbooking'),'class="form-control"'); 
            ?>
            <span style="color:red;"><?php echo form_error('txtPerbooking'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Text for booking form <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $txtBooking = array('name'=>'txtBooking', 'class' => 'form-control textarea', 'value' => set_value('txtBooking'));
                echo form_textarea($txtBooking);
            ?>
            <span style="color:red;"><?php echo form_error('txtBooking'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">File input <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <select id="demo-htmlselect-basic" style="width:400px;" name="txtPhotos">
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
        <label class="col-sm-2 control-label">Text for E-ticket <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtEticket = array('name'=>'txtEticket', 'class' => 'form-control textarea', 'value' => set_value('txtEticket')); 
                echo form_textarea($txtEticket);
            ?>
            <span style="color:red;"><?php echo form_error('txtEticket'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Purchase Price <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php
                $purchasePrice = array('name' => 'purchasePrice','class' => 'form-control', 'value' => set_value('purchasePrice'));
                echo form_input($purchasePrice);
            ?>
        </div>
        <div class="col-sm-4">
            <span style="color:red;"><?php echo form_error('purchasePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Sale Price <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php
                $salePrice = array('name' => 'salePrice','class' => 'form-control','value' => set_value('salePrice'));
                echo form_input($salePrice);
            ?>
        </div>
        <div class="col-sm-4">
            <span style="color:red;"><?php echo form_error('salePrice'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Original Stock <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php
                $originalStock = array('name' => 'originalStock','class' => 'form-control', 'value' => set_value('originalStock'));
                echo form_input($originalStock);
            ?>
        </div>
        <div class="col-sm-4">
            <span style="color:red;"><?php echo form_error('originalStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Actual Stock <span class="require">*</span> :</label>
        <div class="col-sm-2">
            <?php
                $actualStock = array('name' => 'actualStock','class' => 'form-control', 'value' => set_value('actualStock'));
                echo form_input($actualStock);
            ?>
        </div>
        <div class="col-sm-4">
            <span style="color:red;"><?php echo form_error('actualStock'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date Provider :</label>
        <div class="col-sm-4">
            <div id="alert">
                <strong></strong>
                <?php
                    $txtProvider = array('id'=>'dp1' ,'name' => 'txtProvider', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:210px;', 'value' => set_value('txtProvider'));
                    echo form_input($txtProvider);
                ?>
            </div>
            <span style="color:red;"><?php echo form_error('txtProvider'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Paid :</label>
        <div class="col-sm-4">
            <strong></strong>
            <?php
                $payed = array( 'id'=>'dp2','name' => 'txtPayed', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:210px;', 'value' => set_value('txtPayed'));
                echo form_input($payed);
            ?>
            <span style="color:red;"><?php echo form_error('txtPayed'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Deadline :</label>
        <div class="col-sm-4">
            <?php
                $deadline = array( 'id'=>'dp3','name' => 'txtDeadline', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:210px;', 'value' => set_value('txtDeadline'));
                echo form_input($deadline);
            ?>
            <span style="color:red;"><?php echo form_error('txtDeadline'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Text for Admin <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $txtAdmin = array('name'=>'txtAdmin', 'class' => 'form-control textarea', 'value' => set_value('txtAdmin')); 
                echo form_textarea($txtAdmin);
            ?>
            <span style="color:red;"><?php echo form_error('txtAdmin'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('txtStatus', $txtStatus, set_value('txtStatus'),'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('txtStatus'); ?></span>
        </div>
    </div>
    
    <div class="form-group">
        <div <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('addExtraproducts', 'Add',"class='btn btn-primary'");
				echo '  ';
				echo anchor('extra_products/list_record', 'Cancel', "class='btn btn-sm btn-default'");
            ?>
        </div>
    </div>
<!-- </form> -->
            <?php
echo form_close();?>
