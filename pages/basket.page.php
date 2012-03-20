<?php # basket.inc.php

/* 
 *	This is the basket content module.
 *	This page is included by index.php.
 */

// Redirect if this page was accessed directly:
if (!defined('BASE_URL')) {

	// Need the BASE_URL, defined in the config file:
	require_once ('../modules/config.inc.php');
	
	// Redirect to the index page:
	$url = BASE_URL . 'index.php';
	header ("Location: $url");
	exit;
	
} // End of defined() IF.

// Include the product class
require_once(BASE_URI.'modules/basket.class.php');

// Create a new product
$basket = new basket();
?>
<h1>Basket</h1>

<?php var_dump($_POST); ?>