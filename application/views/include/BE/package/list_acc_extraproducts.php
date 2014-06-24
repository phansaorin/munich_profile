<h5><b>Extra Products</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th><input type="checkbox" name="checkbox_all_pk_epacc" class="checkbox_all_pk_epacc check_checkbox" data-id=".tbl_bodyaccep<?php echo $accID; ?>" checked="true"></th>
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
    <tbody class="ep_pk_body tbl_bodyaccep<?php echo $accID; ?>">
        <?php 
            if(isset($extraproduct_pk)){
                foreach ($extraproduct_pk as $epacc) {
        ?>
                <tr class="real_ep_pk remove<?php echo $epacc['ep_id']; ?>">
                    <td><?php echo form_checkbox(array('class' => 'check_checkbox','id' => 'check_checkbox', 'name' => 'epacc_checkbox['.$accID.']['.$epacc['ep_id'].']', "checked" => true), $epacc['ep_id'] );  ?></td>
                    <td><?php echo character_limiter($epacc['ep_name'], 7); ?></td>
                    <td><?php echo $epacc['start_date']; ?></td>
                    <td><?php echo $epacc['end_date']; ?></td>
                    <td><?php echo $epacc['ep_purchaseprice']; ?></td>
                    <td><?php echo $epacc['ep_saleprice']; ?></td>
                    <td><?php echo $epacc['ep_originalstock']; ?></td>
                    <td><?php echo $epacc['ep_actualstock']; ?></td>
                    <td><span class="icon-list-alt pkadd clickDetailep" data-url="<?php echo base_url(); ?>package/epdetail/acc/<?php echo $accID; ?>/<?php echo $this->uri->segment(3); ?>/<?php echo $epacc['ep_id']; ?>" data-toggle='modal' data-target='.modalDetials' title="Details"></span></td>
                </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>