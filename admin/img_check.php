<?php
include "security.php";
include "../includes/config/dbconfig.php";

echo "<h2>Admin Image Diagnostic</h2>";

// Check 1: Real path of admin folder
echo "Current Folder: " . __DIR__ . "<br>";

// Check 2: Try to find a book image
$query = "SELECT image FROM books LIMIT 1";
$run = mysqli_query($connection, $query);
if ($row = mysqli_fetch_assoc($run)) {
    $db_path = $row['image'];
    echo "Database Book Image Path: <code>$db_path</code><br>";
    
    $relative_path = "../" . $db_path;
    $absolute_path = realpath(__DIR__ . "/" . $relative_path);
    
    echo "Resolved Relative: <code>$relative_path</code><br>";
    echo "System Absolute: <code>" . ($absolute_path ?: "NOT FOUND") . "</code><br>";
    
    if ($absolute_path) {
        echo "<span style='color:green'>File exists on disk!</span><br>";
    } else {
        echo "<span style='color:red'>File NOT found on disk! Check capitalization or path.</span><br>";
    }
} else {
    echo "No books found in database.<br>";
}

// Check 3: Check slider images
$query2 = "SELECT image FROM slider1 LIMIT 1";
$run2 = mysqli_query($connection, $query2);
if ($row2 = mysqli_fetch_assoc($run2)) {
    echo "Database Slider Path: <code>" . $row2['image'] . "</code><br>";
}

echo "<hr>";
echo "<h3>Test Tags:</h3>";
echo "With <code>../</code>: <img src='../$db_path' height='50' style='border:1px solid red'> (Should work if file exists)<br>";
echo "Without <code>../</code>: <img src='$db_path' height='50' style='border:1px solid blue'> (Should fail)<br>";
?>
