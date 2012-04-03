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

// Set the timezone to GMT
@date_default_timezone_set("GMT");

// Errors are emailed here.
$contact_email = 'ben2.argo@live.uwe.ac.uk'; 

// Determine whether we're working on a local server
// or on the real server:
if (stristr($_SERVER['HTTP_HOST'], 'local')) {
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
	define ('BASE_URI', '/Users/ben/Dropbox/Documents/University/Year 2/WP/Beady/');
	define ('BASE_URL',	'http://localhost/');
	define ('DB', '/Users/ben/Dropbox/Documents/University/Year 2/WP/Beady/includes/mysql.inc');
	
} else {

	define ('BASE_URI', '/nas/students/b/b2-argo/unix/public_html/wp/assignment/');
	define ('BASE_URL',	'http://www.cems.uwe.ac.uk/~b2-argo/wp/assignment/');
	define ('DB', BASE_URI.'includes/mysql.inc');
	
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

/** Function: Get file through UWE proxy **/
function get_file($uri) {

/*********************************************************
 * @function: get_file
 * @author: Chris Wallace
 * @created: 30 November 2009
 * @updated: 20 January 2012
 * @source: http://www.cems.uwe.ac.uk/~pchatter/php/dsa/dsa_utility.phps
 *
 * This function will get any file through the UWE proxy. 
 *
 * It has been adapted so that if we
 * are running on our local testing server, we do not
 * need to use this function, as Ben's private server
 * does not have proxy requirements.
 *********************************************************/

	// Conditional: Do we need to use the proxy?
	if(stristr($_SERVER['HTTP_HOST'], 'cems.uwe.ac.uk')) { // Conditional @value: Yes
	
		// Create a context for the PHP file_get_contents function
		$context = stream_context_create(array('http'=> array('proxy'=>'proxysg.uwe.ac.uk:8080', 'header'=>'Cache-Control: no-cache'))); 
	
		// Get the contents of the requested URI
		$contents = file_get_contents($uri, false, $context); 
	
	} else { // Conditional @value: No
	
		// Get the contents of the requres URI without use of the proxy
		$contents = file_get_contents($uri, false);
	
	} // End Conditional
	
	// And return the contents of the file
	return $contents;
	
}

# **************************** #
# ***** ERROR MANAGEMENT ***** #

// Create the error handler.
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {

	global $debug, $contact_email;
	
	// Build the error message.
	$message = "An error occurred in script '$e_file' on line $e_line: \n<br />$e_message\n<br />";
	
	// Add the date and time.
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
	
	// Append $e_vars to the $message.
	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n<br />";
	
	if ($debug == TRUE) { // Show the error.
	
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
set_error_handler('my_error_handler');

# ***** ERROR MANAGEMENT ***** #
# **************************** #

?>
