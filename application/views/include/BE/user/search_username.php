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
    <div class="col-md-8 column search">
        <?php
      if(isset($search_user_name)) $searchtitle = $search_user_name; 
        else $searchtitle = "";
        echo form_open("user/search_username", 'class="navbar-form navbar-left" role="search"');
        echo '<div class="form-group">';
        echo form_input(
                array('name' => 'search_name',
                    'value' => set_value('search_name'),
                    'class' => 'form-control input-sm',
                    'placeholder' => 'User Name'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm")).nbs(3);;
         echo anchor("user/list_record","Back to list", 'class="btn btn-default btn-sm"');
	
        echo form_close();
        ?>
   </div>
        <div class="col-md-4 column top-action">
             <form role="search">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
                            <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
                            <?php echo anchor('user/deletePermenentUser','','class="error pdelete"'); ?>
                            <?php echo anchor('user/deleteUserMultiple','','class="error tdelete"'); ?>
                            <?php echo anchor('user/add_user', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
                        </div>
                    </form>
        </div>
</div>
        <div class="container-fluid clearfix">
                <table class="table table-striped table-hover table-bordered">
                <tr> 
                    <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
                    <td><?php echo anchor("user/list_record/ID/" . $sort, "No"); ?></td>
                    <td><?php echo anchor("user/list_record/Name/" . $sort, "User Name"); ?></td>
                    <td>Gender</td>
                    <td>Email</td>
                    <td>Phone Number</td>
                    <td>Position</td>
                    <td>Address</td>
                    <td>Company</td>
                    <td>Action</td>
                </tr>	
                <?php if ($users->num_rows > 0) { ?>
                  <?php foreach ($users->result() as $data) { ?>
                        <tr>
                            <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->user_id
                                        ); 
                                ?>
                            </td>
                            <td><?php echo $data->user_id; ?></td>
                            <td><?php echo $data->user_name; ?></td> 
                             <td><?php echo $data->user_gender; ?></td>                
                            <td><?php echo $data->user_mail; ?></td>
                            <td><?php echo $data->user_telone; ?></td>
                            <td><?php  $position = $data->role_id;
                            if($position == 1){
                            	echo "Admin";
                            }elseif($position == 2){
                            	echo "Simple";
                            }

                            ?></td>
                            <td><?php echo $data->user_address; ?></td>
                            <td><?php echo $data->user_company; ?></td>
                             <td>
                                <?php
                                $uri = "";
                                echo
                                anchor('user/view_user/'.$data->user_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                                anchor('user/edit_user/'.$data->user_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('user/deleteUserById/' . $data->user_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                                
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
            <?php 
            
			?>
            
 