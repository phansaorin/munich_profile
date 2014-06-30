<h5><b>Extra Products</b></h5>
<table class="table table-striped table-hover table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th>Name</th>
        <th>Purchase($)</th>
        <th>Sale($)</th>
        <th>Amount Book</th>
    </tr> 
    </thead>
    <tbody class="ep_pk_body tbl_bodytpsep<?php echo $tpsID; ?>">
        <?php 
            if(isset($extraproduct_cus)){
                foreach ($extraproduct_cus as $eptps) {
            ?>
                <tr class="real_ep_pk remove<?php echo $eptps->ep_id; ?>">
                    <td><?php echo character_limiter($eptps->ep_name, 7); ?></td>
                    <td><?php echo $eptps->ep_purchaseprice; ?></td>
                    <td><?php echo $eptps->ep_saleprice; ?></td>
                    <td><?php echo $eptps->amount_bked; ?></td>
                </tr>
            <?php
                }
            }
        ?>
    </tbody>
</table>