<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("feedbacks/list_record","Manage"); ?></li>
      <li>Edit</li>
</ol>
<h1 class="action_page_header">Edit Feedback</h1>
<?php  echo form_open('feedbacks/edit_feedback/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Name<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php foreach($get_feedback->result() as $row){?>
            <?php
                $fbname = array('name' =>'old_name','value'=> $row->fb_name,'class' => 'form-control');
                echo form_input($fbname);
            ?>
            <span style="color:red;"><?php echo form_error('old_name'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Email <span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $fbemail = array('name' =>'old_email','value'=> $row->fb_email,'class' => 'form-control');
                echo form_input($fbemail);
            ?>
            <span style="color:red;"><?php echo form_error('old_email'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Subject<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $subject = array('name' =>'old_subject','value'=> $row->fb_subject,'class' => 'form-control');
                echo form_input($subject);
            ?>
            <span style="color:red;"><?php echo form_error('old_subject'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $date = array('name' =>'old_date','value'=> $row->fb_date,'class' => 'form-control','id'=>'dp6','data-date-format'=>'yyyy-mm-dd');
                echo form_input($date);
            ?>
            <span style="color:red;"><?php echo form_error('old_date'); ?></span>
        </div>
       
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Status<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php echo form_dropdown('old_txtStatus', $txtStatus,$row->fb_status,'class="form-control"'); ?>
            <span style="color:red;"><?php echo form_error('old_txtStatus'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Text<span class="require">*</span> :</label>
        <div class="col-sm-4">
            <?php
                $text = array('name' =>'old_text','value'=> $row->fb_text,'class' => 'form-control');
                echo form_textarea($text);
            ?>
            <span style="color:red;"><?php echo form_error('old_text'); ?></span>
        </div>
    </div>
  
    <?php } ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php 
                echo form_submit('edit_feedback', 'Update',"class='btn btn-primary'");
                echo '  ';
                echo anchor('feedbacks/list_record', form_button('close', 'Cancel', 'class="btn btn-sm btn-default"'));
            ?>
        </div>
    </div>

<!-- </form> -->

            <?php echo form_close(); ?>
