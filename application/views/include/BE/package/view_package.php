<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("package/list_record","Manage Packages"); ?></li>
  <li>View Package</li>
</ol>
<h1 class="action_page_header">View Package</h1>
<blockquote class="blockquote">
  <span>Note, all the field below have been disabled.</span> &nbsp; <span class="view_enable_package">Enable for editing</span>
</blockquote>
<?php 
  if($packageById->num_rows > 0){
    foreach ($packageById->result() as $value) {
        $exploded = explode('.', $value->pho_source);
        $pho_source = $exploded['0'].'_thumb.'.$exploded['1'];
        $txtFrom = $value->pkcon_start_date;
        $txtTo = $value->pkcon_end_date;
        $lc = $value->pkcon_lt_id;
        $ftv = $value->pkconl_ftv_id;
        $chosimg = $value->phoid;
        $pkdc = $value->pkcon_description;
        $status = $value->pkcon_status;
        $pkName = $value->pkcon_name;
        $purchasePriceV = $value->pkcon_purchaseprice;
        $salePriceV = $value->pkcon_saleprice;
        $originalStockV = $value->pkcon_originalstock;
        $actualStockV = $value->pkcon_actualstock;

        $package_accomodation['package_accomodation']   = $value->pk_accomodation;
        $package_activities['pg_activities']     = $value->pk_activities;
        $package_transportation['package_transportation'] = $value->pk_transportation;
    }
  }else{
    $pkName = '';
    $purchasePriceV = '';
    $salePriceV = '';
    $originalStockV = '';F
    $actualStockV = '';
    $package_accomodation['package_accomodation']   = '';
    $package_activities['package_activities']     = '';
    $package_transportation['package_transportation'] = '';
  }
?>
<div class="row">
    <?php  echo form_open_multipart('package/view_package/'.$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="form-horizontal view_package"'); ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Name <span class="require">*</span> :</label>
            <div class="col-sm-4">
                <?php
                $packageName = array('name' =>'pkName','value'=> set_value('pkName', $pkName),'class' => 'form-control');
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
                echo form_dropdown('txtFastival', $fastivals, $ftv, 'class="form-control"');  
                ?>
                <span style="color:red;"><?php echo form_error('txtFastival'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Images<span class="require">*</span> :</label>
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
            <label class="col-sm-2 control-label">Original Price <span class="require">*</span> :</label>
            <div class="col-sm-4">
                <?php
                    $purchasePrice = array('name' => 'purchasePrice','class' => 'form-control', 'value' => set_value('purchasePrice',$purchasePriceV));
                    echo form_input($purchasePrice);
                ?>
                <span style="color:red;"><?php echo form_error('purchasePrice'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Sale Price <span class="require">*</span> :</label>
            <div class="col-sm-4">
                <?php
                    $salePrice = array('name' => 'salePrice','class' => 'form-control','value' => set_value('salePrice',$salePriceV));
                    echo form_input($salePrice);
                ?>
                <span style="color:red;"><?php echo form_error('salePrice'); ?></span>
            </div>            
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Original Stock <span class="require">*</span> :</label>
            <div class="col-sm-4">
                <?php
                    $originalStock = array('name' => 'originalStock','class' => 'form-control', 'value' => set_value('originalStock',$originalStockV));
                    echo form_input($originalStock);
                ?>
                <span style="color:red;"><?php echo form_error('originalStock'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Actual Stock <span class="require">*</span> :</label>
            <div class="col-sm-4">
                <?php
                    $actualStock = array('name' => 'actualStock','class' => 'form-control', 'value' => set_value('actualStock',$actualStockV));
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
                echo form_submit('saveChangePackage', 'Save Change',"class='btn btn-primary btn-md check_value'");
                echo ' '.nbs(1);
                echo anchor('package/list_record', 'Cancel', "class='btn btn-primary'");
              ?>
            </div>
        </div>
        <div class="pk_activities">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/pk_list_activities', $package_activities); ?>
        </div>
        <div class="pk_accommodation">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/pk_list_accommodation', $package_accomodation); ?>
        </div>
        <div class="pk_transportation">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/pk_list_transportation', $package_transportation); ?>
        </div>
    <?php echo form_close(); ?>
</div>      
<?php 
    $this->load->view(INCLUDE_BE.'modal/package-modal'); 
?>