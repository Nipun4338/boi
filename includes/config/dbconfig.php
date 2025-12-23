<?php
date_default_timezone_set("Asia/Dhaka");

// Database Configuration using Environment Variables with local fallbacks
$server_name = getenv('DB_HOST') ?: "localhost";
$db_username = getenv('DB_USER') ?: "root";
$db_password = getenv('DB_PASS') ?: "";
$db_name     = getenv('DB_NAME') ?: "boi_db";

$connection = mysqli_connect($server_name, $db_username, $db_password, $db_name);
$link = $connection; // Standardizing on one connection variable

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
