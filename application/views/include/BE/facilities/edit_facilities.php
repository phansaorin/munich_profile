
    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("facilities/list_record","Manage"); ?></li>
      <li>Edit</li>
    </ol>
<h1 class="action_page_header">Edit Facility</h1>
<?php  echo form_open('facilities/edit_facilities/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($get_facilities->result() as $row) {
            ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Facilities Name <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <?php 
                        $facilitiesName = array('name' => 'facilitiesName','value'=> $row->facilities_title,'class' => 'form-control');
                        echo form_input($facilitiesName); 
                ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Facilities Value <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <?php 
                        $facilitiesValue = array('name' => 'facilitiesValue','value'=> $row->facilities_value,'class' => 'form-control');
                        echo form_input($facilitiesValue); 
                ?>
                </div>
            </div>
<?php }?>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('edit_facilities', 'Save',"class='btn btn-primary'");
            echo '  ';
            echo anchor('facilities/list_record', 'Cancel', "class='btn btn-sm btn-default'");
        ?>
    </div>
</div