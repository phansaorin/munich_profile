<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("subscribers/list_record","Manage"); ?></li>
      <li>Send mail</li>
</ol>
<h1 class="action_page_header">Send Mail</h1>
<form class="form-horizontal" role="form" action="sendToEmail" id="sendmail" method="post">
  <div class="form-group">
    <label class="col-sm-2 control-label">Subject<span class="require">*</span> :</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">To <span class="require">*</span> :</label>
    <div class="col-sm-4">
      	<ul class="nav nav-list" style="border:1px solid #CCC;">
        		<input type="checkbox" name="checkbox_all" id="checkbox_all">&nbsp;&nbsp;<font color="red">Check all</font>
        		<?php foreach($value as $data) { 
                		$checkBox = form_checkbox(array('class' => 'check_checkbox recievers','id' => 'check_checkbox','name' => 'sb_checkbox[]'),$data->sub_email); 
		    	?>
		    	<li><?php echo $checkBox.' '.$data->sub_email ; ?></li>
		    	<?php  } ?>
		</ul>
	 </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">From <span class="require">*</span> :</label>
    <div class="col-sm-4">
    
      	 <?php 
        foreach($emailAdmin as $email) { 
          ?>

          <input type="email" class="form-control" id="sender" name="sender" value="<?php echo $email->user_mail; ?>" />
        
        <?php } ?>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Message <span class="require">*</span> :</label>
    <div class="col-sm-4">
      <textarea class="form-control" rows="3" name="messages" id="messages"></textarea>
    </div>
  </div>

  <div class="form-group">
        <div <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" name="btnSend" id="btnSend" value="Send" />
            <?php 
                echo anchor('subscribers/list_record', form_button('btn_cancel', 'Cancel', 'id="btnCancel" class="btn"'));
            ?>
        </div>
    </div>
            
</form>
