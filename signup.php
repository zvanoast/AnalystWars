<?php
    include_once 'includes/register_inc.php';
    include_once 'includes/functions.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AnalystWars Signup</title>
    <script type="text/JavaScript" src="js/sha512.js"></script> 		<!-- JS -->
    <script type="text/JavaScript" src="js/forms.js"></script>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
  <nav class="top-bar" data-topbar>
          <ul class="title-area">
             
              <li class="name">
                  <h1><a href="index.html">Analyst Wars</a></h1>
              </li>
              <li class="toggle-topbar menu-icon">
              <a href="#">menu</a>
              </li>
          </ul>
          
          <section class="top-bar-section">
             
              <ul class="right">
                  <li class="divider"></li>
                  <li><a href="login.php">LOG IN</a></li>
	      </ul>
          </section>
   </nav>
      
     

<hr />

<div class="row">
      <div class="large-5 medium-10 small-centered columns">
      	<div class="callout panel">
              <center><h5>CREATE YOUR ACCOUNT</h5></center>
              <br />

                    <form data-abide method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" name="registration_form">
                    	<fieldset>
                    	<div class="row">
                                    <label>Email Address</label>
                                    <input type="text" name="email" placeholder="xyz@gmail.com" required>
                                    <small class="error">An email address is required.</small>
                        </div>
                        <div class="row">
                                
                                    <label>First Name</label>
                                    <input type="text" name="firstName" placeholder="John" required>
                                    <small class="error">A first name is required</small> 
                        </div>
                        <div class="row">
                            
                                    <label>Last Name</label>
                                    <input type="text" name="lastName" placeholder="Doe" />
                           
                        </div>
                        <div class="row">
                               
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Passw0rd" required>
                                    <small class="error">Passwords must be at least 6 characters with 1 capital letter & 1 number</small> <!--error can be modified for password requirements-->
                        </div>
                        <div class="row">
                               
                                    <label>Repeat Password</label>
                                    <input type="password" name="confirmpwd" placeholder="Passw0rd" data-equalto="password" >
                                    <small class="error">Passwords must match</small>
                        </div>
                      	<div class="row">
           			    <center><label>I agree to the <a href="#">Terms and Conditions</a></label>
                                    <input id="checkbox1" type="checkbox" required></center>
                                    <small class="error">You must agree to the terms and conditions</small>
                        </div>
                        
                        <div class ="row">
                            
                            <center><input class="small radius button" type= "submit" value="REGISTER" onclick="return regformhash(this.form,
											                                   this.form.email,
											                                   this.form.password,
											                                   this.form.confirmpwd);"/><br/></center>
                        </div>
                        
			</fieldset>
                    </form>
               

	    </div>
      </div>
 </div>



      
    
          


    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.abide.js"></script>    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>