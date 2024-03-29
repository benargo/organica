<?php # category.inc.php

/* 
 *	This is the category display page
 *	This page is included by index.php.
 */

// Redirect if this page was accessed directly:
if (!defined('BASE_URL')) {

	// Need the BASE_URL, defined in the config file:
		require_once ('../modules/config.inc.php');
	
	// Redirect to the index page:
	$url = BASE_URL;
	header ("Location: $url");
	exit;
	
} // End of defined() IF.


// Process which category to render
if(!isset($_GET['id'])) { // We have a category ID in the querystring
	
	// Need the BASE_URL, defined in the config file:
	require_once(BASE_URI.'/pages/404.page.php'); 
	exit;
	
}

require(BASE_URI.'modules/category.class.php');

$category = new category($_GET['id']);
?>

<h1><?php echo $category->title; ?></h1>
<?php echo $category->description(); ?>

<section id="products">
<?php $category->products(); ?>
</section>