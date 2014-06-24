
    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li>Manage</li>
    </ol>
<div class="row">
    <div class="col-md-7 column search">
        <?php
         if (isset($classification_search_name))
             $searchclassification = $classification_search_name;
         else
             $searchclassification = "";
        echo form_open("classification/search_classification", 'class="navbar-form navbar-left" role="search"');
        
        echo '<div class="form-group">';
        echo form_input(
                array('name' => 'search_classification_name',
                    'value' => set_value('search_name'),
                    'class' => 'form-control input-sm',
                    'placeholder' => 'Classification Name'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "Search", "class" => "btn btn-primary btn-sm"));
        echo form_close();
        ?>
    </div>
    <div class="col-md-5 column top-action">
                    <?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
                           echo anchor("classification/deleteMultipleClassification","",'class="tdelete" style="display:none;"'); 
                    ?>
                    <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
                          echo anchor("classification/deletePermenentClassification", "", 'class="pdelete" style="display:none;"');
                    ?>
                    <?php echo anchor('classification/add_classification', 'Add New', 'class="btn btn-primary btn-sm"'); ?>

    </div>
</div>  
    <table class="table table-bordered">
        <tr> 
            <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
            <td><?php echo anchor("classification/list_record/ID/" . $sort, "No"); ?></td>
            <td><?php echo anchor("classification/list_record/Name/" . $sort, "Classification"); ?></td>
            <td>Action</td>
        </tr>
        <?php 
        if($search_classification->num_rows() > 0){
          foreach($search_classification->result() as $key => $data){
        ?>

        <tr>
            <td>
                                <?php echo form_checkbox(
                                    array('class' => 'check_checkbox',
                                          'id' => 'check_checkbox', 
                                          'name' => 'check_checkbox[]'
                                        ), 
                                          $data->clf_id
                                    ); 
                                ?>
                            </td>
            <td><?php echo $data->clf_id; ?></td>
            <td><?php echo $data->clf_name; ?></td>
            <td>
				<?php
                    $uri = "";
                    echo
                    anchor('classification/view_classification/'.$data->clf_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                    anchor('classification/edit_classification/'.$data->clf_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                    anchor('classification/deleteClassificationById/' . $data->clf_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
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