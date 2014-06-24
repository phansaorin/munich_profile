<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage</li>
</ol>
<div>
  <div class="col-md-7 column search">
    <?php 
      if($this->session->userdata('search')){ $searchtitle = $this->session->userdata('search'); $this->session->unset_userdata('search'); }else{ $searchtitle = ""; }
      echo form_open("content/search_content", 'class="navbar-form navbar-left" role="search"');
      echo '<div class="form-group">';
      echo form_input(array("name"=>"search_title", "value" => set_value('searchtitle', $searchtitle), "class" => "form-control input-sm", "placeholder"=>"filter by title"));
      echo '</div> &nbsp;';
      echo form_submit(array("name"=>"submit_search","value" => "filter", "class"=>"btn btn-primary btn-sm"));
      echo form_close();
    ?>
  </div>
  <div class="col-md-5 column top-action">
  <!-- <button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button> -->
  <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
  <?php echo anchor('content/delete_multi','', 'class="error tdelete"'); ?> 
  <?php //echo anchor('content/delete_permanent','', 'class="error pdelete"'); ?>   
  <?php echo form_button('btnDeletePermenent', 'Remove Permenent', 'class="btn btn-primary btn-sm perm_delete"');
      echo anchor("content/delete_permanent", "", 'class="pdelete" style="display:none;"');
  ?>
  <?php echo anchor('content/add_content','Add New', 'class="btn btn-primary btn-sm"'); ?>
  </div>
</div>
<div class="container-fluid clearfix">
    <table class="table table-striped table-hover table-bordered">
        <tr> 
            <th width="3%"><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
            <th><?php echo anchor("content/list_record/ID/".$sort, "ID"); ?></th>
            <th><?php echo anchor("content/list_record/Title/".$sort, "Title"); ?></th>
            <th>Text</th>
            <th>Layout</th>
            <th width="10%">Action</th>           
        </tr>
<?php 
if($content_record->num_rows() > 0){
    foreach($content_record->result() as $key => $value){
?>
        <tr>
          <td><?php echo form_checkbox(array('class' => 'check_checkbox', 'id' => 'check_checkbox', 'name' => 'check_checkbox[]'), $value->con_id); ?></td>
          <td><?php echo $value->con_id; ?></td>
          <td><?php echo character_limiter($value->con_title, 20); ?></td>
          <td><?php echo character_limiter($value->con_text, 50)?></td>
          <td><?php echo $value->con_template; ?></td>
          <td>
            <?php
              $status = '';
              $uri = "";
              if($this->uri->segment(3))  $uri = $this->uri->segment(3); 
              if($this->uri->segment(4)) $uri .= '/'.$this->uri->segment(4);
              if($this->uri->segment(5)) $uri .= '/'.$this->uri->segment(5);
              if ($value->con_status == 1) {
                  $status = anchor('content/status_content/' . $value->con_status . '/' . $value->con_id.'/'.$uri, '<span class="icon-ok"></span>', 'title="published" data-toggle="tooltip" id="tooltip"');
              } else if ($value->con_status == 0) {
                  $status = anchor('content/status_content/' . $value->con_status . '/' . $value->con_id.'/'.$uri, '<span class="icon-minus-sign"></span>', 'title="Unpublished" data-toggle="tooltip" id="tooltip"');
              }
              echo $status . ' | '.anchor('content/view_content/'. $value->con_id, '<span class="icon-eye-open"></span>', 'title="View" data-toggle="tooltip" id="tooltip"').' | '. anchor('content/edit_content/' . $value->con_id . '/' . $value->con_menu_id, '<span class="icon-edit"></span>', 'title="Edit" data-toggle="tooltip" id="tooltip"') . ' | ' . anchor('content/deleteById/'. $value->con_id.'/'.$uri, '<span class="icon-remove"></span>', 'title="Delete" onclick="return confirm(\'Are you sure want to delete?\');" data-toggle="tooltip" id="tooltip"');
            ?>
          </td>
        </tr>
<?php
  }
}else{
  if($this->uri->segment(3)){
    if(is_numeric($this->uri->segment(3))){
      redirect("content/list_record/");
    }elseif($this->uri->segment(5)){
      redirect("content/list_record/");
    }
  }
  echo "<tbody><tr><td colspan='6'>";
  echo "There is not record was found...";
  echo "</td></tr></tbody>";
}
?>
    </table>
</div>
<ul class="pagination">
  <?php echo $pagination; ?>
</ul>