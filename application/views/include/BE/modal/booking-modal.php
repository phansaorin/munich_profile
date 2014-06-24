<input type="hidden" name="passid" id="passid" value="<?php echo $this->session->userdata('passid'); ?>" />
<!-- Add passenger -->
<div class="modal fade modal-passenger" tabindex="-1" role="dialog" aria-labelledby="bkpassengerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("booking/add_morepassenger/".$this->uri->segment(3).'/'.$this->session->userdata('passid').'/'.$this->uri->segment(4), 'class="frm_bk_pass"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="bkpassengerModalLabel">Add more passenger</h4>
      </div>
      <div class="modal-body modal-act-body">
        <div class="form-group">
          <label class="col-sm-4 control-label">Passenger Email <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php 
                $passengers = array();
                $passengers[''] = "--- select ---";
                    if($passenger->num_rows > 0){
                        foreach($passenger->result() as $value){
                            $passengers[$value->pass_id] = $value->pass_email;
                        }
                    }
                echo form_dropdown('bkmodalpass', $passengers, '', 'class="ppname form-control"');
            ?>
          </div>
        </div>
      </div>
      <div class="modal-footer modal-act-footer">
        <?php echo form_submit("btnsubmitpassbk", "Save Passenger", 'class="btn btn-primary"'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- add extra servcie -->
<div class="modal fade modal-extraservice" tabindex="-1" role="dialog" aria-labelledby="bkextraModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("booking/add_extraservice/".$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="frm_bk_pass"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="bkextraModalLabel">Add Extra Service</h4>
      </div>
      <div class="modal-body modal-es-body">
        <div class="form-group">
          <label class="col-sm-4 control-label">Extra Service <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php 
                $extraservices = array();
                $extraservices[''] = "--- select ---";
                    if($extraService->num_rows > 0){
                        foreach($extraService->result() as $value){
                            $extraservices[$value->ep_id] = $value->ep_name;
                        }
                    }
                echo form_dropdown('bkmodalextraservice', $extraservices, '', 'class="es form-control"');
            ?>
          </div>
        </div>
      </div>
      <div class="modal-footer modal-act-footer">
        <?php echo form_submit("btnsubmitextrabk", "Save Extra Service", 'class="btn btn-primary"'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
