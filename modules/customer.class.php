<?php // customer.class.php

/* 
 *	This is the customer class. It handles account management for users
 */

class customer {
	
	// Variables
	private $id;
	private $title;
	public $first_name;
	public $last_name;
	private $address;
	public $post_code;
	public $email;
	public $phone;
	private $password;
	
	// Construction function
	public function __construct() {
		
		// Include the database details
		global $db;
		
		// Check out whether we have a user set in the session
		if(isset($_SESSION['customer']) { // Yes there is one
			
			$id = $_SESSION['customer'];
		
			// Get the customer's details from the database
			$sql = $db->query("SELECT * FROM `customers` WHERE `id` = $id LIMIT 0, 1");
			$c = $sql->fetch_object();
			
			// Loop through and add all the variables
			$this->id = $c->id;
			$this->title = $c->title;
			$this->first_name = $c->first_name;
			$this->last_name = $c->last_name;
			$this->address  = $c->address;
			$this->post_code = $c->post_code;
			$this->email = $c->email;
			$this->phone = $c->phone;
			$this->password = $c->password;
			
			// Nothing else to do so far
			return true;
			
		} else { // No there isn't
			
			// Wait for further instructions
			return true;
			
		}
		
	}
	
	// Get the titles and print them out as a form select box
	public function getTitles() {
		
		// Include the database details
		global $db;
		
		// Run the query to get the titles back
		$sql = $db->query("SELECT * FROM `customer_titles`") or die("Unable to get titles");
		
		// First echo out the start of the select statement
		echo "<select name=\"title\">";
		
		// Loop through each of the titles
		while($title = $sql->fetch_object()) {
		
			// Print out the start of the option
			echo "<option value=\"". $title->id ."\"";
			
			// If this is the user's current title
			if($this->title == $title->id) {
			
				// echo out the fact that it's selected
				echo " selected";
				
			}
			
			// Echo out the end of the option
			echo ">". $title->name; ."</option>";
			
		}
		
		// Echo out the end of the select
		echo "</select>";
		
		// And finish!
		
	}
	
	// Print out the address line by line
	public function getAddress() {
		
		// We don't need the database here!
		
		// Let's start by exploding the address
		$address = explode("\n", $this->address);
		
		// Loop through each line
		foreach($address as $line) {
			
			// Print out the line, wrapped by paragraph tags
			echo "<p>$line</p>";
		
		}
		
	}
	
	// Registers the customer based on the details they give us
	// This expects a hash (array) with the posted data.
	public function register($post) {
		
		// Include the database details
		global $db;
		
		// Let's go through all the variables we want
		$title = $post['title'];
		$first_name = $post['first_name'];
		$last_name = $post['last_name'];
		$address = $post['address'];
		$post_code = $post['post_code'];
		$email = $post['email'];
		$phone = $post['phone'];
		$password = $post['password'];
		
		// Create the account in the database
		$db->query("INSERT INTO `customers` (`title`, `first_name`, `last_name`, `address`, `post_code`, `email`, `phone`, `password`) VALUES ($title, '$first_name', '$last_name', '$address', '$post_code', '$email', $phone, '$password')") or die($db->error);
		
		// Get the ID number of the inserted row
		$id = $db->insert_id;
		
		// Set that ID to the session
		$_SESSION['customer'] = $id;
		
		// Set all the variables of the object
		$this->id = $id;
		$this->title = $title;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->address  = $address;
		$this->post_code = $post_code;
		$this->email = $email;
		$this->phone = $phone;
		$this->password = $password;
		
		// Return true
		return true;
		
	}
	
	// Let the user login
	public function login($email, $password) {
		
		// Include the database details
		global $db;
		
		// Get the user account
		$sql = $db->query("SELECT * FROM `customers` WHERE `email` = '$email' LIMIT 0, 1");
		
		$c = $sql->fetch_object();
		
		if($c->password == $password) {
			
			$_SESSION['customer'] = $c->id;
			
			// Loop through and add each of the variables
			$this->id = $c->id;
			$this->title = $c->title;
			$this->first_name = $c->first_name;
			$this->last_name = $c->last_name;
			$this->address  = $c->address;
			$this->post_code = $c->post_code;
			$this->email = $c->email;
			$this->phone = $c->phone;
			$this->password = $c->password;
		
			// Success!
			return true;
			
		} else {
			
			// Else return false
			return false;
			
		}
		
	}
	
	public function logout() {
		unset($_SESSION['customer']);
	}
	
}