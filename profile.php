<?php
    include_once 'includes/register_inc.php';
    include_once 'includes/functions.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AnalystWars User Profile</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
   
   
   <nav class="top-bar" data-topbar>
          <ul class="title-area">
              
              <li class="name">
                  <h1><a href="index.html">ANALYST WARS</a></h1>
              </li>
              <li class="toggle-topbar menu-icon"><a href="#">menu</a></li>
          </ul>
          
          <section class="top-bar-section">
             
              <ul class="right">
                  <li class="divider"></li>
                  <li><a href="includes/logout.php">LOG OUT</a></li>    
                  <li class="divider"></li> 
                  <li class="has-dropdown"><a href="#">ACCOUNT</a>
                             <ul class="dropdown">
                                  <li><a href="settings.php">SETTINGS</a></li>
                                  <li><a href="faq.php"></a>HELP</li>        
              		     </ul>
          </section>
   </nav>
   
    <br />
    
     
   

  <div class="row">
    <div class="large-18 columns">
      
      		
      		<div class="large-6 columns ">
        	<h3>NAME</h3>
        	</div>
        	<div class="large-4 columns "> 
        	<label>Enter Stock Symbol</label>
        	<input type="search"></input> <!--for yql-->
        	</div>
        	
      
    </div>
  </div>

  <hr/>


  <div class="row">



 
    <div class="large-6 columns ">
      
        <a href="#"><img src="http://placehold.it/300x240&text=[img]"/></a>
        
         <div class="section-container vertical-nav" data-section data-options="deep_linking: false; one_up: true">
          <section class="section">
            <h5 class="title"><a href="settings.php">Update Profile</a></h5>
          </section>
          <section class="section">
            <h5 class="title"><a href="#">Create Stock Ratings</a></h5>
          </section>
          <section class="section">
            <h5 class="title"><a href="#">Complete Leaderboard</a></h5>
          </section>
       
          <section class="section">
            <h5 class="title"><a href="#">Research Stocks</a></h5>
          </section>
           <section class="section">
            <h5 class="title"><a href="#">How To? Videos</a></h5>
          </section>
          <section class="section">
            <h5 class="title"><a href="includes/logout.php">Log out</a></h5>
          </section>
         </div>

     
    </div>
    
   
    <div class="large-8 columns">
    
		<h5>
		ANALYST WARS SOCIAL FEED
		</h5>
      
    
    </div>

    
   
    <aside class="large-4 columns hide-for-small">
    	
    		<h5>LEADERBOARD</h5>
    </aside>

  </div>


 

  <footer class="row">
    <div class="large-18 columns">
      <hr />
      <div class="row">
        <div class="large-8 columns">
          <p>&copy; ANALYST WARS</p>
        </div>
        <div class="large-10 columns">
          <ul class="inline-list right">
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
 


    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>