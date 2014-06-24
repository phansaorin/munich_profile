<div class="row clearfix">
	<div class="col-md-12 column">
	    <div class="row clearfix header">
	        <div class="col-md-2 column">
	            <?php echo img("assets/img/BE/codingate-logo.png"); ?>
	        </div>
	        <div class="col-md-7 column dashboard"><h1> Dashboard</h1></div>
	        <div class="col-md-3 column logout-profile">
	           <!-- <span id="profile-name"> Hi, Administrator </span>
	            <span id="profile-icon"> <?php// echo img("assets/img/BE/20090218213201657.png"); ?></span>
	            <span id="setting"><?php// echo anchor("setting/module_settings",img("assets/img/BE/setting.png")); ?></span>
	        	<span id="logout"><?php// echo anchor("login/logout",img("assets/img/BE/logout-icon.png")); ?></span>-->
                
                 <span class="logout">
                           <font color="#FFFFFF">Welcome to &nbsp; &nbsp;</font>
						   <?php 
								 echo anchor('profile/detail_profile/'.$this->session->userdata('userid'), $this->session->userdata('full_username'));
                           ?>
                           &nbsp; &nbsp;|&nbsp; &nbsp;
                           <?php echo anchor('login_admin/logout','<font color="#FFFFFF">Log out</font>','onclick="return confirm(\'Are you sure want to logout from the system?\');"'); ?>
					</span>
                
	        </div>
	    </div>
	</div>
<div>&nbsp;</div>
</div>
