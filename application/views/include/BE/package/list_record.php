<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage Packages</li>
</ol>
<?php 
  if($this->session->userdata('search_package')) $this->session->unset_userdata('search_package');
  if($this->session->userdata('msg_success')){
?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <?php echo $this->session->userdata('msg_success'); $this->session->unset_userdata('msg_success'); ?>
</div>
<?php
  }elseif($this->session->userdata('msg_error')){
?>
<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <?php echo $this->session->userdata('msg_error'); $this->session->unset_userdata('msg_error'); ?>
</div>
<?php
  }
?>
<div class="container-fluid clearfix">
    <div class="col-md-8 column search">
     <?php
        echo form_open("package/search_package", 'class="navbar-form navbar-left form_search" role="search"');
        echo '<div class="form-group">';
        echo form_input(array('name' => 'search_package_name','value' => set_value('search_name'), 'class' => 'form-control input-sm', 'placeholder' => 'Package Name'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "filter", "class" => "btn btn-primary btn-sm"));
        echo form_close();
      ?>
    </div>
    <div class="col-md-4 column top-action padding-top-action">
        <button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
        <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
        <?php echo anchor('package/deletePermanent','','class="error pdelete"'); ?>
        <?php echo anchor('package/deleteMulti','','class="error tdelete"'); ?>
        <?php echo anchor('package/add_package', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
    </div>
</div>
<div class="container-fluid clearfix">
  <table class="table table-striped table-hover table-bordered">
    <tr>
      <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
      <th><?php echo anchor("package/list_record/ID/" . $sort, "ID"); ?></th>
      <th><?php echo anchor("package/list_record/Name/" . $sort, "Package"); ?></th>
      <th><?php echo anchor("ackage/list_record/start_date/" . $sort, "From Date"); ?></th>
      <th><?php echo anchor("ackage/list_record/end_date/" . $sort, "To Date"); ?></th>
      <th>Location</th>
      <th>Festival</th>
      <th>Purchase($)</th>
      <th>Sale($)</th>
      <th>Original Stock</th>
      <th>Actual Stock</th>
      <th>Action</th>
    </tr>
      <?php 
        if($packages->num_rows > 0){
          foreach($packages->result() as $row){
      ?>
      <tr>
        <td><?php echo form_checkbox(array('class' => 'check_checkbox','id' => 'check_checkbox', 'name' => 'check_checkbox[]' ), $row->pkcon_id );  ?></td>
        <td><?php echo $row->pkcon_id;  ?></td>
        <td><?php echo character_limiter($row->pkcon_name, 7);  ?></td>
        <td><?php echo $row->pkcon_start_date;  ?></td>
        <td><?php echo $row->pkcon_end_date;  ?></td>
        <td><?php echo character_limiter($row->ftv_name, 7);  ?></td>
        <td><?php echo character_limiter($row->lt_name, 7);  ?></td>
        <td><?php echo $row->pkcon_purchaseprice;  ?></td>
        <td><?php echo $row->pkcon_saleprice;  ?></td>
        <td><?php echo $row->pkcon_originalstock;  ?></td>
        <td><?php echo $row->pkcon_actualstock;  ?></td>
        <td>
            <?php
                $encryp = $row->pkcon_start_date.','.$row->pkcon_end_date;
                $encrypted_id = base64_encode($encryp);
                $status = '';
                $uri = "";
                if($this->uri->segment(3)) $uri = $this->uri->segment(3); 
                if($this->uri->segment(4)) $uri .= '/'.$this->uri->segment(4);
                if($this->uri->segment(5)) $uri .= '/'.$this->uri->segment(5);
                if ($row->pkcon_status == 1) {
                  $status = anchor('package/status_package/' . $row->pkcon_status . '/' . $row->pkcon_id.'/'.$uri, '<span class="icon-ok"></span>', 'title="published" data-toggle="tooltip" id="tooltip"');
                } else if ($row->pkcon_status == 0) {
                  $status = anchor('package/status_package/' . $row->pkcon_status . '/' . $row->pkcon_id.'/'.$uri, '<span class="icon-minus-sign"></span>', 'title="Unpublished" data-toggle="tooltip" id="tooltip"');
                }
                echo $status. ' | ' . anchor('package/view_package/'.$row->pkcon_id.'/'.$encrypted_id, '<span class="icon-eye-open" title="View" ></span>') . ' | ' .
                anchor('package/deletePackageById/' . $row->pkcon_id . '/' . $uri, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                ;
            ?>
          </td>
      </tr>
      <?php
          }
        }else{
          echo "no - record";
        }
      ?>
  </table>
  <ul class="pagination" style="background:red;">
    <?php echo $pagination; ?>
  </ul>
</div>            