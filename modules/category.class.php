<?php # category.class.php

/* 
 * File name: category.class.php
 * Configuration file used for rendering a single category
 */

class category {
	
	// Define variables
	private $id;
	public $title;
	public $description;

	// Variables with default values
	public $limit = 20;
	public $start = 0;
	public $finish = $this->start+$this->limit;

	
	public function __construct($id) {
		
		// Include database configuration
		require(DB);
		
		// Query the database to get the category
		$query = $db->query("SELECT * FROM `product_categories` WHERE `id` = $id LIMIT 0, 1");
		
		// Loop through the results
		while($row = $query->fetch_object()) {
			
			// Don't worry, this will only loop through once.
			
			// Update the variables
			$this->id = $row->id;
			$this->title = $row->title;
			$this->description = $this->setDescription($row->description);
			
		}
		
		$db->close();
	
	}
	
	private function setDescription($content) {
		
		// Split the description into an array, with a newline being the delimiter
		$lines = explode("\n", $content);
		
		$final = "<section id=\"desc\">\n";
		
		// For each of the lines available
		while($line = $lines) {
			 $final .= "<p>$line</p>\n";
		}
		
		$final .= "</section>\n";
		
		return $final;
		
		$db->close();
		
	}
	
	public function products($page) {
		
		// Include database configuration
		require(DB);
		
		// Work out where to start
		$this->start = $page * 20;
		$this->finish = $this->start + $this->limit;
		
		$query = $db->query("SELECT * FROM `products` WHERE `category` = $this->id LIMIT $this->start, $this->finish");
		
		return $query->fetch_object();
		
		$db->close();
		
	}
	
}