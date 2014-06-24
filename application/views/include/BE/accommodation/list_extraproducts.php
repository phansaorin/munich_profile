<div class="extraproductdiv clear-fix">
    <h3>Extra Products</h3>
    <table class="table table-striped table-hover table-bordered">
    	<thea>
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
        </thea>
        <tbody class="extra_body">
        	<?php 
        		if($ExtraRelatedacc->num_rows() > 0){
        			foreach ($ExtraRelatedacc->result() as $extrapro) {
 			?>
 				<tr class="removeep<?php echo $extrapro->ep_id; ?>">
 					<td><?php echo $extrapro->ep_id; ?></td>
 					<td><?php echo character_limiter($extrapro->ep_name, 7); ?></td>
 					<td><?php echo $extrapro->start_date; ?></td>
 					<td><?php echo $extrapro->end_date; ?></td>
 					<td><?php echo $extrapro->ep_purchaseprice; ?></td>
 					<td><?php echo $extrapro->ep_saleprice; ?></td>
 					<td><?php echo $extrapro->ep_originalstock; ?></td>
 					<td><?php echo $extrapro->ep_actualstock; ?></td>
 					<td><?php echo anchor('accommodation/detail_extraproduct/'.$extrapro->ep_id, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#accommodationViewModal"></span>','class="extraModalview"') .' | '.
 					anchor('accommodation/delete_extraproduct/'.$extrapro->ep_id, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-remove=".removeep'.$extrapro->ep_id.'" data-toggle="tooltip" id="tooltip" class="deleteEACHextraproduct"'); ?></td>
 				</tr>
 			<?php
        			}
        		}
        	?>
        </tbody>
        <tfoot></tfoot>   
    </table>
</div>