<?php
include("security.php");
include('database/dbconfig.php');
$m="";
$m="zmessage_";
$m.=$_SESSION['user_id'];
$query = "Delete from $m";
$statement = $connection->prepare($query);
$statement->execute();
$error = '';
$error = '<p class="text-danger">Messages Deleted.</p>';
$data = array(
 'error'  => $error
);
echo json_encode($data);
?>
