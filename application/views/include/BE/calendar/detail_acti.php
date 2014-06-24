

<?php  echo form_open('calendar/detail_acti/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<h4>Detail Activities</h4>
<?php
        foreach ($detail_activiteis->result() as $row) {
            ?>
    	<div class="table-responsive">
              <table class="table table-bordered">
                	<tr><th>No</th><td><?php echo $row->act_id   ; ?></td></tr>
                	<tr><th>Activities</th> <td><?php echo $row->act_name ; ?></td></tr>	 
                    <tr><th>Sub activities</th> <td><?php echo $row->act_subof ; ?></td></tr>
                    <tr><th>Photo</th> <td><?php echo $row->pho_name ; ?></td></tr>
                    <tr><th>Photo detail</th> <td><?php echo $row->	pho_detail ; ?></td></tr>
                    <tr><th>Location</th> <td><?php echo $row->lt_name ; ?></td></tr>
                    <tr><th>Festival</th> <td><?php echo $row->ftv_name ; ?></td></tr> 	
                    <tr><th>Choose item</th> <td><?php echo $row->act_choiceitem; ?></td></tr>
                    <tr><th>Booking</th> <td><?php echo $row->act_bookingtext ; ?></td></tr>
                    <tr><th>Ticket</th> <td><?php echo $row->act_texteticket ; ?></td></tr>
                    <tr><th>Purchaseprice</th> <td><?php echo $row->act_purchaseprice ; ?></td></tr>
                   <tr><th>Sale price</th> <td><?php echo $row->act_saleprice ; ?></td></tr>
                    <tr><th>Actual stock</th> <td><?php echo $row->act_actualstock; ?></td></tr>
                    <tr><th>Original stock</th> <td><?php echo $row->act_originalstock  ; ?></td></tr>
                    <tr><th>Organiser date</th> <td><?php echo $row->act_organiserdate ; ?></td></tr>
                    <tr><th>Payed date</th> <td><?php echo $row->act_payeddate ; ?></td></tr>
                   <tr> <th>Deadline</th> <td><?php echo $row->	act_deadline ; ?></td></tr>
                    <tr><th>Admin text</th> <td><?php echo $row->act_admintext ; ?></td></tr>
                    
                    <tr><th>Moday</th> <td><?php echo $row->monday.'&nbsp;&nbsp;&nbsp;' ; 
					if($row->monday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
											
											}?></td></tr>
                    <tr><th>Tuesday</th> <td><?php echo $row->tuesday.'&nbsp;&nbsp;&nbsp;' ; 
					if($row->tuesday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
											
											}?></td></tr>
                   <tr> <th>Wednesday</th> <td><?php echo $row->wednesday.'&nbsp;&nbsp;&nbsp;'  ;
				   if($row->wednesday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
											
											} ?></td></tr>
                    <tr><th>Thursday</th> <td><?php echo $row->thursday.'&nbsp;&nbsp;&nbsp;' ; 
					if($row->thursday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
											
											}?></td></tr>
                    <tr><th>Friday</th> <td><?php echo $row->friday.'&nbsp;&nbsp;&nbsp;' ; 
					if($row->friday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
											
											}?></td></tr>
                   <tr> <th>Saturday</th> <td><?php echo $row->saturday.'&nbsp;&nbsp;&nbsp;' ;
				   if($row->saturday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
											
											} ?></td></tr>
                    <tr><th>Sunday</th> <td><?php echo $row->sunday.'&nbsp;&nbsp;&nbsp;' ; 
					if($row->sunday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
											
											}?></td></tr>
                   <tr> <th>Start date</th> <td><?php echo $row->start_date ; 
				   ?></td></tr>
                   <tr> <th>End date</th> <td><?php echo $row->end_date ; ?></td></tr>
                  <tr>  <th>Start time</th> <td><?php echo $row->start_time ; ?></td></tr>
                   <tr> <th>End time</th> <td><?php echo $row->end_time ; ?></td></tr>
                
            </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('calendar/list_actiCalendar', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>

            <?php echo form_close(); ?>