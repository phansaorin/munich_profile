<div class="col-md-12 column">
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

</div>
<div class="row">
    <div class="col-md-12 column">
    <div class="col-md-7 column">
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
    <div class="col-md-5 column">
        	<form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <?php echo form_button('btnDeleteMulti', 'Delete', 'class="btn btn-primary btn-sm multi_delete"'); 
                           echo anchor("classification/deleteMultipleClassification","",'class="tdelete" style="display:none;"'); 
                    ?>
                    <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
                          echo anchor("classification/deletePermenentClassification", "", 'class="pdelete" style="display:none;"');
                    ?>
                    <?php echo anchor('classification/add_classification', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
                </div>
            </form>

    </div>
    </div>
</div>
<div class="col-md-12 column">
            <table class="table table-bordered">
                <tr> 
                    <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
                    <td><?php echo anchor("classification/list_classification/ID/" . $sort, "No"); ?></td>
                    <td><?php echo anchor("classification/list_classification/Name/" . $sort, "Classification Name"); ?></td>
                    <td><?php echo anchor("classification/list_classification/Value/" . $sort, "Classification Value"); ?></td>
                    <td>Action</td>
                </tr>	
                <?php if ($getAllClassification->num_rows > 0) { ?>
                  <?php foreach ($getAllClassification->result() as $data) { ?>
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
                            <td><?php echo $data->clf_value; ?></td>
                            <td>
                                <?php
                                $uri = "";
                                echo
                                anchor('classification/view_classification/'.$data->clf_id.'/'.$uri, '<span class="icon-eye-open"></span>') . '|' .
                    			anchor('classification/edit_classificaion/'.$data->clf_id.'/'.$uri, '<span class="icon-edit"></span>') . '|' .
                                anchor('classification/deleteClassificationById/' . $data->clf_id . '/' . $uri, '<span class="icon-trash"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                                ;
                                ?>
                            </td>
                        </tr>
                    <?php } ?><!-- -->
                <?php
                } else {
                    echo "don't have data";
                }
                ?>
            </table> 
            <ul class="pagination">
                <?php echo $pagination; ?>
            </ul>
</div>



