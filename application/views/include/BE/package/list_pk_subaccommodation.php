<h5><b>Sub Accommodation</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th><input type="checkbox" name="checkbox_all_pk_acc" data-id=".tbl_bodyacc<?php echo $accID; ?>" class="checkbox_all_pk_acc check_checkbox" checked="true"></th>
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
    <tbody class="sub_acc_pk_body tbl_bodyacc<?php echo $accID; ?>">
    	<?php 
    		if(isset($sub_accommodation)){
    			foreach ($sub_accommodation as $subacc) {
		?>
				<tr class="real_sub_acc_pk remove<?php echo $subacc["acc_id"]; ?>">
					<td><?php echo form_checkbox(array('class' => 'check_checkbox','id' => 'check_checkbox', 'name' => 'subacc_checkbox['.$accID.']['.$subacc["acc_id"].']', "checked" => true ), $subacc["acc_id"] );  ?></td>
					<td><?php echo character_limiter($subacc["acc_name"], 7); ?></td>
					<td><?php echo $subacc["start_date"]; ?></td>
					<td><?php echo $subacc["end_date"]; ?></td>
					<td><?php echo $subacc["acc_purchaseprice"]; ?></td>
					<td><?php echo $subacc["acc_saleprice"]; ?></td>
					<td><?php echo $subacc["acc_originalstock"]; ?></td>
					<td><?php echo $subacc["acc_actualstock"]; ?></td>
					<td><span class="icon-list-alt pkadd clickDetailsubacc" data-url="<?php echo base_url(); ?>package/subaccdetail/<?php echo $accID; ?>/<?php echo $this->uri->segment(3); ?>/<?php echo $subacc["acc_id"]; ?>" data-toggle='modal' data-target='.modalDetials' title="Details"></span></td>
				</tr>
		<?php
    			}
    	    }
    	?>
    </tbody>
</table>
