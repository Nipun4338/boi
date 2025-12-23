<?php
/**
 * Router file for PHP Built-in Development Server
 * This simulates the behavior of the .htaccess file.
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the file exists and is not a directory, serve it as is (for CSS, JS, Images)
if (file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

// Clean the URI path for mapping
$path = ltrim($uri, '/');

// Route mapping matches the rules in .htaccess
$routes = [
    ''              => 'index.php',
    'home'          => 'index.php',
    'login'         => 'login.php',
    'profile'       => 'profile.php',
    'logout'        => 'logout.php',
    'sell'          => 'sell.php',
    'instructions'  => 'instructions.php',
    'contact'       => 'contact.php',
    'messages'      => 'messages.php',
    'wishlist'      => 'wishlist.php',
    'filter'        => 'filter.php',
    'chat'          => 'chat.php',
    'subscribe'     => 'subscribe.php',
    'book_edit'     => 'book_edit.php',
    'book'          => 'book.php',
    'verify'        => 'verify.php',
    'credit'        => 'credit.php'
];

if (isset($routes[$path])) {
    require __DIR__ . '/' . $routes[$path];
} else {
    // 404 Handling
    header("HTTP/1.1 404 Not Found");
    if (file_exists(__DIR__ . '/404.php')) {
        require __DIR__ . '/404.php';
    } else {
        echo "<h1>404 Not Found</h1>";
        echo "<p>The requested page <strong>" . htmlspecialchars($path) . "</strong> could not be found.</p>";
    }
}
