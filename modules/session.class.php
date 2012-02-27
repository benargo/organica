<?php # session.class.php

/* 
 * File name: session.class.php
 * Configuration file used for maintaining state
 */

class session {
	
	private $id;
	public $basket;
	public $customer;
	
	public function __construct() {
		
		// Initialise the session
		session_start();
		
		// Include the database configuration
		global $db;
		
		if(isset($_SESSION['id'])) {  // Session Already Exists
			
			// Query the database
			$query = $db->query("SELECT * FROM `sessions` WHERE `id` = ". $_SESSION['id'] ." LIMIT 0, 1");
			
			// Loop through the results
			while($row = $query->fetch_object()) {
				// Don't worry, this will only loop through once
			
				// Update the variables
				$this->id = $row->id;
				
				// The following two can be NULL, 
				//  so only set their values if they're not.
				if(isset($row->basket)) {
					$this->basket = $row->basket;
				}
				
				if(isset($row->customer)) {
					$this->customer = $row->customer;
				}
			
			}
			
			// Update the session timer
			$db->query("UPDATE `sessions` SET `expires` = $this->expires WHERE `id` = ". $_SESSION['id'] ." LIMIT 0, 1");
			
		} else {
			
			// Initialise the session
			$this->createSession();

		}
		
	}
	
	private function createSession() {
		
		// Include the database configuration
		global $db;
		
		// Add it to the database
		$db->query("INSERT INTO `sessions` (`created`, `expires`) VALUES (". $this->created .", ". $this->expires .")");
	
		// Set the ID of the newly created session.
		$this->id = $db->insert_id;
		$_SESSION['id'] = $this->id;
		
	}
	
	public function setCustomer($value) {
		
		// Include the database configuration
		global $db;
		
		// Set the local variable
		$this->customer = $value;
		
		// Add it to the database
		$db->query("UPDATE `sessions` SET `customer` = $value WHERE `id` = $this->id LIMIT 0, 1");
		
	}
	
	public function setBasket($value) {
		
		// Include the database configuration
		global $db;
		
		// Set the local variable
		$this->basket = $value;
		
		// Add it to the database
		$db->query("UPDATE `sessions` SET `basket` = $value WHERE `id` = $this->id LIMIT 0, 1");
		
	}
}