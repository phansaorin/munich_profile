<div class="row">
<?php 
    if(isset($festival)){
        if($festival->num_rows() > 0){
            $location = 0;
            $countView = 0;
            $viewall = false;
            foreach($festival->result() as $ftv){
                if($location != 0){
                    if($location == $ftv->ftv_lt_id){
                        if($countView == 0 OR $countView <= 3){
                            echo '<div class="col-lg-3 .col-xs-6 div-ftv-contain"><div class="div-ftv">
                                '.img(array('src'=>'user_uploads/thumbnail/original/'.$ftv->pho_source,'alt'=>$ftv->ftv_name,'class'=>'img-responsive img-thumbnail')).'
                                <h4>'.$ftv->ftv_name.'</h4>
                                <p>'.character_limiter($ftv->ftv_detail, 100).'</p>';
                                echo form_open('site/booking/tour_type');
                                echo form_hidden('ftv_id',$ftv->ftv_id);
                                echo form_hidden('location_id',$ftv->ftv_lt_id);
                                echo form_submit('submit', 'Book','class="btn-info pull-right"');                            
                                echo form_close();
                                echo '<p class="clearfix"></p>';
                            echo '</div></div>';
                            $countView = $countView + 1;
                        }else{
                            if(! $viewall){ 
                                $salt = "90408752631";
                                $encrypted_id = base64_encode($ftv->ftv_lt_id.$salt);
                                echo '<p class="clearfix"></p>';
                                echo anchor("site/booking/view_more/".$encrypted_id, 'View more...', 'class="btn btn-default pull-right"'); 
                                $viewall = true;
                            }
                        }
                    }else{
                        $countView = 1;
                        $viewall = false;
                        $location = $ftv->ftv_lt_id;
                        echo '</div><div class="clearfix"><h3 class="h3_location">'.ucfirst($ftv->lt_name).'</h3>';
                        echo '<div class="col-lg-3 .col-xs-6 div-ftv-contain"><div class="div-ftv">
                            '.img(array('src'=>'user_uploads/thumbnail/original/'.$ftv->pho_source,'alt'=>$ftv->ftv_name,'class'=>'img-responsive img-thumbnail')).'
                            <h4>'.$ftv->ftv_name.'</h4>
                            <p>'.character_limiter($ftv->ftv_detail, 100).'</p>';
                            echo form_open('site/booking/tour_type');
                            echo form_hidden('ftv_id',$ftv->ftv_id);
                            echo form_hidden('location_id',$ftv->ftv_lt_id);
                            echo form_submit('submit', 'Book','class="btn-info pull-right"');
                            echo form_close();
                            echo '<p class="clearfix"></p>';
                        echo '</div></div>';  
                    }
                }else{
                    $countView = 1;
                    $viewall = false;
                    $location = $ftv->ftv_lt_id;
                    echo '<div class="clearfix"><h3 class="h3_location">'.ucfirst($ftv->lt_name).'</h3>';
                    echo '<div class="col-lg-3 .col-xs-6 div-ftv-contain"><div class="div-ftv">
                            '.img(array('src'=>'user_uploads/thumbnail/original/'.$ftv->pho_source,'alt'=>$ftv->ftv_name,'class'=>'img-responsive img-thumbnail')).'
                            <h4>'.$ftv->ftv_name.'</h4>
                            <p>'.character_limiter($ftv->ftv_detail, 100).'</p>';
                        echo form_open('site/booking/tour_type');
                        echo form_hidden('ftv_id',$ftv->ftv_id);
                        echo form_hidden('location_id',$ftv->ftv_lt_id);
                        echo form_submit('submit', 'Book','class="btn-info pull-right"');
                            echo '<p class="clearfix"></p>';
                        echo form_close();
                    echo '</div></div>';
                }
            }
        }else{
            echo "There is no record of festivals";
        }
        echo '</div>';
    }else{
        echo "problem connecting...";
    }
 ?>
</div>