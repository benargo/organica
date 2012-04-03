<?php # header.inc (includes navigation & sidebar)

// This page begins the HTML header for the site.

// Check for a $page_title value:
if (!isset($page_title)) $page_title = 'Default Page Title';
?><!DOCTYPE html>
<html lang="en" dir="ltr" class="nojs <?php echo $p; ?>">
	<head>
		<!-- Meta Information -->
		<meta charset="utf-8" />
		<meta name="author" content="10008548" />
		<meta name="description" content="Discover our fantastic range of ecological Cretan holidays with the DiscoverCrete. Fully ABTA and ATOL protected." />

		<!-- Page Title -->
		<title><?php echo $page_title; ?></title>
		
		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/beady.css" />
		
	</head>
	<body>
		<!-- Header -->
		<header>
			
			<!-- Wrapper -->
			<div class="wrapper">
				
				<!-- Accessibility: Skip Function -->
				<a id="skip" href="#content" title="Click to skip to the primary content">Skip to Content</a>
				
				<!-- Logo -->
				<a href="./" id="logo" title="Home page">
					<hgroup>
						<h1>Organica</h1>
						<h2>Organic Fruit &amp; Veg</h2>
					</hgroup>
				</a>
				<!-- Logo -->
				
			</div>
			<!-- Wrapper -->
			
		</header>
		<!-- Header -->
		
		<!-- Primary Navigation -->
		<nav>
			<ol>
				<li><a href="<?php echo BASE_URL; ?>" title="Home page">Home</a></li>
				<?php
					// For each of the categories we have, print a navigation item.
					$categories = $db->query("SELECT * FROM `product_categories` ORDER BY `title`");
					
					// Loop through each of the categories
					while($category = $categories->fetch_object()) {
						
						?><li><a href="<?php echo BASE_URL; ?>category?id=<?php echo $category->id; ?>"><?php echo $category->title; ?></a></li><?php
						echo "\n";
						
					}
					
					// Unset $categories so we can use it later
					unset($categories);
					
					// If there's an active basket
					if(isset($_SESSION['basket'])) {
					
						?><li><a href="<?php echo BASE_URL; ?>basket">Basket</a></li><?php
						echo "\n";
						
					}
					
					// Work out if the user is logged in or not.
					if(isset($_SESSION['customer'])) {
					
						?><li><a href="<?php echo BASE_URL; ?>account?a=logout" id="btn_logout">Logout</a></li><?php
						echo "\n";
						
					} else {
					
						?><li><a href="<?php echo BASE_URL; ?>account?a=login" id="btn_login">Login</a></li>
						  <li><a href="<?php echo BASE_URL; ?>account?a=register" id="btn_register">Register</a></li><?php
						
					}
				?>
			</ol>
		</nav>
		<!-- Primary Navigation -->
		
		<!-- Wrapper -->
		<div class="wrapper" id="content">
		
		<aside>
			<?php include(BASE_URI.'/includes/sidebar.inc'); ?>
		</aside>
		<article>