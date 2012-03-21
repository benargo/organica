<?php # basket.class.php

/* 
 * File name: basket.class.php
 * Configuration file used for rendering the shopping basket
 */

class basket {
	
	// Variables
	public $id;
	private $paid;
	
	// Construction function
	public function __construct() {
		
		// First include the database
		global $db;
		
		// Check to see if we have a session
		if(!isset($_SESSION['basket'])) {

			// Create a basket
			$db->query("INSERT INTO `basket` (`paid`) VALUES (0)");

			// Get the ID number of the basket
			$basket_id = $db->insert_id;
			
			$_SESSION['basket'] = $basket_id;

			// Set the object variables
			$this->id = $basket_id;
			$this->paid = 0;
			
		} else {
			
			$basket_id = $_SESSION['basket'];
	
			// Run the database query
			$sql = $db->query("SELECT * FROM `basket` WHERE `id` = ". $basket_id ." LIMIT 0, 1");

			// Set it to an object
			$basket = $sql->fetch_object();

			// Set the variables
			$this->id = $basket->id;
			$this->paid = $basket->paid;
			
			// This is an override to make sure it works a second time around
			$_SESSION['basket'] = $basket_id;
			
		}
	}
	
	// Add an item to the basket
	public function addItem($product, $quantity) {
		
		// Include the database details
		global $db;
		
		if($this->checkIfExists($product, $quantity)) {
			
			return true;
			exit;
			
		} else {
		
			// Run the query
			$db->query("INSERT INTO `basket_items` (`basket`, `product`, `quantity`) VALUES (". $this->id .", ". $product .", ". $quantity .")");
		
			// Return true
			return true;
		
		}
		
	}
	
	// Remove an item from the basket
	public function rmItem($id) {
		
		// Include the database details
		global $db;
	
		// Run the query
		$db->query("DELETE FROM `basket_items` WHERE `id` = $id");
		
		// Return true
		return true;
		
	}
	
	// Change quantity of an item
	public function changeQuantity($id, $quantity) {
		
		// Include the database details
		global $db;
	
		// Run the query
		$db->query("UPDATE `basket_items` SET `quantity` = $quantity WHERE `id` = $id");
		
		// Return true
		return true;
		
	}
	
	// Get the basket items
	public function getItems() {
		
		// Include the database details
		global $db;
		
		// Run the database query
		$sql = $db->query("SELECT * FROM `basket_items` WHERE `basket` = ". $this->id);
		
		// Count the number of rows
		if(count($sql->num_rows) <= 0) {
			
			// Redirect to the home page
			header("location: ". BASE_URL);
			
			// Exit this script
			exit;
			
		}
		
		// Declare a new array
		$rows = Array();
		
		// Go through each of the rows
		while($row = $sql->fetch_object()) {
			
			// Add each row to the end of the array
			array_push($rows, $row);
			
		}
		
		// Finally return all the rows
		return $rows;
		
	}
	
	// Set the basket as paid
	public function paid() {
		
		// Include the database details
		global $db; 
		
		// Set the basket as paid
		$db->query("UPDATE `basket` SET `paid` = 1 WHERE `id` = ". $this->id);
		
		// Return true
		return true;
		
	}
	
	// Check if the items are already in the basket
	private function checkIfExists($product, $quantity) {
		
		// Include the database details
		global $db;
		
		// Run the database query
		$sql = $db->query("SELECT * FROM `basket_items` WHERE `basket` = ". $this->id ." AND `product` = $product LIMIT 0, 1");
		
		// Check the object.
		if($obj = $sql->fetch_object()) {
		
			// Get the row id
			$row_id = $obj->id;
		
			// Update the value
			$db->query("UPDATE `basket_items` SET `quantity` = $quantity WHERE `id` = $row_id");
			
			// Return true
			return true;
		
		}
		
		// And return true
		return false;
		
	}
	
	// Calculate the final value of the basket
	public function calcFinalValue() {
		
		// Include the product class (just in case)
		require_once(BASE_URI.'modules/product.class.php');
		
		// Include the database details
		global $db;
		
		// Create a new variable called price, and set it to 0.
		$price = 0;
		
		// Get all of the items
		$items = $this->getItems();
		
		// Run through all of the rows
		foreach($items as $item) {
			
			// Create a new iteration of a product
			$product = new product($item->product);
			
			// Find out the price 
			$price = $price + ($product->price * $item->quantity);
		}
		
		// Return the final price
		return number_format($price, 2);
		
	}
	
	// Empty all the products in this basket
	public function emptyBasket() {
		
		// Include the database details
		global $db;
		
		// Run the first database query
		// We want to remove all of the basket items
		$db->query("DELETE FROM `basket_items` WHERE `basket` = ". $this->id);
		
	}
	
	public function destroyBasket() {
		unset($_SESSION['basket']);
	}
}
	
?>