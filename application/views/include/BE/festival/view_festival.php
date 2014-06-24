<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("festival/list_record","Manage"); ?></li>
      <li>View</li>
</ol>
<h1 class="action_page_header">View Festival</h1>
<?php  echo form_open('festival/view_festival/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_festival->result() as $row) {
            ?>
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>Festival Name</th> <td><?php echo $row->ftv_name; ?></td>
                </tr>
                <tr>
                  <th>Festival Detail</th> <td><?php echo $row->ftv_detail; ?></td>
                </tr> 
                <tr>                   
                  <th>Festival Photo</th>
                    <?php   
                        $exploded = explode('.', $row->pho_source);
                        $img = $exploded['0'] . '_thumb.'.$exploded['1'];
                        $image_properties = array('src' => site_url('user_uploads/thumbnail/thumb/' . $img), 'alt' => $row->pho_name, 'width' => '50', 'height' => '50', 'class' => 'style_img', 'title' => $row->pho_name);            
                    ?>
                  <td><?php echo img($image_properties); ?></td> 
                </tr> 
              	<tr>
                	<th>Festival Location</th> <td><?php echo $row->lt_name; ?></td>
                </tr>                              
              </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('festival/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
            <?php echo form_close(); ?>