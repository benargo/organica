<?php # config.inc.php

/* 
 *	File name: config.inc.php
 *	Configuration file does the following things:
 *	- Has site settings in one location.
 *	- Stores URLs and URIs as constants.
 *	- Sets how errors will be handled.
 *
 *	Framework adopted from Larry Ullman http://www.dmcinsights.com
 */

# ******************** #
# ***** SETTINGS ***** #

// Errors are emailed here.
$contact_email = 'ben2.argo@live.uwe.ac.uk'; 

// Determine whether we're working on a local server
// or on the real server:
if (stristr($_SERVER['HTTP_HOST'], '.dev')) {
	$local = TRUE;
} else {
	$local = FALSE;
}

// Determine location of files and the URL of the site:
// Allow for development on different servers.
if ($local) {

	// Always debug when running locally:
	$debug = TRUE;
	
	// Define the constants:
	define ('BASE_URI', '/Users/ben/Dropbox/Documents/University/year2/wp/Assignment/');
	define ('BASE_URL',	'http://wp.uwe.dev/');
	define ('DB', '/Users/ben/Dropbox/Documents/University/year2/wp/Assignment/includes/mysql.inc');
	
} else {

	define ('BASE_URI', '/nas/students/b/b2-argo/unix/public_html/wp/assignment/');
	define ('BASE_URL',	'http://www.cems.uwe.ac.uk/~b2-argo/wp/assigmment/');
	define ('DB', '/nas/students/b/b2-argo/unix/public_html/wp/assignment/includes/mysql.inc');
	
}
	
/* 
 *	Most important setting...
 *	The $debug variable is used to set error management.
 *	To debug a specific page, add this to the index.php page:

if ($p == 'thismodule') $debug = TRUE;
require_once('./includes/config.inc.php');

 *	To debug the entire site, do

$debug = TRUE;

 *	before this next conditional.
 */

// Assume debugging is off. 
if (!isset($debug)) {
	$debug = FALSE;
}

# ***** SETTINGS ***** #
# ******************** #

# **************************** #
# ***** ERROR MANAGEMENT ***** #

// Create the error handler.
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	global $debug, $contact_email;
	
	// Build the error message.
	$message = "An error occurred in script '$e_file' on line $e_line: \n<br />$e_message\n<br />";
	
	// Add the date and time.
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
	
	// Append $e_vars to the $message.
	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n<br />";
	
	if ($debug) { // Show the error.
	
		echo '<p class="error">' . $message . '</p>';
		
	} else { 
	
		// Log the error:
		error_log ($message, 1, $contact_email); // Send email.
		
		// Only print an error message if the error isn't a notice or strict.
		if ( ($e_number != E_NOTICE) && ($e_number < 2048)) {
			echo '<p class="error">A system error occurred. We apologize for the inconvenience.</p>';
		}
		
	} // End of $debug IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler ('my_error_handler');

# ***** ERROR MANAGEMENT ***** #
# **************************** #

?>
