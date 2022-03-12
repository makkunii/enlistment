<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "dbenlist";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

define( "DB_HOST", "localhost" );
define( "DB_USER", "root" );
define( "DB_PASSWORD", "" );
define( "DB_NAME", "dbenlist" );