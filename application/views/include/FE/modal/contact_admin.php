<?php 
  if ($this->session->userdata('send_success')) {
            echo $this->session->userdata('send_success');
            $this->session->unset_userdata('send_success');
        }
  if ($this->session->userdata('send_error')) {
            echo $this->session->userdata('send_error');
            $this->session->unset_userdata('send_error');
        }
  if ($this->session->userdata('error')) {
            echo $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }
  if ($this->session->userdata('success')) {
            echo $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }
?>
<div class="modal fade contact_admin" role="dialog" aria-labelledby="subscribeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <?php 
          echo form_open_multipart("site/contact_admin",'class="form_subscribe"');
        ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title">More Passenger</h2>
        </div>
      <div class="modal-body">
        <table>
        <tr>
            <td>Booking ID<span class="require">*</span> :</td>
            <td>
                <?php
              $booking_id = array();
              $booking_id[''] = "--- select ---";
              if(isset($passengerbooking_info)){
                if($passengerbooking_info->num_rows > 0){
                  foreach($passengerbooking_info->result() as $value){
                    $booking_id[$value->bk_id] = $value->bk_id; 
                  }
                }
              }
              ?>
                <?php
                  echo form_dropdown('txtBooking',$booking_id,set_value('txtBooking') ,'class="form-control"'); 
                ?>
                <span style="color:red;"><?php echo form_error('txtBooking'); ?></span>
          </td>
        </tr> 
        <tr>
            <td>Subject<span class="require">*</span> :</td>
            <td>
                <?php
                    $subject = array('name' => 'subject','value'=> set_value('subject'),'class' => 'form-control');
                    echo form_input($subject);?>
                    <span style="color:red;"><?php echo form_error('subject'); ?></span>
          </td>
        </tr>
        <tr>
            <td>Email<span class="require">*</span> :</td>
            <td>
                <?php
                    $emailpass = array('name' => 'email','value'=> set_value('email'),'class' => 'form-control');
                    echo form_input($emailpass);?>
                    <span style="color:red;"><?php echo form_error('email'); ?></span>
          </td>
        </tr>
        <tr>
            <td>Text<span class="require">*</span> :</td>
            <td>
                <?php
                    $text = array('name' => 'text','value'=> set_value('text'),'class' => 'form-control','rows'=>'5','cols'=>'40');
                    echo form_textarea($text);?>
                    <span style="color:red;"><?php echo form_error('text'); ?></span>
          </td>
        </tr>
        <tr>
            <td>Attach File<span class="require">*</span> :</td>
            <td>
                <?php
                    $attach_file = array('name' => 'userfile','value' => set_value('userfile'), 'multiple' => 'multiple');
                    echo form_upload($attach_file);?>
                    <span style="color:red;"><?php echo form_error('userfile'); ?></span>
          </td>
        </tr>  
      </table>
      <br />
      <p style="font-size:15px;">NOTE: all (<span class="require">*</span>) are requirement<p>
                      </div>
                            <div class="modal-footer">
                            <?php echo form_submit(array("name"=>"btn_sending","class"=>"frm_profile","id"=>"frm_profile","value"=>set_value("frm_profile","submit"),"class"=>"btn btn-primary")); ?>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
      
      <?php 
          echo form_close();
        ?>
    </div>
  </div>
</div>