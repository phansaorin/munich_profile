<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage</li>
</ol>
<div>
  <div class="col-md-7 column search">
    <?php 
      if($this->session->userdata('search')){ $searchtitle = $this->session->userdata('searchMenu'); $this->session->unset_userdata('searchMenu'); }else{ $searchtitle = ""; }
      echo form_open("menu/search_menu", 'class="navbar-form navbar-left" role="search"');
      echo '<div class="form-group">';
      echo form_input(array("name"=>"search_title", "value" => set_value('searchtitle', $searchtitle), "class" => "form-control input-sm", "placeholder"=>"filter by title"));
      echo '</div> &nbsp;';
      echo form_submit(array("name"=>"submit_search","value" => "filter", "class"=>"btn btn-primary btn-sm"));
      echo form_close();
    ?>
  </div>
  <div class="col-md-5 column top-action">
  <button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
  <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
  <?php echo anchor('menu/delete_multi','', 'class="error tdelete"'); ?> 
  <?php echo anchor('menu/delete_permanent','', 'class="error pdelete"'); ?>   
  <?php echo anchor('menu/add_menu','Add New', 'class="btn btn-primary btn-sm"'); ?>
  </div>
</div>
<div class="container-fluid clearfix">
    <table class="table table-striped table-hover table-bordered">
        <tr> 
            <th width="3%"><input type="checkbox" name="checkbox_all" id="checkbox_all"></th>
            <th><?php echo anchor("menu/list_record/ID/".$sort, "ID"); ?></th>
            <th><?php echo anchor("menu/list_record/Title/".$sort, "Title"); ?></th>
            <th>Alaise</th>
            <th>Menum Parent</th>
            <th>Menum Position</th>
            <th width="10%">Action</th>           
        </tr>
<?php 
if($menu_record->num_rows() > 0){
  foreach($menu_record->result() as $key => $value){
?>
        <tr>
          <td><?php echo form_checkbox(array('class' => 'check_checkbox', 'id' => 'check_checkbox', 'name' => 'check_checkbox[]'), $value->menu_id); ?></td>
          <td><?php echo $value->menu_id; ?></td>
          <td><?php echo $value->menu_title; ?></td>
          <td><?php echo $value->menu_aliase; ?></td>
          <td>
            <?php
              $menu_parent = $value->menu_aliase;
                if($value->menu_menu_id != NULL){
                  $submenuone = $this->db->select("*")->where('menu_status', 1)->where('menu_delete', 0)->where("menu_id", $value->menu_menu_id)->get('menu');
                  if($submenuone->num_rows() > 0){
                    foreach($submenuone->result() as $keyone => $valueone){
                      $menu_parent = $valueone->menu_aliase."/".$menu_parent;
                      if($valueone->menu_menu_id != NULL){
                        $submenutwo = $this->db->select("*")->where('menu_status', 1)->where('menu_delete', 0)->where("menu_id", $valueone->menu_menu_id)->get('menu');
                        if($submenutwo->num_rows() > 0){
                          foreach($submenutwo->result() as $valuetwo){
                            $menu_parent = $valuetwo->menu_aliase."/".$menu_parent;
                          }
                        }
                      }
                    }
                  }
                }
              echo "/".$menu_parent; 
            ?>
          </td>
          <td><?php echo $value->menu_position; ?></td>
          <td>
            <?php
              $status = '';
              $uri = "";
              if($this->uri->segment(3))  $uri = $this->uri->segment(3); 
              if($this->uri->segment(4)) $uri .= '/'.$this->uri->segment(4);
              if($this->uri->segment(5)) $uri .= '/'.$this->uri->segment(5);
              if ($value->menu_status == 1) {
                  $status = anchor('menu/status_menu/' . $value->menu_status . '/' . $value->menu_id.'/'.$uri, '<span class="icon-ok"></span>', 'title="Dispublished" data-toggle="tooltip" id="tooltip"');
              } else if ($value->menu_status == 0) {
                  $status = anchor('menu/status_menu/' . $value->menu_status . '/' . $value->menu_id.'/'.$uri, '<span class="icon-minus-sign"></span>', 'title="Published" data-toggle="tooltip" id="tooltip"');
              }
              echo $status . ' | ' . anchor('menu/edit_menu/' . $value->menu_id . '/' . $value->menu_menu_id, '<span class="icon-edit"></span>', 'title="Edit" data-toggle="tooltip" id="tooltip"') . ' | ' . anchor('menu/deleteById/'. $value->menu_id.'/'.$uri, '<span class="icon-remove"></span>', 'title="Delete" onclick="return confirm(\'Are you sure want to delete?\');" data-toggle="tooltip" id="tooltip"');
              ?>
          </td>
        </tr>
<?php
  }
}else{
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