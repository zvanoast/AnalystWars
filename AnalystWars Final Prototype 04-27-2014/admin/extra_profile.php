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
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>AnalystWars | Profile</title>
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
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/css/pages/profile.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-sidebar-closed">
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
					<?php echo $dbFirstName . "'s ";?> Profile
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
								Profile
							</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			
			<!-- BEGIN PROFILE SEARCH -->
			<form name="userSearchForm" action="view_profile.php" method="post">
				<input type="text" placeholder="Search a user profile" name="userSearchBox">
				<input type="submit" value="Search">
			</form>
			<br><br>
			
			<!-- END PROFILE SEARCH -->
			
			<!-- BEGIN PAGE CONTENT-->
			<div class="row profile">
				<div class="col-md-12">
					<!--BEGIN TABS-->
					<div class="tabbable tabbable-custom tabbable-full-width">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_1_1" data-toggle="tab">
									 Overview
								</a>
							</li>
							<li>
								<a href="#tab_1_3" data-toggle="tab">
									 Account
								</a>
							</li>
							<li>
								<a href="#tab_1_4" data-toggle="tab">
									 Stock Rating
								</a>
							</li>
							<li>
								<a href="#tab_1_6" data-toggle="tab">
									 Help
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1_1">
								<div class="row">
									<div class="col-md-3">
										<ul class="list-unstyled profile-nav">
											<li>
												<?php echo "<img class=\"img-responsive\" alt=\"\" src=\"userFiles/".$email."/".$dbProfilePicture."\"/>"; ?>
												<a href="#" class="profile-edit">
													 edit
												</a>
											</li>
											<li>
												<a href="#">
													 Ratings
												</a>
											</li>
											<li>
												<a href="#">
													 Messages
													<span>
														 2
													</span>
												</a>
											</li>
											<li>
												<a href="#">
													 Friends
												</a>
											</li>
											<li>
												<a href="#">
													 Settings
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-8 profile-info">
												<h1><?php echo $dbFirstName . " " . $dbLastName; ?></h1>
												<p>
													 <?php echo $dbAbout; ?>
												</p>
                                                <p>
													 <?php echo $dbOccupation; ?>
												</p>
                                                <p>
													 <?php echo $dbEducationLevel; ?>
												</p>
                                                <p>
													 <?php echo $dbInvestmentExperience; ?>
												</p>
                                                <p>
													 <?php echo $dbResearchExpertise; ?>
												</p>
												<p>
													<a href="http://<?php echo $dbWebsiteURL;?>">
														<?php echo $dbWebsiteURL; ?>
													</a>
												</p>
												<ul class="list-inline">
													<li>
														<i class="fa fa-map-marker"></i> USA
													</li>
													<li>
														<i class="fa fa-calendar"></i> <?php echo $date[$dateSplit[1]] . " " . $dateSplit[2] . ", " . $dateSplit[0]; ?>
													</li>
													<li>
														<i class="fa fa-briefcase"></i> Finance
													</li>
													<li>
														<i class="fa fa-star"></i> Top rater
													</li>
													<li>
														<i class="fa fa-heart"></i> stock rating
													</li>
												</ul>
											</div>
											<!--end col-md-8-->
											<div class="col-md-4">
												<div class="portlet sale-summary">
													<div class="portlet-title">
														<div class="caption">
															 Rating Summary
														</div>
														<div class="tools">
															<a class="reload" href="javascript:;">
															</a>
														</div>
													</div>
													<div class="portlet-body">
														<ul class="list-unstyled">
															<li>
																<span class="sale-info">
																	 Leaderboard Ranking
																	 </span>
																<span class="sale-num">
																	 1
																</span>
															</li>
															<li>
																<span class="sale-info">
																	 Points
																	 </span>
																<span class="sale-num">
																	 120
																</span>
															</li>
															<li>
																<span class="sale-info">
																	 TODAY Rated <i class="fa fa-img-up"></i>
																</span>
																<span class="sale-num">
																	 23
																</span>
															</li>
															<li>
																<span class="sale-info">
																	 WEEKLY Rated <i class="fa fa-img-down"></i>
																</span>
																<span class="sale-num">
																	 87
																</span>
															</li>
															<li>
																<span class="sale-info">
																	 TOTAL Rated
																</span>
																<span class="sale-num">
																	 2377
																</span>
															</li>
														
														</ul>
													</div>
												</div>
											</div>
											<!--end col-md-4-->
										</div>
										<!--end row-->
										<div class="tabbable tabbable-custom tabbable-custom-profile">
											<ul class="nav nav-tabs">
												<li class="active">
													<a href="#tab_1_11" data-toggle="tab">
														 Followed Stocks
													</a>
												</li>
												<li>
													<a href="#tab_1_22" data-toggle="tab">
														 Feeds
													</a>
												</li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane active" id="tab_1_11">
													<div class="portlet-body">
														<table class="table table-striped table-bordered table-advance table-hover">
														<thead>
														<tr>
															<th>
																<i class="fa fa-briefcase"></i> Stock Symbol
															</th>
															<th class="hidden-xs">
																<i class="fa fa-question"></i> Company
															</th>
															<th>
																<i class="fa fa-bookmark"></i> Today Price
															</th>
															<th>
															</th>
														</tr>
														</thead>
														<tbody>
														<tr>
															<td>
																<a href="#">
																	 AAPL
																</a>
															</td>
															<td class="hidden-xs">
																 Apple Inc.
															</td>
															<td>
																 $539.78
																<span class="label label-success label-sm">
																   Rated
																</span>
															</td>
															<td>
																<a class="btn default btn-xs green-stripe" href="#">
																	 View
																</a>
															</td>
														</tr>
														<tr>
															<td>
																<a href="#">
																	 AMZN
																</a>
															</td>
															<td class="hidden-xs">
																 Amazon.com, Inc
															</td>
															<td>
																 $343.41
																<span class="label label-success label-sm">
																	 Rated
																</span>
															</td>
															<td>
																<a class="btn default btn-xs blue-stripe" href="#">
																	 View
																</a>
															</td>
														</tr>
														<tr>
															<td>
																<a href="#">
																	 GOOG
																</a>
															</td>
															<td class="hidden-xs">
																 Google
															</td>
															<td>
																 $1131.97
																<span class="label label-success label-sm">
																	 Rated
																</span>
															</td>
															<td>
																<a class="btn default btn-xs blue-stripe" href="#">
																	 View
																</a>
															</td>
														</tr>
														
													
														<tr>
															<td>
																<a href="#">
																	 BAC
																</a>
															</td>
															<td class="hidden-xs">
																 Bank of America Corporation
															</td>
															<td>
																 $17.78
																<span class="label label-warning label-sm">
																	 Not Rated
																</span>
															</td>
															<td>
																<a class="btn default btn-xs blue-stripe" href="#">
																	 View
																</a>
															</td>
														</tr>
														
														</tbody>
														</table>
													</div>
												</div>
												<!--tab-pane-->
												<div class="tab-pane" id="tab_1_22">
													<div class="tab-pane active" id="tab_1_1_1">
														<div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
															<ul class="feeds">
																<li>
																	<a href="#">
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-success">
																						<i class="fa fa-bell-o"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						 New version v1.4 just lunched!
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				 20 mins
																			</div>
																		</div>
																	</a>
																</li>								
															</ul>
														</div>
													</div>
												</div>
												<!--tab-pane-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--tab_1_2-->
							<div class="tab-pane" id="tab_1_3">
								<div class="row profile-account">
									<div class="col-md-3">
										<ul class="ver-inline-menu tabbable margin-bottom-10">
											<li class="active">
												<a data-toggle="tab" href="#tab_1-1">
													<i class="fa fa-cog"></i> Personal info
												</a>
												<span class="after">
												</span>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_2-2">
													<i class="fa fa-picture-o"></i> Change Avatar
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_3-3">
													<i class="fa fa-lock"></i> Change Password
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_4-4">
													<i class="fa fa-eye"></i> Privacity Settings
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="tab-content">
											<div id="tab_1-1" class="tab-pane active">
												<form role="form" action="update_profile.php" method="post">
													<div class="form-group">
														<label class="control-label">First Name</label>
														<input type="text" placeholder="John" class="form-control" name="firstName"/>
													</div>
													<div class="form-group">
														<label class="control-label">Last Name</label>
														<input type="text" placeholder="Doe" class="form-control" name="lastName"/>
													</div>
													<div class="form-group">
														<label class="control-label">Date Of Birth</label>
														<input type="text" placeholder="yyyy/mm/dd" class="form-control" name="dob"/>
													</div>
													<div class="row">
														<label>Education Level</label>
														  <select name="educationLevel">
																<option value=""></option>
																<option value="High School Diploma">High School Diploma/GED</option>
																<option value="Bachelor's degree">Bachelor&#39s Degree</option>
																<option value="Graduate School">Master&#39s Degree</option>
																<option value="PhD">Doctor of Philosophy</option>
														   </select>
												   
													</div>
													<div class="form-group">
														<label class="control-label">Occupation</label>
														<input type="text" placeholder="Web Developer" class="form-control" name="occupation"/>
													</div>
													<div class="form-group">
														<label class="control-label">About Me</label>
														<input type="text" placeholder="I have been trading stock for 10 years" class="form-control" name="about"/>
													</div>
													<div class="form-group">
														<label class="control-label">Investment Experience</label>
														<textarea class="form-control" rows="3" placeholder="Short or Long Term Investment Experience" name="investmentExperience"></textarea>
													</div>
													<div class="form-group">
														<label class="control-label">Research Expertise</label>
														<input type="text" placeholder="Sector or Market Cap Research Expertise" class="form-control" name="researchExpertise"/>
													</div>
													<div class="form-group">
														<label class="control-label">Website Url</label>
														<input type="text" placeholder="www.mywebsite.com" class="form-control" name="websiteURL"/>
													</div>
													<div class="margiv-top-10">
                                                                                                                <input class="btn green" type="submit" value = "Save Changes" name="submit">
														<a href="#" class="btn default">
															 Cancel
														</a>
													</div>
												</form>
											</div>
											<div id="tab_2-2" class="tab-pane">
												<p>
													 Please upload your own picture for avatar.
												</p>
												<form action="upload_profile_picture.php" role="form" method="post" enctype="multipart/form-data">
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
															</div>
															<div>
																<span class="btn default btn-file">
																	<span class="fileinput-new">
																		 Select image
																	</span>
																	<span class="fileinput-exists">
																		 Change
																	</span>
																	<input type="file" name="userPicture" id="file">
																</span>
																<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
																	 Remove
																</a>
															</div>
														</div>
														<div class="clearfix margin-top-10">
															<span class="label label-danger">
																 NOTE!
															</span>
															<span>
																 Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only
															</span>
														</div>
													</div>
													<div class="margin-top-10">
														<input class="btn green" type="submit" value = "Submit" name="uploadPicture">
														<a href="#" class="btn default">
															 Cancel
														</a>
													</div>
												</form>
											</div>
											<div id="tab_3-3" class="tab-pane">
												<form action="#">
													<div class="form-group">
														<label class="control-label">Current Password</label>
														<input type="password" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">New Password</label>
														<input type="password" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Re-type New Password</label>
														<input type="password" class="form-control"/>
													</div>
													<div class="margin-top-10">
														<a href="#" class="btn green">
															 Change Password
														</a>
														<a href="#" class="btn default">
															 Cancel
														</a>
													</div>
												</form>
											</div>
											<div id="tab_4-4" class="tab-pane">
												<form action="#">
													<table class="table table-bordered table-striped">
													<tr>
														<td>
															 Share personal info to the public?
														</td>
														<td>
															<label class="uniform-inline">
															<input type="radio" name="optionsRadios1" value="option1"/>
															Yes </label>
															<label class="uniform-inline">
															<input type="radio" name="optionsRadios1" value="option2" checked/>
															No </label>
														</td>
													</tr>
													<tr>
														<td>
															 test
														</td>
														<td>
															<label class="uniform-inline">
															<input type="checkbox" value=""/> Yes </label>
														</td>
													</tr>
													<tr>
														<td>
															 test
														</td>
														<td>
															<label class="uniform-inline">
															<input type="checkbox" value=""/> Yes </label>
														</td>
													</tr>
													<tr>
														<td>
															 test
														</td>
														<td>
															<label class="uniform-inline">
															<input type="checkbox" value=""/> Yes </label>
														</td>
													</tr>
													</table>
													<!--end profile-settings-->
													<div class="margin-top-10">
														<a href="#" class="btn green">
															 Save Changes
														</a>
														<a href="#" class="btn default">
															 Cancel
														</a>
													</div>
												</form>
											</div>
										</div>
									</div>
									<!--end col-md-9-->
								</div>
							</div>
							<!--end tab-pane-->
							<div class="tab-pane" id="tab_1_4">
								<div class="row">
									<div class="col-md-12">
										<div class="add-portfolio">
											<span>
												 3 Stocks Rated
											</span>
											<a href="#" class="btn icn-only green">
												 Rate More <i class="m-icon-swapright m-icon-white"></i>
											</a>
										</div>
									</div>
								</div>
								<!--end add-portfolio-->
								<div class="row portfolio-block">
									<div class="col-md-5">
										<div class="portfolio-text">
											<img src="assets/img/profile/apple.jpg" alt=""/>
											<div class="portfolio-text-info">
												<h4>AAPL</h4>
												<p>
													 Apple Inc.
												</p>
											</div>
										</div>
									</div>
									<div class="col-md-5 portfolio-stat">
										<div class="portfolio-info">
											 Today price
											<span>
												 $900
											</span>
										</div>
										<div class="portfolio-info">
											 Your target
											<span>
												 $950
											</span>
										</div>
										<div class="portfolio-info">
											 Your rating
											<span>
												 Buy
											</span>
										</div>
									</div>
									<div class="col-md-2">
										<div class="portfolio-btn">
											<a href="#" class="btn bigicn-only">
												<span>
													 Manage
												</span>
											</a>
										</div>
									</div>
								</div>
								<!--end row-->
								<div class="row portfolio-block">
									<div class="col-md-5 col-sm-12 portfolio-text">
										<img src="assets/img/profile/amazon.jpg" alt=""/>
										<div class="portfolio-text-info">
											<h4>AMZN</h4>
											<p>
												 Amazon Inc
											</p>
										</div>
									</div>
									<div class="col-md-5 portfolio-stat">
										<div class="portfolio-info">
											 Today price
											<span>
												 $600
											</span>
										</div>
										<div class="portfolio-info">
											 Your price
											<span>
												 $660
											</span>
										</div>
										<div class="portfolio-info">
											 Your rating
											<span>
												 hold
											</span>
										</div>
									</div>
									<div class="col-md-2 col-sm-12 portfolio-btn">
										<a href="#" class="btn bigicn-only">
											<span>
												 Manage
											</span>
										</a>
									</div>
								</div>
								<!--end row-->
								<div class="row portfolio-block">
									<div class="col-md-5 portfolio-text">
										<img src="assets/img/profile/google.jpg" alt=""/>
										<div class="portfolio-text-info">
											<h4>GOOG</h4>
											<p>
												 Google Inc
											</p>
										</div>
									</div>
									<div class="col-md-5 portfolio-stat">
										<div class="portfolio-info">
											 Today Price
											<span>
												 $1000
											</span>
										</div>
										<div class="portfolio-info">
											 Your price
											<span>
												 $1500
											</span>
										</div>
										<div class="portfolio-info">
											 Your rating
											<span>
												 buy
											</span>
										</div>
									</div>
									<div class="col-md-2 portfolio-btn">
										<a href="#" class="btn bigicn-only">
											<span>
												 Manage
											</span>
										</a>
									</div>
								</div>
								<!--end row-->
							</div>
							<!--end tab-pane-->
							<div class="tab-pane" id="tab_1_6">
								<div class="row">
									<div class="col-md-3">
										<ul class="ver-inline-menu tabbable margin-bottom-10">
											<li class="active">
												<a data-toggle="tab" href="#tab_1">
													<i class="fa fa-briefcase"></i> General Questions
												</a>
												<span class="after">
												</span>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_2">
													<i class="fa fa-group"></i> Membership
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_3">
													<i class="fa fa-leaf"></i> Terms Of Service
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_1">
													<i class="fa fa-info-circle"></i> License Terms
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_2">
													<i class="fa fa-tint"></i> Payment Rules
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_3">
													<i class="fa fa-plus"></i> Other Questions
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="tab-content">
											<div id="tab_1" class="tab-pane active">
												<div id="accordion1" class="panel-group">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
																 1.
															</a>
															</h4>
														</div>
														<div id="accordion1_1" class="panel-collapse collapse in">
															<div class="panel-body">
																 1.
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">
																 2. 
															</a>
															</h4>
														</div>
														<div id="accordion1_2" class="panel-collapse collapse">
															<div class="panel-body">
																 2.
															</div>
														</div>
													</div>
													<div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">
																 3. 
															</a>
															</h4>
														</div>
														<div id="accordion1_3" class="panel-collapse collapse">
															<div class="panel-body">
																 3.
															</div>
														</div>
													</div>
													<div class="panel panel-warning">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4">
																 4. 
															</a>
															</h4>
														</div>
														<div id="accordion1_4" class="panel-collapse collapse">
															<div class="panel-body">
																 4.
															</div>
														</div>
													</div>
													<div class="panel panel-danger">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5">
																 5.
															</a>
															</h4>
														</div>
														<div id="accordion1_5" class="panel-collapse collapse">
															<div class="panel-body">
																 
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6">
																 6. 
															</a>
															</h4>
														</div>
														<div id="accordion1_6" class="panel-collapse collapse">
															<div class="panel-body">
																 
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7">
																 7. test2
															</a>
															</h4>
														</div>
														<div id="accordion1_7" class="panel-collapse collapse">
															<div class="panel-body">
																 
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="tab_2" class="tab-pane">
												<div id="accordion2" class="panel-group">
													<div class="panel panel-warning">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1">
																 1. 
															</a>
															</h4>
														</div>
														<div id="accordion2_1" class="panel-collapse collapse in">
															<div class="panel-body">
																<p>
																	 test
																</p>
																<p>
																	 test
																</p>
															</div>
														</div>
													</div>
													<div class="panel panel-danger">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2">
																 2. 
															</a>
															</h4>
														</div>
														<div id="accordion2_2" class="panel-collapse collapse">
															<div class="panel-body">
																 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. test
															</div>
														</div>
													</div>
													<div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_3">
																 3. test
															</a>
															</h4>
														</div>
														<div id="accordion2_3" class="panel-collapse collapse">
															<div class="panel-body">
																 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. test
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_4">
																 4. test2
															</a>
															</h4>
														</div>
														<div id="accordion2_4" class="panel-collapse collapse">
															<div class="panel-body">
																 test2
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_5">
																 5. test2
															</a>
															</h4>
														</div>
														<div id="accordion2_5" class="panel-collapse collapse">
															<div class="panel-body">
																 
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_6">
																 6. test2
															</a>
															</h4>
														</div>
														<div id="accordion2_6" class="panel-collapse collapse">
															<div class="panel-body">
																 
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_7">
																 7. test2
															</a>
															</h4>
														</div>
														<div id="accordion2_7" class="panel-collapse collapse">
															<div class="panel-body">
																 
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="tab_3" class="tab-pane">
												<div id="accordion3" class="panel-group">
													<div class="panel panel-danger">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_1">
																 1. 
															</a>
															</h4>
														</div>
														<div id="accordion3_1" class="panel-collapse collapse in">
															<div class="panel-body">
																<p>
																	 test
																</p>
																<p>
																	 test
																</p>
																<p>
																	 test2
																</p>
															</div>
														</div>
													</div>
													<div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_2">
																 2. 
															</a>
															</h4>
														</div>
														<div id="accordion3_2" class="panel-collapse collapse">
															<div class="panel-body">
																 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. test
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_3">
																 3. test
															</a>
															</h4>
														</div>
														<div id="accordion3_3" class="panel-collapse collapse">
															<div class="panel-body">
																 Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. test
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_4">
																 4. test2
															</a>
															</h4>
														</div>
														<div id="accordion3_4" class="panel-collapse collapse">
															<div class="panel-body">
																 test2
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_5">
																 5. test2
															</a>
															</h4>
														</div>
														<div id="accordion3_5" class="panel-collapse collapse">
															<div class="panel-body">
																 5
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_6">
																 6. test2
															</a>
															</h4>
														</div>
														<div id="accordion3_6" class="panel-collapse collapse">
															<div class="panel-body">
																 7
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_7">
																 7.
															</a>
															</h4>
														</div>
														<div id="accordion3_7" class="panel-collapse collapse">
															<div class="panel-body">
																 7
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--end tab-pane-->
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
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
<script type="text/javascript" src="assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/scripts/core/app.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   App.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>