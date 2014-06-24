<?php 
    if($menuById->num_rows() > 0){
        foreach($menuById->result() as $menuRecord){
            $mtitle = $menuRecord->menu_title;
            $maliase = $menuRecord->menu_aliase;
            $mstatus = $menuRecord->menu_status;
            $mparent = $menuRecord->menu_menu_id;
            $mId = $menuRecord->menu_id;
        }
    }
?>
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("menu/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('searchMenu')){?>
  <li><?php echo anchor("menu/search_menu","Search"); ?></li>
  <?php }?>
  <li>Edit</li>
</ol>
<h1 class="action_page_header">Edit Menu</h1>
<?php 
    echo form_open("menu/edit_menu/".$mId.'/'.$mparent,'class="form-horizontal menu_edit" role="form"');
    // $hiddenMenuId = array("name" => "menu_id", "value" => $mId);
    echo form_hidden("menu_id", $mId);
?>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Title<sup class="require">*</sup>:</label>
    <div class="col-sm-4">
        <?php echo form_input(array("name"=>"mtitle", "value"=>set_value('mtitle', $mtitle),"class"=>"form-control mtitle")); ?>
        <span class="error mtitleError"><br />The menu title is required...</span>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Aliase:</label>
    <div class="col-sm-4">
        <?php echo form_input(array("name"=>"maliase", "value"=>set_value('maliase', $maliase),"class"=>"form-control maliase")); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Parent:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('mparent', $parent_menu, $mparent, 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Position:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('mposition', $position_menu, '' ,'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Menu Status:</label>
    <div class="col-sm-4">
        <?php 
            $option_mstatus = array('0'=> "Unpublish",'1'=>"Publish");
            echo form_dropdown('mstatus', $option_mstatus, $mstatus, 'class="form-control"'); 
        ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('menu_edit', 'Save',"class='btn btn-primary'");
            echo '  ';
            echo anchor('menu/list_record', 'Cancel', "class='btn btn-sm btn-default'");
        ?>
    </div>
</div>