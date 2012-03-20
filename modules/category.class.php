<?php # category.class.php

/* 
 * File name: category.class.php
 * Configuration file used for rendering a single category
 */

class category {
	
	// Define variables
	public $id;
	public $title;
	private $description;

	public function __construct($id) {
		
		// Include database configuration
		global $db;
		
		// Query the database to get the category
		$query = $db->query("SELECT * FROM `product_categories` WHERE `id` = $id LIMIT 0, 1");
		
		// Loop through the results
		while($row = $query->fetch_object()) {
			
			// Don't worry, this will only loop through once.
			
			// Update the variables
			$this->id = $row->id;
			$this->title = $row->title;
			$this->description = $row->description;
			
		}
		
		return true;
		
	}
	
	public function description() {
		
		// Get the value of the description
		$content = $this->description;
		
		// Split the description into an array, with a newline being the delimiter
		$lines = explode("\n", $content);
		
		$final = "<section id=\"desc\">\n";
		
		// For each of the lines available
		for($i = 0; $i <= count($lines)-1; $i++) {
			$final .= "<p>$lines[$i]</p>\n";
		}
		
		$final .= "</section>\n";
		
		return $final;
		
	}
	
	public function products() {
		
		// Include database configuration
		global $db;
		
		$query = $db->query("SELECT * FROM `products` WHERE `category` = ". $this->id);
		
		while($product = $query->fetch_object()) { ?>
			<a href="<?php echo BASE_URL; ?>product?id=<?php echo $product->id; ?>" title="More Information: <?php echo $product->title; ?>" class="product">
					<h3><?php echo $product->title; ?></h3>
					<p>&pound;<?php echo $product->price; ?></p>
					<p><img src="<?php echo BASE_URL; ?>images/<?php echo $product->image; ?>" alt="Product Image: <?php echo $product->title; ?>" /></p>
			</a>
<?php	}
		
	}
	
}