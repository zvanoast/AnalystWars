<?php
//$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

//array containing possible errors
$errors = array(
	1 => 'Your account has been locked due to a high number of failed login attempts.',
	2 => 'Invalid email/password combination.',
	);

//set the error displayed to the corresponding error
if (isset($_GET['err'])) {
	$error_id = (int)$_GET['err'];
}
else {
	$error_id = 0;
}
error_log($error_id);
if (($error_id != 0) && (array_key_exists($error_id, $errors))) {
    $error_disp = $errors[$error_id];
}
else {
    $error_disp = 'An unknown error happened.';
}
error_log($error_disp);


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Error</title>
        <link rel="stylesheet" href="css/foundation.css" />
    	<script src="js/vendor/modernizr.js"></script>
    </head>
    <body>
    
    	<nav class="top-bar" data-topbar>
          <ul class="title-area">
              
              <li class="name">
                 <h1><a href="index.html">ANALYST WARS</a></h1>
              </li>
              <li class="toggle-topbar menu-icon">
              	<a href="#">menu</a>
              </li>
          </ul>
          
          <section class="top-bar-section">
              
              <ul class="right">
                  <li class="divider"></li>
                  <li><a href="login.php">LOG IN</a></li>
                  <li class="divider"></li>
                  <li><a href="signup.php">SIGN UP</a></li>
              </ul>
          </section>
   	</nav>
   <br>
   	<div class="row">
	      	<div class="large-18 columns">
      		<div class="panel">	
        	<center><h2>An Error Has Occurred:</h2> 
        	<p class="error"><?php echo $error_disp; ?></p>  
    	
    	</div>
    	</div>
    	</div>
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    </body>
</html>