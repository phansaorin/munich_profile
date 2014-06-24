<div class="subaccommodationdiv clear-fix">
    <h3>Sub Accommodation</h3> 
    <table class="table table-striped table-hover table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Purchase($)</th>
            <th>Sale($)</th>
            <th>Original Stock</th>
            <th>Actual Stock</th>
            <th>Action</th>
        </tr> 
        </thead>
        <tbody class="sub_body tbl_body">
        	<?php 
        		if($subaccommodation->num_rows() > 0){
        			foreach ($subaccommodation->result() as $subacc) {
 			?>
 				<tr class="real-sub remove<?php echo $subacc->acc_id; ?>">
 					<td><?php echo $subacc->acc_id; ?></td>
 					<td><?php echo character_limiter($subacc->acc_name, 7); ?></td>
 					<td><?php echo $subacc->start_date; ?></td>
 					<td><?php echo $subacc->end_date; ?></td>
 					<td><?php echo $subacc->acc_purchaseprice; ?></td>
 					<td><?php echo $subacc->acc_saleprice; ?></td>
 					<td><?php echo $subacc->acc_originalstock; ?></td>
 					<td><?php echo $subacc->acc_actualstock; ?></td>
 					<td><?php echo anchor('accommodation/detail_accommodation/'.$subacc->acc_id, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#accommodationViewModal"></span>','class="eachAccommodationView"') .' | '.
 					anchor('accommodation/delete_accommodation/'.$subacc->acc_id, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip" data-remove="remove'.$subacc->acc_id.'" class="deleteEACHaccommodation"'); ?></td>
 				</tr>
 			<?php
        			}
        		}
        	?>
        </tbody>
        <tfoot></tfoot>  
    </table>
</div>
