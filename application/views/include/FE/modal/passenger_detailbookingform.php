<div class="modal fade passenger_detailbookingform" tabindex="-1" role="dialog" aria-labelledby="passenger_detailbookingform" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title">Details Passenger booking</h2>
        </div>
        <div class="modal-body">
               <?php
                            $id = 1;
                            if ($this->uri->segment(3)) {
                                $id = $this->uri->segment(3) + 1;
                            } else {
                                $id = 1;
                            }
                             ?>
                           <?php if ($passengerbooking_info->num_rows > 0) { ?>
                            <?php foreach($passengerbooking_info->result() as $row) { ?>
                      <div class="table-responsive">
                          <table class="table table-bordered">
                            <tr>
                                    <th>Booking ID </th> <td><?php echo $id++ ; ?></td> 
                            </tr>
                            <tr>
                                    <th>Booking Type </th> <td><?php echo $row->bk_type ; ?></td> 
                            </tr>
                            <tr>
                                    <th>Booking date</th> <td><?php echo $row->bk_date; ?></td>
                            </tr>
                            <tr>
                                    <th>Arrival date</th> <td><?php echo $row->bk_arrival_date; ?></td>
                            </tr>
                            <tr>
                                    <th>Booking total people</th> <td><?php echo $row->bk_total_people; ?></td>
                            </tr>
                            <tr>
                                    <th>Booking pay date</th> <td><?php echo $row->bk_pay_date ; ?></td>
                            </tr>
                            <tr>
                                    <th>Booking pay prices</th> <td><?php echo $row->bk_pay_price ; ?></td>
                            </tr>
                           </table>

             </div>         
                       <?php } ?>
                   <?php } ?>
        </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
      
  </div>
  </div>
</div>