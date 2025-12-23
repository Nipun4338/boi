<?php
session_start();
include "includes/config/dbconfig.php";

if (isset($_POST["login"])) {
    $email_login = $_POST["email"];
    // Note: Project currently uses MD5 for passwords. In a real production 
    // environment, password_hash and password_verify should be used.
    $password_login = md5($_POST["password"]);

    $stmt = mysqli_prepare($connection, "SELECT * FROM user WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email_login, $password_login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($row["status"] == 1) {
            $_SESSION["username"] = $row["email"];
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["user_name"] = $row["name"];
            header("Location: profile");
            exit();
        } elseif ($row["status"] == 2) {
            $_SESSION["status"] = "Please confirm your email address!";
            header("Location: login");
            exit();
        } else {
            $_SESSION["status"] = "Your account has been suspended.";
            header("Location: login");
            exit();
        }
    } else {
        $_SESSION["status"] = "Invalid Email or Password";
        header("Location: login");
        exit();
    }
} else {
    header("Location: login");
    exit();
}
?>
