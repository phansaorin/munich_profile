
    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("location/list_record","Manage"); ?></li>
      <li>Edit</li>
    </ol>
    <h1 class="action_page_header">Edit Location</h1>

<?php  echo form_open('location/edit_location/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($get_location->result() as $row) {
            ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Location Name <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <?php 
                        $locationName = array('name' => 'locationName','value'=> $row->lt_name,'class' => 'form-control');
                        echo form_input($locationName); 
                ?>
                </div>
            </div>
<?php }?>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('edit_location', 'Save',"class='btn btn-primary'");
            echo '  ';
            echo anchor('location/list_record', 'Cancel', "class='btn btn-sm btn-default'");
        ?>
    </div>
</div