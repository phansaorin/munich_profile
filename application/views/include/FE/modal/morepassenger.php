<?php 
  if ($this->session->userdata('create')) {
            echo $this->session->userdata('create');
            $this->session->unset_userdata('create');
        }
?>
 

<div class="modal fade addmorepassenger" role="dialog" aria-labelledby="subscribeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <?php 
          echo form_open("site/morepassenger",'class="form_subscribe"');
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
            <td>First Name<span class="require">*</span> :</td>
            <td>
                <?php
                    $firstnamepass = array('name' => 'fname','value'=> set_value('fname'),'class' => 'form-control');
                    echo form_input($firstnamepass); ?>
                  <span style="color:red;"><?php echo form_error('fname'); ?></span>
          </td>
        </tr>
        <tr>
            <td>Last Name<span class="require">*</span> :</td>
            <td>
                <?php
                      $lastnamepass = array('name' => 'lname','value'=> set_value('lname'),'class' => 'form-control');
                      echo form_input($lastnamepass);?>
                      <span style="color:red;"><?php echo form_error('lname'); ?></span>
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
            <td>Mobile Phone<span class="require">*</span> :</td>
            <td>
                <?php
                      $phonepass = array('name' => 'phone','value'=> set_value('phone'),'class' => 'form-control');
                       echo form_input($phonepass);?>
                        <span style="color:red;"><?php echo form_error('phone'); ?></span>
          </td>
        </tr>
        <tr>
            <td>Telephone:</td>
            <td>
                 <?php
                    $telephone = array('name' => 'telephone','value'=> set_value('telephone'),'class' => 'form-control');
                     echo form_input($telephone); ?>
          </td>
        </tr>
        <tr>
            <td>Company<span class="require">*</span> :</td>
            <td>
                <?php
                    $companypass = array('name' => 'company','value'=> set_value('company'),'class' => 'form-control');
                    echo form_input($companypass);?>
                    <span style="color:red;"><?php echo form_error('company'); ?></span>
          </td>
        </tr>
        <!-- add new file -->
        <tr>
            <td>Country<span class="require">*</span> :</td>
            <td>
                 <?php
                    $country = array('name' => 'country','value'=> set_value('country'),'class' => 'form-control');
                     echo form_input($country); ?>
          </td>
        </tr>
        <tr>
            <td>City<span class="require">*</span> :</td>
            <td>
                 <?php
                    $city = array('name' => 'city','value'=> set_value('city'),'class' => 'form-control');
                     echo form_input($city); ?>
          </td>
        </tr>
        <!-- end add new filde <textarea class="form-control" rows="5" cols="30" name="address"></textarea>-->
        <tr>
            <td>Address<span class="require">*</span> :</td>
            <td>
                <?php
                    $addresspass = array('name' => 'address','value'=> set_value('address'),'class' => 'form-control','rows'=>'4','cols'=>'40');
                    echo form_textarea($addresspass);?>
                    <span style="color:red;"><?php echo form_error('address'); ?></span>
          </td>
        </tr>
        <tr>
            <td>About you<span class="require">*</span> :</td>
            <td>
                <?php
                    $aboutYou = array('name' => 'aboutyou','value'=> set_value('aboutyou'),'class' => 'form-control','rows'=>'4','cols'=>'40');
                    echo form_textarea($aboutYou);?>
                    <span style="color:red;"><?php echo form_error('aboutyou'); ?></span>
          </td>
        </tr>
        <tr>
            <td>Gender<span class="require">*</span> :</td>
            <td>
                <?php 
                      //$txtGender = array('' => '-- Select --', 'F' => 'Female', 'M' => 'Male');
                      echo form_dropdown('gender',$old_gender,set_value('gender') ,'class="form-control"'); ?>
                      <span style="color:red;"><?php echo form_error('gender'); ?></span>
          </td>
        </tr>
      </table>
      <br />
      <p style="font-size:15px;">NOTE: all (<span class="require">*</span>) are requirement<p>
                      </div>
                            <div class="modal-footer">
                            <?php echo form_submit(array("name"=>"addmore_profile","class"=>"frm_profile","id"=>"frm_profile","value"=>set_value("frm_profile","submit"),"class"=>"btn btn-primary")); ?>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
      
      <?php 
          echo form_close();
        ?>
    </div>
  </div>
</div>