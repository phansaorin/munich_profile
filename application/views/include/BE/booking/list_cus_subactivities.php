<h5><b>Sub Activities</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <!-- <th><input type="checkbox" name="checkbox_all_pk_act" data-id=".tbl_bodyact<?php // echo $actID; ?>" class="checkbox_all_pk_act check_checkbox" checked="true"></th> -->
        <th>Name</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Unit Purchase($)</th>
        <th>Unite Sale($)</th>
        <th>Amount</th>
        <!-- <th>Action</th> -->
    </tr> 
    </thead>
    <tbody class="sub_act_pk_body tbl_bodyact<?php echo $actID; ?>">
    	<?php if(isset($sub_activites)){ ?>
			<tr class="real_sub_act_pk remove<?php echo $sub_activites->act_id; ?>">
				<!-- <td><?php // echo form_checkbox(array('class' => 'check_checkbox','id' => 'check_checkbox', 'name' => 'subact_checkbox['.$actID.']['.$subact["act_id"].']', "checked" => true ), $subact["act_id"] );  ?></td> -->
				<td><?php echo character_limiter($sub_activites->act_name, 7); ?></td>
				<td><?php //echo $subact["start_date"]; ?></td>
				<td><?php //echo $subact["end_date"]; ?></td>
				<td><?php echo $sub_activites->act_purchaseprice; ?></td>
                <td><?php echo $sub_activites->act_saleprice; ?></td>
				<td><?php echo $sub_activites->amount_bked; ?></td>
				<!-- <td><span class="icon-list-alt pkadd clickDetailsubact" data-url="<?php //echo base_url(); ?>package/subactdetail/<?php //echo $actID; ?>/<?php //echo $this->uri->segment(3); ?>/<?php //echo $subact["act_id"]; ?>" data-toggle='modal' data-target='.modalDetials' title="Details"></span></td> -->
			</tr>
		<?php } ?>
    </tbody>
</table>
