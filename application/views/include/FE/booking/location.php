<div class="row clearfix">
	<div class="form-group">
        <div class="col-sm-3 col-sm-offset-9">
            <?php 
                $locations = array();
                $locations[''] = "--- select country ---";
                    if($getLocation->num_rows > 0){
                        foreach($getLocation->result() as $value){
                            $locations[$value->lt_id] = $value->lt_name;
                        }
                    }
            echo form_dropdown('select_value', $locations, '', 'class="form-control"');  
            ?>
        </div>
    </div>
</div>