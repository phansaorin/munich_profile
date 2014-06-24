<?php  echo form_open_multipart('classification/add_classification', 'class="form-horizontal add_classification"'); ?>

<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("classification/list_record","Manage"); ?></li>
      <li>Add</li>
    </ol>
    <h1 class="action_page_header">Add Classification</h1>
<div class="col-md-12 column">
    <div class="form-group">
        <label class="col-sm-2 control-label">Classification Name <span class="require">*</span></label>
        <div class="col-sm-4">
            <?php
                $classificationName = array('name' => 'classificationName','value'=> set_value('classificationName'),'class' => 'form-control');
                echo form_input($classificationName);
            ?>
            <span style="color:red;"><?php echo form_error('classificationName'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Classification Value <span class="require">*</span></label>
        <div class="col-sm-4">
            <?php
                $classificationValue = array('name' => 'classificationValue','value'=> set_value('classificationValue'),'class' => 'form-control');
                echo form_input($classificationValue);
            ?>
            <span style="color:red;"><?php echo form_error('classificationValue'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('addClassification', 'Add',"class='btn btn-primary check_value'");
                echo '  ';
                echo anchor('classification/list_record', form_button('btn_close', 'Cancel', 'class="btn btn-primary btn-sm"'));
            ?>
            <p style="display:none; color:red">Some Field is wrong!... Please check Data Again before you submit.</p>
        </div>
    </div>
</div>
<!-- </form> -->
            <?php
echo form_close();?>
