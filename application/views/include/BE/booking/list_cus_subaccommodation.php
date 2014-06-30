<h5><b>Sub Accommodation</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th>Name</th>
        <th>Room Type</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Sale($)</th>
        <th>Per Room</th>
        <th>Amount Room</th>
    </tr> 
    </thead>
    <tbody class="sub_acc_pk_body tbl_bodyacc<?php echo $accID; ?>">
    	<?php if(isset($sub_accommodation)){ ?>
				<tr class="real_sub_acc_pk remove<?php echo $accID; ?>">
					<td><?php echo character_limiter($sub_accommodation->ht_name, 7); ?></td>
                    <td><?php echo $sub_accommodation->rt_name; ?></td>
					<td><?php echo $departure; ?></td>
                    <td><?php echo $return_date; ?></td>
                    <td><?php echo $sub_accommodation->dhht_price; ?></td>
                    <td><?php echo $sub_accommodation->rt_people_per_room; ?></td>
					<td><?php echo $sub_accommodation->amount_bked; ?></td>
				</tr>
		<?php } ?>
    </tbody>
</table>
