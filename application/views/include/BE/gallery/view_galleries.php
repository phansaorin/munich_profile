<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("gallery/list_record","Manage"); ?></li>
      <li>View</li>
</ol>
<h1 class="action_page_header">View Gallery</h1>
<?php  echo form_open('gallery/view_galleries/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($view_galleries->result() as $row) {
            
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>Image Name</th> 
                	<td><?php echo $row->pho_name; ?></td>
                </tr>
                <tr>                   
                	<th>Image</th>
                    <?php    
                        $id = 1;
                    if ($this->uri->segment(3)) {
                        $id = $this->uri->segment(3) + 1;
                    } else {
                        $id = 1;
                    }   
                        $exploded = explode('.', $row->pho_source);
                        $img = $exploded['0'] . '_thumb.'.$exploded['1'];
                        $image_properties = array('src' => site_url('user_uploads/thumbnail/thumb/' . $img), 'alt' => $row->pho_name, 'width' => '50', 'height' => '50', 'class' => 'style_img', 'title' => $row->pho_name);            
                    ?>
                    <td><?php echo img($image_properties); ?></td> 
                </tr>
                <tr>
                    <th>Detail</th>
                    <td><?php echo $row->pho_detail; ?></td>
                </tr>
                <tr>
                    <th>Photo Type</th>
                    <td><?php $type = $row->pt_title; echo $type; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo anchor ('gallery/list_record','<span class="btn btn-primary">Back</span>');?></td>
                </tr>
                
                <?php } ?>
        </table>
</div>