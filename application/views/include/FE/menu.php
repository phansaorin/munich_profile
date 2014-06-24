<div class="row defualt_page menu_tem">
    <div class="col-md-12">
        <ul class="nav navbar-nav" id="menu">
        <?php 

        if($this->uri->segment(2)) $current_0 = $this->uri->segment(2);
        if($this->uri->segment(3)) $current_1 = $this->uri->segment(3);
        if($this->uri->segment(4)) $current_2 = $this->uri->segment(4);

            if(isset($menu_fe)){
                foreach($menu_fe->result() as $value){
                echo '<li>';
                if($this->uri->segment(2)) $current_m = $current_0 == $value->menu_id? "current": ""; else $current_m = "";
                echo anchor("page/".$value->menu_id, ucfirst($value->menu_title),'class="'.$current_m.'"');
                    $submenu1 = $this->db->select("*")
                    ->where('menu_status', 1)
                    ->where('menu_delete', 0)
                    ->where("menu_menu_id", $value->menu_id)
                    ->order_by("menu_position","ASC")
                    ->get('menu');
                    if($submenu1->num_rows() > 0){
                        echo '<ul class="submenu1">';
                        foreach($submenu1->result() as $valueone){
                            if($this->uri->segment(3)) $current_o = $current_1 == $valueone->menu_id? "current": ""; else $current_o = "";
                            echo '<li class="'.$current_o.'">';
                            echo anchor("page/".$value->menu_id.'/'.$valueone->menu_id, ucfirst($valueone->menu_title));
                                $submenu2 =  $this->db->select("*")
                                ->where('menu_status', 1)
                                ->where('menu_delete', 0)
                                ->where("menu_menu_id", $valueone->menu_id)
                                ->order_by("menu_position","ASC")
                                ->get('menu');
                                if($submenu2->num_rows() > 0){
                                    echo '<ul class="submenu2">';
                                    foreach ($submenu2->result() as $valuetwo) {
                                        if($this->uri->segment(4)) $current_t = $current_2 == $valuetwo->menu_id ? "current": ""; else $current_t = "";
                                        echo '<li class="'.$current_t.'">'.anchor("page/".$value->menu_id.'/'.$valueone->menu_id.'/'.$valuetwo->menu_id, ucfirst($valuetwo->menu_title)).'</li>';
                                    }
                                    echo '</ul>';
                                }
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                echo '</li>';
                }
            }
        ?>
        
       
        <li><?php echo anchor("site/booking", ucfirst("booking")); ?></li>
         <li><?php echo anchor("site/feedback", ucfirst("feedback")); ?></li>
        <li><?php echo anchor("site/contact", ucfirst("contact")); ?></li>
        <?php
                $Menuprofile = $this->uri->segment(3);
                if($this->session->userdata('passenger')){ 
                        if($Menuprofile === "profile"){ ?>
                                <li><?php echo anchor('site/profile/', ucfirst('profile')); ?></li>
                                <?php 
                        }
                }
        ?>
        <?php
            if ($Menuprofile !== "profile") {
                    echo '<li>'. anchor('fe_login/loginuser','Log In') .'</li>';
            }else if($Menuprofile === "profile"){ ?>
                                <li><?php echo anchor('fe_login/logout/', ucfirst('log out')); ?></li>
                                <?php 
            }
        ?>

  	</ul>   
    </div>
</div> 