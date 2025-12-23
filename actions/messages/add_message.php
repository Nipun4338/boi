<?php
include "../../includes/auth/security.php";
include "../../includes/config/dbconfig.php";

$error = "";
$user_id = $_SESSION["user_id"];
$receiver_id = $_SESSION["receive"];

if (!isset($_POST["commenton"]) || empty(trim($_POST["commenton"]))) {
    echo json_encode(["error" => "Message cannot be empty"]);
    exit();
}

$m = "zmessage_" . $user_id;
$m1 = "zmessage_" . $receiver_id;

date_default_timezone_set("Asia/Dhaka");
$datetime = date("Y-m-d H:i:s");
$message = $_POST["commenton"]; // Will use prepared statements, so no need for manual escape here if using bind_param correctly

// Insert into sender's table
$stmt1 = mysqli_prepare($connection, "INSERT INTO $m (message, sendto, type, date) VALUES (?, ?, 'send', ?)");
mysqli_stmt_bind_param($stmt1, "sis", $message, $receiver_id, $datetime);
mysqli_stmt_execute($stmt1);

// Insert into receiver's table
$stmt2 = mysqli_prepare($connection, "INSERT INTO $m1 (message, sendto, type, date) VALUES (?, ?, 'receive', ?)");
mysqli_stmt_bind_param($stmt2, "sis", $message, $user_id, $datetime);
mysqli_stmt_execute($stmt2);

$data = [
    "error" => "Message Sent",
];
echo json_encode($data);
?>
