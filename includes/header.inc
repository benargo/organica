<?php # header.inc (includes navigation & sidebar)

// This page begins the HTML header for the site.

// Check for a $page_title value:
if (!isset($page_title)) $page_title = 'Default Page Title';
?><!DOCTYPE html>
<html dir="ltr" lang="en" class="nojs">
	<head>
		<!-- Meta Information -->
		<meta charset="UTF-8" />
		<meta name="robots" content="none" />
		<meta name="author" content="10008548" />
		
		<!-- Page Title -->
		<title><?php echo $page_title; ?> - Beady.co.uk</title>
		
		<!-- Shortcut Icon -->
		<link type="image/x-icon" rel="shortcut icon" href="./images/favicon.ico" />
		
		<!-- Stylesheets -->
		<link type="text/css" rel="stylesheet" href="./styles/style.css" />
		
		<!-- Scripts -->
		<script type="text/javascript" src="./scripts/jquery.min.js"></script>
	</head>
	<body>
		<div id="container">
			<header>
				<!-- Logo -->
				<hgroup>
					<h1><a href="./" title="Beady: Home">Beady</a></h1>
				</hgroup>
				
				<!-- Navigation -->
				<nav id="primary"> 
					<ol><?php
						if(isset($session->basket)) { ?>
							<li><a href="./basket?action=view" title="Beady: View My Shopping Basket">Shopping Basket</a></li><?php }
						if(isset($session->customer)) { // We have a logged-in customer ?>
							<li><a href="./account?action=manage" title="Beady: My Account">My Account</a></li>
							<li><a href="./account?action=logout" title="Beady: Log Out of My Account">Log Out</a></li><?php }
						else { // Customer is not logged in ?>
							<li><a href="./account?action=login" title="Beady: Log In to My Account">Log In</a></li>
							<li><a href="./account?action=register" title="Beady: Sign up for an account">Register</a></li><?php } ?>
							<!-- Search -->	
							<li><form id="search" method="get" action="./search">
								<input type="text" name="q" placeholder="Search..." />
								<input type="submit" value="GO" />
							</form></li>
					</ol>
				</nav>	
			</header>
			
			<article>

			
