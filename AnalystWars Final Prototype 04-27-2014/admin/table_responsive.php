<?php
include_once('../inc/db_connect.php');
include_once('../inc/functions.php');

sec_session_start();

if (login_check($mysqli)) error_log("logged in");
else error_log("not logged in");

?>
<!DOCTYPE html>
<?php


if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$email = $_SESSION['email'];

error_log($email);

if($insert_stmt = $mysqli->prepare("SELECT firstName, lastName, dateOfBirth, educationLevel, occupation, about, investmentExperience, researchExpertise, websiteURL, profilePicture FROM user_information WHERE email=?")){
	$insert_stmt->bind_param('s', $email);
	$insert_stmt->execute();
    $insert_stmt->bind_result($dbFirstName, $dbLastName, $dbDateOfBirth, $dbEducationLevel, $dbOccupation, $dbAbout, $dbInvestmentExperience, $dbResearchExpertise, $dbWebsiteURL, $dbProfilePicture);
    $insert_stmt->fetch();
    $insert_stmt->close();
}
?>

<?php

include_once 'assets/pchart/class/pData.class.php'; 
include_once 'assets/pchart/class/pDraw.class.php'; 
include_once 'assets/pchart/class/pImage.class.php';

$symbol1 = $_SESSION['stockTicker'];

if ($query = $mysqli->prepare("SELECT * FROM stock WHERE stockSymbol = ? ORDER BY stockDate DESC LIMIT 30")) {
	$query->bind_param('s',$symbol1);
	$query->execute();
	$result = array();
	$result = fetch($query);
	$today = $result[0];
        $query->close();
	//$query->bind_result($symbol, $ddate, $openPrice, $highPrice, $closePrice, $volume, $priceChange, $percChange, $eps, $revenue);
	
}

$loginEmail = $_SESSION['email'];

//Database call to get the profile picture for user that is currently logged in
if($insert_stmt = $mysqli->prepare("SELECT firstName, lastName, profilePicture FROM user_information WHERE email=?")){
    $insert_stmt->bind_param('s', $loginEmail);
    $insert_stmt->execute();
    $insert_stmt->bind_result($dbFirstName, $dbLastName, $dbLoginProfilePicture);
    $insert_stmt->fetch();
    $insert_stmt->close();
}
else error_log('query failed');

//error log each row returned and put into $result
/*
foreach ($result as $rowNum => $row)
{
	error_log($rowNum);
	foreach ($row as $col) error_log($col);
}
*/

/*
if ($result = $mysqli->query($query)) {
	$row = $result->fetch_assoc();
}
*/

error_log("symbol is: " . $symbol);
error_log("date is: " . $ddate);
?>

<!DOCTYPE html>


