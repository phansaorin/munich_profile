
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
            <div class="form-group">
                    <?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
                           echo anchor("facilities/deleteMultipleFacilities","",'class="tdelete" style="display:none;"'); 
                    ?>
                    <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
                          echo anchor("facilities/deletePermenentFacilities", "", 'class="pdelete" style="display:none;"');
                    ?>
                    <?php echo anchor('facilities/add_facilities', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
            </div>

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
        <?php if ($search_facilities->num_rows > 0) { ?>
        <?php foreach ($search_facilities->result() as $data) { ?>
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
                anchor('facilities/edit_facilities/'.$data->facilities_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                anchor('facilities/deleteFacilitiesById/' . $data->facilities_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                ;
                ?>
            </td>            
        </tr>
        <?php 
		}
      	}
		else{
        	echo '<tr><td colspan="12"><div class="alert alert-info bs-alert-old-docs">No data match for search!	</div></td></tr>';
        }
         ?>	
       </table>
            <ul class="pagination">
                <?php echo $pagination; ?>
            </ul>