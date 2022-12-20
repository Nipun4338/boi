
<?php
include "security.php";
include "database/dbconfig.php";
$error = "";
$user = $_SESSION["user_id"];
$receiver = $_SESSION["receive"];
$m = "zmessage_";
$m .= $user;
$m1 = "zmessage_";
$m1 .= $receiver;

date_default_timezone_set("Asia/Dhaka");
$datetime = "";
$datetime = date("Y-m-d H:i:s");
$message1 = htmlspecialchars($_POST["commenton"]);

$sql2 = sprintf(
    "insert into $m(message,sendto,type,date)
values('%s','$receiver','send','$datetime')",
    mysqli_real_escape_string($link, $message1),
);
($result2 = mysqli_query($link, $sql2)) or die(mysqli_error($link));
$sql2 = sprintf(
    "insert into $m1(message,sendto,type,date)
values('%s','$user','receive','$datetime')",
    mysqli_real_escape_string($link, $message1),
);
($result2 = mysqli_query($link, $sql2)) or die(mysqli_error($link));
$error = '<p class="text-danger">Message Added.</p>';
$data = [
    "error" => $error,
];

echo json_encode($data);


?>
