<div class="subtransportationdiv clear-fix">
    <h3>Sub Transportation</h3> 
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
        		if($subtransportation->num_rows() > 0){
        			foreach ($subtransportation->result() as $subtp) {
 			?>
 				<tr class="real-sub remove<?php echo $subtp->tp_id; ?>">
 					<td><?php echo $subtp->tp_id; ?></td>
 					<td><?php echo character_limiter($subtp->tp_name, 7); ?></td>
 					<td><?php echo $subtp->start_date; ?></td>
 					<td><?php echo $subtp->end_date; ?></td>
 					<td><?php echo $subtp->tp_purchaseprice; ?></td>
 					<td><?php echo $subtp->tp_saleprice; ?></td>
 					<td><?php echo $subtp->tp_originalstock; ?></td>
 					<td><?php echo $subtp->tp_actualstock; ?></td>
 					<td><?php echo anchor('transportation/detail_transportation/'.$subtp->tp_id, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#transportationViewModal"></span>','class="eachTransportationView"') .' | '.
 					anchor('transportation/delete_transportation/'.$subtp->tp_id, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip" data-remove="remove'.$subtp->tp_id.'" class="deleteEACHtransportation"'); ?></td>
 				</tr>
 			<?php
        			}
        		}
        	?>
        </tbody>
        <tfoot></tfoot>  
    </table>
</div>
