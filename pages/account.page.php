<?php # account.page.php

/* 
 *	This is the account handler.
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

// Require the account class
require_once(BASE_URI.'modules/customer.class.php');

// Create a new instance of the account class
$customer = new customer();

// Check if there's an action set
if(isset($_GET['a'])) {
	// Set a variable with the action
	$action = $_GET['a'];
} elseif(isset($_POST['a'])) {
	$action = $_POST['a'];
} else {
	$action = "login";
}
	
	// Switch through all the actions
	switch($action) {
		
		// Login
		case "login": ?><h1>Login</h1>
		
		<p>Please login to continue. If you do not have an account you can <a href="<?php echo BASE_URL; ?>account?a=register">register for one</a>.</p>
		
		<form action="<?php echo BASE_URL; ?>account" method="post">
			<input type="hidden" name="a" value="loginSubmit" />
			<input type="hidden" name="ref" value="<?php if(isset($_POST['ref'])) {
					echo $_POST['ref']; 
				} else {
					echo $_SERVER['HTTP_REFERER'];
				} ?>" />
			<p>Email Address: <input type="email" name="email" placeholder="john.smith@example.com" /></p>
			<p>Password: <input type="password" name="password" /></p>
			<p><input type="submit" value="Login" /></p>
		</form>
		
<?php 	// Finish this itteration
			break;
		
		// Register
		case "register": ?><h1>Register</h1>
		
		<form action="<?php echo BASE_URL; ?>account" method="post">
			<input type="hidden" name="a" value="registerSubmit" />
			<input type="hidden" name="ref" value="<?php if(isset($_POST['ref'])) {
					echo $_POST['ref']; 
				} else {
					echo $_SERVER['HTTP_REFERER'];
				} ?>" />	
			<p>Title: <?php echo $customer->getTitles(); ?></p>
			<p>First Name: <input type="text" name="first_name" placeholder="John" required /></p>
			<p>Last Name: <input type="text" name="last_name" placeholder="Smith" required /></p>
			<p>Address: <textarea name="address" rows="5"></textarea></p>
			<p>Post Code: <input type="text" name="post_code" placeholder="AA99 9AA" /></p>
			<p>Email: <input type="email" name="email" placeholder="john.smith@example.com" required /></p>
			<p>Phone: <input type="tel" name="phone" placeholder="01234 567890" /></p>
			<p>Password: <input type="password" name="password" required /></p>
			<p><input type="submit" value="Register" /></p>
		</form>
		
<?php 	// Finish this itteration
			break;
			
		case "loginSubmit":
		
			// Process the login
			$customer->login($_POST['email'], $_POST['password']);
			
			// Redirect back to the page the user was at before
			header("location: ". $_POST['ref']);
			
			// Exit the script here
			exit;
		
 			// Finish this itteration
			break;
			
		case "registerSubmit":
		
			// Process the registration
			$customer->register($_POST);
			
			// Redirect back to the page the user was at before
			header("location: ". $_POST['ref']);
		
			// Exit the script here
			exit;
		
			// Finish this itteration
			break;
			
		case "logout":
		
			// Log the customer out
			$customer->logout();
			
			// Redirect to the home page
			header("location: ". BASE_URL);
			
			// Exit the script here
			exit;
			
			// Finish this itteration
			break;
	}

?>