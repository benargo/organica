<?php # search.page.php

/* 
 *	This is the search page.
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

// Include the search class
require_once(BASE_URI.'modules/search.class.php');

// Get the search variable
$q = $_GET['q'];

// Create a new search
$search = new search($q);
?><h1>Search Results</h1>
<?php $search->products(); ?>