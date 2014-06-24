
    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li>Manage Calendar</li>
    </ol>
	<div class="row">
        <div class="col-md-12 column">
            
                <ul class="nav nav-tabs">
                      <li class="active"><?php echo anchor('calendar/list_accCalendar', 'Accommodation'); ?></li>
                       
                      <li><?php echo anchor('calendar/list_actiCalendar', 'Activities'); ?></li>
                      <li><?php echo anchor('calendar/list_transportationCalendar', 'Transportation'); ?></li>
                      <li><?php echo anchor('calendar/list_extraproductsCalendar', 'Extraproducts'); ?></li>
                </ul>
       </div>
        <div class="col-md-12 column">

          <table class="table table-striped table-hover table-bordered">
           		<tr>
                	<th>No</th>
                	<th>Accommodation name</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>
                <?php if ($acc_calendar->num_rows > 0) { ?>
                  <?php foreach ($acc_calendar->result() as $data) { ?>
                        <tr>
                         
                            <td><?php echo $data->accca_id ; ?></td>
                            
                            <td>
                              
                                <?php echo $data->acc_name ; ?>
                               
                            </td>
                            <td>
								<?php 
										echo $data->monday .'</br>'; 
										if($data->monday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
											
											}
								?>
                            </td>
                            <td>
							<?php
										 echo $data->tuesday .'</br>'; 
											if($data->tuesday == 1){
												echo '<span style="color:red;">'."Available!".'</span>';
												
												}
								?>
							
                            </td>
                            <td>
								<?php
										 echo $data->wednesday .'</br>' ;
											if($data->wednesday == 1){
												echo '<span style="color:red;">'."Available!".'</span>';
													
												}
								 ?>
                            </td>
                            <td><?php 
										echo $data->thursday .'</br>';
											if($data->thursday == 1){
											echo '<span style="color:red;">'."Available!".'</span>';
												
											} ?></td>
                            <td><?php 
										echo $data->friday .'</br>';
											if($data->friday == 1){
												echo '<span style="color:red;">'."Available!".'</span>';
											}
							 ?></td>
                            <td><?php
									 echo $data->saturday .'</br>';
									 if($data->saturday == 1){
												echo '<span style="color:red;">'."Available!".'</span>';
											}
							 ?></td>
                            <td><?php echo $data->sunday .'</br>' ; 
							if($data->sunday == 1){
												echo '<span style="color:red;">'."Available!".'</span>';
											}
							?></td> 
                            <td><?php echo $data->start_date  ; ?></td>
                            <td><?php echo $data->end_date ; ?></td>
                            <td><?php echo $data->start_time ; ?></td>
                            <td><?php echo $data->end_time ; ?></td>
                            <td>
                            
							<?php
							$uri = "";
							echo anchor('calendar/detail_acc/'.$data->accca_id.'/'.$uri, '<span class="icon-list-alt" title="Details"></span>');
							 ?>
                            </td>
						 </tr>
                    <?php } ?>
                    
                <?php
                }
                ?>
              
            </table>  
        <ul class="pagination" style="background:red;">
            <?php echo $pagination; ?>
        </ul>
     </div>    
 </div>
			