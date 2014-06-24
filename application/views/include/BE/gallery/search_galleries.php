<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage</li>
</ol>
<div class="row">
  <div class="col-md-8 column search">        <?php
        if(isset($search_photo_name)) $searchtitle = $search_photo_name; 
        else $searchtitle = "";
        echo form_open("gallery/search_galleries", 'class="navbar-form navbar-left" role="search"');
        echo '<div class="form-group">';
        echo form_input(
                array('name' => 'search_name',
                    'value' => set_value('search_name'),
                    'class' => 'form-control input-sm',
                    'placeholder' => 'Image Name'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
	
        echo form_close();
        ?>

    </div>
<div class="col-md-4 column top-action">
                    <form role="search">
                        <div class="form-group">
                        	<button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
                            <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
                            <?php echo anchor('user/deletePermenentUser','','class="error pdelete"'); ?>
							<?php echo anchor('user/deleteUserMultiple','','class="error tdelete"'); ?>
                            <?php echo anchor('gallery/add_galleries', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
                     </div>
                    </form>
                </div>
            </div>
            <table class="table table-striped">
                <tr> 
                    <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
                    <td><?php echo anchor("gallery/search_galleries/ID/" . $sort, "No"); ?></td>
                    <td><?php echo anchor("gallery/search_galleries/Name/" . $sort, "Name"); ?></td>
                    <td>Image</td>
                    <td>Detail</td>
                    <td>Photo Type</td>
                    <td>Action</td>
                </tr>	
                <?php if ($photos ->num_rows > 0) { ?>
                  <?php foreach ($photos->result() as $data) { ?>
                        <tr>
                            <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->photo_id
                                        ); 
                                ?>
                            </td>
                            <td><?php echo $data->photo_id; ?></td>
                            <td><?php echo $data->pho_name; ?></td> 
                             <?php    
                $id = 1;
                if ($this->uri->segment(3)) {
                    $id = $this->uri->segment(3) + 1;
                } else {
                    $id = 1;
                }   
                $exploded = explode('.', $data->pho_source);
                $img = $exploded['0'] . '_thumb.'.$exploded['1'];
                $image_properties = array('src' => site_url('user_uploads/thumbnail/thumb/' . $img), 'alt' => $data->pho_name, 'width' => '50', 'height' => '50', 'class' => 'style_img', 'title' => $data->pho_name);            
                ?>
                          
                            <td><?php echo img($image_properties); ?></td> 
                            <td><?php echo $data->pho_detail; ?></td>
                            <td><?php echo $data->pt_id; ?></td>
                             <td>
                                <?php
                                $uri = "";
                                echo
                                anchor('gallery/view_galleries/'.$data->photo_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                                anchor('gallery/edit_galleries/'.$data->photo_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('gallery/deletePhotoById/' . $data->photo_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                                
                                ?>
                            </td>


                        </tr>
                    <?php } ?><!-- -->
                    
                <?php
                } else {
                    echo '<tr><td colspan="12"><div class="alert alert-info bs-alert-old-docs">No data match for search!	</div></td></tr>';
                }
                ?>
            </table>  
     	</div>
            <ul class="pagination">
                <?php echo $pagination; ?>
            </ul>
            <?php 
            
			?>
            
