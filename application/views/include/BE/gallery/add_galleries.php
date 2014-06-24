<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("gallery/list_record","Manage"); ?></li>
      <li>Add</li>
</ol>
<h1 class="action_page_header">Create New Gallery</h1>
<?php  echo form_open_multipart('gallery/add_galleries', 'class="form-horizontal add_galleries"'); ?>

<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
    if ($this->session->userdata('error')) {
        echo $this->session->userdata('error');
        $this->session->unset_userdata('error');
    } 
?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Image Name<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $name = array('name' =>'name','value'=> set_value('name'),'class' => 'form-control');
                echo form_input($name);
            ?>
            <span style="color:red;"><?php echo form_error('name'); ?></span>
        </div>
        
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Upload Image<span class="require">*</span> :</label>
        <div class="col-sm-4">
            
             <?php
                echo form_upload(array('name' => 'img_name[]', 'value' => set_value('img_name[]'), 'multiple' => 'multiple'));
                ?>
            <span style="color:red;"><?php echo form_error('img_name'); ?></span>
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
    <label class="col-sm-2 control-label">Photo Type<span class="require">*</span> :</label>
    <div class="col-sm-4">
        <?php
        $photo_type = array();
        $photo_type[''] = "--- select ---";
        if($photoTypes->num_rows > 0){
        foreach($photoTypes->result() as $value){
        $photo_type[$value->pt_id] = $value->pt_title;
        }
        }
        ?>
<?php echo form_dropdown('photoType', $photo_type, set_value('photoType'),'class="form-control"'); ?>
<span style="color:red;"><?php echo form_error('photoType'); ?></span>
    </div>
</div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Image Detail<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $detail = array('name'=>'detail', 'class' => 'form-control textarea', 'value' => set_value('detail'));
                echo form_textarea($detail);
            ?>
            <span style="color:red;"><?php echo form_error('detail'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-primary btn-xs"  data-toggle="tooltip" data-placement="right" title="* are requries">Note</button><span class="require"> All (*) are requries.</span>
        </div> 
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('addImage', 'Add',"class='btn btn-primary'");
                echo '  ';
                echo anchor('gallery/list_record', form_button('close', 'Cancel', 'class="btn btn-sm btn-default"'));

            ?>
        </div>
    </div>

<!-- </form> -->
            <?php echo form_close();?>
