<?php # 404.page.php

/* 
 *	This is the 404 page handler
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
?>

<h2>404 Not Found</h2>

<p>Ever felt like you're in the wrong place? Well you are, this page does not exist...</p>

<p class="center"><img src="<?php echo BASE_URL; ?>/images/404.jpg" alt="404" /></p>