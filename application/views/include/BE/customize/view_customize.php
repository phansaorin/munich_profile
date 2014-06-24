<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("customize/list_record","Manage Customize"); ?></li>
  <li>View Customize</li>
</ol>
<h1 class="action_page_header">View Customize</h1>
<blockquote class="blockquote">
  <span>Note, all the field below have been disabled.</span> &nbsp; <span class="view_enable_customize">Enable for editing</span>
</blockquote>
<?php 
  if($customizeById->num_rows > 0){
    foreach ($customizeById->result() as $value) {
        $exploded = explode('.', $value->pho_source);
        $pho_source = $exploded['0'].'_thumb.'.$exploded['1'];
        $txtFrom = $value->cuscon_start_date;
        $txtTo = $value->cuscon_end_date;
        $lc = $value->cuscon_lt_id;
        $ftv = $value->cuscon_ftv_id;
        $chosimg = $value->cuscon_pho_id;
        $cuscondc = $value->cuscon_description;
        $status = $value->cuscon_status;
        $cusconName = $value->cuscon_name;
        $purchasePriceV = $value->cuscon_purchaseprice;
        $salePriceV = $value->cuscon_saleprice;
        $originalStockV = $value->cuscon_originalstock;
        $actualStockV = $value->cuscon_actualstock;

        $customize_accomodation['customize_accomodation']   = $value->cuscon_accomodation;
        $customize_activities['customize_activities']     = $value->cuscon_activities;
        $customize_transportation['customize_transportation'] = $value->cuscon_transportation;
    }
  }else{
    $cusconName = '';
    $purchasePriceV = '';
    $salePriceV = '';
    $originalStockV = '';
    $actualStockV = '';
    $customize_accomodation['customize_accomodation']   = '';
    $customize_activities['customize_activities']     = '';
    $customize_transportation['customize_transportation'] = '';
  }
?>

<div class="row">
    <?php  echo form_open_multipart('customize/view_customize/'.$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="form-horizontal view_customize"'); ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Name <span class="require">*</span> :</label>
            <div class="col-sm-4">
                <?php
                $customizeName = array('name' =>'cusconName','value'=> set_value('cusconName', $cusconName),'class' => 'form-control');
                echo form_input($customizeName);
                ?>
                <span style="color:red;"><?php echo form_error('cusconName'); ?></span>
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
            <label class="col-sm-2 control-label">File input <span class="require">*</span> :</label>
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
                $txtDescribe = array('name' => 'txtDescribe', 'class' => 'form-control textarea', 'value' => set_value('txtDescribe', $cuscondc),"rows" => 3);
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
                echo form_submit('saveChangeCustomize', 'Save Change',"class='btn btn-primary btn-md check_value'");
                echo ' '.nbs(1);
                echo anchor('customize/list_record', 'Cancel', "class='btn btn-primary'");
              ?>
            </div>
        </div>
        <div class="cuscon_activities">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/cuscon_list_activities', $customize_activities); ?>
        </div>
        <div class="cuscon_accommodation">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/cuscon_list_accommodation', $customize_accomodation); ?>
        </div>
        <div class="cuscon_transportation">
            <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/cuscon_list_transportation', $customize_transportation); ?>
        </div>
    <?php echo form_close(); ?>
</div>      
<?php 
    $this->load->view(INCLUDE_BE.'modal/customize-modal'); 
?>