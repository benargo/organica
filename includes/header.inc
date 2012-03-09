<?php # header.inc (includes navigation & sidebar)

// This page begins the HTML header for the site.

// Check for a $page_title value:
if (!isset($page_title)) $page_title = 'Default Page Title';
?><!DOCTYPE html>
<html lang="en" dir="ltr" class="nojs">
	<head>
		<!-- Meta Information -->
		<meta charset="utf-8" />
		<meta name="author" content="10008548" />
		<meta name="description" content="Discover our fantastic range of ecological Cretan holidays with the DiscoverCrete. Fully ABTA and ATOL protected." />

		<!-- Page Title -->
		<title><?php echo $page_title; ?></title>
		
		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>styles/beady.css" />
		
		<!-- jQuery -->
		<script src="<?php echo BASE_URL; ?>scripts/jquery.js"></script>
	</head>
	<body>
		<header>
			<a id="skip" href="#content" title="Click to skip to the primary content">Skip to Content</a>
			<hgroup>
				<a href="./" title="Home page">
					<h1>West Side Tees</h1>
					<h2>Est. 2012.</h2>
				</a>
			</hgroup>
			<nav>
				<ol>
					<li><a href="<?php echo BASE_URL; ?>" title="Home page">Home</a></li>
					<?php
						// For each of the categories we have, print a navigation item.
						$categories = $db->query("SELECT * FROM `product_categories` ORDER BY `title`");
						
						// Loop through each of the categories
						while($category = $categories->fetch_object()) {
							
							?><li><a href="<?php echo BASE_URL; ?>category?id=<?php echo $category->id; ?>"><?php echo $category->title; ?></a></li><?php
							
						}
						
						// Work out if the user is logged in or not.
					?>
				</ol>
			</nav>
		</header>
		<form id="search" action="<?php echo BASE_URL; ?>search" method="get">
			<input type="text" name="q" placeholder="Search..." /> <input type="submit" value="Go" />
		</form>
		
		<aside>
			<?php include(BASE_URI.'/includes/sidebar.inc'); ?>
		</aside>
		<article id="content">