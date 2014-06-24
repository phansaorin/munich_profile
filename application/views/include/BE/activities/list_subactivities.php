<div class="subactivitiesdiv clear-fix">
    <h3>Sub Activities</h3> 
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
        		if($subactivities->num_rows() > 0){
        			foreach ($subactivities->result() as $subact) {
 			?>
 				<tr class="real-sub remove<?php echo $subact->act_id; ?>">
 					<td><?php echo $subact->act_id; ?></td>
 					<td><?php echo character_limiter($subact->act_name, 7); ?></td>
 					<td><?php echo $subact->start_date; ?></td>
 					<td><?php echo $subact->end_date; ?></td>
 					<td><?php echo $subact->act_purchaseprice; ?></td>
 					<td><?php echo $subact->act_saleprice; ?></td>
 					<td><?php echo $subact->act_originalstock; ?></td>
 					<td><?php echo $subact->act_actualstock; ?></td>
 					<td><?php echo anchor('activities/detail_activities/'.$subact->act_id, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#activitiesViewModal"></span>','class="eachActivitiesView"') .' | '.
 					anchor('activities/delete_activities/'.$subact->act_id, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip" data-remove="remove'.$subact->act_id.'" class="deleteEACHactivities"'); ?></td>
 				</tr>
 			<?php
        			}
        		}
        	?>
        </tbody>
        <tfoot></tfoot>  
    </table>
</div>
