    <ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("festival/list_record","Manage"); ?></li>
      <li>Edit</li>
    </ol>
    <h1 class="action_page_header">Edit Festival</h1>
    
<?php 
    if($get_festival->num_rows() > 0){
        foreach($get_festival->result() as $value){
            $exploded = explode('.', $value->pho_source);
            $pho_source = $exploded['0'].'_thumb.'.$exploded['1'];
        }
    }
?>

<?php  echo form_open('festival/edit_festival/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>
<?php
        foreach ($get_festival->result() as $row) {
            ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Festival Name <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <?php 
                        $festivalName = array('name' => 'festivalName','value'=> $row->ftv_name,'class' => 'form-control');
                        echo form_input($festivalName); 
                ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Festival Detail <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <?php 
                        $festivalDetail = array('name' => 'festivalDetail','value'=> $row->ftv_detail,'class' => 'form-control');
                        echo form_input($festivalDetail); 
                ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Festival Photo <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <select id="demo-htmlselect-basic" style="width:400px;" name="festivalPhotos">
                        <?php
                            if($txtPhotos->num_rows() > 0){
                                foreach($txtPhotos->result() as $values){ 
                                    $exploded = explode('.', $values->pho_source);
                                    $image = $exploded['0'].'_thumb.'.$exploded['1'];
                                    if($pho_source == $image){
                                        $photos[$values->photo_id]="<option selected='selected' value='".$values->photo_id."' id='demo-htmlselect-basic' data-imagesrc=".site_url('user_uploads/thumbnail/thumb/'.$image).">".$values->pho_name."</option>";                                   
                                    }else{
                                        $photos[$values->photo_id]="<option value='".$values->photo_id."' id='demo-htmlselect-basic' data-imagesrc=".site_url('user_uploads/thumbnail/thumb/'.$image).">".$values->pho_name."</option>";
                                    }
                                    echo $photos[$values->photo_id];
                                } 
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Festival Location <sup class="require">*</sup>:</label>
                <div class="col-sm-4">
                    <?php 
                        $location = array();
                            if($festivalLocation->num_rows > 0){   
                                foreach($festivalLocation->result() as $value){
                                    $location['0'] = "--- select ---";
                                    $location[$value->lt_id] = $value->lt_name;

                                }
                            }
                    echo form_dropdown('old_txtLocation', $location, $row->ftv_lt_id, 'class="form-control"');  
                    ?>
                </div>
            </div>
<?php }?>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php 
            echo form_submit('edit_festival', 'Save',"class='btn btn-primary'");
            echo '  ';
            echo anchor('festival/list_record', 'Cancel', "class='btn btn-sm btn-default'");
        ?>
    </div>
</div