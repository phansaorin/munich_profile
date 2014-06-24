<input type="hidden" name="customize-date" id="cuscon-date" value="<?php echo $this->uri->segment(4); ?>" />
<!-- Add Activity -->
<div class="modal fade modal-cusconaddactivities" tabindex="-1" role="dialog" aria-labelledby="cusconactivitiesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("customize/add_activities/".$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="frm_cuscon_act"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="cusconactivitiesModalLabel">Add Activity to Customize</h4>
      </div>
      <div class="modal-body modal-act-body">
        <div class="form-group">
          <label class="col-sm-5 control-label">Activity Name <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php
            echo form_dropdown('cusconact', $cusconSelectedAct, '', 'class="form-control actCusconOnchange" data-url="'.base_url().'"');
            ?>
          </div>
          <div id="display_sub_ep_activities"></div>
        </div>
      </div>
      <div class="modal-footer modal-act-footer">
        <?php echo form_submit("btnsubmitcusconact", "Save Activities", 'class="btn btn-primary"'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Add accommodation -->
<div class="modal fade modal-cusconaddaccommocation" tabindex="-1" role="dialog" aria-labelledby="cusconaccommodationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("customize/add_accommodation/".$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="frm_cuscon_acc"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="cusconaccommodationModalLabel">Add Accommodation to Customize</h4>
      </div>
      <div class="modal-body modal-acc-body">
        <div class="form-group">
          <label class="col-sm-5 control-label">Accommodation Name <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php
              echo form_dropdown('cusconacc', $cusconSelectedAcc, '', 'class="form-control accCusconOnchange" data-url="'.base_url().'"');
            ?>
          </div>
          <div id="display_sub_ep_accommodation"></div>
        </div>
      </div>
      <div class="modal-footer modal-acc-footer">
        <?php echo form_submit("btnsubmitcusconacc", "Save Accommodation", 'class="btn btn-primary"'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Add transportation -->
<div class="modal fade modal-cusconaddtransport" tabindex="-1" role="dialog" aria-labelledby="cuscontransportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("customize/add_transport/".$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="frm_cuscon_tps"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="cuscontransportModalLabel">Add Transportation to Customize</h4>
      </div>
      <div class="modal-body modal-tps-body">
        <div class="form-group">
          <label class="col-sm-5 control-label">Transportation Name <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php
              echo form_dropdown('cuscontps', $cusconSelectedTps, '', 'class="form-control tpsCusconOnchange" data-url="'.base_url().'"');
            ?>
          </div>
          <div id="display_sub_ep_transport"></div>
        </div>
      </div>
      <div class="modal-footer modal-tps-footer">
        <?php echo form_submit("btnsubmitcuscontps", "Save Transportation", 'class="btn btn-primary"'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- modal for detail -->
<div class="modal fade modalDetials" tabindex="-1" role="dialog" aria-labelledby="modalDetialsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modalDetialsLabel">Detail</h4>
      </div>
      <div class="modal-body modal-detail-body">
        &nbsp;
      </div>
      <div class="modal-footer modal-activities-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>