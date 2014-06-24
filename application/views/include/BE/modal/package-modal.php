<input type="hidden" name="package-date" id="pk-date" value="<?php echo $this->uri->segment(4); ?>" />
<!-- Add Activity -->
<div class="modal fade modal-pkaddactivities" tabindex="-1" role="dialog" aria-labelledby="pkactivitiesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("package/add_activities/".$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="frm_pk_act"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="pkactivitiesModalLabel">Add Activity to Package</h4>
      </div>
      <div class="modal-body modal-act-body">
        <div class="form-group">
          <label class="col-sm-5 control-label">Activity Name <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php
            echo form_dropdown('pkact', $pkSelectedAct, '', 'class="form-control actOnchange" data-url="'.base_url().'"');
            ?>
          </div>
          <div id="display_sub_ep_activities"></div>
        </div>
      </div>
      <div class="modal-footer modal-act-footer">
        <?php echo form_submit("btnsubmitpkact", "Save Activities", 'class="btn btn-primary"'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Add accommodation -->
<div class="modal fade modal-pkaddaccommocation" tabindex="-1" role="dialog" aria-labelledby="pkaccommodationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("package/add_accommodation/".$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="frm_pk_acc"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="pkaccommodationModalLabel">Add Accommodation to Package</h4>
      </div>
      <div class="modal-body modal-acc-body">
        <div class="form-group">
          <label class="col-sm-5 control-label">Accommodation Name <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php
              echo form_dropdown('pkacc', $pkSelectedAcc, '', 'class="form-control accOnchange" data-url="'.base_url().'"');
            ?>
          </div>
          <div id="display_sub_ep_accommodation"></div>
        </div>
      </div>
      <div class="modal-footer modal-acc-footer">
        <?php echo form_submit("btnsubmitpkacc", "Save Accommodation", 'class="btn btn-primary"'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Add transportation -->
<div class="modal fade modal-pkaddtransport" tabindex="-1" role="dialog" aria-labelledby="pktransportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("package/add_transport/".$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="frm_pk_tps"'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="pktransportModalLabel">Add Transportation to Package</h4>
      </div>
      <div class="modal-body modal-tps-body">
        <div class="form-group">
          <label class="col-sm-5 control-label">Transportation Name <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php
              echo form_dropdown('pktps', $pkSelectedTps, '', 'class="form-control tpsOnchange" data-url="'.base_url().'"');
            ?>
          </div>
          <div id="display_sub_ep_transport"></div>
        </div>
      </div>
      <div class="modal-footer modal-tps-footer">
        <?php echo form_submit("btnsubmitpktps", "Save Transportation", 'class="btn btn-primary"'); ?>
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