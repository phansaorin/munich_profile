<h5><b>Sub Transportation</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <!-- <th><input type="checkbox" name="checkbox_all_pk_tps" data-id=".tbl_bodytps<?php // echo $tpsID ?>" class="checkbox_all_pk_tps check_checkbox" checked="true"></th> -->
        <th>Name</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Purchase($)</th>
        <th>Sale($)</th>
        <th>Original Stock</th>
        <th>Actual Stock</th>
        <!-- <th>Action</th> -->
    </tr> 
    </thead>
    <tbody class="sub_tps_pk_body tbl_bodytps<?php echo $tpsID; ?>">
    	<?php 
    		if(isset($sub_transport)){
    			foreach ($sub_transport as $subtps) {
		?>
				<tr class="real_sub_tps_pk remove<?php echo $subtps["tp_id"]; ?>">
					<!-- <td><?php // echo form_checkbox(array('class' => 'check_checkbox','id' => 'check_checkbox', 'name' => 'subtps_checkbox['.$tpsID.']['.$subtps["tp_id"].']', "checked" => true ), $subtps["tp_id"] );  ?></td> -->
					<td><?php echo character_limiter($subtps["tp_name"], 7); ?></td>
					<td><?php echo $subtps["start_date"]; ?></td>
					<td><?php echo $subtps["end_date"]; ?></td>
					<td><?php echo $subtps["tp_purchaseprice"]; ?></td>
					<td><?php echo $subtps["tp_saleprice"]; ?></td>
					<td><?php echo $subtps["tp_originalstock"]; ?></td>
					<td><?php echo $subtps["tp_actualstock"]; ?></td>
					<!-- <td><span class="icon-list-alt pkadd clickDetailsubtps" data-url="<?php // echo base_url(); ?>package/subtpsdetail/<?php // echo $tpsID; ?>/<?php // echo $this->uri->segment(3); ?>/<?php // echo $subtps["tp_id"]; ?>" data-toggle='modal' data-target='.modalDetials' title="Details"></span></td> -->
				</tr>
		<?php
    			}
    	    }
    	?>
    </tbody>
</table>
