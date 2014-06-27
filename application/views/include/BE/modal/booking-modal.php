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
                            $passengers[$value->pass_id] = $value->pass_fname.' '.$value->pass_lname.' < '.$value->pass_email.' >';
                        }
                    }
                if($stock > 0){
                  echo form_dropdown('bkmodalpass', $passengers, '', 'class="ppname form-control"');
                }else{                  
                  echo form_dropdown('bkmodalpass', $passengers, '', 'class="ppname form-control" disabled');
                }
            ?>
          </div>
        </div>        
      </div>
      <div class="modal-footer modal-act-footer">      
        <p style="float:left;">The package in stock is <?php echo $stock; ?></p>
        <?php 
          if($stock > 0){
            echo form_submit("btnsubmitpassbk", "Save Passenger", 'class="btn btn-primary" disabled');
          }else{
            echo form_submit("btnsubmitpassbk", "Save Passenger", 'class="btn btn-primary" disabled');
          } 
        ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- add extra servcie of customize -->
<div class="modal fade modal-extraservice-customize" tabindex="-1" role="dialog" aria-labelledby="bkextraModalLabel" aria-hidden="true">
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

<!-- modal for add more services of booking package -->
<!-- add extra servcie -->
<div class="modal fade modal-extraservice" tabindex="-1" role="dialog" aria-labelledby="bkextraModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo form_open("booking/add_extraservice/".$this->uri->segment(3).'/'.$this->uri->segment(4), 'class="frm_bk_eps"'); ?>
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
                $extraService = mod_booking::getAllExtraService($ppl);
                    if($extraService->num_rows > 0){
                        foreach($extraService->result() as $value){
                            $extraservices[$value->ep_id] = $value->ep_name;
                        }
                    }
                echo form_dropdown('bkmodalextraservice', $extraservices, '', 'class="es form-control form-group"');
            ?>
            <p class="msges">extra service is required...</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Amount of product <span class="require">*</span> :</label>
          <div class="col-sm-7">
            <?php
                echo form_input(array('name'=>'bkamountproduct', 'value'=>set_value('bkamountproduct'),'placeholder'=>'0','class'=>'bkap form-control form-group'));
            ?>
            <p class="msgaop">Invalid...</p>
          </div>
        </div>
      </div>
      <div class="modal-footer modal-act-footer" style="clear:both;">
        <?php echo form_submit("btnsubmitextrabk", "Save Extra Service", 'class="btn btn-primary"'); ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
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

<div class="modal fade addmorepassenger_modal" tabindex="-1" role="dialog" aria-labelledby="subscribeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <?php
        if(isset($bookingedit)){
          if($bookingedit->num_rows() > 0){
            foreach ($bookingedit->result() as $rows) {
              // booking
              $bkID = $rows->bk_id;
              $passID = $rows->pass_id;
            }
          }
        }
        ?>
        <?php  echo form_open_multipart('booking/customize_more_passenger', 'class="form-horizontal" name="frm_personal_info_modal" id="frm_personal_info_modal" '); ?>
        <!-- Start Div Control Form Personal Information -->
        <div class="col-sm-12 form-booking" id="personal_info">
                <h2>Personal Information</h2>
                <hr>        
                <div class="col-sm-12">
                  <div class="form-group" id="feedback_bar_modal"></div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Passenger Firstname <span class="require">*</span>:</label>
                    <div class="col-sm-5">
                        <?php 
                        echo form_hidden('bk_id', $bkID);
                        echo form_hidden('pass_id', $passID);

                          $pfname = array(
                          'name' => 'pfname', 
                          'title' => 'First Name',
                          'class' => 'form-control input_require', 
                          'placeholder' => 'Passenger firstname',
                          'value' => ''
                          ); 
                          echo form_input($pfname); 
                        ?>
                    </div>
                    <p class="help-block error"></p>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Passenger Lastname <span class="require">*</span>:</label>
                    <div class="col-sm-5">
                         <?php $plname = array(
                          'name' => 'plname', 
                          'title' => 'Last Name',
                          'class' => 'form-control input_require', 
                          'placeholder' => 'Passenger lastname',
                          'value' => ''
                          ); 
                          echo form_input($plname); 
                         ?>
                    </div>
                    <p class="help-block error"></p>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Email <span class="require">*</span>: </label>
                    <div class="col-sm-5">
                        <?php $pemail = array(
                          'type' => "email",
                          'name' => 'pemail', 
                          'title' => 'Email',
                          'class' => 'form-control input_email',
                          'placeholder' => 'Email',
                          'value' => ''
                          ); 
                          echo form_input($pemail); 
                        ?>
                        <span class="help-block">Example: username@example.com</span>
                    </div>
                    <p class="help-block error"></p>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Home Phone <span class="require">*</span>:</label>
                    <div class="col-sm-5">
                         <?php $phphone = array(
                          'name' => 'phphone', 
                          'title' => 'Phone',
                          'class' => 'form-control input_require', 
                          'placeholder' => 'Home phone',
                          'value' => ''
                          ); 
                          echo form_input($phphone); 
                         ?>
                    </div>
                    <p class="help-block error"></p>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Mobile Phone :</label>
                    <div class="col-sm-5">
                         <?php $pmobile = array(
                          'name' => 'pmobile', 
                          'class' => 'form-control', 
                          'placeholder' => 'Mobile phone ',
                          'value' => ''
                          ); 
                          echo form_input($pmobile); 
                         ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Company :</label>
                    <div class="col-sm-5">
                         <?php $pcompany = array(
                          'name' => 'pcompany', 
                          'class' => 'form-control', 
                          'placeholder' => 'Company',
                          'value'=> ''
                          ); 
                          echo form_input($pcompany); 
                        ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Country <span class="require">*</span>:</label>
                    <div class="col-sm-5">
                         <?php 
                        echo country_dropdown('pcountry', 'cont', 'form-control input_require', '', array('KH','CA','US'), '');
                         ?>
                    </div>
                    <p class="help-block error"></p>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Gender <span class="require">*</span>:</label>
                    <div class="col-sm-5">
                         <?php 
                         $pgender = array('' => '--- selected --- ','F' => 'Female' , 'M' => 'Male'); 
                         echo form_dropdown("pgender", $pgender, '',"class = form-control title = Gender"); 
                         ?>
                    </div>
                    <p class="help-block error"></p>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Address <span class="require">*</span>:</label>
                    <div class="col-sm-5">
                         <?php $paddress = array(
                          'name' => 'paddress', 
                          'title' => 'Address',
                          'class' => 'form-control input_require', 
                          'placeholder' => 'Passenger Address', 
                          'rows' => '3',
                          'valu' => ''
                          ); 
                          echo form_textarea($paddress); 
                         ?>
                    </div>
                    <p class="help-block error"></p>
                  </div>
                </div>
                <div>
            </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
                  <?php $input = array('name' => 'btnPersonalInfoModal', 'class' => 'btn btn-primary btn-sm', 'value' => ' Submit '); echo form_submit($input);?>
                </div>
        <?php echo form_close(); ?>
        </div>
        <!-- End Div control form Personal Information -->
    </div>
  </div>
</div>