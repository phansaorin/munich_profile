<div class="container-fluid">
<?php $this->load->view(INCLUDE_BE.'tm_header'); ?>
<div class="container">
    <div class="col-md-2 dboard-padding">
        <?php 
            $booking_img = array(
                'src' => 'assets/img/BE/5775652_l.jpg',
                'alt' => 'booking',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Booking'
            );
        ?>
        <?php 
            echo anchor('booking/list_record',img($booking_img)).br(1);
            echo anchor('booking/list_record',"Booking");  
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $customize_img = array(
                'src' => 'assets/img/BE/customize.jpg',
                'alt' => 'customize',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Customize'
            );
        ?>
        <?php 
            echo anchor('customize/list_record',img($customize_img)).br(1); 
            echo anchor('customize/list_record',"Customize"); 
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $package_img = array(
                'src' => 'assets/img/BE/basic-package.png',
                'alt' => 'package',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Packages'
            );
        ?>
        <?php 
            echo anchor('package/list_record',img($package_img)).br(1);
            echo anchor('package/list_record',"Packages");
         ?>
    </div>
    <div class="col-md-2 dboard-padding">  
        <?php 
            $activities_img = array(
                'src' => 'assets/img/BE/activities-puzzle.gif',
                'alt' => 'activity',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Activities'
            );
        ?>
    	<?php 
            echo anchor('activities/list_record',img($activities_img)).br(1); 
            echo anchor('activities/list_record',"Activities"); 
        ?> 
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $accomodation_img = array(
                'src' => 'assets/img/BE/hotel-sleeping-accomodation-md.png',
                'alt' => 'accomodation',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Accomodation'
            );
        ?>
        <?php 
            echo anchor('accommodation/list_record',img($accomodation_img)).br(1); 
            echo anchor('accommodation/list_record',"Accommodation"); 
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $transportation_img = array(
                'src' => 'assets/img/BE/transportationIcon.jpg',
                'alt' => 'transportation',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Transportation'
            );
        ?>
        <?php 
            echo anchor('transportation/list_record',img($transportation_img)).br(1); 
            echo anchor('transportation/list_record',"Transportation"); 
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $extra_product_img = array(
                'src' => 'assets/img/BE/bag.jpg',
                'alt' => 'extra_product',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Extra Products'
            );
        ?>
        <?php 
            echo anchor('extra_products/list_record',img($extra_product_img)).br(1);
            echo anchor('extra_products/list_record',"Extra Products"); 
        ?>
    </div>
    <!-- <div class="col-md-2 dboard-padding">
        <?php 
            // $calendar_img = array(
            //     'src' => 'assets/img/BE/calendar.png',
            //     'alt' => 'Calendar Trips',
            //     'class' => 'img-thumbnail images-dashboard',
            //     'title' => 'Calendar Trips'
            // );
        ?>
        <?php 
            // echo anchor('calendar/list_accCalendar',img($calendar_img)).br(1); 
            // echo anchor('calendar/list_accCalendar',"Calendar Trips");
        ?>
    </div> -->
    <div class="col-md-2 dboard-padding">
        <?php 
            $festival_img = array(
                'src' => 'assets/img/BE/festival.jpg',
                'alt' => 'Festivals',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Festivals'
            );
        ?>
        <?php 
            echo anchor('festival/list_record',img($festival_img)).br(1); 
            echo anchor('festival/list_record',"Festivals");
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $location_img = array(
                'src' => 'assets/img/BE/Location-Change.jpg',
                'alt' => 'location',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Locations'
            );
        ?>
        <?php 
            echo anchor('location/list_record',img($location_img)).br(1); 
            echo anchor('location/list_record',"Locations");
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $photo_img = array(
                'src' => 'assets/img/BE/photo.jpg',
                'alt' => 'Photo galleries',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Photo galleries'
            );
        ?>
        <?php 
            echo anchor('gallery/list_record',img($photo_img)).br(1); 
            echo anchor('gallery/list_record',"Photo galleries");
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $content_img = array(
                'src' => 'assets/img/BE/content.png',
                'alt' => 'Content Management',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Content Management'
            );
        ?>
        <?php 
            echo anchor('content/list_record',img($content_img)).br(1); 
            echo anchor('content/list_record',"Contents");
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $menu_img = array(
                'src' => 'assets/img/BE/menu.png',
                'alt' => 'Menu Management',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Menu Management'
            );
        ?>
        <?php 
            echo anchor('menu/list_record',img($menu_img)).br(1); 
            echo anchor('menu/list_record',"Navigation");
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $passenger = array(
                'src' => 'assets/img/BE/Affiliate-call-tracking.png',
                'alt' => 'passenger',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Passengers'
            );
        ?>
        <?php echo anchor('passenger/list_record',img($passenger)).br(1); 
              echo anchor('passenger/list_record',"Passengers"); 
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $supplier_img = array(
                'src' => 'assets/img/BE/SupplierDiversityLogo.jpg',
                'alt' => 'passenger',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Supplier'
            );
        ?>
        <?php 
            echo anchor('supplier/list_record',img($supplier_img)).br(1); 
            echo anchor('supplier/list_record',"Supplier");
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $user_img = array(
                'src' => 'assets/img/BE/create_user.png',
                'alt' => 'user',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Users'
            );
        ?>
        <?php 
            echo anchor('user/list_record',img($user_img)).br(1);
            echo anchor('user/list_record',"Users"); 
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $subscribe_img = array(
                'src' => 'assets/img/BE/subscribe.jpg',
                'alt' => 'Subscribers',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Subscribers'
            );
        ?>
        <?php echo anchor('subscriber/list_record',img($subscribe_img)).br(1); 
              echo anchor('subscriber/list_record',"Subscribers"); 
        ?>
    </div>
    <div class="col-md-2 dboard-padding">
        <?php 
            $feedback_img = array(
                'src' => 'assets/img/BE/feedback.jpg',
                'alt' => 'Feedbacks',
                'class' => 'img-thumbnail images-dashboard',
                'title' => 'Feedbacks'
            );
        ?>
        <?php echo anchor('feedbacks/list_record',img($feedback_img)).br(1); 
              echo anchor('feedbacks/list_record',"Feedbacks"); 
        ?>
    </div>
</div>
  	<?php $this->load->view(INCLUDE_BE.'tm_footer'); ?> 
</div>