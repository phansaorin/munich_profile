
<?php  echo form_open('classification/edit_classificaion/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("classification/list_record","Manage"); ?></li>
      <li>Edit</li>
    </ol>
    <h1 class="action_page_header">Edit Classification</h1>

<?php
        foreach ($get_classification->result() as $row) {
            ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Classification Name <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <?php 
                        $classificationName = array('name' => 'classificationName','value'=> $row->clf_name,'class' => 'form-control');
                        echo form_input($classificationName); 
                ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Classification Value <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <?php 
                        $classificationValue = array('name' => 'classificationValue','value'=> $row->clf_value,'class' => 'form-control');
                        echo form_input($classificationValue); 
                ?>
                </div>
            </div>
<?php }?>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('edit_classification', 'Save',"class='btn btn-primary'");
            echo '  ';
            echo anchor('classification/list_record', 'Cancel', "class='btn btn-sm btn-default'");
        ?>
    </div>
</div