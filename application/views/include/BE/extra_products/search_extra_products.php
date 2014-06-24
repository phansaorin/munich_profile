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
    <div class="row clearfix">
                <div class="col-md-6 column search">
                    <?php
						if (isset($extra_products_search_title))
							$searchextra_products = $extra_products_search_title;
						else
							$searchextra_products = "";
						echo form_open("extra_products/search_extra_products", 'class="navbar-form navbar-left" role="search"');
						echo '<div class="form-group">';
						echo form_input(
								array('name' => 'search_extra_products_name',
									'value' => set_value('search_name'),
									'class' => 'form-control input-sm',
									'placeholder' => 'Extra Products Name'));
						echo '</div> &nbsp;';
						echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
					
						echo form_close();
					?>

                </div>

                <div class="col-md-6 column top-action">
                        <div class="form-group">
                        	<div class="btn-group">							
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Export as PDF
                                    <span class="caret"></span>
                                </button>
                                 <ul class="dropdown-menu" role="menu">
                                     <li><?php echo anchor ('extra_products/exportPDF/'.$this->uri->segment(2),'Export all Data','title="Print"');?></li>
                                     <li><?php echo anchor ('extra_products/exportByPagePDF/'.$this->uri->segment(2),'Export data for this page','title="Print"');?></li>
                                </ul>
                            </div>
							<div class="btn-group">						
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Export as Excel
                                    <span class="caret"></span>
                                </button>
                                 <ul class="dropdown-menu" role="menu">
                                     <li><?php echo anchor ('extra_products/exportExcel/'.$this->uri->segment(2),'Export all Data','title="Print"');?></li>                                                                     
                                     <li><?php echo anchor ('extra_products/exportByPageExcel/'.$this->uri->segment(2),'Export data for this page','title="Print" class="error check_excel_print"');?></li>
                                
                                </ul>
                            </div>
                        
                        	<button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
                            <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
                            <?php echo anchor('extra_products/deletePermenentExtraproducts','','class="error pdelete"'); ?>
							<?php echo anchor('extra_products/deleteMultiExtraproducts','','class="error tdelete"'); ?>
                            <?php echo anchor('extra_products/add_extra_products', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
                     </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered" >
            	
                <tr> 
                    <th><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
                    <th><?php echo anchor("extra_products/search_extra_products/ID/" . $sort, "No"); ?></th>
                    <th><?php echo anchor("extra_products/search_extra_products/Name/" . $sort, "Name"); ?></th>
                    <th>Per Person</th>
                    <th><?php echo anchor("extra_products/search_extra_products/Providerdate/" . $sort, "Provider Date"); ?></td>
                    <th><?php echo anchor("extra_products/search_extra_products/Payeddate/" . $sort, "Paid Date"); ?></th>
                    <th>Purchase Price ($)</th>
                    <th>Sale Price ($)</th>
                    <th>Original Stock</th>
                    <th>Actual Stock</th>
                    <th>Action</th>
                </tr>	
                <?php if ($search_extra_products->num_rows > 0) { ?>
                  <?php foreach ($search_extra_products->result() as $data) { ?>
                        <tr>
                            <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->ep_id
                                        ); 
                                ?>
                            </td>
                            <td><?php echo $data->ep_id; ?></td>
                            <td><?php echo $data->ep_name; ?></td>
                            <?php $item = $data->ep_perperson; ?>
                            <?php if ($item == 1) { ?>
                                    <td><?php echo "yes"; ?></td>
                            <?php } elseif ($item == 0) { ?>
                                    <td><?php echo "no"; ?></td>
                            <?php } ?>
                            <td><?php echo $data->ep_providerdate; ?></td>
                            <td><?php echo $data->ep_payeddate; ?></td>
                            <td><?php echo $data->ep_purchaseprice; ?></td>
                            <td><?php echo $data->ep_saleprice; ?></td>
                            <td><?php echo $data->ep_originalstock; ?></td>
                            <td><?php echo $data->ep_actualstock; ?></td>
                            <td>
                                <?php
                                $uri = "";
                                echo
                                anchor('extra_products/view_extra_products/'.$data->ep_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                    			anchor('extra_products/edit_extra_products/'.$data->ep_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('extra_products/deleteExtraproductsById/' . $data->ep_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
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
            
            
            
