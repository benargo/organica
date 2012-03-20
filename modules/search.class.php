<?php # search.inc.php

/* 
 *	This is the search content module.
 *	This page is included by index.php.
 *	This page expects to receive $_GET['terms'].
 */

class search {

	// Variables
	private $term;
	private $results;
	
	// Construction function
	public function __construct($q) {
		
		// Include the database details
		global $db;
		
		// Set the search terms to the object
		$this->term = $q;
		
		// Run the database query
		$sql = $db->query("SELECT * FROM `products` WHERE `title` OR `description` LIKE '%$q%'");
		
		// Declare a new array
		$rows = Array();
		
		// Go through each of the rows
		while($row = $sql->fetch_object()) {
			
			// Add each row to the end of the array
			array_push($rows, $row);
			
		}
		
		// Add the rows to the result; 
		$this->results = $rows;
		
		// Do nothing for now
		return true;
		
	}
	
	public function products() {
		
	 	foreach($this->results as $product) { ?>
			<a href="/product?id=<?php echo $product->id; ?>" title="More Information: <?php echo $product->title; ?>" class="product">
					<h3><?php echo $product->title; ?></h3>
					<p>&pound;<?php echo $product->price; ?></p>
					<p><img src="/images/<?php echo $product->image; ?>" alt="Product Image: <?php echo $product->title; ?>" /></p>
			</a>
<?php	}
		
	}
}
?>
