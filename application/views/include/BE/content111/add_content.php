<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("content/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("content/search_content","Search"); ?></li>
  <?php }?>
  <li>Add</li>
</ol>
<h1 class="action_page_header">Create New Content</h1>
<?php 
    echo form_open("content/add_content",'class="form-horizontal content_add" role="form"');
?>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Title<sup class="require">*</sup>:</label>
    <div class="col-sm-4">
        <?php echo form_input(array("name"=>"ctitle", "value"=>set_value('ctitle'),"class"=>"form-control ctitle")); ?>
        <span class="error ctitleError"><br />The content title is required...</span>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Meta key:</label>
    <div class="col-sm-4">
        <?php echo form_input(array("name"=>"cKey", "value"=>set_value('cKey'),"class"=>"form-control cKey")); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Meta Description:</label>
    <div class="col-sm-4">
        <?php echo form_textarea(array("name"=>"cDescripe", "value"=>set_value('cDescripe'),"class"=>"form-control cDescripe","rows"=>1)); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Layout:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('contemplate', $conTemplate,'', 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Stay In menu:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('stayInMenu', $all_menu,'', 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Photos:</label>
    <div class="col-sm-4">
        <?php echo form_multiselect('cphoto[]', $all_photos,'', 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Status:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('cstatus', array('0'=> "Unpublish",'1'=>"Publish"),'', 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Text:</label>
    <div class="col-sm-10">
        <?php echo form_textarea(array("name"=>"cText", "value"=>set_value('cText'),"class"=>"form-control cText")); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('content_add', 'Save',"class='btn btn-primary'");
            echo '  ';
            echo anchor('content/list_record', 'Cancel', "class='btn btn-sm btn-default'");
        ?>
    </div>
</div>