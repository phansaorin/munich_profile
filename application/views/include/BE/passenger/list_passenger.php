
<?php
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
<div class="col-md-12 column">
    <h4>Manage Passengers</h4>
</div>
    <div>
            <div class="col-md-12 column">
                <div class="col-md-5 column">
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

                <div class="col-md-7 column">
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                        	<button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
                            <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
                            <?php echo anchor('passenger/deletePassengerPermenent','','class="error pdelete"'); ?>
							<?php echo anchor('passenger/deletePassengerMultiple','','class="error tdelete"'); ?>
                            <?php echo anchor('passenger/add_passenger', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
                     </div>
                    </form>
                </div>
            </div>

            <table class="table table-striped">
                <tr> 
                    <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
                    <td><?php echo anchor("passenger/list_passenger/ID/" . $sort, "No"); ?></td>
                    <td><?php echo anchor("passenger/list_passenger/FName/" . $sort, "First Name"); ?></td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td>Company</td>
                    <td>Gender</td>
                    <td>Action</td>
                   
                </tr>	
                <?php if ($passenger->num_rows > 0) { ?>
                  <?php foreach ($passenger->result() as $data) { ?>
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
                                anchor('passenger/view_passenger/'.$data->pass_id.'/'.$uri, 'view') . '|' .
                                anchor('passenger/edit_passenger/'.$data->pass_id.'/'.$uri, 'edit') . '|' .
                                anchor('passenger/deletePassengerById/' . $data->pass_id . '/' . $uri, 'delete', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"') ;
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
