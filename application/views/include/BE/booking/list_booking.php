<div class="col-md-8 column">
                    <h4>Manage Booking</h4>
                </div>
                <div class="col-md-4 column">
                    <form class="navbar-form navbar-left" role="search">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search booking">
                      </div>
                      <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <table class="table table-striped">
                    <tr>
                        <td>No</td>
                        <td>BookingID</td>
                        <td>From Date</td>
                        <td>To Date</td>
                        <td>Number of Px</td>
                        <td>Purchase Price</td>
                        <td>Sale Price</td>
                        <td>Action</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>001</td>
                        <td>12/12/2013</td>
                        <td>15/12/2013</td>
                        <td>2 people</td>
                        <td>$1200</td>
                        <td>$1500</td>
                        <td><?php echo anchor('booking/view_booking','View');?> | <?php echo anchor('booking/edit_booking','Edit');?> | <?php echo anchor('booking/edit_booking','Delete');?></td>
                    </tr>
                </table>
                <div class="col-md-8 column">
                    <button type="button" class="btn btn-primary btn-sm">Export to pdf</button>
                    <button type="button" class="btn btn-primary btn-sm">Export to excel</button>  
                </div>
                <div class="col-md-4 column">
                    <ul class="pagination">
                      <li class="disabled"><a href="#">&laquo;</a></li>
                      <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                      <li><a href="#">2 </a></li>
                      <li><a href="#">3 </a></li>
                      <li><a href="#">4 </a></li>
                      <li><a href="#">5 </a></li>
                    </ul>
                </div>
            </div>
                
            
                    
