<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../includes/config/dbconfig.php";

if (isset($_POST["login_btn"])) {
    $email_login = trim($_POST["email"]);
    $password_login = md5($_POST["password"]); // Note: Standardizing on MD5 as per current project DB

    $stmt = mysqli_prepare($connection, "SELECT * FROM adminpanel WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email_login, $password_login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['status'] == 1) {
            $_SESSION["username"] = $row['email'];
            $_SESSION["admin_name"] = $row['username'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION["status"] = "This account has been disabled. Please contact the super admin.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION["status"] = "Invalid Email Address or Password. Please try again.";
        header("Location: login.php");
        exit();
    }
} else {
    // Direct access to code.php is not allowed
    header("Location: login.php");
    exit();
}
?>
