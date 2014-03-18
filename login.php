<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
/*
if (login_check($mysqli) == true) {			//commented out
    $logged = 'in';
} else {
    $logged = 'out';
}
*/
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AnalystWars Log In</title>
    <script type="text/JavaScript" src="js/sha512.js"></script> 		<!-- JS -->
    <script type="text/JavaScript" src="js/forms.js"></script>
    
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
  <nav class="top-bar" data-topbar>
          <ul class="title-area">
              
              <li class="name">
                  <h1>
                      <a href="index.html">
                          ANALYST WARS
                      </a>
                  </h1>
              </li>
              <li class="toggle-topbar menu-icon"><a href="#">menu</a></li>
          </ul>
          
          <section class="top-bar-section">
              
              <ul class="right">
                  
                  <li class="divider"></li>
                  <li><a href="signup.php">SIGN UP</a></li>
                  
              </ul>
          </section>
    </nav>
      
      
<br>
 
    
<div class="row">
      <div class="large-5 medium-8 small-centered columns">
      		<div class="panel"> 
      		    <center><h5>PLEASE ENTER</h5></center>
                    <form action="includes/process_login.php" method="post" name="login_form">
			<fieldset>

  			<div class="email-field">
    				<label>Email Address 
      				<input type="text" name="email" Placeholder="xyz@gmail.com">
    				</label>
    				
  			</div>	
  			<div class="password-field">
    				<label>Password
      				<input type="password" name="password" placeholder="Passw0rd">
    				</label>
    				
  			</div>
  
  			<center>
  			<input id="" type="checkbox"><label for="">Remember Me</label> <!--needs work-->
  			<br>
  			<input class="small radius button" type="submit" value="LOGIN" onclick="return formhash(this.form, this.form.password);"/>
  			</center>
  			</fieldset>	 
	 
		    </form>
                
                	<div class ="row">
                		<div class="large-18 medium-18 small-centered columns">
                                    <center><a href="#" data-dropdown="drop" class="small alert radius button dropdown">NEED HELP?</a><br>
                                    <ul id="drop" data-dropdown-content class="f-dropdown">
                                    <li><a href="#">Forgot Password</a></li>
                                    <li><a href="#">Forgot Email Address</a></li>
                                    </ul>
                                </div>                                        
                	</div>
                	
            	</div>
   	</div>
</div>
<hr>
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
  </body>
  
</html>