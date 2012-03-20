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
	private $start;
	private $finish;
	private $limit = 20;

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
		
	}
	
	public function description() {
		
		// Get the value of the description
		$content = $this->description;
		
		// Split the description into an array, with a newline being the delimiter
		$lines = explode("\n", $content);
		
		$final = "<section id=\"desc\">\n";
		
		// For each of the lines available
		for($i = 0; $i <= count($lines); $i++) {
			echo $i;
			// $final .= "<p>$lines[$i]</p>\n";
		}
		
		$final .= "</section>\n";
		
		return $final;
		
	}
	
	public function products($page) {
		
		// Include database configuration
		global $db;
		
		// Work out where to start
		$this->start = $page * 20;
		$this->finish = $this->start + $this->limit;
		
		$query = $db->query("SELECT * FROM `products` WHERE `category` = $this->id LIMIT $this->start, $this->finish");
		
		return $query->fetch_object();
		
	}
	
}