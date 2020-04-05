<?php
header("cache-Control: no-store, no-cache, must-revalidate");
header("cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
if($this->session->userdata('user_id')){ //require_once('config/config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SUN SMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="layout" content="main"/>
    <!-- Bootstrap -->
    <!--<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="<?/*=BASE_URL*/?>css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="<?/*=BASE_URL*/?>css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />
    <link href="<?/*=BASE_URL*/?>css/style-default.css" rel="stylesheet" id="style_color" />
    <link href="<?/*=BASE_URL*/?>css/custom-styles.css" rel="stylesheet" id="style_color" />-->
    <!--<link href="<?/*=BASE_URL*/?>css/datepicker.css" rel="stylesheet" id="style_color" />-->
	
	
    <!-- Bootstrap -->
    <!--<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">-->    
    <link href="<?=BASE_URL?>css/bootstrap.min.css" type="text/css" media="screen, projection" rel="stylesheet" />
	
    <link href="<?=BASE_URL?>css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />
    <link href="<?=BASE_URL?>css/style-default.css" rel="stylesheet" id="style_color" />
    <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link href="<?=BASE_URL?>css/font-awesome.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
	
	<!--<link href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">-->
    <link href="<?=BASE_URL?>css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="<?=BASE_URL?>js/jquery.min.js"></script>
	
    <!--<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="<?=BASE_URL?>js/bootstrap.min.js"></script>
	
    <link href="<?=BASE_URL?>css/bootstrap-fullcalendar.css" rel="stylesheet" />
    <style>
    </style>
    <script>
		var BASE_URL = '<?=BASE_URL?>';
    </script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    <!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
    <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->

    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
    <link rel="stylesheet" href="<?=BASE_URL?>css/jquery-ui.css">
	
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="<?=BASE_URL?>js/jquery-1.12.4.js"></script>
	
    <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <script src="<?=BASE_URL?>js/jquery-ui.js"></script>
	
</head>
<body>
<div class="main-wrapper container"> <!--<div class="navbar-inner">
	<a class="logo" href="<?/*=BASE_URL*/?>">
		<img src="<?/*=BASE_URL*/?>images/sun-logo.png"/>
		<span class="logo-txt">School Management System</span>
	</a>	
	<div class="top-container">
		<button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div id="app-nav-top-bar" class="nav-collapse">
			<ul class="nav pull-right">
				<li>
					<?php /*if($this->session->userdata('user_id') && $this->session->userdata('user_type_id')==1){ */?>
					<a href="<?/*=BASE_URL*/?>index.php/admin/logout">Logout</a>
					<?php /*} else { */?>
						<a href="<?/*=BASE_URL*/?>index.php/welcome/logout">Logout</a>
					<?php /*} */?>
				</li>
			</ul>
		</div>
	</div>
    </div>-->
        <div class="navbar">
            <div class="navbar-inner">
                <a class="logo" href="#"><img src="<?=BASE_URL?>images/sun-logo.png"/> <span class="logo-txt">School Management System</span></a>
                <div class="top-container">
                    <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div id="app-nav-top-bar" class="">
                        <div class="nav pull-right show-on-hover">
                            <button type="button" class="btn btn-default dropdown-toggle action-button" data-toggle="dropdown">
                                Log Out <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Help</a></li>
                                <li>
								<?php if($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0) { ?>
                                    <a href="<?=BASE_URL?>index.php/admin/logout">Logout</a>
								<?php } ?>
								
                                <!--<?php //if($this->session->userdata('user_id') && $this->session->userdata('user_type_id')==1){ ?>
                                    <a href="<?=BASE_URL?>index.php/admin/logout">Logout</a>
                                <?php //} else { ?>
                                    <a href="<?=BASE_URL?>index.php/welcome/logout">Logout</a>
                                <?php //} ?> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        <!-- BEGIN THEME CUSTOMIZER (Multiple Themes)-->
        <div id="theme-change" class="hidden-phone">
            <i class="icon-cogs"></i>
			<span class="settings">
				<span class="text">Theme Color:</span>
				<span class="colors">
					<span class="color-default" data-style="default"></span>
					<span class="color-cyan" data-style="cyan"></span>
					<span class="color-violet" data-style="violet"></span>
					<span class="color-red" data-style="red"></span>
					<span class="color-orange" data-style="orange"></span>
				</span>
			</span>
        </div>
        </div>
        <!-- END THEME CUSTOMIZER-->
	<?php $this->load->view('header_menu'); ?>
    <div id="body-content">
	<?php } else { ?>
	<!DOCTYPE html>
		<html>
			<head>	
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
				<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />	
				<title>SUN SMS</title>	
				<link href="<?=BASE_URL?>css/font-google-apis.css" rel="stylesheet" type="text/css">    
				<!--<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">	-->
				<link href="<?=BASE_URL?>css/bootstrap.min.css" type="text/css" media="screen, projection" rel="stylesheet" />
				<link href="<?=BASE_URL?>css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />		
				<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->    
				<!--[if lt IE 9]>      
				<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>      
				<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>    <![endif]-->
			</head>
	<?php } ?>
