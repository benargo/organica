<?php # mysql.inc.php

/*
 * File name: mysql.inc.php
 * Configuration file that opens a new database connection
 */

$host     = "rs-web.benargo.net";
$username = "beady";
$password = "ZNgnGyu364r7xZo32FmAj$";
$database = "beady";

$db = new mysqli($host, $username, $password, $database);

// Unset these variables (for security purposes)
unset($host, $username, $password, $database);

?>