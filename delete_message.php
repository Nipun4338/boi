<?php
include "security.php";
include "database/dbconfig.php";
$m = "";
$m = "zmessage_";
$m .= $_SESSION["user_id"];
$del = $_SESSION["receive"];
$query = "Delete from $m where sendto=$del";
$statement = $connection->prepare($query);
$statement->execute();
$error = "";
$error = '<p class="text-danger">Messages Deleted.</p>';
$data = [
    "error" => $error,
];
echo json_encode($data);
?>
