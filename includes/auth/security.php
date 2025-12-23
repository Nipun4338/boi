<?php
if (!isset($_SESSION)) {
    session_start();
}

// User security check
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    header("Location: login");
    exit();
}
?>
