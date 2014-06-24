
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage</li>
</ol>
   <div class="row">
                <div class="col-md-7 column search">
                    <?php
						if (isset($passengerTItle))
							$searchPassengers = $passengerTItle;
						else
							$searchPassengers = "";
						echo form_open("passenger/search_passenger", 'class="navbar-form navbar-left" role="search"');
						echo '<div class="form-group">';
						echo form_input(
								array('name' => 'searchPassengerName',
									'value' => set_value('search_name'),
									'class' => 'form-control input-sm',
									'placeholder' => 'Passenger Name'));
						echo '</div> &nbsp;';
						echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
						echo form_close();
					?>
                </div>

                <div class="col-md-5 column top-action">
                            <?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
								  echo anchor("passenger/deletePassengerMultiple","",'class="tdelete" style="display:none;"'); 
							?>
                            <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
								  echo anchor("passenger/deletePassengerPermenent", "", 'class="pdelete" style="display:none;"');
						    ?>
                            <?php echo anchor('passenger/add_passenger', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
                </div>
            </div>

            <table class="table table-striped table-hover table-bordered">
                <tr> 
                    <th><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
                    <th><?php echo anchor("passenger/list_record/ID/" . $sort, "No"); ?></th>
                    <th><?php echo anchor("passenger/list_record/FName/" . $sort, "First Name"); ?></th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Company</th>
                    <th>Gender</th>
                    <th>Action</th>
                   
                </tr>
                <?php if ($search_passenger->num_rows > 0) { ?>
                  <?php foreach ($search_passenger->result() as $data) { ?>
                        <tr>
                            <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->pass_id
                                        ); 
                                ?>
                            </td>
                            <td><?php echo $data->pass_id; ?></td>
                            <td><?php echo $data->pass_fname; ?></td>
                            <td><?php echo $data->pass_lname; ?></td>
                            <td><?php echo $data->pass_email; ?></td>
                            <td><?php echo $data->pass_phone; ?></td>
                            <td><?php echo $data->pass_address; ?></td>
                            <td><?php echo $data->pass_company; ?></td>
                            <td><?php echo $data->pass_gender; ?></td>
    
                            <td>
								<?php
                                $uri = "";
                                echo
                                anchor('passenger/view_passenger/'.$data->pass_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                                anchor('passenger/edit_passenger/'.$data->pass_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('passenger/deletePassengerById/' . $data->pass_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"') ;
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
</div>
