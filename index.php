<?php # index.php

/* 
 *	This is the main page.
 *	This page includes the configuration file, 
 *	the templates, and any content-specific modules.
 */

// Start PHP sessions
session_start();

// Require the configuration files before any PHP code:
require_once('modules/config.inc.php');

// Require the database config
require_once(DB);

// Validate what page to show:
if (isset($_GET['p'])) {
	$p = $_GET['p'];
} elseif (isset($_POST['p'])) { // Forms
	$p = $_POST['p'];
} else {
	$p = 'home'	;
}

// Determine what page to display:
switch ($p) {

	case 'account':
		$page = 'account.page.php';
		$page_title = 'My Account';
		break;
	
	case 'category':
		$page = 'category.page.php';
		$page_title = 'Product Category';
		break;
		
	case 'product':
		$page = 'product.page.php';
		$page_title = 'Product Details';
		break;
		
	case 'basket':
		$page = 'basket.page.php';
		$page_title = 'Your Shopping Basket';
		break;
		
	case 'checkout':
		$page = 'checkout.page.php';
		$page_title = 'Checkout';
		break;
	
	case 'search':
		$page = 'search.page.php';
		$page_title = 'Search Results';
		break;
		
	case 'home':
		$page = 'main.page.php';
		$page_title = 'Site Home Page';
		break;
	
	// Default is to include the main page.
	default:
		$page = '404.page.php';
		$page_title = '404 Not Found';
		break;
		
} // End of main switch.

// Make sure the file exists:
if (!file_exists(BASE_URI.'/pages/' . $page)) {
	$page = 'main.inc.php';
	$page_title = 'Site Home Page';
}

// Include the header file:
include_once (BASE_URI.'/includes/header.inc');

// Include the content-specific module:
// $page is determined from the above switch.
include (BASE_URI.'/pages/' . $page);

// Include the footer file to complete the template:
include_once (BASE_URI.'/includes/footer.inc');

// Update the basket session if we have an active basket
if(isset($basket)) {
	$_SESSION['basket'] = (int) $basket->id;
}

// Close the database connections
$db->close();

?>
