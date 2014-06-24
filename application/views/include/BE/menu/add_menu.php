<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("menu/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('searchMenu')){?>
  <li><?php echo anchor("menu/search_menu","Search"); ?></li>
  <?php }?>
  <li>Add</li>
</ol>
<h1 class="action_page_header">Create New Menu</h1>
<?php 
    echo form_open("menu/add_menu",'class="form-horizontal menu_add" role="form"');
?>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Title<sup class="require">*</sup>:</label>
    <div class="col-sm-4">
        <?php echo form_input(array("name"=>"mtitle", "value"=>set_value('mtitle'),"class"=>"form-control mtitle")); ?>
        <span class="error mtitleError"><br />The menu title is required...</span>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Aliase:</label>
    <div class="col-sm-4">
        <?php echo form_input(array("name"=>"maliase", "value"=>set_value('maliase'),"class"=>"form-control maliase")); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Parent:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('mparent', $parent_menu,'', 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Position:</label>
    <div class="col-sm-4">
        <!-- <?php //echo form_dropdown('mposition', $position_menu,'', 'class="form-control"'); ?> -->
        <?php
               echo form_dropdown('mposition', $position_menu, set_value('mposition'),'class="form-control"');
        ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Status:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('mstatus', array('0'=> "Unpublish",'1'=>"Publish"),'', 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('menu_add', 'Save',"class='btn btn-primary'");
            echo '  ';
            echo anchor('menu/list_record', 'Cancel', "class='btn btn-sm btn-default'");
        ?>
    </div>
</div>