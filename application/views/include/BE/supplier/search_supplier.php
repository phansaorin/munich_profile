<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage</li>
</ol>

<div class="row">
                <div class="col-md-7 column search">
                    <?php
						if (isset($supplier_search_title))
							$searchsupplier = $supplier_search_title;
						else
							$searchsupplier = "";
						echo form_open("supplier/search_supplier", 'class="navbar-form navbar-left" role="search"');
						echo '<div class="form-group">';
						echo form_input(
								array('name' => 'search_supplier_name',
									'value' => set_value('search_name'),
									'class' => 'form-control input-sm',
									'placeholder' => 'Supplier Name'));
						echo '</div> &nbsp;';
						echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
					
						echo form_close();
					?>
                </div>
                <div class="col-md-5 column top-action">
                            <?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
								  echo anchor("supplier/deleteMultiSupplier","",'class="tdelete" style="display:none;"'); 
							?>
                            <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
								  echo anchor("supplier/deletePermenentSupplier", "", 'class="pdelete" style="display:none;"');
						    ?>
                            <?php echo anchor('supplier/add_supplier', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
      			</div>
</div>
<div class="container-fluid clearfix">
            <table class="table table-striped table-hover table-bordered">
            	
                <tr> 
                    <th width="3%"><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
                    <th><?php echo anchor("supplier/search_supplier/ID/" . $sort, "No"); ?></th>
                    <th><?php echo anchor("supplier/search_supplier/FName/" . $sort, "Supplier Name"); ?></th>
                    <th>Last Name</th>
                    <th>Company</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Moblie Phone</th>
                    <th>Action</th>
                    
                </tr>	
                <?php if ($search_supplier->num_rows > 0) { ?>
                  <?php foreach ($search_supplier->result() as $data) { ?>
                        <tr>
                            <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->sup_id
                                        ); 
                                ?>
                            </td>
                            <td><?php echo $data->sup_id; ?></td>
                            <td><?php echo $data->sup_fname; ?></td>
                            <td><?php echo $data->sup_lname; ?></td>
                            <td><?php echo $data->sup_company_name; ?></td>
                            <td><?php echo $data->sup_address; ?></td>
                            <td><?php echo $data->sup_country; ?></td>
                            <td><?php echo $data->sup_city; ?></td>
                            <td><?php echo $data->sup_email; ?></td>
                            <td><?php echo $data->sup_phone; ?></td>
                            <td>
                                <?php
                                $uri = "";
                                echo
                                anchor('supplier/view_supplier/'.$data->sup_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                    			anchor('supplier/edit_supplier/'.$data->sup_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('supplier/deleteSupplierById/' . $data->sup_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                                ;
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
            
            
            
