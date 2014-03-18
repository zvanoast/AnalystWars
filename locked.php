<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'Your account has been locked due to too many unsuccessful logins.';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Error</title>
        <link rel="stylesheet" href="styles/main.css" />
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
                  <li><a href="signup.php">SIGN UP</a></li>
	      </ul>
          </section>
   </nav>
        <div class="row"> 
        	<div class="large-10 large-centered columns">
      			<div class="panel">
        
        			<h1>There was a problem</h1>
        			<p class="error"><?php echo $error; ?></p>  
   
   			</div>
   		</div>
   	</div>
   
   
   
   </body>
</html>