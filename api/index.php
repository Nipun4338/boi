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
// 1. Handle directory roots (e.g., /admin should load /admin/index.php)
$clean_path = rtrim($path, '/');
if (is_dir($base_path . $clean_path)) {
    $index_file = $base_path . $clean_path . '/index.php';
    if (file_exists($index_file)) {
        chdir(dirname($index_file));
        require $index_file;
        exit;
    }
}

// 2. Handle specific PHP files or extension-less URLs
$php_file = $base_path . $clean_path . '.php';
$direct_file = $base_path . $path;

if (file_exists($php_file)) {
    chdir(dirname($php_file));
    require $php_file;
} elseif (file_exists($direct_file) && !is_dir($direct_file)) {
    chdir(dirname($direct_file));
    require $direct_file;
} else {
    chdir($base_path);
    require $base_path . '/index.php';
}
?>
