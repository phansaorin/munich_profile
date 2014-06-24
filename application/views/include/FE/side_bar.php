<ul style="max-width: 300px;" class="list-group">
	<?php 
		$menu = $this->uri->segment(2);
		$current_id = $menu;
		if($this->uri->segment(4)){
			$current_id = $this->uri->segment(4);
		}elseif($this->uri->segment(3)){
			$current_id = $this->uri->segment(3);
		}

		$menu_parent = $this->db->select("*")->where('menu_status', 1)->where('menu_delete', 0)->where("menu_id", $menu)->get('menu');
		if($menu_parent->num_rows() > 0){
			foreach($menu_parent->result() as $parent){
				$current = $current_id == $parent->menu_id? "current": "";
				echo '<li class="'.$current.' list-group-item">'.anchor("page/".$parent->menu_id, ucfirst($parent->menu_title)).'</li>';
			}
		}

		$subMenu1 = $this->db->select("*")->where('menu_status', 1)->where('menu_delete', 0)->where("menu_menu_id", $menu)->get('menu');
		if($subMenu1->num_rows() > 0){
			foreach($subMenu1->result() as $value){
				$current = $current_id == $value->menu_id? "current": "";
				echo '<li class="'.$current.' list-group-item"><i class="icon-chevron-right"></i>&nbsp;&nbsp;'.anchor("page/".$menu.'/'.$value->menu_id, ucfirst($value->menu_title)).'</li>';
				$subMenu2 = $this->db->select("*")->where('menu_status', 1)->where('menu_delete', 0)->where("menu_menu_id", $value->menu_id)->get('menu');
				if($subMenu2->num_rows() > 0){
					foreach ($subMenu2->result() as $valueone) {
						$current = $current_id == $valueone->menu_id? "current": "";
						echo '<li class="'.$current.' list-group-item"><i class="icon-chevron-right"></i><i class="icon-chevron-right"></i>&nbsp;&nbsp;'.anchor("page/".$menu.'/'.$value->menu_id.'/'.$valueone->menu_id, ucfirst($valueone->menu_title)).'</li>';
					}
				}
			}
		}
	?>
  <!-- <li class="current list-group-item"><a href="#">Home</a></li>
  <li class="list-group-item"><a href="#">Profile</a></li>
  <li class="list-group-item"><a href="#">Messages</a></li> -->
</ul>
