<?php # basket.class.php

/* 
 * File name: basket.class.php
 * Configuration file used for rendering the shopping basket
 */

class basket {
	
	// Variables
	private $id;
	private $paid;
	
	// Construction function
	public function __construct() {
		
		// First include the database
		global $db;
		
		// Check to see if we have a session
		if($_SESSION['basket']) {
			
			// Run the database query
			$sql = $db->query("SELECT * FROM `basket` WHERE `id` = ". $_SESSION['basket'] ." LIMIT 0, 1");
			
			// Set it to an object
			$basket = $sql->fetch_object();
			
			// Set the variables
			$this->id = $basket->id;
			$this->paid = $basket->paid;
			
			// Return true
			return true;
			
		} else {
			
			// Create a basket
			$db->query("INSERT INTO `basket`");
			
			// Get the ID number of the basket
			$basket_id = $db->insert_id;
			
			// Set the ID number of the newly created basket to a session
			$_SESSION['basket'] = $basket_id;
			
			// Set the object variables
			$this->id = $basket_id;
			$this->paid = 0;
			
			// Return true
			return true;
			
		}
	}
	
	// Add an item to the basket
	public function addItem($product, $quantity) {
		
		// Run the query
		$db->query("INSERT INTO `basket_items` (`basket`, `product`, `quantity`) VALUES (". $this->id .", ". $product .", ". $quantity .")");
		
		// Return true
		return true;
		
	}
	
	// Remove an item from the basket
	public function rmItem($id) {
	
		// Run the query
		$db->query("DELETE FROM `basket_items` WHERE `id` = $id");
		
		// Return true
		return true;
		
	}
	
	// Change quantity of an item
	public function changeQuantity($id, $quantity) {
	
		// Run the query
		$db->query("UPDATE `basket_items` SET `quantity` = $quantity WHERE `id` = $id");
		
		// Return true
		return true;
		
	}
	
	// Get the basket items
	public function getItems() {
		
		// Run the database query
		$sql = $db->query("SELECT * FROM `basket_items` WHERE `basket` = ". $this->id);
		
		// Return the items
		return $sql->fetch_object();
		
	}
	
	// Set the basket as paid
	public function paid() {
		
		// Set the basket as paid
		$db->query("UPDATE `basket` SET `paid` = 1 WHERE `id` = ". $this->id);
		
		// Return true
		return true;
		
	}
}
	
?>