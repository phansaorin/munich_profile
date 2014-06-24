<?php
//Additional values
$pdfFileName = 'export_activities.pdf';
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Etichet data";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
// $obj_pdf->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
// $obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER,0,0,0,20);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
?>
<?php 
    // we can have any view part here like HTML, PHP etc
     // $content = ob_get_contents();
    // $content ='<div style="background-color:gray">Activity</div>'
$content = '
<table>
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
        foreach ($eticket_collection as $value):
            $passengerWith = unserialize($value->pbk_pass_come_with);
     ?>
     <?php 
            $content = '<div style="border: 1px solid black; height:30px;">'.$value->pkcon_name.'</div>';
            $content .= '<div><img src="assets/img/FE/etichet/booking_information.PNG" height="20" align="right"></div>';
            // $content .= '<div style="text-transform: capitalize;"><img src="assets/img/FE/etichet/accommodation.PNG" height="15" margin-left="50"></div>';            
     ?>
     <?php 
     $content .='<div style="background-color:gray; width:50px;height:50px; font-size:11px;color:#ffffff;">Main Activity</div>';
     $getMainActivities = $value->pk_activities;
     $un_activities = unserialize($getMainActivities);
     // $content = $value->pk_activities;
        if(isset($un_activities['main-activities'])){
            foreach($un_activities['main-activities'] as $rows){
                $content.='<div style="margin-left:141px;">
                <table>
                    <tr>
                        <td>Name'.'  '.':</td>
                        <td>'.$rows["act_name"].'</td>
                    </tr>
                    <tr>
                        <td>Location'.'  '.':</td>
                        <td>'.$rows["lt_name"].'</td>
                    </tr>
                    <tr>
                        <td>Fetival Name'.'  '.':</td>
                        <td>'.$rows["ftv_name"].'</td>
                    </tr>
                    <tr>
                        <td>Activity Eticket'.'  '.':</td>
                        <td>'.$rows["act_texteticket"].'</td>
                    </tr>
                    <tr>
                        <td>Activity Payeddate'.'  '.':</td>
                        <td>'.$rows["act_payeddate"].'</td>
                    </tr>
                    <tr>
                        <td>Activity Dealine'.'  '.':</td>
                        <td>'.$rows["act_deadline"].'</td>
                    </tr>';
                $content.='</table></div>';
     ?>
     <?php
      $content .='<div style="width:60%;"><img src="assets/img/FE/etichet/sub_acitivties.PNG" height="12" align="right">'.$id++.'</div>';
            if(isset($un_activities['sub-activities'][$rows['act_id']])){
                    foreach ($un_activities['sub-activities'][$rows['act_id']] as $rows) {
                $content.='<div style="margin-left:141px;">
                <table>
                    <tr>
                        <td>Name'.'  '.':</td>
                        <td>'.$rows["act_name"].'</td>
                    </tr>
                    <tr>
                        <td>Location'.'  '.':</td>
                        <td>'.$rows["lt_name"].'</td>
                    </tr>
                    <tr>
                        <td>Fetival Name'.'  '.':</td>
                        <td>'.$rows["ftv_name"].'</td>
                    </tr>
                    <tr>
                        <td>Activity Eticket'.'  '.':</td>
                        <td>'.$rows["act_texteticket"].'</td>
                    </tr>
                    <tr>
                        <td>Activity Payeddate'.'  '.':</td>
                        <td>'.$rows["act_payeddate"].'</td>
                    </tr>
                    <tr>
                        <td>Activity Dealine'.'  '.':</td>
                        <td>'.$rows["act_deadline"].'</td>
                    </tr>';
                $content.='</table></div>';
            }
        }
            // echo $allPassengers;
    $content .= '</div>';
                ?>
    <!-- end of main activities -->
 <?php                            
                 }
            }
     ?>  
    <?php 
    $content .='<div style="background-color:gray; font-size:11px;color:#ffffff;">Acommodation</div>';
            $getAccommodation = $value->pk_accomodation; 
            $accommodation = unserialize($getAccommodation);
            if(isset($accommodation['main-accommodation'])){
                foreach($accommodation['main-accommodation'] as $rows){
                             $content.='<div style="margin-left:141px;">
                            <table>
                            <tr>
                                <td>Name'.'  '.':</td>
                                <td>'.$rows['acc_name'].'</td>
                            </tr>
                             <tr>
                                <td>E-ticket'.'  '.':</td>
                                <td>'.$rows['acc_texteticket'].'</td>
                            </tr>
                             <tr>
                                <td>Booking Date'.'  '.':</td>
                                <td>'.$rows['acc_payeddate'].'</td>
                            </tr>
                            <tr>
                                <td>Dealine'.'  '.':</td>
                                <td>'.$rows['acc_deadline'].'</td>
                            </tr>
                            <tr>
                                <td>acility'.'  '.':</td>
                                <td>'.$rows['clf_name'].'</td>
                            </tr>
                            <tr>
                                <td>Location'.'  '.':</td>
                                <td>'.$rows['lt_name'].'</td>
                            </tr>';
                         $content.'</table></div>';
                         ?>
                <?php 
                $acc = 1;
                if($this->uri->segment(3)){
                    $acc = $this->uri->segment(3)+1;
                }else{
                    $acc = 1;
                }
     $content .='<div style="width:60%;"><img src="assets/img/FE/etichet/sub_acc.PNG" height="12" align="right">'.$acc++.'</div>';
    if(isset($accommodation['sub-accommodation'])){
        foreach ($accommodation['sub-accommodation'][$rows['acc_id']] as $row) { ?>
          <?php
                            $content.='<div style="margin-left:141px;">
                            <table>
                            <tr>
                                <td>Name'.'  '.':</td>
                                <td>'.$rows['acc_name'].'</td>
                            </tr>
                             <tr>
                                <td>E-ticket'.'  '.':</td>
                                <td>'.$rows['acc_texteticket'].'</td>
                            </tr>
                             <tr>
                                <td>Booking Date'.'  '.':</td>
                                <td>'.$rows['acc_payeddate'].'</td>
                            </tr>
                            <tr>
                                <td>Dealine'.'  '.':</td>
                                <td>'.$rows['acc_deadline'].'</td>
                            </tr>
                            <tr>
                                <td>acility'.'  '.':</td>
                                <td>'.$rows['clf_name'].'</td>
                            </tr>
                            <tr>
                                <td>Location'.'  '.':</td>
                                <td>'.$rows['lt_name'].'</td>
                            </tr>';
                         $content.'</table></div>';
                         ?>

                         <?php
                          } 
                     }
                     ?>

    <!--the end of main accomodation -->
    <?php 
        }
    }

    ?>
    <!-- start of transportation -->
     <?php 
    $content .='<div style="background-color:gray; font-size:11px; color:#ffffff;">Transportation</div>';
      $getTransportation = $value->pk_transportation;
       $transportation = unserialize($getTransportation); 
        if(isset($transportation['main-transport'])){
            foreach($transportation['main-transport'] as $rows){
                             $content.='<div style="margin-left:141px;">
                            <table>
                            <tr>
                                <td>Name'.'  '.':</td>
                                <td>'.$rows['tp_name'].'</td>
                            </tr>
                             <tr>
                                <td>E-ticket'.'  '.':</td>
                                <td>'.$rows['tp_texteticket'].'</td>
                            </tr>
                             <tr>
                                <td>Booking Date'.'  '.':</td>
                                <td>'.$rows['tp_providerdate'].'</td>
                            </tr>
                            <tr>
                                <td>Dealine'.'  '.':</td>
                                <td>'.$rows['tp_payeddate'].'</td>
                            </tr>
                            <tr>
                                <td>acility'.'  '.':</td>
                                <td>'.$rows['tp_admintext'].'</td>
                            </tr>
                            <tr>
                                <td>Location'.'  '.':</td>
                                <td>'.$rows['tp_textbooking'].'</td>
                            </tr>';
                         $content.'</table></div>';
                         ?>
            <!-- start of sub transportation -->
            <?php 
            $tra = 1;
            if($this->uri->segment(3)){
                $tra = $this->uri->segment(3) + 1;
            }else{
                $tra = 1;
            }
            $content .='<div style="width:60%;"><img src="assets/img/FE/etichet/sub_tran.PNG" height="12" align="right">'.$tra++.'</div>';
            if(isset($transportation['sub-transport'])){
                 foreach ($transportation['sub-transport'][$rows['tp_id']] as $rows) { ?>
                 <?php
                             $content.='<div style="margin-left:141px;">
                            <table>
                            <tr>
                                <td>Name'.'  '.':</td>
                                <td>'.$rows['tp_name'].'</td>
                            </tr>
                             <tr>
                                <td>E-ticket'.'  '.':</td>
                                <td>'.$rows['tp_texteticket'].'</td>
                            </tr>
                             <tr>
                                <td>Booking Date'.'  '.':</td>
                                <td>'.$rows['tp_providerdate'].'</td>
                            </tr>
                            <tr>
                                <td>Dealine'.'  '.':</td>
                                <td>'.$rows['tp_payeddate'].'</td>
                            </tr>
                            <tr>
                                <td>acility'.'  '.':</td>
                                <td>'.$rows['tp_admintext'].'</td>
                            </tr>
                            <tr>
                                <td>Location'.'  '.':</td>
                                <td>'.$rows['tp_textbooking'].'</td>
                            </tr>';
                         $content.'</table></div>';
                         ?>
        <!-- the end of sub transportation -->
                         <?php
                          } 
                     }
                     ?>
            <!--  the end of main transportation-->
                         <?php
                          } 
                     }
                     ?>
   <?php 
   
            $accompany = mod_index::getAccompany($passengerWith);
            $allPassengers = '';    
            $content .= '<div class="clearfix">';
            $content .='<div><img src="assets/img/FE/etichet/information.PNG" height="18"></div>';
            foreach($accompany->result() as $rows){
                $content .= '<table>
                            <tr>
                                <td>Passenger Name</td>
                                <td>:</td>
                                <td>'.$rows->pass_fname.' '.$rows->pass_lname.'</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>'.$rows->pass_email.'</td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>:</td> 
                                <td>'.$rows->pass_phone.'</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>'.$rows->pass_address.'</td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td>:</td>
                                <td>'.$rows->pass_company.'</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>:</td>
                                <td>'.$rows->pass_gender.'</td>
                             </tr>';
                        $content .= '</table>';
                        $content .='<div>&nbsp;</div>';
                     }
            // echo $allPassengers;
            $content .= '</div>';
          //}?>
    <!-- end of transportation -->
        <?php endforeach;

      ?>
<?php
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output($pdfFileName, 'I');