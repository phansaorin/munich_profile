
<?php 
	$query = $this->db->select('*')
			->from('photo')
			->join('photo_type','photo_type.pt_id = photo.pt_id')
			->where('photo.pt_id',5)
			->where('photo.pho_delete',0)
			->limit(5)
    		->get();
    	?>
    	<?php if($query->num_rows() > 0){?>
    			<div class="row defualt_page">
                       <div class="container-slide" id="slides">
                       	<?php foreach($query->result() as $value){?>
                       		 <?php    
				                $id = 1;
				                if ($this->uri->segment(3)) {
				                    $id = $this->uri->segment(3) + 1;
				                } else {
				                    $id = 1;
				                }   
				                $exploded = explode('.', $value->pho_source);
				                $img = $exploded['0'] . '.'.$exploded['1'];//user_uploads/thumbnail/thumb/
				                $image_properties = array('src' => site_url('user_uploads/thumbnail/original/' . $img), 'alt' => $value->pho_name,'title' => $value->pho_name);            
				                echo img($image_properties);?>      		
				               <?php	}?>
                		 </div>
                </div>
        <?php }?>

