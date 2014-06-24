
<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage</li>
</ol>
    <div class="row">
                <div class="col-md-7 column search">
                    <div class="btn-group">
                        <?php
                        if (isset($subscriberTItle))
                            $searchSubscribers = $subscriberTItle;
                        else
                            $searchSubscribers = "";
                        echo form_open("subscribers/search_subscribers", 'class="navbar-form navbar-left" role="search"');
                        echo '<div class="form-group">';
                        echo form_input(
                                array('name' => 'searchSubscribersName',
                                    'value' => set_value('search_name'),
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'Subscribers Name'));
                        echo '</div> &nbsp;';
                        echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
                        echo form_close();
                        ?>
                    </div>
                </div>

                <div class="col-md-5 column top-action">
                    <div class="form-group">
                        	<button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
                            <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
                            <?php echo anchor('subscribers/deleteSubscriberPermenent','','class="error pdelete"'); ?>
			    <?php echo anchor('subscribers/deleteSubscriberMultiple','','class="error tdelete"'); ?>
                            <?php echo anchor('subscribers/sendEmail', 'Send Email', 'class="btn btn-primary btn-sm"'); ?>
                    
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover table-bordered">
                <tr> 
                    <th><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
                    <th><?php echo anchor("subscribers/list_record/ID/" . $sort, "No"); ?></th>
                    <th><?php echo anchor("subscribers/list_record/FName/" . $sort, "First Name"); ?></th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
                   
                </tr>	
                <?php if ($subscriber->num_rows > 0) { ?>
                  <?php foreach ($subscriber->result() as $data) { ?>
                        <tr>
                          <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->sub_id
                                        ); 
                                ?>
                            </td>
                            <td><?php echo $data->sub_id ; ?></td>
                            <td><?php echo $data->sub_fname ; ?></td>
                            <td><?php echo $data->sub_lname ; ?></td>
                            <td><?php echo $data->sub_email ; ?></td>                            
                            <td>
								<?php
                                $uri = "";
								$status = '';
								if ($data->sub_status == 1) {
										$status = anchor('subscribers/status_subscribers/' . $data->sub_status . '/' . $data->sub_id, '<span class="icon-ok"></span>', 'title="Published"');
								} else if ($data->sub_status == 0) {
										$status = anchor('subscribers/status_subscribers/' . $data->sub_status . '/' . $data->sub_id , '<span class="icon-minus-sign"></span>', 'title="Unpublish"');
								}
                                echo
                                anchor('subscribers/view_subscribers/'.$data->sub_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                                anchor('subscribers/edit_subscribers/'.$data->sub_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('subscribers/deleteSubscriberById/' . $data->sub_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"').'|'.$status; 
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
