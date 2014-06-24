
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
         if (isset($facilities_search_name))
             $searchfacilities = $facilities_search_name;
         else
             $searchfacilities = "";
        echo form_open("facilities/search_facilities", 'class="navbar-form navbar-left" role="search"');
        
        echo '<div class="form-group">';
        echo form_input(
                array('name' => 'search_facilities_name',
                    'value' => set_value('search_name'),
                    'class' => 'form-control input-sm',
                    'placeholder' => 'Facilities Name'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
        echo form_close();
        ?>
    </div>
    <div class="col-md-5 column top-action">
                    <?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
                           echo anchor("facilities/deleteMultipleFacilities","",'class="tdelete" style="display:none;"'); 
                    ?>
                    <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
                          echo anchor("facilities/deletePermenentFacilities", "", 'class="pdelete" style="display:none;"');
                    ?>
                    <?php 
                      echo form_button('', 'Add New','class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"');
                    ?>
    </div>
</div>
            <table class="table table-striped table-hover table-bordered">
                <tr> 
                    <th><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
                    <th><?php echo anchor("facilities/list_record/ID/" . $sort, "No"); ?></th>
                    <th><?php echo anchor("facilities/list_record/Title/" . $sort, "Facilities"); ?></th>
                    <th>Facilities Value</th>
                    <th>Action</th>
                </tr>	
                <?php if ($getAllFacilities->num_rows > 0) { ?>
                  <?php foreach ($getAllFacilities->result() as $data) { ?>
                        <tr>
                        	<td>
                        		<?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->facilities_id
                                    ); 
                                ?>
                        	</td>
                            <td><?php echo $data->facilities_id; ?></td>
                            <td><?php echo $data->facilities_title; ?></td>
                            <td><?php echo $data->facilities_value; ?></td>
                            <td>
                                <?php
                                $uri = "";
                                echo anchor('facilities/view_facilities/'.$data->facilities_id.'/'.$uri, '<span class="icon-eye-open"></span>')  . '|' .
                    			      anchor('facilities/edit_facilities/'.$data->facilities_id.'/'.$uri, '<span class="icon-edit"></span>')  . '|' .
                                anchor('facilities/deleteFacilitiesById/' . $data->facilities_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                                ;
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php
                } else {
                    echo "don't have data";
                }
                ?>
            </table> 
            <ul class="pagination">
                <?php echo $pagination; ?>
            </ul>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add facilities</h4>
      </div>
      <div class="modal-body">
        <?php  echo form_open_multipart('facilities/add_facilities', 'class="form-horizontal add_location"'); ?>
        <div class="form-group">
            <label class="col-sm-4 control-label">Facilities Name <span class="require">*</span> :</label>
            <div class="col-sm-7">
                <?php
                    $facilitiesName = array('name' => 'facilitiesName','value'=> set_value('facilitiesName'),'class' => 'form-control');
                    echo form_input($facilitiesName);
                ?>
                <span style="color:red;"><?php echo form_error('facilitiesName'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Facilities Value <span class="require">*</span> :</label>
            <div class="col-sm-7">
                <?php
                    $facilitiesValue = array('name' => 'facilitiesValue','value'=> set_value('facilitiesValue'),'class' => 'form-control');
                    echo form_input($facilitiesValue);
                ?>
                <span style="color:red;"><?php echo form_error('facilitiesValue'); ?></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <?php 
          echo form_submit('addFacilities', 'Add',"class='btn btn-primary check_value'");
        ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <p style="display:none; color:red">Some Field is wrong!... Please check Data Again before you submit.</p>
      </div>
      <?php echo form_close();?>
    </div>
  </div>
</div>






