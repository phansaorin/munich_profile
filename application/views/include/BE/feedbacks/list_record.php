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
  <div class="col-md-7 column search">
        <?php
        if(isset($search_photo_name)) $searchtitle = $search_photo_name; 
        else $searchtitle = "";
        echo form_open("feedbacks/search_feedback", 'class="navbar-form navbar-left" role="search"');
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
    <div class="col-md-5 column top-action">
                        <div class="form-group">
                            <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
                           echo anchor("feedbacks/deletePermenentFeedback", "", 'class="pdelete" style="display:none;"');
                           ?>
                        	<?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
                                 echo anchor("feedbacks/deleteFeedbackMultiple","",'class="tdelete" style="display:none;"'); 
                              ?>
                            <?php echo anchor('feedbacks/add_feedback', 'Add New', 'class="btn btn-primary btn-sm"'); ?>                 
                            </div>
    </div>
</div>
                <table class="table table-striped table-hover table-bordered">
                <tr> 
                    <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
                    <td><?php echo anchor("feedbacks/list_record/ID/" . $sort, "No"); ?></td>
                    <td><?php echo anchor("feedbacks/list_record/Name/" . $sort, "Name"); ?></td>
                    <td>Email</td>
                    <td>Subject</td>
                    <td>Text</td>
                    <td>Action</td>
                </tr>	
                <?php if ($show_feedback ->num_rows > 0) { ?>
                     <?php foreach ($show_feedback->result() as $data) {  ?>
                <tr>
                      <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->fb_id
                                        ); 
                                ?>
                            </td>
                            <td><?php echo $data->fb_id; ?></td>
                            <td><?php echo $data->fb_name; ?></td>
                            <td><?php echo $data->fb_email; ?></td>
                            <td><?php echo $data->fb_subject; ?></td> 
                            <td><?php echo $data->fb_text; ?></td>
                            <td>
                                <?php
                                $uri = "";
                                echo
                                anchor('feedbacks/view_feedback/'.$data->fb_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                    			anchor('feedbacks/edit_feedback/'.$data->fb_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('feedbacks/deleteFeedbackByID/' . $data->fb_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                                
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
            <ul class="pagination">
                <?php echo $pagination; ?>
            </ul>
            <?php 
            
			?>
            
