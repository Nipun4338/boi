<?php
date_default_timezone_set("Asia/Dhaka");

// Database Configuration using Environment Variables with local fallbacks
$server_name = getenv('DB_HOST') ?: "localhost";
$db_username = getenv('DB_USER') ?: "root";
$db_password = getenv('DB_PASS') ?: "";
$db_name     = getenv('DB_NAME') ?: "boi_db";
$db_port     = getenv('DB_PORT') ?: "3306";

// Create connection
$connection = mysqli_init();

// Aiven and some other cloud providers require SSL
// If we are on Vercel (remote), we should use the port and try to connect
if (getenv('DB_HOST')) {
    $connection = mysqli_connect($server_name, $db_username, $db_password, $db_name, $db_port);
} else {
    // Local XAMPP
    $connection = mysqli_connect($server_name, $db_username, $db_password, $db_name);
}

$link = $connection; // Standardizing on one connection variable

if (!$connection) {
    die("Database Connection failed: " . mysqli_connect_error());
}
?>
