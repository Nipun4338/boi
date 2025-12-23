<?php
include "../../includes/auth/security.php";
include "../../includes/config/dbconfig.php";

$user_id = $_SESSION["user_id"];
$receiver_id = $_SESSION["receive"];

$m = "zmessage_" . $user_id;

// Use prepared statement to delete messages with specific recipient
$stmt = mysqli_prepare($connection, "DELETE FROM $m WHERE sendto = ?");
mysqli_stmt_bind_param($stmt, "i", $receiver_id);

if (mysqli_stmt_execute($stmt)) {
    $data = ["error" => "Messages Deleted"];
} else {
    $data = ["error" => "Failed to delete messages"];
}

echo json_encode($data);
?>
