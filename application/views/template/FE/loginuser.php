 <html lang="en">
        <head>
            <title>Login Passenger</title>
            <?php
                echo link_tag("assets/css/External/bootstrap.css");
                echo link_tag("assets/css/External/bootstrap.min.css");
                echo link_tag("assets/css/External/bootstrap-responsive.css");
                echo link_tag("assets/css/External/bootstrap-responsive.min.css");
                echo link_tag("assets/css/BE/style.css");
            ?>
            <script type="text/javascript">
					function validate() {
						if (myform.txt_email.value.length == 0) {
							document.getElementById("txt_email").value = document.getElementById("txt_email").value;
							document.getElementById("errorMessage").style.display = "block";
						}
						if(myform.txt_password.value.length == 0){
							document.getElementById("txt_password").value = document.getElementById("txt_password").value;
							document.getElementById("errorMessage1").style.display = "block";
							}
						
					}
    </script>
    	</head>
		<body class="page-admin">
        			
                <div class="container-fluid">
               
                                <form class="form-horizontal form-login" method="post" action="fe_login/loginuser" role="form" name="myform">
                                      <h3 class="form-login-heading">Log In</h3>
                                      <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-8">
                                           
                              			<input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email" onblur="validate()"></input>
                                            <span id="errorMessage" style="display:none; color:#F00;">Email field must not be empty!</span>
                                    
                              			</div>
                                      </div>
                                      <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-8">
                                          <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Password" onblur="validate()">
                                       		<span id="errorMessage1" style="display:none; color:#F00;">Password field must not be empty!</span>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <div class="checkbox">
                                            <label class="checkbox" for="remember">
                    				<input type="checkbox" name="remember" value="remember-me" /> Remember me
                			    </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <input type="submit" class="btn btn-default" name="btn_loginfe" value="Log In" onClick="validate()"/>
                                        </div>
                                      </div>
                                </form>
                                
                                 
                </div>

  </body>
</html>