<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("feedbacks/list_record","Manage"); ?></li>
      <li>Add</li>
</ol>
<h1 class="action_page_header">Add Feedback</h1>
<?php  echo form_open_multipart('feedbacks/add_feedback', 'class="form-horizontal add_galleries"'); ?>

<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Name<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $name = array('name' =>'name','value'=> set_value('name'),'class' => 'form-control');
                echo form_input($name);
            ?>
            <span style="color:red;"><?php echo form_error('name'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $email = array('name' =>'email','value'=> set_value('email'),'class' => 'form-control');
                echo form_input($email);
            ?>
            <span style="color:red;"><?php echo form_error('email'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date :</label>
        <div class="col-sm-4">
            <div id="alert">
                <strong></strong>
                <?php
                    $txtDate = array('id'=>'dp6' ,'name' => 'date', 'class' => 'form-control','data-date-format'=>'yyyy-mm-dd','style'=>'width:333px;', 'value' => set_value('date'));
                    echo form_input($txtDate);
                ?>
            </div>
            <span style="color:red;"><?php echo form_error('date'); ?></span>
        </div>
    </div>
    <div class="form-group">
         <label class="col-sm-2 control-label">Subjcet<span class="require">*</span> :</label>
        <div class="col-sm-4">
         <?php
                echo form_input(array('name' => 'subject', 'value' => set_value('subject'), 'class' => 'form-control'));
                ?>
            <span style="color:red;"><?php echo form_error('subject'); ?></span>
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
        <label class="col-sm-2 control-label">Text<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php 
                $text = array('name'=>'text', 'class' => 'form-control textarea', 'value' => set_value('text'));
                echo form_textarea($text);
            ?>
            <span style="color:red;"><?php echo form_error('text'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-primary btn-xs"  data-toggle="tooltip" data-placement="right" title="* are requries">Note</button><span class="require"> All (*) are requries.</span>
        </div>

    </div>
    <div class="form-group">
        <div <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('add_feedback', 'Add',"class='btn btn-primary'");
                echo '  ';
                echo anchor('feedbacks/list_record', 'Cancel', "class='btn btn-sm btn-default'");
            ?>
        </div>
    </div>

<!-- </form> -->
<?php echo form_close(); ?>
