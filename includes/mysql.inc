<?php # mysql.inc.php

/*
 * File name: mysql.inc.php
 * Configuration file that opens a new database connection
 */

$host     = "rs1.benargo.net";
$username = "organica";
$password = "ZNgnGyu364r7xZo32FmAj$";
$database = "organica";

$db = new mysqli($host, $username, $password, $database);

// Unset these variables (for security purposes)
unset($host, $username, $password, $database);

?>