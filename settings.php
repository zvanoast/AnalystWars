<?php
    include_once 'includes/register_inc.php';
    include_once 'includes/functions.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AnalystWars Profile Setttings</title>
    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.magellan.js"></script>
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
                  <li><a href="includes/logout.php">LOG OUT</a></li>
	      </ul>
          </section>
   </nav>
      
     

<hr />

<div class="row">
      <div class="large-6 medium-10 small-centered columns">
      	
          <div class="callout panel">
          <center><h5>PROFILE SETTINGS</h5></center>
            <form method="post" action="" name="">
            	<fieldset>
            	
                	<div class="row">
                                
                                    <label>Select a Profile Picture</label>
                                    <input id="" name="" type="file"></input>
                                    <img alt="" class="" src="http://placehold.it/300x240&text=[img]"/>
                               
                        </div>

                
                    	<div class="row">
                               
                                    <label>Email Address</label>
                                    <input type="text" name="email"  />
                                
                        </div>
                        
                        <div class="row">
                                
                                    <label>First Name</label>
                                    <input type="text" name="firstName" />
                                
                        </div>
                        <div class="row">
                            	
                                	<label>Last Name</label>
                                	<input type="text" name="lastName" />
                            	
                        </div>
                        <div class="row">
                                
                                    	<label>Change Password</label>
                                    	<input type="password" name="password" />
                               
                        </div>
                      
               		<div class="row">
                               
                                    <label>Date of Birth</label>
                                    <input type="date" name="dateOfBirth" />
                                
                        </div>
                        
                        <div class="row">
                                
                                    <label>Education Level</label>
                                      <select name="educationLevel">
                                      	    <option value=""></option>
                                            <option value="HighSchoolDiploma">High School Diploma/GED</option>
                                            <option value="Bachelors">Bachelor&#39s Degree</option>
                                            <option value="Masters">Master&#39s Degree</option>
                                            <option value="PhD">Doctor of Philosophy</option>
                                       </select>
                                   
                        </div>
                        
                        <div class="row">
                                 
                                            <label>Investment Experience</label>
                                            <textarea placeholder="Short or Long Term Investment Experience"></textarea>
                                  
                        </div>
                        
                        <div class="row">
                                  
                                            <label>Reserach Expertise</label>
                                            <textarea placeholder="Sector or Market Cap Research Expertise"></textarea>
                                 
                        </div>
                       

               
               		<div class ="row">
               			
                            	<center><input class="small radius button" type= "submit" value="SAVE" onclick=""/></center><br>
                         	
                        </div>
                        
                 </fieldset>
              </form>
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