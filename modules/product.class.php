<?php # product.class.php

/* 
 * File name: product.class.php
 * Configuration file used for rendering a single category
 */


class product {
	
	// Define variables
	public $id;
	private $category;
	public $title;
	public $description;
	public $price;
	public $image;
	
	// Define a construct function
	public function __construct($id) {
		// Include the database
		global $db;
		
		// Run the query
		$query = $db->query("SELECT * FROM `products` WHERE `id` = $id LIMIT 0, 1");
		$c = $query->fetch_object();
		
		// Set all the variables
		$this->id = $c->id;
		$this->category = $c->category;
		$this->title = $c->title;
		$this->description = $c->description;
		$this->price = $c->price;
		$this->image = $c->image;
	}
}