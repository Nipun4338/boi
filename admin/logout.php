<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["logout_btn"])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login with logout flag
    header("Location: login.php?logout=true");
    exit();
}

// Fallback if accessed directly without POST
header("Location: index.php");
exit();
?>
