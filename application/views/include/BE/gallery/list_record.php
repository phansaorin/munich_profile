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
<div>
  <div class="col-md-8 column search">
        <?php
      if(isset($search_photo_name)) $searchtitle = $search_photo_name; 
        else $searchtitle = "";
        echo form_open("gallery/search_galleries", 'class="navbar-form navbar-left" role="search"');
        echo '<div class="form-group">';
        echo form_input(
                array('name' => 'search_name',
                    'value' => set_value('search_name'),
                    'class' => 'form-control input-sm',
                    'placeholder' => 'Search Name'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
	
        echo form_close();
        ?>

    </div>
        <div class="col-md-4 column top-action">
                    <form role="search">
                        <div class="form-group">
                            <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
                            echo anchor("gallery/deletePhotoPermenent", "", 'class="pdelete" style="display:none;"');
                            ?>
                        	<?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
                                 echo anchor("gallery/deletePhotoMultiple","",'class="tdelete" style="display:none;"'); 
                              ?>
                            <?php echo anchor('gallery/add_galleries', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
                     
                            
                            </div>
                    </form>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <tr> 
                    <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
                    <td><?php echo anchor("gallery/list_record/ID/" . $sort, "No"); ?></td>
                    <td><?php echo anchor("gallery/list_record/Name/" . $sort, "Name"); ?></td>
                    <td>Image</td>
                    <td>Detail</td>
                    <td>Photo Type</td>
                    <td>Action</td>
                </tr>	
                <?php if ($galleries ->num_rows > 0) { 
                    ?>

                  <?php foreach ($galleries->result() as $data) { 

                // $exploded = explode('.', $data->photo_source);
                // $img = $exploded['0'] . '.' . $exploded['1'];
                // $image_properties = array('src' => site_url('assets/img/uploads' . $img), 'alt' => $data->photo_source, 'width' => '50', 'height' => '50', 'class' => 'style_img', 'title' => $data->photo_source);
                ?>
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
                $image_properties = array('src' => site_url('user_uploads/thumbnail/thumb/' . $img), 'alt' => $data->pho_name, 'class' => 'style_img', 'title' => $data->pho_name);            
                ?>
                          
                            <td><?php echo img($image_properties); ?></td>  
                            <td><?php echo $data->pho_detail; ?></td>
                            <td><?php $type = $data->pt_title; echo $type;?></td>
                            <td>
                                <?php

                                $status = '';
                                $uri = "";
                                  if($this->uri->segment(3)) $uri .= $this->uri->segment(3); 
                                  if($this->uri->segment(4)) $uri .= '/'.$this->uri->segment(4);
                                  if($this->uri->segment(5)) $uri .= '/'.$this->uri->segment(5);
                                  if ($data->pho_status == 1) {
                                      $status = anchor('gallery/status_gallery/' . $data->pho_status . '/' . $data->photo_id.'/'.$uri, '<span class="icon-ok"></span>', 'title="published" data-toggle="tooltip" id="tooltip"');
                                  } else if ($data->pho_status == 0) {
                                      $status = anchor('gallery/status_gallery/' . $data->pho_status . '/' . $data->photo_id.'/'.$uri, '<span class="icon-minus-sign"></span>', 'title="Unpublished" data-toggle="tooltip" id="tooltip"');
                                  }
                                  echo $status . ' | '.

                                 anchor('gallery/view_galleries/'.$data->photo_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
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
            
