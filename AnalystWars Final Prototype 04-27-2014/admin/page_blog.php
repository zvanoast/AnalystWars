<?php
include_once '../inc/db_connect.php';
include_once '../inc/functions.php';

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
<title>AnalystWars | Blog</title>
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
<link href="assets/css/pages/blog.css" rel="stylesheet" type="text/css"/>
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
										<span class="time">
										</span>
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
						<a href="extra_profile.html">
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
						<a href="login.html">
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
							<a href="page_blog.html">
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
					Blog <small>blog listing and post samples</small>
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
								Blog
							</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 blog-page">
					<div class="row">
						<div class="col-md-9 col-sm-8 article-block">
							<h1>Latest Blog</h1>
							<div class="row">
								<div class="col-md-4 blog-img blog-tag-data">
									<img src="assets/img/gallery/image4.jpg" alt="" class="img-responsive">
									<ul class="list-inline">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="#">
												 April 16, 2013
											</a>
										</li>
										<li>
											<i class="fa fa-comments"></i>
											<a href="#">
												 38 Comments
											</a>
										</li>
									</ul>
									<ul class="list-inline blog-tags">
										<li>
											<i class="fa fa-tags"></i>
											<a href="#">
												 Technology
											</a>
											<a href="#">
												 Education
											</a>
											<a href="#">
												 Internet
											</a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 blog-article">
									<h3>
									<a href="page_blog_item.html">
										first blog title
									</a>
									</h3>
									<p>
										blog content put here. 
									</p>
									<a class="btn blue" href="page_blog_item.html">
										 Read more <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-4 blog-img blog-tag-data">
									<img src="assets/img/gallery/image3.jpg" alt="" class="img-responsive">
									<ul class="list-inline">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="#">
												 April 16, 2013
											</a>
										</li>
										<li>
											<i class="fa fa-comments"></i>
											<a href="#">
												 38 Comments
											</a>
										</li>
									</ul>
									<ul class="list-inline blog-tags">
										<li>
											<i class="fa fa-tags"></i>
											<a href="#">
												 Technology
											</a>
											<a href="#">
												 Education
											</a>
											<a href="#">
												 Internet
											</a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 blog-article">
									<h3>
									<a href="page_blog_item.html">
										 second blog title
									</a>
									</h3>
									<p>
										 second blog content go here.
									</p>
									<a class="btn blue" href="page_blog_item.html">
										 Read more <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-4 blog-img blog-tag-data">
									<img src="assets/img/gallery/image4.jpg" alt="" class="img-responsive">
									<ul class="list-inline">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="#">
												 April 16, 2013
											</a>
										</li>
										<li>
											<i class="fa fa-comments"></i>
											<a href="#">
												 38 Comments
											</a>
										</li>
									</ul>
									<ul class="list-inline blog-tags">
										<li>
											<i class="fa fa-tags"></i>
											<a href="#">
												 Technology
											</a>
											<a href="#">
												 Education
											</a>
											<a href="#">
												 Internet
											</a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 blog-article">
									<h3>
									<a href="page_blog_item.html">
										 third blog title
									</a>
									</h3>
									<p>
										 third blog content go here.
									</p>
									<a class="btn blue" href="page_blog_item.html">
										 Read more <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-4 blog-img blog-tag-data">
									<img src="assets/img/gallery/image3.jpg" alt="" class="img-responsive">
									<ul class="list-inline">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="#">
												 April 16, 2013
											</a>
										</li>
										<li>
											<i class="fa fa-comments"></i>
											<a href="#">
												 38 Comments
											</a>
										</li>
									</ul>
									<ul class="list-inline blog-tags">
										<li>
											<i class="fa fa-tags"></i>
											<a href="#">
												 Technology
											</a>
											<a href="#">
												 Education
											</a>
											<a href="#">
												 Internet
											</a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 blog-article">
									<h3>
									<a href="page_blog_item.html">
										 fourth blog title
									</a>
									</h3>
									<p>
										 fourth blog contect go here.
									</p>
									<a class="btn blue" href="page_blog_item.html">
										 Read more <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-4 blog-img blog-tag-data">
									<img src="assets/img/gallery/image5.jpg" alt="" class="img-responsive">
									<ul class="list-inline">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="#">
												 April 16, 2013
											</a>
										</li>
										<li>
											<i class="fa fa-comments"></i>
											<a href="#">
												 38 Comments
											</a>
										</li>
									</ul>
									<ul class="list-inline blog-tags">
										<li>
											<i class="fa fa-tags"></i>
											<a href="#">
												 Technology
											</a>
											<a href="#">
												 Education
											</a>
											<a href="#">
												 Internet
											</a>
										</li>
									</ul>
								</div>
								<div class="col-md-8 blog-article">
									<h3>
									<a href="page_blog_item.html">
										 fifth blog title
									</a>
									</h3>
									<p>
										 fifth blog content go here.
									</p>
									<a class="btn blue" href="page_blog_item.html">
										 Read more <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
							</div>
						</div>
						<!--end col-md-9-->
						<div class="col-md-3 col-sm-4 blog-sidebar">
							<h3>Top Entiries</h3>
							<div class="top-news">
								<a href="#" class="btn red">
									<span>
										 Stock News
									</span>
									<em>Posted on: April 16, 2013</em>
									<em>
									<i class="fa fa-tags"></i>
									Money, Business, Google </em>
									<i class="fa fa-briefcase top-news-icon"></i>
								</a>
								<a href="#" class="btn green">
									<span>
										 Top Week
									</span>
									<em>Posted on: April 15, 2013</em>
									<em>
									<i class="fa fa-tags"></i>
									Internet, Music, People </em>
									<i class="fa fa-music top-news-icon"></i>
								</a>
								<a href="#" class="btn blue">
									<span>
										 Gold Price Falls
									</span>
									<em>Posted on: April 14, 2013</em>
									<em>
									<i class="fa fa-tags"></i>
									USA, Business, Apple </em>
									<i class="fa fa-globe top-news-icon"></i>
								</a>
								<a href="#" class="btn yellow">
									<span>
										 Study Abroad
									</span>
									<em>Posted on: April 13, 2013</em>
									<em>
									<i class="fa fa-tags"></i>
									Education, Students, Canada </em>
									<i class="fa fa-book top-news-icon"></i>
								</a>
								<a href="#" class="btn purple">
									<span>
										 Top Destinations
									</span>
									<em>Posted on: April 12, 2013</em>
									<em>
									<i class="fa fa-tags"></i>
									Places, Internet, Google Map </em>
									<i class="fa fa-bolt top-news-icon"></i>
								</a>
							</div>
							<div class="space20">
							</div>
							<h3>Flickr</h3>
							<ul class="list-inline blog-images">
								<li>
									<a class="fancybox-button" data-rel="fancybox-button" title="390 x 220 - keenthemes.com" href="assets/img/blog/1.jpg">
										<img alt="" src="assets/img/blog/1.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/2.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/3.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/4.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/5.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/6.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/8.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/10.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/11.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/1.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/2.jpg">
									</a>
								</li>
								<li>
									<a href="#">
										<img alt="" src="assets/img/blog/7.jpg">
									</a>
								</li>
							</ul>
							<div class="space20">
							</div>
							<h3>Tabs</h3>
							<div class="tabbable tabbable-custom">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#tab_1_1">
											 Section 1
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab_1_2">
											 Section 2
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="tab_1_1" class="tab-pane active">
										<p>
											 I'm in Section 1.
										</p>
										<p>
											 I'm in Section 1.
										</p>
									</div>
									<div id="tab_1_2" class="tab-pane">
										<p>
											 Howdy, I'm in Section 2.
										</p>
										<p>
											Howdy, I'm in Section 2.
										</p>
									</div>
								</div>
							</div>
							<div class="space20">
							</div>
							<h3>Recent Twitts</h3>
							<div class="blog-twitter">
								<div class="blog-twitter-block">
									<a href="">
										 @analystwars
									</a>
									<p>
										 good site
									</p>
									<a href="#">
										<em>http://analystwars.com</em>
									</a>
									<span>
										 2 hours ago
									</span>
									<i class="fa fa-twitter blog-twiiter-icon"></i>
								</div>
								<div class="blog-twitter-block">
									<a href="">
										 @analystwars
									</a>
									<p>
										 Welcome.
									</p>
									<a href="#">
										<em>http://analystwars.com</em>
									</a>
									<span>
										 5 hours ago
									</span>
									<i class="fa fa-twitter blog-twiiter-icon"></i>
								</div>
								<div class="blog-twitter-block">
									<a href="">
										 @analystwars
									</a>
									<p>
										 Please visit us!
									</p>
									<a href="#">
										<em>http://analystwars.com</em>
									</a>
									<span>
										 7 hours ago
									</span>
									<i class="fa fa-twitter blog-twiiter-icon"></i>
								</div>
							</div>
						</div>
						<!--end col-md-3-->
					</div>
					<ul class="pagination pull-right">
						<li>
							<a href="#">
								<i class="fa fa-angle-left"></i>
							</a>
						</li>
						<li>
							<a href="#">
								 1
							</a>
						</li>
						<li>
							<a href="#">
								 2
							</a>
						</li>
						<li>
							<a href="#">
								 3
							</a>
						</li>
						<li>
							<a href="#">
								 4
							</a>
						</li>
						<li>
							<a href="#">
								 5
							</a>
						</li>
						<li>
							<a href="#">
								 6
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
					</ul>
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
<script src="assets/scripts/core/app.js"></script>
<script>
jQuery(document).ready(function() {    
   App.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>