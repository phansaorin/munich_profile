<h5><b>Sub Activities</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th>Name</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Unit Purchase($)</th>
        <th>Unite Sale($)</th>
        <th>Amount</th>
    </tr> 
    </thead>
    <tbody class="sub_act_pk_body tbl_bodyact<?php echo $actID; ?>">
    	<?php if(isset($sub_activites)){ ?>
			<tr class="real_sub_act_pk remove<?php echo $sub_activites->act_id; ?>">
				<td><?php echo character_limiter($sub_activites->act_name, 7); ?></td>
				<td><?php echo $departure; ?></td>
                <td><?php echo $return_date; ?></td>
				<td><?php echo $sub_activites->act_purchaseprice; ?></td>
                <td><?php echo $sub_activites->act_saleprice; ?></td>
				<td><?php echo $sub_activites->amount_bked; ?></td>
			</tr>
		<?php } ?>
    </tbody>
</table>
