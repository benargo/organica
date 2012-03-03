<?php # index.php

/* 
 *	This is the main page.
 *	This page includes the configuration file, 
 *	the templates, and any content-specific modules.
 */

ob_start();

// Require the configuration files before any PHP code:
require_once ('./modules/config.inc.php');

// Require the database config
require_once(DB);

// Require the session class
require_once(__DIR__ .'/modules/session.class.php');

// Create a new session object (required for all pages)
$session = new session();

// Validate what page to show:
if (isset($_GET['p'])) {
	$p = $_GET['p'];
} elseif (isset($_POST['p'])) { // Forms
	$p = $_POST['p'];
} else {
	$p = NULL;
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
	
	case 'search':
		$page = 'search.page.php';
		$page_title = 'Search Results';
		break;
	
	// Default is to include the main page.
	default:
		$page = 'main.page.php';
		$page_title = 'Site Home Page';
		break;
		
} // End of main switch.

// Make sure the file exists:
if (!file_exists(__DIR__ .'/pages/' . $page)) {
	$page = 'main.inc.php';
	$page_title = 'Site Home Page';
}

// Include the header file:
include_once (__DIR__ .'/includes/header.inc');

// Include the content-specific module:
// $page is determined from the above switch.
include (__DIR__ .'/pages/' . $page);

// Include the footer file to complete the template:
include_once (__DIR__ .'/includes/footer.inc');

// Close the database connections
$db->close();

ob_end_flush();

?>
