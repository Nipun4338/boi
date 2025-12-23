<?php
/**
 * Vercel PHP Router
 * This file redirects all incoming requests to the appropriate PHP file in the root.
 */

$request_uri = $_SERVER['REQUEST_URI'];
$base_path = __DIR__ . '/..';

// Extract the path without query strings
$path = parse_url($request_uri, PHP_URL_PATH);

// Simple routing logic
if ($path == '/' || $path == '') {
    require $base_path . '/index.php';
} else {
    // Check if the file exists with .php extension
    $php_file = $base_path . $path . '.php';
    $direct_file = $base_path . $path;

    if (file_exists($php_file)) {
        require $php_file;
    } elseif (file_exists($direct_file) && !is_dir($direct_file)) {
        // Serve static files if needed, though Vercel handles assets separately
        return false; 
    } else {
        // Fallback to index or 404
        require $base_path . '/index.php';
    }
}
?>
