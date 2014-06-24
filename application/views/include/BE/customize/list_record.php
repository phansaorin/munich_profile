<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage Customize</li>
</ol>
<?php 
  if($this->session->userdata('search_customize')) $this->session->unset_userdata('search_customize');
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
        echo form_open("customize/search_customize", 'class="navbar-form navbar-left form_search" role="search"');
        echo '<div class="form-group">';
        echo form_input(array('name' => 'search_customize_name','value' => set_value('search_name'), 'class' => 'form-control input-sm', 'placeholder' => 'Customize Name'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "filter", "class" => "btn btn-primary btn-sm"));
        echo form_close();
      ?>
    </div>
    <div class="col-md-4 column top-action padding-top-action">
        <button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
        <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
        <?php echo anchor('customize/deletePermanent','','class="error pdelete"'); ?>
        <?php echo anchor('customize/deleteMulti','','class="error tdelete"'); ?>
        <?php echo anchor('customize/add_customize', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
    </div>
</div>
<div class="container-fluid clearfix">
  <table class="table table-striped table-hover table-bordered">
    <tr>
      <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
      <th><?php echo anchor("customize/list_record/ID/" . $sort, "ID"); ?></th>
      <th><?php echo anchor("customize/list_record/Name/" . $sort, "Customize"); ?></th>
      <th><?php echo anchor("ackage/list_record/start_date/" . $sort, "From Date"); ?></th>
      <th><?php echo anchor("ackage/list_record/end_date/" . $sort, "To Date"); ?></th>
      <th>Location</th>
      <th>Fastival</th>
      <th>Purchase($)</th>
      <th>Sale($)</th>
      <th>Original Stock</th>
      <th>Actual Stock</th>
      <th>Action</th>
    </tr>
      <?php 
        if($customize->num_rows > 0){
          foreach($customize->result() as $row){
      ?>
      <tr>
        <td><?php echo form_checkbox(array('class' => 'check_checkbox','id' => 'check_checkbox', 'name' => 'check_checkbox[]' ), $row->cuscon_id );  ?></td>
        <td><?php echo $row->cuscon_id;  ?></td>
        <td><?php echo character_limiter($row->cuscon_name, 7);  ?></td>
        <td><?php echo $row->cuscon_start_date;  ?></td>
        <td><?php echo $row->cuscon_end_date;  ?></td>
        <td><?php echo character_limiter($row->ftv_name, 7);  ?></td>
        <td><?php echo character_limiter($row->lt_name, 7);  ?></td>
        <td><?php echo $row->cuscon_purchaseprice;  ?></td>
        <td><?php echo $row->cuscon_saleprice;  ?></td>
        <td><?php echo $row->cuscon_originalstock;  ?></td>
        <td><?php echo $row->cuscon_actualstock;  ?></td>
        <td>
            <?php
                $encryp = $row->cuscon_start_date.','.$row->cuscon_end_date;
                $encrypted_id = base64_encode($encryp);
                $status = '';
                $uri = "";
                if($this->uri->segment(3)) $uri = $this->uri->segment(3); 
                if($this->uri->segment(4)) $uri .= '/'.$this->uri->segment(4);
                if($this->uri->segment(5)) $uri .= '/'.$this->uri->segment(5);
                if ($row->cuscon_status == 1) {
                  $status = anchor('customize/status_customize/' . $row->cuscon_status . '/' . $row->cuscon_id.'/'.$uri, '<span class="icon-ok"></span>', 'title="published" data-toggle="tooltip" id="tooltip"');
                } else if ($row->cuscon_status == 0) {
                  $status = anchor('customize/status_customize/' . $row->cuscon_status . '/' . $row->cuscon_id.'/'.$uri, '<span class="icon-minus-sign"></span>', 'title="Unpublished" data-toggle="tooltip" id="tooltip"');
                }
                echo $status. ' | ' . anchor('customize/view_customize/'.$row->cuscon_id.'/'.$encrypted_id, '<span class="icon-eye-open" title="View" ></span>') . ' | ' .
                anchor('customize/deleteCustomizeById/' . $row->cuscon_id . '/' . $uri, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
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