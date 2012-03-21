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
require_once(BASE_URI.'modules/product.class.php');

// Create a new product
$basket = new basket();

// Get the action
$action = $_POST['a'];

// Loop through the possible actions
switch($action) {
	
	// Add products
	case 'add':
		
		// Get some variables
		$id = $_POST['id'];
		$q = $_POST['q'];
		
		// Run the database query
		$basket->addItem($id, $q) or die('Failed to add item to basket');
		
		// Finish this iteration
		break;
	
	// Update the quantity
	case 'edit':
		
		// Get some variables
		$id = $_POST['id'];
		$q = $_POST['q'];
		
		// Run the database query
		$basket->changeQuantity($id, $q) or die('Failed to update basket');
		
		// Finish this iteration
		break;
		
	// Remove the product
	case 'rm':
	
		// Get some variables
		$id = $_POST['id'];
		
		// Run the database query
		$basket->rmItem($id);
		
		// Finish this iteration
		break;
		
	// Empty the whole basket
	case 'empty':
	
		// Run the database query
		$basket->emptyBasket();
		
		// Finish this iteration
		break;
		
	// If we didn't set a task (illegal call)
	default:
		
		// Finish this iteration
		break;
}
?><h1>Basket</h1><?php

	echo "<pre>7 = ";
	var_dump($_SESSION['basket']);
	echo "</pre>";

	// Loop through each of the basket items
	foreach($basket->getItems() as $item) {
		
		echo "<pre>8.". $item->id ." = ";
		var_dump($_SESSION['basket']);
		echo "</pre>";
		
		// Get a product initialisation of each item
		$product = new product($item->product);
		
		echo "<pre>9.". $item->id ." = ";
		var_dump($_SESSION['basket']);
		echo "</pre>";
		
		?><section class="product">
			<h2><?php echo $product->title; ?></h2>
			<img src="<?php echo BASE_URL; ?>images/<?php echo $product->image; ?>" alt="Photo of <?php echo $product->title; ?>" />
			<div class="controls">
				<form action="<?php echo BASE_URL; ?>basket" method="post">
					<input type="hidden" name="a" value="edit" />
					<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
					<p><select name="q"><?php
					for($i = 1; $i <= 6; $i++) {
						echo "<option";
						if($i == $item->quantity) {
							echo " selected";
						}
						echo ">$i</option>";
					}
					
					echo "<pre>10.". $item->id ." = ";
					var_dump($_SESSION['basket']);
					echo "</pre>";
					?></select> <input type="submit" value="Update" /></p>
				</form>
				<form action="<?php echo BASE_URL; ?>basket" method="post">
					<input type="hidden" name="a" value="rm" />
					<input type="hidden" name="id" value="<?php echo $item->id; ?>" />
					<p><input type="submit" value="Remove" /></p>
				</form>
			</div>
		</section><?php
	}
	
	echo "<pre>11.". $item->id ." = ";
	var_dump($_SESSION['basket']);
	echo "</pre>";
?><p>Total: <span class="bold">&pound;<?php echo $basket->calcFinalValue(); ?></span></p>
<p class="center"><form action="<?php echo BASE_URL; ?>checkout" method="post">
	<input type="hidden" name="stage" value="0" />
	<input type="submit" value="Checkout" />
</form><form action="<?php echo BASE_URL; ?>basket" method="post">
	<input type="hidden" name="a" value="empty" />
	<input type="submit" value="Empty Basket" />
</form></p><?php
echo "<pre>12.". $item->id ." = ";
var_dump($_SESSION['basket']);
echo "</pre>";
?>