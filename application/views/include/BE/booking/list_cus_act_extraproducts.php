<h5><b>Extra Products</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th>Name</th>
        <th>Unit Purchase($)</th>
        <th>Unit Sale($)</th>
        <th>Amount</th>
    </tr> 
    </thead>
    <tbody class="ep_pk_body tbl_bodyactep<?php echo $actID; ?>">
        <?php if(isset($extraproduct_cus)){ 
            foreach ($extraproduct_cus as $extra_pro) { ?>
                <tr class="real_ep_pk remove<?php echo $extra_pro->ep_id; ?>">
                    <td><?php echo character_limiter($extra_pro->ep_name, 7); ?></td>
                    <td><?php echo $extra_pro->ep_purchaseprice; ?></td>
                    <td><?php echo $extra_pro->ep_saleprice; ?></td>
                    <td><?php echo $extra_pro->amount_bked; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>