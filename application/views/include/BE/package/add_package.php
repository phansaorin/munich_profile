<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("package/list_record","Manage Packages"); ?></li>
  <li>Add</li>
</ol>
<h1 class="action_page_header">Create New Package</h1>
<div class="row">
    <?php  echo form_open_multipart('package/add_package', 'class="form-horizontal add_package"'); ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Name <span class="require">*</span> :</label>
            <div class="col-sm-4">
                <?php
                $packageName = array('name' =>'pkName','value'=> set_value('pkName'),'class' => 'form-control');
                echo form_input($packageName);
                ?>
                <span style="color:red;"><?php echo form_error('pkName'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Date <span class="require">*</span> :</label>
            <div class="col-sm-4">
            <div class="input-daterange input-group" id="datepicker">
                <?php
                    $txtFrom = array('id'=>'dp4' ,'name' => 'txtFrom', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtFrom', $txtFrom));
                   echo form_input($txtFrom);
                ?>
                <span class="input-group-addon">to</span>
                <?php
                    $txtTo = array('id'=>'dp5' ,'name' => 'txtTo', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'', 'value' => set_value('txtTo', $txtTo));
                    echo form_input($txtTo);
                ?>
            </div>
            <div id="alert"><strong></strong></div>
            <span style="color:red;"><?php if(form_error('txtFrom') or form_error('txtTo')) echo "The date field is required."; ?></span>
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
                echo form_dropdown('txtLocation', $locations, $lc, 'class="form-control"');  
                ?>
                <span style="color:red;"><?php echo form_error('txtLocation'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Fastival <span class="require">*</span> :</label>
            <div class="col-sm-4">
                <?php 
                    $fastivals = array();
                    $fastivals[''] = "--- select ---";
                        if($txtFastival->num_rows > 0){
                            foreach($txtFastival->result() as $value){
                                $fastivals[$value->ftv_id] = $value->ftv_name;
                            }
                        }
                echo form_dropdown('txtFastival', $fastivals, $ftv, 'class="form-control"');  
                ?>
                <span style="color:red;"><?php echo form_error('txtFastival'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Photos <span class="require">*</span> :</label>
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
            <label class="col-sm-2 control-label">Original Price <span class="require">*</span> :</label>
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
            <label class="col-sm-2 control-label">Description :</label>
            <div class="col-sm-4">
                <?php 
                $txtDescribe = array('name' => 'txtDescribe', 'class' => 'form-control textarea', 'value' => set_value('txtDescribe', $pkdc),"rows" => 3);
                echo form_textarea($txtDescribe);
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Status :</label>
            <div class="col-sm-4">
                <?php echo form_dropdown('txtStatus', $txtStatus, set_value('txtStatus',$status),'class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <?php 
                echo form_submit('addPackage', 'Add',"class='btn btn-primary btn-md check_value'");
                echo ' '.nbs(1);
                echo anchor('package/list_record', 'Cancel', "class='btn btn-primary btn-sm'");
              ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>      
