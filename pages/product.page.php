<?php # main.inc.php

/* 
 *	This is the main content module.
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

if(!$_GET['id']) {
	require(BASE_URI.'pages/404.page.php');
	exit;
}

// Include the product class
require_once(BASE_URI.'modules/product.class.php');

// Create a new product
$product = new product($_GET['id']);
?>

<h1><?php echo $product->title; ?></h1>

<form action="<?php echo BASE_URL; ?>basket" method="post">
	<input type="hidden" name="a" value="add" />
	<input type="hidden" name="id" value="<?php echo $product->id; ?>" />
	<img class="product_img" src="<?php echo BASE_URL; ?>images/<?php echo $product->image; ?>" alt="<?php echo $product->title; ?>" />
	<p><?php echo $product->description; ?></p>
	<p>Price: <span class="bold">&pound;<?php echo $product->price; ?></span></p>
	<p>Quantity: <select name="q">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			<option>6</option>
		</select> <input type="submit" value="Add to Cart" />
</form>