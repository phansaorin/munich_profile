<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("feedbacks/list_record","Manage"); ?></li>
      <li>View</li>
</ol>
<h1 class="action_page_header">View Feedback</h1>
<?php  echo form_open('feedback/view_feedback/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_feedback->result() as $row) {
            
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
            
              <table class="table table-bordered">
              	<tr>
                	<th>Name</th> 
                	<td><?php echo $row->fb_name; ?></td>
                </tr>
                <tr>                   
                	<th>Email</th>
                    <td><?php echo $row->fb_email;?></td>
                </tr>
                <tr>
                    <th>Text</th>
                    <td><?php echo $row->fb_text; ?></td>
                </tr>
                <tr>
                    <th>Subject</th>
                    <td><?php echo $row->fb_subject; ?></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><?php echo $row->fb_date; ?></td>
                </tr>
        </table>
    </div>
    <?php echo anchor ('feedbacks/list_record','<span class="btn btn-primary">Back</span>');?>
<?php } ?>
