<?php # checkout.page.php

/* 
 *	This is the checkout handler.
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

// Check to see if there is a basket active
if(!isset($_SESSION['basket'])) {
	
	// Redirect to the account page
	header("location: ". BASE_URL);
	
	// Exit the script
	exit;
	
}

// Check to see if the user is logged in
if(!isset($_SESSION['customer'])) {
	
	// Redirect to the account page
	header("location: ". BASE_URL ."account");
	
	// Exit the script
	exit;
	
} ?><h1>Checkout</h1>

<form action="<?php echo BASE_URL; ?>pay" method="post">
	<p>Credit Card Number: <input type="text" name="num_md5" placeholder="XXXX XXXX XXXX XXXX" /></p>
	<p>Start Date: <input type="text" name="syear" placeholder="MMYY" /></p>
	<p>End Date: <input type="text" name="fyear" placeholder="MMYY" /></p>
	<p><input type="submit" value="Checkout" /></p>
</form>