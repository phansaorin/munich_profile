<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("content/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("content/search_content","Search"); ?></li>
  <?php }?>
  <li>Edit</li>
</ol>
<h1 class="action_page_header">Edit Content</h1>
<?php 
    if($contentById->num_rows() > 0){
        foreach($contentById->result() as $key => $value){
            $ctitle = $value->con_title;
            $cKey = $value->meta_key;
            $cDescripe = $value->meta_describe;
            $cstatus = $value->con_status;
            $cText = $value->con_text;
            $stayInMenu = $value->con_menu_id;
            $cTemplate = $value->con_template;
            $con_id = $this->uri->segment(3);
            $con_menu_id = $this->uri->segment(4);
        }
    }else{
            $ctitle = '';
            $cKey = '';
            $cDescripe = '';
            $cstatus = '';
            $cText = '';
            $stayInMenu = '';
            $cTemplate = '';
            $con_id = $this->uri->segment(3);
            $con_menu_id = $this->uri->segment(4);
    }
?>
<?php 
    echo form_open("content/edit_content/".$con_id.'/'.$con_menu_id,'class="form-horizontal content_edit" role="form"');
?>

<div class="form-group">
    <label class="col-sm-2 control-label">Content Title<sup class="require">*</sup>:</label>
    <div class="col-sm-4">
        <?php echo form_input(array("name"=>"ctitle", "value"=>set_value('ctitle',$ctitle),"class"=>"form-control ctitle")); ?>
        <span class="error ctitleError"><br />The content title is required...</span>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Meta key:</label>
    <div class="col-sm-4">
        <?php echo form_input(array("name"=>"cKey", "value"=>set_value('cKey',$cKey),"class"=>"form-control cKey")); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Meta Description:</label>
    <div class="col-sm-4">
        <?php echo form_textarea(array("name"=>"cDescripe", "value"=>set_value('cDescripe',$cDescripe),"class"=>"form-control cDescripe","rows"=>1)); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Layout:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('contemplate', $conTemplate, $cTemplate, 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Stay In menu:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('stayInMenu', $all_menu, $stayInMenu, 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Photos:</label>
    <div class="col-sm-4">
        <?php echo form_multiselect('cphoto[]', $all_photos, $con_photo, 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Status:</label>
    <div class="col-sm-4">
        <?php echo form_dropdown('cstatus', array('0'=> "Unpublish",'1'=>"Publish"),$cstatus, 'class="form-control"'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Content Text:</label>
    <div class="col-sm-10">
        <?php echo form_textarea(array("name"=>"cText", "value"=>set_value('cText',$cText),"class"=>"form-control cText")); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('content_edit', 'Save',"class='btn btn-primary'");
            echo '  ';
            echo anchor('content/list_record', 'Cancel', "class='btn btn-sm btn-default'");
        ?>
    </div>
</div>