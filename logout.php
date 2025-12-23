<?php
session_start();
include "includes/config/dbconfig.php";

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    
    // Update active status to Offline using prepared statements
    $stmt = mysqli_prepare($connection, "UPDATE user SET active_status = 'Offline' WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
}

// Destroy session
session_unset();
session_destroy();

header("Location: login");
exit();
?>