<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>AnalystWars | Stock</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="index.php">
			<img src="assets/img/logo.png" alt="logo" class="img-responsive"/>
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="assets/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN NOTIFICATION DROPDOWN -->
		<li class="dropdown" id="header_notification_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-warning"></i>
					<span class="badge">
						 1
					</span>
				</a>
				<ul class="dropdown-menu extended notification">
					<li>
						<p>
							 You have 1 new notifications
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="#">
									<span class="label label-sm label-icon label-success">
										<i class="fa fa-plus"></i>
									</span>
									 New user registered.
									<span class="time">
										 Just now
									</span>
								</a>
							</li>
							
						</ul>
					</li>
					<li class="external">
						<a href="#">
							 See all notifications <i class="m-icon-swapright"></i>
						</a>
					</li>
				</ul>
			</li>
			<!-- END NOTIFICATION DROPDOWN -->
			<!-- BEGIN INBOX DROPDOWN -->
			<li class="dropdown" id="header_inbox_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="fa fa-envelope"></i>
					<span class="badge">
						 2
					</span>
				</a>
				<ul class="dropdown-menu extended inbox">
					<li>
						<p>
							 You have 2 new messages
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="inbox.html?a=view">
									<span class="photo">
										<img src="./assets/img/avatar2.jpg" alt=""/>
									</span>
									<span class="subject">
										<span class="from">
											 Lisa Wong
										</span>
										<span class="time">
											 Just Now
										</span>
									</span>
									<span class="message">
										 hi...
									</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
									<span class="photo">
										<img src="./assets/img/avatar3.jpg" alt=""/>
									</span>
									<span class="subject">
										<span class="from">
											 Richard Hen
										</span>
										<span class="time">
											 16 mins
										</span>
									</span>
									<span class="message">
										 test...
									</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="inbox.html">
							 See all messages <i class="m-icon-swapright"></i>
						</a>
					</li>
				</ul>
			</li>
			<!-- END INBOX DROPDOWN -->
		
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<?php echo "<img alt=\"\" src=\"userFiles/".$email."/".$dbProfilePicture."\" style='width:20px; height:20px;' />"; ?>
					<span class="username">
						 <?php echo $dbFirstName . " " . $dbLastName; ?>
					</span>
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="extra_profile.php">
							<i class="fa fa-user"></i> My Profile
						</a>
					</li>
					<li>
						<a href="inbox.html">
							<i class="fa fa-envelope"></i> My Message
							<span class="badge badge-danger">
								 2
							</span>
						</a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="javascript:;" id="trigger_fullscreen">
							<i class="fa fa-arrows"></i> Full Screen
						</a>
					</li>
					<li>
						<a href="../inc/logout.php">
							<i class="fa fa-key"></i> Log Out
						</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search" action="get_stock_data.php" method="POST">
					
						<div class="form-container">				
							<div class="input-box">
								<a href="javascript:;" class="remove">
								</a>
								<input type="text" placeholder="Search..." name="stockTicker"/>
								<input type="button" class="submit" value=" "/>
							</div>
						</div>
						
					</form>
					
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				  <li class="start active ">
					<a href="index.php">
						<i class="fa fa-home"></i>
						<span class="title">
							Home
						</span>
						<span class="selected">
						</span>
					</a>
				</li>
				
				<li class="last">
					<li>
							<a href="page_blog.php">
								<i class="fa fa-comments"></i>
								<span class="title">
								Blog
								</span>
							</a>
					</li>
				</li>
				
				<li class="last">
					<li>
							<a href="page_blog_item.html">
								<i class="fa fa-font"></i>
								<span class="title">
								Blog Post
								</span>
							</a>
					</li>
				</li>
				
				<!-- REMOVED FOR NOW
				
				<li class="last">
					<li>
							<a href="page_news.html">
								<i class="fa fa-coffee"></i>
								<span class="badge badge-success">
									9
								</span>
								<span class="title">
								News
								</span>
							</a>
					</li>
				</li>
				
				<li class="last">
					<li>
							<a href="page_news_item.html">
								<i class="fa fa-bell"></i>
								<span class="title">
								News View
								</span>
							</a>
					</li>
				</li>
				
				-->
				
				<li class="last">
					<li>  
							<a href="extra_profile.php">
							<i class="fa fa-user"></i>
							<span class="title">
								 User Profile
							 </span>
							</a>
					</li>
				</li>
				
				<li class="last">
					<li>  
							<a href="table_responsive.php">
							<i class="fa fa-th"></i>
							<span class="title">
								 Stock
						    </span>
							</a>
					</li>
				</li>
				
				<li class="last ">
					<a href="charts.html">
						<i class="fa fa-bar-chart-o"></i>
						<span class="title">
							Stock Charts
						</span>
					</a>
				</li>
				
				<li class="last">
					<li>  
							<a href="table_managed.html">
							<i class="fa fa-group"></i>
							<span class="title">
								 Leaderboard
							</span>
							</a>
					</li>
				</li>
				
				
				<li>
					<a href="javascript:;">
						<i class="fa fa-file-text"></i>
						<span class="title">
							Extra pages
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="404.html">
								 404 page
							</a>
						</li>
						
						<li>
							<a href="extra_pricing_table.html">
								 Price table
							</a>
						</li>
						
						<li>
							<a href="page_coming_soon.html">
								 Coming soon 
							</a>
						</li>
					
						
						<li>
							<a href="form_wizard.html">
								 Register page
							</a>
						</li>
						
						</ul>
				</li>
			
			
				
			
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
							 THEME COLOR
						</span>
						<ul>
							<li class="color-black current color-default" data-style="default">
							</li>
							<li class="color-blue" data-style="blue">
							</li>
							<li class="color-brown" data-style="brown">
							</li>
							<li class="color-purple" data-style="purple">
							</li>
							<li class="color-grey" data-style="grey">
							</li>
							<li class="color-white color-light" data-style="light">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
							 Layout
						</span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Header
						</span>
						<select class="header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar
						</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar Position
						</span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Footer
						</span>
						<select class="footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Stock <small> stock data</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
							<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
							<span>
								Actions
							</span>
							<i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a href="#">
										Action
									</a>
								</li>
								<li>
									<a href="#">
										Another action
									</a>
								</li>
								<li>
									<a href="#">
										Something else here
									</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">
										Separated link
									</a>
								</li>
							</ul>
						</li>
						<li>
							<i class="fa fa-home"></i>
							<a href="index.php">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">
								Stock
							</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
				
				
				
					
				
				
				
				
					<div class="note note-success">
						<form action="get_stock_data.php" method="POST">
					
						
								<input type="text" placeholder="Enter stock symbol" name="stockTicker"/>
						
								<input type="submit" value="submit"/>
					
						</form>
						<p>
							 Please try to re-size your browser window in order to see the tables in responsive mode.
						</p>
					</div>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i><?php echo $today['stockSymbol']; ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th width="20%">
									 Code
								</th>
								<th>
									 Company
								</th>
								<th class="numeric">
									 Price
								</th>
								<th class="numeric">
									 Change
								</th>
								<th class="numeric">
									 Change %
								</th>
								<th class="numeric">
									 Open
								</th>
								<th class="numeric">
									 High
								</th>
								<th class="numeric">
									 Low
								</th>
								<th class="numeric">
									 Volume
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									 <? echo $today['stockSymbol']; ?>
								</td>
								<td>
									 <? echo $_SESSION['stockName']; ?>
								</td>
								<td class="numeric">
									 <? echo $today['closePrice']; ?>
								</td>
								<td class="numeric">
									 <? echo $today['priceChange']; ?>
								</td>
								<td class="numeric">
									 <? echo $today['percentageChange']; ?>
								</td>
								<td class="numeric">
									 <? echo $today['openPrice']; ?>
								</td>
								<td class="numeric">
									 <? echo $today['highPrice']; ?>
								</td>
								<td class="numeric">
									 Low Price
								</td>
								<td class="numeric">
									 <? echo $today['volume']; ?>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
					
					
					
				
				
					
					
					
							
					
					
					
					<!-- BEGIN INTERACTIVE CHART PORTLET
					
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Interactive Chart
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div id="chart_2" class="chart">
							</div>
						</div>
					</div>
					
					 END INTERACTIVE CHART PORTLET-->
					
					
					
					<!-- BEGIN PCHART -->
					
					<?php
					
					$MyData = new pData();  
					
					$lastMonth = array();
					$lastMonthDate = array();
					$resultRev = array_reverse($result);
					for ($i = 0; $i < count($resultRev); $i++)
					{
						$lastMonth[$i] = $resultRev[$i]['closePrice'];
						$lastMonthDate[$i] = $resultRev[$i]['stockDate'];
						error_log($lastMonth[$i]);
						error_log($lastMonthDate[$i]);
					}
				 
					$MyData->addPoints($lastMonth,"Actual Price");
					$MyData->setSerieWeight("Actual Price",2);
					$MyData->setAxisName(0,"Price"); 
					$MyData->addPoints($lastMonthDate,"Labels"); 
					$MyData->setSerieDescription("Labels","Date"); 
					$MyData->setAbscissa("Labels");
					
					
					/* Create the pChart object */ 
					$myPicture = new pImage(700,230,$MyData); 
					
					/* Turn of Antialiasing */ 
					$myPicture->Antialias = FALSE; 
					
					/* Draw the background */ 
					$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107); 
					$myPicture->drawFilledRectangle(0,0,700,230,$Settings); 
					
					/* Overlay with a gradient */ 
					$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50); 
					$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings); 
					$myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>80)); 
					
					/* Add a border to the picture */ 
					$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0)); 
					
					/* Write the chart title */  
					$myPicture->setFontProperties(array("FontName"=>"assets/pchart/fonts/Forgotte.ttf","FontSize"=>8,"R"=>255,"G"=>255,"B"=>255)); 
					$myPicture->drawText(10,16,"Current Stock - " . $today['stockSymbol'],array("FontSize"=>11,"Align"=>TEXT_ALIGN_BOTTOMLEFT)); 
					
					/* Set the default font */ 
					$myPicture->setFontProperties(array("FontName"=>"assets/pchart/fonts/pf_arma_five.ttf","FontSize"=>6,"R"=>0,"G"=>0,"B"=>0)); 
					
					/* Define the chart area */ 
					$myPicture->setGraphArea(60,40,650,200); 
					
					/* Draw the scale */ 
					$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
					$myPicture->drawScale($scaleSettings); 
					
					/* Turn on Antialiasing */ 
					$myPicture->Antialias = TRUE; 
					
					/* Enable shadow computing */ 
					$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 
					
					/* Draw the line chart */ 
					$myPicture->drawLineChart(); 
					$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80)); 
					
					/* Write the chart legend */ 
					$myPicture->drawLegend(590,9,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>255,"FontG"=>255,"FontB"=>255)); 
					
					/* Render the picture (choose the best way) */ 
					$myPicture->Render("test.png"); 
					?>
					
					
					
					
							
					
					
					
					
					
					
					
					
					
					
	
	
	
</div>

				<img src="test.png">
				
				<!-- END PCHART -->
				
		<br><br>
		<form method="post">
			Estimate Tomorrow&#8217;s Closing Stock Price:
			<br><br>
			<input type="text" name="estimate" placeholder="$0.00">
			<input type="submit" value="Estimate!">
		</form>


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<br><br><br>
<div class="footer">
	<div class="footer-inner">
		 2014 &copy; AnalystWars.com
	</div>
	<div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->



<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/plugins/flot/jquery.flot.min.js"></script>
<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="assets/plugins/flot/jquery.flot.stack.min.js"></script>
<script src="assets/plugins/flot/jquery.flot.crosshair.min.js"></script>
<script src="assets/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/core/app.js"></script>
<script src="assets/scripts/custom/charts.js"></script>
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   App.init();
   Charts.init();
   Charts.initCharts();
   Charts.initPieCharts();
   Charts.initBarCharts();
});
</script>
<!-- END PAGE LEVEL SCRIPTS -->








<!--
<script src="assets/scripts/core/app.js"></script>
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   App.init();
});
</script>
-->

</body>
<!-- END BODY -->
</html>