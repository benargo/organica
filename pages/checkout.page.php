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
	
} 

// Check if there's an action set
if(isset($_POST['stage'])) {
	$stage = $_POST['stage'];
} else {
	$stage = 0;
}

// Loop through all the stages
switch($stage) {
	
	// Case 0: Payment details
	case 0: ?><h1>Checkout</h1>

	<form action="<?php echo BASE_URL; ?>checkout" method="post">
		<input type="hidden" name="stage" value="1" />
		<p>Credit Card Number: <input type="text" name="num_md5" placeholder="XXXX XXXX XXXX XXXX" /></p>
		<p>Start Date: <input type="text" name="syear" placeholder="MMYY" /></p>
		<p>End Date: <input type="text" name="fyear" placeholder="MMYY" /></p>
		<p><input type="submit" value="Checkout" /></p>
	</form><?php
	
		// Finish this itteration
		break;
		
	// Case 1: Clear the credit card
	case 1:
		
		// First remove any spaces from the credit card number
		$fragments = explode(" ", $_POST['num_md5']);
		
		// Now put the fragments back together
		$num_md5 = implode($fragments);
		
		// Finally, hash the lot
		$num_md5 = md5($num_md5);
		
		// This is really all we need for the credit card clearing system
		
		// The next step is to get the basket
		require_once(BASE_URI.'modules/basket.class.php');
		$basket = new basket();
		
		// so the next step is building the restful URL
		$url = "http://www.cems.uwe.ac.uk/~pchatter/rest/rest.php?service=cardAuth&msg_id=". str_pad($basket->id, 4, '0', STR_PAD_LEFT) ."&num_md5=". $num_md5 ."&amount=". $basket->calcFinalValue() ."&currency=GBP&api_key=739a720ade31ad2a14b30aa7b3a6b20e";
		
		$xml = simplexml_load_string(get_file($url));
		
		if($xml->error) {
			// Find out what the error code is
			$error_code = $xml->error['code']; ?>
			
			<h1>Error</h1>
			<p>There was an error in clearing your payment.</p>
			<p class="bold"><?php		
			// Switch through each of the error codes
			switch($error_code) {
			
				case 100: 
					echo "Required Parameters are Missing";
					break;
				case 105:
					echo "Undefined or Unknown Service";
					break;
				case 110:
					echo "Service not yet implemented";
					break;
				case 115:
					echo "Undefined or Invalid Message ID";
					break;
				case 120:
					echo "Undefined or Invalid Card Number";
					break;
				case 125:
					echo "Undefined or Invalid Amount";
					break;
				case 130:
					echo "Undefined or Invalid Currency";
					break;
				case 135:
					echo "Undefined or Invalid API Key";
					break;
				case 140:
					echo "Card Blocked";
					break;
				case 145:
					echo "Card Expired";
					break;
				case 150:
					echo "Card Limit Exceeded";
					break;
				case 155:
					echo "Card not found in Database";
					break;
				case 170:
					echo "Error in Service";
					break;
				case 180:
					echo "test OK";
					break;
				
			} ?></p><?php
			
			// Stop the script from going any further
			exit;
			
			$basket->order("fail");
		}
		
		// Okay so it's gone through fine, let's mark the basket as paid.
		$basket->order("pay");
		
		// Destroy the basket now
		$basket->destroyBasket();
		
		// Finally echo out a confirmation message
		?><h1>Order Complete</h1>
		
		<p>Relax! Your payment has gone through. Your order will be on its way to you within 4-5 business years.</p><?php
	
}

?>