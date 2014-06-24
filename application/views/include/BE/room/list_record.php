
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
                        if (isset($roomTItle))
                            $searchRooms = $roomTItle;
                        else
                            $searchRooms = "";
                        echo form_open("room/search_room", 'class="navbar-form navbar-left" role="search"');
                        echo '<div class="form-group">';
                        echo form_input(
                                array('name' => 'searchRoomName',
                                    'value' => set_value('search_name'),
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'Room Name'));
                        echo '</div> &nbsp;';
                        echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
                        echo form_close();
                        ?>
                </div>

                <div class="col-md-5 column top-action">
                    <?php 
                        echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
                        echo anchor("room/deleteRoomMultiple","",'class="tdelete" style="display:none;"'); 
                    ?>
                    <?php 
                        echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
                        echo anchor("room/deleteRoomPermenent", "", 'class="pdelete" style="display:none;"');
                    ?>
                    <?php 
                        echo anchor('room/add_room', 'Add New', 'class="btn btn-primary btn-sm"'); 
                    ?>
                </div>
</div>

            <table class="table table-striped table-hover table-bordered">
                <tr> 
                    <th><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
                    <th><?php echo anchor("room/list_record/ID/" . $sort, "No"); ?></th>
                    <th><?php echo anchor("room/list_record/Name/" . $sort, "Room Name"); ?></th>
                    <th>Action</th>
                   
                </tr>	
                <?php if ($room->num_rows > 0) { ?>
                  <?php foreach ($room->result() as $data) { ?>
                        <tr>
                          <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->rt_id
                                        ); 
                                ?>
                            </td>
                            <td><?php echo $data->rt_id; ?></td>
                            <td><?php echo $data->rt_name; ?></td>
                            <td>
								<?php
								
								$uri = "";
								$status = '';
								if ($data->rt_status == 1) {
										$status = anchor('room/status_room/' . $data->rt_status . '/' . $data->rt_id, '<span class="icon-ok"></span>', 'title="Published"');
								} else if ($data->rt_status == 0) {
										$status = anchor('room/status_room/' . $data->rt_status . '/' . $data->rt_id , '<span class="icon-minus-sign"></span>', 'title="Unpublish"');
								}
                                echo
								
                                anchor('room/view_room/'.$data->rt_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|'.
                                anchor('room/edit_room/'.$data->rt_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('room/deleteRoomById/' . $data->rt_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"').'|'.$status;
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

