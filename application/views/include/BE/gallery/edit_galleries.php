<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("gallery/list_record","Manage"); ?></li>
      <li>Edit</li>
</ol>
<h1 class="action_page_header">Edit Gallery</h1>
<?php  echo form_open_multipart('gallery/edit_galleries/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
<h4>Edit Image</h4>
<?php foreach($get_gallery->result() as $row){?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Image Name<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $old_name = array('name' =>'old_name','value'=>$row->pho_name ,'class' => 'form-control');
                echo form_input($old_name);
            ?>
            <span style="color:red;"><?php echo form_error('old_name'); ?></span>
        </div>
        
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Upload Image<span class="require">*</span> :</label>
        <div class="col-sm-4">
            
             <?php  

               // echo $row->pho_source; die();
                echo form_upload(array('name' => 'old_img_name[]', 'value' =>$row->pho_source, 'multiple' => 'multiple'));
                //echo $row->pho_source;
                ?>
            <span style="color:red;"><?php echo form_error('old_img_name'); ?></span>
        </div>
    </div>
     <div class="form-group">
         <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('old_txtStatus', $txtStatus,$row->pho_status,'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('old_txtStatus'); ?></span>
        </div>
    </div>
    <div class="form-group">
         <label class="col-sm-2 control-label">Photo Type<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('old_photoType', $phototype,$row->pt_id,'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('old_photoType'); ?></span>
        </div>
    </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Image Detail<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $detail = array('name'=>'old_detail', 'class' => 'form-control textarea', 'value' => $row->pho_detail);
                echo form_textarea($detail);
            ?>
            <span style="color:red;"><?php echo form_error('detail'); ?></span>
        </div>
    </div>
    <?php } ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="button" class="btn btn-primary btn-xs"  data-toggle="tooltip" data-placement="right" title="* are requries">Note</button><span class="require"> All (*) are requries.</span>
        </div> 
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('UpdateImage', 'Update',"class='btn btn-primary'");
                echo '  ';
                echo anchor('gallery/list_record', form_button('close', 'Cancel', 'class="btn btn-sm btn-default"'));
            ?>
        </div>
    </div>

<!-- </form> -->
            <?php
echo form_close();?>
