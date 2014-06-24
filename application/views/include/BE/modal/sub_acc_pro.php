<!-- sub accommodation -->
<div class="modal fade modal-subaccommodation" id="subaccModal" tabindex="-1" role="dialog" aria-labelledby="subaccommodation" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <?php echo form_open("accommodation/add_subaccommodation", 'class="subof_add"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add New Sub Accommodation</h4>
      </div>
      <div class="modal-body">
        <?php $this->load->view(INCLUDE_BE.$this->uri->segment(1).'/sub_accommodation'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save_subof">Save Sub Accommodation</button>
        <button type="button" class="btn btn-default close_subof" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- extra product -->
<div class="modal fade modal-extraproduct" id="subaccModal" tabindex="-1" role="dialog" aria-labelledby="extraproduct" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <?php echo form_open("accommodation/add_extraproduct", 'class="ep_add"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add Extra Product</h4>
      </div>
      <div class="modal-body">
      	<?php echo form_hidden('acc_subof', $this->uri->segment(3)); ?>
        <?php 
                $extras = array();
                $extras[''] = "--- select ---";
                    if($txtExtraProduct->num_rows > 0){
                        foreach($txtExtraProduct->result() as $value){
                            $extras[$value->ep_id] = $value->ep_id.' : '.$value->ep_name;
                        }
                    }
            echo form_dropdown('txtExtra', $extras, '', 'class="form-control"');  
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary save_ep">Save Extra Product</button>
        <button type="button" class="btn btn-default close_ep" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>