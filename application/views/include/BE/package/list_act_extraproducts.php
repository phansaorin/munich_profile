<?php // var_dump($extraproduct_pk); ?>
<h5><b>Extra Products</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th><input type="checkbox" name="checkbox_all_pk_epact" class="checkbox_all_pk_epact check_checkbox" data-id=".tbl_bodyactep<?php echo $actID; ?>" checked="true"></th>
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
    <tbody class="ep_pk_body tbl_bodyactep<?php echo $actID; ?>">
        <?php 
            if(isset($extraproduct_pk)){
                foreach ($extraproduct_pk as $epact) {
        ?>
                <tr class="real_ep_pk remove<?php echo $epact['ep_id']; ?>">
                    <td><?php echo form_checkbox(array('class' => 'check_checkbox','id' => 'check_checkbox', 'name' => 'epact_checkbox['.$actID.']['.$epact['ep_id'].']', "checked" => true), $epact['ep_id'] );  ?></td>
                    <td><?php echo character_limiter($epact['ep_name'], 7); ?></td>
                    <td><?php echo $epact['start_date']; ?></td>
                    <td><?php echo $epact['end_date']; ?></td>
                    <td><?php echo $epact['ep_purchaseprice']; ?></td>
                    <td><?php echo $epact['ep_saleprice']; ?></td>
                    <td><?php echo $epact['ep_originalstock']; ?></td>
                    <td><?php echo $epact['ep_actualstock']; ?></td>
                    <td><span class="icon-list-alt pkadd clickDetailep" data-url="<?php echo base_url(); ?>package/epdetail/act/<?php echo $actID; ?>/<?php echo $this->uri->segment(3); ?>/<?php echo $epact['ep_id']; ?>" data-toggle='modal' data-target='.modalDetials' title="Details"></span></td>
                </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>