<div class="col-md-12 column">
    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li>Manage</li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12 column">
    <div class="col-md-7 column">
        <?php
             if (isset($location_search_name))
                 $searchlocation = $location_search_name;
             else
                 $searchlocation = "";
            echo form_open("location/search_location", 'class="navbar-form navbar-left" role="search"');
            
            echo '<div class="form-group">';
            echo form_input(
                    array('name' => 'search_location_name',
                        'value' => set_value('search_name'),
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Location Name'));
            echo '</div> &nbsp;';
            echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
            echo form_close();
        ?>
    </div>
    <div class="col-md-5 column">
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
                    <?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
                           echo anchor("location/deleteMultipleLocation","",'class="tdelete" style="display:none;"'); 
                    ?>
                    <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
                          echo anchor("location/deletePermenentLocation", "", 'class="pdelete" style="display:none;"');
                    ?>
                    <?php 
                      echo form_button('', 'Add New','class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"');
                    ?>
            </div>
        </form>

    </div>
    </div>
</div>
<div class="col-md-12 column">  
    <table class="table table-striped table-hover table-bordered">
        <tr> 
            <th><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
            <th><?php echo anchor("location/list_record/ID/" . $sort, "No"); ?></th>
            <th><?php echo anchor("location/list_record/Name/" . $sort, "Locations"); ?></th>
            <th>Action</th>
        </tr>
        <?php 
        if($search_location->num_rows() > 0){
          foreach($search_location->result() as $key => $data){
        ?>

        <tr>
            <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->lt_id
                                    ); 
                                ?>
                            </td>
            <td><?php echo $data->lt_id; ?></td>
            <td><?php echo $data->lt_name; ?></td>
            <td>
                <?php
                    $uri = "";
                    echo
                    anchor('location/view_location/'.$data->lt_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                    anchor('location/edit_location/'.$data->lt_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                    anchor('location/deleteLocationById/' . $data->lt_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                    ;
                ?>
            </td>             
        
        </tr>
        <?php 
        }
        }
        else{
            echo '<tr><td colspan="12"><div class="alert alert-info bs-alert-old-docs">No data match for search!    </div></td></tr>';
        }
         ?> 
       </table>
            <ul class="pagination">
                <?php echo $pagination; ?>
            </ul>
</div>

<!-- add new in search -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Location</h4>
      </div>
      <div class="modal-body">
        <?php  echo form_open_multipart('location/add_location', 'class="form-horizontal add_location"'); ?>
              <div class="form-group">
                  <label class="col-sm-4 control-label">Location Name <span class="require">*</span> :</label>
                  <div class="col-sm-7">
                      <?php
                          $locationName = array('name' => 'locationName','value'=> set_value('locationName'),'class' => 'form-control');
                          echo form_input($locationName);
                      ?>
                      <span style="color:red;"><?php echo form_error('locationName'); ?></span>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                      <?php 
                          echo form_submit('addLocation', 'Add',"class='btn btn-primary check_value'");
                     ?>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <p style="display:none; color:red">Some Field is wrong!... Please check Data Again before you submit.</p>
                  </div>
              </div>
          </div>
                      <?php
          echo form_close();?>
    </div>
  </div>
</div>





