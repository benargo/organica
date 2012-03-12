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
?>

<h2>Welcome to Organica</h2>
<p>We stock the finest fruit and veg produce selected from a small number of farmers around the world.</p>

<h2>Featured Produce</h2>
<?php
// We're not going to add a featured stat, but to make it seem featured we're going to get 3 random products.
$query = $db->query("SELECT * FROM `products` ORDER BY RAND LIMIT 0, 3");

// Loop through the random produce
while($product = $query->fetch_object()) {
	
	?><div class="product">
		<a href="<?php echo BASE_URL; ?>product?id=<?php echo $product->id; ?>">
			<h3><?php echo $product->title; ?></h3>
			<img src="<?php echo BASE_URL.$product->image; ?>" alt="<?php echo $product->title; ?>" />
			<p>£<?php echo $product->price; ?></p> 
		</a>
	</div><?php
	
}
?>