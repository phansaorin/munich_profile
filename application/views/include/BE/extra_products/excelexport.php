<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
echo '<table width="900" cellpadding="0" cellspacing="0" border="1" style="text-align:center; margin-top: 5px;">
        <thead>
                <tr>
                    <th>N&ordm;</th>
                    <th>Extra Product Name</th>
                    <th>Per Person</th>
                    <th>Date Provider</th>
                    <th>Payed Date</th>
					<th>Purchase Price</th>
					<th>Sale Price</th>
					<th>Original Stock</th>
					<th>Actual Stock</th>
                </tr>
            </thead>
            <tbody>';
?>

        <?php
        // column id
        $id = 1;
        if ($this->uri->segment(3)) {
            $id = $this->uri->segment(3) + 1;
        } else {
            $id = 1;
        }
		
        foreach ($extraproduct as $data):
            	 echo '<tr><td>'.$id++.'</td>
                        <td>'.$data->ep_name.'</td>
                        <td>'.$data->ep_perperson.'</td>
                        <td>'.$data->ep_providerdate.'</td>
                        <td>'.$data->ep_payeddate.'</td>
						<td>'.$data->ep_purchaseprice.'</td>
						<td>'.$data->ep_saleprice.'</td>
						<td>'.$data->ep_originalstock.'</td>
						<td>'.$data->ep_actualstock.'</td></tr>';
		
            ?>
            
        <?php endforeach; 

         '<tbody></table>'; ?>
<?php
