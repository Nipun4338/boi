<?php
/**
 * DB Path Fixer
 * This script fixes backslashes in image paths for Linux compatibility (Vercel).
 * Run this script once by visiting your-site.vercel.app/db_fix_paths.php
 */

include "includes/config/dbconfig.php";

echo "<h2>Starting Database Path Fix...</h2>";

$tables = [
    'books' => 'image',
    'category' => 'image',
    'images' => 'image',
    'slider1' => 'image',
    'slider2' => 'image',
    'user' => 'image'
];

foreach ($tables as $table => $column) {
    echo "Processing table: <b>$table</b>...<br>";
    
    // Replace double backslashes with forward slashes
    $query = "UPDATE $table SET $column = REPLACE($column, '\\\\', '/') WHERE $column LIKE '%\\\\%'";
    
    if (mysqli_query($link, $query)) {
        $affected = mysqli_affected_rows($link);
        echo "Successfully updated $affected rows in $table.<br>";
    } else {
        echo "<span style='color:red'>Error updating $table: " . mysqli_error($link) . "</span><br>";
    }
}

echo "<h3>Done! You can now delete this file.</h3>";
?>
