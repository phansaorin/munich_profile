<?php
//Additional values
$pdfFileName = 'export_transportation.pdf';

tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Transportation data Export";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc
    // $content = ob_get_contents();
$content = '<table width="500" cellpadding="0" cellspacing="0" border="1" style="text-align:center; margin-top: 5px;">
        <thead>
                <tr bgcolor="#FFDEAD" color="black">
                    <th width="40" height="20"><font size="11">N&ordm;</font></th>
                    <th><font size="11">Transportation Name</font>e</th>
                    <th width="80"><font size="11">From Date</font></th>
                    <th width="50"><font size="11">To Date</font></th>
                    <th><font size="11">Location</font></th>
                    <th width="55"><font size="11">Purchase Price</font></th>
                    <th width="55"><font size="11">Sale Price</font></th>
                    <th width="55"><font size="11">Original Stock</font></th>
                    <th width="55"><font size="11">Actual Stock</font></th>
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
        foreach ($transportation as $data):
            $content .= '<tr><td  width="40">'.$id++.'</td>
                        <td>'.$data->tp_name.'</td>
                        <td width="80">'.$data->start_date.'</td>
                        <td width="50">'.$data->end_date.'</td>
                        <td>'.$data->lt_name.'</td>
                        <td width="55">'.$data->tp_purchaseprice.'</td>
                        <td width="55">'.$data->tp_saleprice.'</td>
                        <td width="55">'.$data->tp_originalstock.'</td>
                        <td width="55">'.$data->tp_actualstock.'</td></tr>';
            ?>
        <?php endforeach; 
        $content .= '<tbody></table>'; ?>
<?php
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output($pdfFileName, 'I');