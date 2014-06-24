<div class="row">
  <?php 
    if($content_fe->num_rows() > 0){
      $photos = array();
      foreach ($content_fe->result() as $value) {
        $content_title = anchor('page/'.$value->con_menu_id, $value->con_title);
        $content_text = $value->con_text;
        if(isset($value->pho_name))
        $photos[] = img(array('src'=>'user_uploads/'.$value->pho_name,'alt'=>$value->pho_name,'class'=>'img-thumbnail'));
      }
  ?>
    <h1><?php echo $content_title; ?></h1>
    <div class="row clearfix">
      <?php 
        if(count($photos) > 0 AND $photos[0] != ""){
          $content_class = "col-lg-9";
          $img_div_class = "col-lg-3";
        }else{
          $content_class = "col-lg-12";
          $img_div_class = "hide";
        }
      ?>
      <div class="<?php echo $content_class; ?>"><?php echo $content_text; ?></div>
      <div class="<?php echo $img_div_class; ?>"><?php echo implode($photos); ?></div>
    </div>
  <?php 
    }
  ?>
</div>