<?php $this->load->view(INCLUDE_FE.'booking/location'); ?>
<div class="row">
<?php 
  if(isset($param2error)){
  	echo $param2error;
  }else{
  	if(isset($getFtvByLcID)){
        if($getFtvByLcID->num_rows() > 0){
        	$allfetival = '';
        	$locationname = ''; 
        	echo '<div class="clearfix">';
			foreach($getFtvByLcID->result() as $ftv){
				$locationname = '<h3 class="h3_location">'.ucfirst($ftv->lt_name).'</h3>';
				$allfetival .= '<div class="col-lg-3 .col-xs-6 div-ftv-contain"><div class="div-ftv">
                    '.img(array('src'=>'user_uploads/thumbnail/original/'.$ftv->pho_source,'alt'=>$ftv->ftv_name,'class'=>'img-responsive img-thumbnail')).'
                    <h4>'.$ftv->ftv_name.'</h4>
                    <p>'.character_limiter($ftv->ftv_detail, 100).'</p>';
                $allfetival .= form_open('site/booking/tour_type');
                $allfetival .= form_hidden('ftv_id',$ftv->ftv_id);
                $allfetival .= form_hidden('location_id',$ftv->ftv_lt_id);
                $allfetival .= form_submit('submit', 'Book','class="btn-info pull-right"');                            
                $allfetival .= form_close();
                $allfetival .= '<p class="clearfix"></p>';
                $allfetival .= '</div></div>';
			}
			echo $locationname;
			echo $allfetival;
			echo '</div>';
		}else{
			echo 'There record was found';
		}
	}else{
		echo "problem in the connecting...";
	}
  }
?>