<?php
    include_once 'includes/register_inc.php';
    include_once 'includes/functions.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BORN FREE beta SIGNUP</title>
    <script type="text/JavaScript" src="js/sha512.js"></script> 		<!-- JS -->
    <script type="text/JavaScript" src="js/forms.js"></script>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
  <nav class="top-bar" data-topbar>
          <ul class="title-area">
              <!-- Title Area -->
              <li class="name">
                  <h1><a href="index.html">Analyst Wars</a></h1>
              </li>
              <li class="toggle-topbar menu-icon">
              <a href="#">menu</a>
              </li>
          </ul>
          
          <section class="top-bar-section">
              <!-- Right Nav Section -->
              <ul class="right">
                  <li class="divider"></li>
                  <li><a href="login.php">LOG IN</a></li>
	      </ul>
          </section>
   </nav>
      
      <!-- End Top Bar --> 

<hr />

<div class="row">
      <div class="large-14 large-centered columns">
      	<div class="panel">
              <center><h5>Please Sign Up Using Your Email:</h5></center>
              <br />
            <div class ="row">
                <div class="large-6 medium-6 columns">
                    
                </div>
                <div class="large-6 large-centered columns">
                
                    <form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" name="registration_form">
                    	<div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>Email Address</label>
                                    <input type="text" name="email" placeholder="Required" />
                                </div>
                        </div>
                        <div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>First Name</label>
                                    <input type="text" name="firstName" placeholder="Required" />
                                </div>
                        </div>
                        <div class="row">
                            <div class="large-18 medium-18 columns">
                                <label>Last Name</label>
                                <input type="text" name="lastName" placeholder="Required" />
                            </div>
                        </div>
                        <div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Required" />
                                </div>
                        </div>
                        <div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>Repeat Password</label>
                                    <input type="password" name="confirmpwd" placeholder="Required" />
                                </div>
                        </div>
                        
                        <div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dateOfBirth" />
                                </div>
                        </div>
                        
                        <div class="row">
                                 <div class="large-18 medium 18 columns">
                                    <label>Marital Status</label>
                                      <select name="maritalStatus">
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                       </select>
                                   </div>
                        </div>
                        <div class="row">
                                 <div class="large-18 medium 18 columns">
                                    <label>Education Level</label>
                                      <select name="educationLevel">
                                            <option value="HighSchoolDiploma">High School Diploma/GED</option>
                                            <option value="Bachelors">Bachelor's Degree</option>
                                            <option value="Masters">Master's Degree</option>
                                            <option value="PhD">Doctor of Philosophy</option>
                                       </select>
                                   </div>
                        </div>
                        <hr />
                        <div class="row">
                                 <div class="large-18 medium 18 columns">
                                    <center><h5>FINANCIAL ASSESSMENT</h5></center>
                                   </div>
                        </div>
                        
                        <div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>Approximate Net Worth</label>
                                    <input type="number" name="approxNetWorth" Placeholder="$ xxxxx" />
                                </div>
                        </div>
                        <div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>Approximate Credit Score</label>
                                    <input type="number" name="approxCreditScore" placeholder="xxx" />
                                </div>
                        </div>
                        <div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>Outstanding Loans or Debt Amount</label>
                                    <input type="number" name="outstandingDebt" placeholder="$ xxxxx" />
                                </div>
                        </div>
                        <div class="row">
                                 <div class="large-18 medium 18 columns">
                                    <label>Living Status</label>
                                      <select>
                                            <option value="HomeOwner">Home Owner</option>
                                            <option value="Rental">Rental</option>
                                      </select>
                                   </div>
                        </div>
                        <div class="row">
                                <div class="large-18 medium-18 columns">
                                    <label>Number of Dependents</label>
                                    <input type="number" placeholder="xx" />
                                </div>
                        </div>
                        <div class="row">
                                  <div class="large-18 medium-18 columns">
                                            <label>Financial Objectives</label>
                                            <textarea placeholder="Please state your short or long term financial objectives"></textarea>
                                  </div>
                        </div>
                        <div class="row">
                                  <div class="large-18 medium-18 columns">
                                            <label>Tax Status</label>
                                            <textarea placeholder="Please provide details regarding your tax status"></textarea>
                                  </div>
                        </div>
                        
                        <hr />

                        <div class="row">
                                 <div class="large-18 medium 18 columns">
                                    <center><h5>INVESTMENT ASSESSMENT</h5></center>
                                 </div>
                        </div> 
                        <div class="row">
                                  <div class="large-18 medium-18 columns">
                                            <label>Investment Objectives</label>
                                            <textarea placeholder="Please state your short or long term investment objectives"></textarea>
                                  </div>
                        </div>
                        <div class="row">
                                  <div class="large-18 medium-18 columns">
                                            <label>Risk Tolerance</label>
                                            <textarea placeholder="Please provide details regarding your risk tolerance level"></textarea>
                                  </div>
                        </div>
                        <div class="row">
                                  <div class="large-18 medium-18 columns">
                                            <label>Time Horizon</label>
                                            <textarea placeholder="Please provide details regarding your investment time horizon"></textarea>
                                  </div>
                        </div>
                        <div class ="row">
                            
                            <center><input class="small round button" type= "submit" value="REGISTER" onclick="return regformhash(this.form,
											                                   this.form.email,
											                                   this.form.password,
											                                   this.form.confirmpwd);"/><br/></center>
                            
                        </div>
                        

                    </form>
                   
                </div>
                <div class="large-7 medium-7 columns">
                   
                </div>
                
            
            
	    </div>
      </div>
 </div>

<hr />
</div>



    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>